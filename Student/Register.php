<?php

session_start();

include("../Database/db_connect.php");

$message = "";

if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        $message = "Please fill all the fields";
    }elseif(str_word_count($fullname) < 2){
        $message = "Full name must be at least 2 words";
    } elseif (strlen($password) < 8) {
        $message = "Password must be at least 8 character";
    } elseif ($password != $confirm_password) {
        $message = "Password do not match";
    } else {

        $check_email = "SELECT * FROM Student WHERE email = '$email'";
        $result = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($result) > 0) {
            $message = "Email already exists.";
        } else {
            $insert_query = "INSERT INTO Student(full_Name, email,Password) VALUES ('$fullname', '$email', '$password')";

            $insert_result = mysqli_query($conn, $insert_query);

            if($insert_result){
                $_SESSION['student_email'] = $email;
                $_SESSION['student_name'] = $fullname;

                header("Location:Student_Dashboard.php");
                exit();
            }else{
                $message = "Registration Failed.";
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
    <title>Student Registration</title>
    <link rel="stylesheet" href="../CSS/Register.css">
</head>

<body>

    <div class="register-container">

        <h1>Create Student Account</h1>
        <p>Join <span class="highlight">CareerConnect</span> and start your career journey.</p>

        <?php

        if ($message != "") {
            echo "<p style='color:red; text-align:center;'> $message </p>";
        }

        ?>

        <form action="" method="POST">

            <div class="form-row">
                <label>Full Name:</label>
                <input type="text" name="fullname" placeholder="Enter your full name" required>
            </div>

            <div class="form-row">
                <label>Email Address:</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-row">
                <label>Password:</label>
                <input type="password" name="password" placeholder="Create password" required>
            </div>

            <div class="form-row">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>

            <input type="submit" name="register" value="Create Account" class="register-btn">

        </form>

        <p class="login-link">
            Already have an account?

            <a href="login.php"> Login</a>
        </p>
    </div>
</body>

</html>
