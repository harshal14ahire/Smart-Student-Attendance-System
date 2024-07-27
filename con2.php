<?php
$host = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$database = "dbharshal"; // Change to your database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS new_student_attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(255),
    student_id INT,
    student_class VARCHAR(255),
    lecture_subject VARCHAR(255),
    attendance_date DATE,
    attendance_time TIME
);";

if ($conn->query($sql) === TRUE) {
    echo "<br><h3>Table created successfully or already exists.</h3>";
} else {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = $conn->real_escape_string($_POST['studentName']);
    $studentID = intval($_POST['studentID']);
    $studentClass = $conn->real_escape_string($_POST['classname']);
    $lectureSubject = $conn->real_escape_string($_POST['lectureSubject']);

    $insertSql = "INSERT INTO new_student_attendance (student_name, student_id, student_class, lecture_subject, attendance_date, attendance_time)
         VALUES ('$studentName', $studentID, '$studentClass', '$lectureSubject', CURDATE(), CURTIME())";

    if ($conn->query($insertSql) === TRUE) {
        echo "Attendance recorded successfully.";
    } else {
        echo "Error recording attendance: " . $conn->error;
    }
}

$conn->close();
?>
