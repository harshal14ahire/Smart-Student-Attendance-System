<?php
session_start();

if (isset($_POST['admin_id']) && isset($_POST['admin_name']) && isset($_POST['admin_email']) && isset($_POST['admin_department']) && isset($_POST['admin_pass'])) {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "dbharshal";
    $port = 3307;

    // Create connection
    $conn = new mysqli($host, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS admin_login (
                Admin_ID INT PRIMARY KEY,
                Admin_EmailID VARCHAR(50),
                Admin_Department VARCHAR(50),
                Admin_Name VARCHAR(50),
                Admin_Password VARCHAR(255)
            )";
    if ($conn->query($sql) === TRUE) {
        echo "<br><h3>Table created successfully or already exists.</h3>";
    }

    $admin_id = (int)$_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_department = $_POST['admin_department'];
    $admin_pass = password_hash($_POST['admin_pass'], PASSWORD_BCRYPT); // Hash the password

    // Check if admin email already exists
    $stmt = $conn->prepare("SELECT * FROM admin_login WHERE admin_email = ?");
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['register_error_message'] = "Admin email already exists. Please choose a different email.";
        header('Location: register_admin1.php');
        exit;
    } else {
        $stmt = $conn->prepare("INSERT INTO admin_login (admin_id, admin_name, admin_email, admin_department, admin_password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $admin_id, $admin_name, $admin_email, $admin_department, $admin_pass);

        if ($stmt->execute() === TRUE) {
            $_SESSION['register_success_message'] = "Registration successful. Please log in.";
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['register_error_message'] = "Registration Failed: " . $stmt->error;
            header('Location: register_admin1.php');
            exit;
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    $_SESSION['register_error_message'] = "Please fill in all the fields.";
    header('Location: register_admin1.php');
    exit;
}
?>
