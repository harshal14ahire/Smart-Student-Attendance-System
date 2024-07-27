<?php
session_start();
if (isset($_POST['uname']) && isset($_POST['pass'])) {
    $host = "localhost";
    $username = "root"; // Change to your database username
    $password = ""; // Change to your database password
    $database = "dbharshal"; // Change to your database name
    $port = 3307; // Specify the port number

    // Create connection
    $conn = new mysqli($host, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS student_login (
                student_id INT PRIMARY KEY,
                student_name VARCHAR(20)
            );";
    if ($conn->query($sql) === TRUE) {
        echo "<br><h3>Table created successfully or already exists.</h3>";
    }

    // Insert data using prepared statements
    $sname = $_POST['uname'];
    $sid = (int)$_POST['pass']; // Cast to integer

    // Check if student ID already exists
    $stmt = $conn->prepare("SELECT * FROM student_login WHERE student_id = ?");
    $stmt->bind_param("i", $sid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['register_error_message'] = "Student ID already exists. Please choose a different ID.";
        header('Location: register_student1.php');
        exit;
    } else {
        $stmt = $conn->prepare("INSERT INTO student_login (student_id, student_name) VALUES (?, ?)");
        $stmt->bind_param("is", $sid, $sname);

        if ($stmt->execute() === TRUE) {
            $_SESSION['register_success_message'] = "<h3>Registration successful. Please log in.</h3>";
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['register_error_message'] = "<h3>Registration Failed: </h3>" . $stmt->error;
            header('Location: register_student.php');
            exit;
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
