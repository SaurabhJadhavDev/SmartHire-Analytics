<?php
include("../Database/db_connect.php");


if (isset($_POST['register'])) {
    $company_name = trim($_POST['company_name']);
    $recruiter_name = trim($_POST['recruiter_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($company_name == "" || $recruiter_name == "" || $email == "" || $password == "" || $confirm_password == "") {
        echo "<script>alert('Please fill all fields');</script>";
    } elseif ($password != $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        $check = "SELECT * FROM Recruiter WHERE email='$email'";
        $result = mysqli_query($conn, $check);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already exists');</script>";
        } else {
            $insert = "INSERT INTO Recruiter
            (Company_Name,recruiter_name,email,password,created_at)

            VALUES

            ('$company_name',
            '$recruiter_name',
            '$email',
            '$password',
            NOW())";

            if (mysqli_query($conn, $insert)) {
                echo "<script>
                alert('Registration Successful');
                window.location='Recruiter_Dashboard.php';
                </script>";
            } else {
                echo mysqli_error($conn);
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
    <title>Recruiter Register</title>
    <link rel="stylesheet" href="../CSS/common.css">
    <link rel="stylesheet" href="../CSS/Register.css">
    <link rel="stylesheet" href="../CSS/Recruiter.css">
</head>

<body>
    <div class="register-container">

        <h1>Create Recruiter Account</h1>

        <p>
            Join CareerConnect and start hiring talented candidates
        </p>

        <form action="" method="POST">

            <div class="form-row">
                <label>Company Name</label>
                <input type="text" name="company_name" placeholder="Enter your company name" required>
            </div>

            <div class="form-row">
                <label>Recruiter Name</label>
                <input type="text" name="recruiter_name" placeholder="Enter recruiter name" required>
            </div>

            <div class="form-row">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your Email" required>
            </div>
            <div class="form-row">
                <label>Password</label>

                <input type="password" name="password" placeholder="Create Password" required>
            </div>

            <div class="form-row">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>

            <button type="submit" name="register" class="register-btn">
                Create Recruiter Account
            </button>

            <a href="../Home/Choose_Register.html" class="back-btn">
                Back
            </a>
        </form>
        <p>
            Already have an account?

            <a href="Recruiter_Login.php">
                Login
            </a>
        </p>
    </div>
</body>

</html>