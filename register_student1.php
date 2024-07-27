<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <style>
        .wrapper {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .input-box {
            margin-bottom: 15px;
        }
        .input-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php
    session_start();
    if (isset($_SESSION['register_error_message'])) {
        echo "<p style='color:red;'>" . $_SESSION['register_error_message'] . "</p>";
        unset($_SESSION['register_error_message']);
    }
    ?>
    <form action="register_student_backend.php" method="post">
        <h3>Student Registration</h3>
        <div class="input-box">
            <input type="text" placeholder="Student Name" name="uname" required>
        </div>
        <div class="input-box">
            <input type="text" placeholder="Student ID" name="pass" required>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>
    <div class="login-link">
        Already have an account? <a href="index.php">Login</a>
    </div>
</div>
</body>
</html>
