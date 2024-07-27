<?php
session_start();

if (isset($_POST['admin_Id']) && isset($_POST['admin_pass'])) {
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

    $admin_id = (int)$_POST['admin_Id'];
    $admin_pass = $_POST['admin_pass'];

    // Prepare the statement to get the stored password hash
    $stmt = $conn->prepare("SELECT Admin_Name, Admin_Password FROM admin_login WHERE Admin_ID = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password_hash = $row['Admin_Password'];
        echo "Stored Password Hash: " . $stored_password_hash . "<br>";

        // Verify the password
        if (password_verify($admin_pass, $stored_password_hash)) {
            $_SESSION['Admin_Name'] = $row['Admin_Name'];
            echo "Password verified. Redirecting to ViewAttendance.php...<br>";
            header('Location: ViewAttendance.php');
            exit();
        } else {
            echo "Password verification failed.<br>";
            $_SESSION['error_message'] = "<h4>Invalid Admin ID or Admin Password.<h4>";
            header('Location: index.php');
            exit();
        }
    } else {
        echo "Admin ID not found.<br>";
        $_SESSION['error_message'] = "<h4>Invalid Admin ID or Admin Password.<h4>";
        header('Location: index.php');
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to login page if accessed directly
    echo "Redirecting to login page as accessed directly.<br>";
    header('Location: index.php');
    exit();
}
?>
