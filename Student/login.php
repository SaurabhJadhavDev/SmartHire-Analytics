<?php
session_start();

include("../Database/db_connect.php");

$message = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $message = "Please fill all the fields";
    } else {
        $check_email = "SELECT * FROM Student WHERE email = '$email'";

        $result = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($result) == 0) {
            $message = "Email does not exist.";
        } else {
            $row = mysqli_fetch_assoc($result);

            if ($password == $row['Password']) {

                $_SESSION['student_id'] = $row['student_id'];
                $_SESSION['student_email'] = $row['email'];
                $_SESSION['student_name'] = $row['full_Name'];

                header("Location: Student_Dashboard.php");
                exit();
            } else {
                $message = "Incorrect password.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/login.css">
</head>

<body>
    <div class="login-container">
        <h1>Welcome Back</h1>

        <p class="login-message">Login to continue your career journey</p>

        <?php

        if ($message != "") {
            echo "<p style='color:red; text-align: center;'>$message </p>";
        }

        ?>

        <form action="" method="POST">

            <div class="form-row">

                <label>Email:</label>

                <input type="email" name="email" placeholder="Enter your Email">
            </div>

            <div class="form-row">
                <label>Password:</label>

                <input type="password" name="password" placeholder="Enter your password">
            </div>

            <div class="button-row">
                <button type="submit" name="login" class="login-btn">Login</button>
            </div>
        </form>

        <p>
            Don't have an account?

            <a href="Register.php">Register</a>
        </p>
    </div>
</body>

</html>