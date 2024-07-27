<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
        .register-link {
            text-align: center;
            margin-top: 15px;
        }
        .register-link a {
            color: #007bff;
            text-decoration: none;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php
    session_start();
    if (isset($_SESSION['error_message'])) {
        echo "<p class='error-message'>" . $_SESSION['error_message'] . "</p>";
        unset($_SESSION['error_message']);
    }
    if (isset($_SESSION['register_success_message'])) {
        echo "<p style='color:green;'>" . $_SESSION['register_success_message'] . "</p>";
        unset($_SESSION['register_success_message']);
    }
    ?>
    <form action="Studentlogin.php" method="post">
        <h2><center>Student Login</center></h2>
        <div class="input-box">
            <input type="text" placeholder="Student Name" name="uname" required>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Student ID" name="pass" required>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="register-link">
        Don't have an account? 
        <a href="register_student1.php">Register as Student</a> 
        <div>
    </form>

    <form action="Adminlogin.php" method="post">
        <h2>Admin Login</h2>
        <div class="input-box">
            <input type="text" placeholder="Admin Id" name="admin_Id" required>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Admin Password" name="admin_pass" required>
        </div>
        <button type="submit" class="btn" name="login">Login</button>
    </form>

    <div class="register-link">
        Don't have an account? 
       
        <a href="register_admin1.php">Register as Admin</a>
    </div>
</div>
</body>
</html>
