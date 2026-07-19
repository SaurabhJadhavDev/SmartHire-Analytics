<?php
session_start();
include("../Database/db_connect.php");

if(isset($_POST['login']))
{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if($email=="" || $password=="")
    {
        echo "<script>alert('Please fill all fields');</script>";
    }
    else
    {
        $query = "SELECT * FROM Recruiter
                  WHERE email='$email'
                  AND password='$password'";

        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)==1)
        {
            $row = mysqli_fetch_assoc($result);

            $_SESSION['recruiter_id'] = $row['recruiter_id'];
            $_SESSION['company_name'] = $row['Company_Name'];
            $_SESSION['recruiter_name'] = $row['recruiter_name'];

            echo "<script>
                alert('Login Successful');
                window.location='Recruiter_Dashboard.php';
            </script>";
        }
        else
        {
            echo "<script>
                alert('Invalid Email or Password');
            </script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Login</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/Recruiter_login.css">

</head>

<body>

    <div class="login-container">

        <h1>Create Recruiter Login</h1>

        <p class="login-message">Login to manage your job postings and applicants.</p>

        <form action="" method="POST">

            <div class="form-row">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your Email" required>
            </div>

            <div class="form-row">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="button-row">
                <button type="submit" name="login" class="login-btn">
                    Login
                </button>

                <a href="../Home/Choose_Login.html" class="back-btn">
                    Back
                </a>

            </div>





        </form>

        <p class="register-link">
            Don't have an account?
            <a href="Recruiter_Register.php">Register</a>
        </p>
    </div>

</body>

</html>