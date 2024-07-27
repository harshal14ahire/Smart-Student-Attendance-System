<?php
// Database connection settings
$host = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$database = "dbharshal"; // Change to your database name

// Create a connection to the MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS Error_student_attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(255),
    student_id INT,
    student_class VARCHAR(255),
    lecture_subject VARCHAR(255),
    attendance_date DATE,
    attendance_time TIME
);";

if ($conn->query($sql) === TRUE) {
    echo "<h1>Table created successfully or already exists.</h1>";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = $_POST['studentName'];
    $studentID = $_POST['studentID'];
    $studentClass = $_POST['classname'];
    $lectureSubject = $_POST['lectureSubject'];

    // Insert data into the database
    $insertSql = "INSERT INTO Error_student_attendance (student_name, student_id, student_class, lecture_subject, attendance_date, attendance_time)
         VALUES ('$studentName', $studentID, '$studentClass', '$lectureSubject', CURDATE(), CURTIME())";

    if ($conn->query($insertSql) === TRUE) {
        echo "<h1>Attendance recorded successfully.</h1>";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>