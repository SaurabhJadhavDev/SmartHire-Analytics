<?php
session_start();

include("../Database/db_connect.php");

if(isset($_POST['login'])){
    $admin_id = mysqli_real_escape_string($conn,$_POST['admin_id']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $query = "
    SELECT * FROM 
    Admin WHERE admin_id='$admin_id'
    AND password='$password'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result)== 1){
        $row = mysqli_fetch_assoc($result);

        $_SESSION['admin_id'] = $row['admin_id'];

        header("Location: Admin_Dashboard.php");
        exit();
    }
    else{
        echo "<script>alert('Invalid Admin ID or Password'); </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/Admin.css">
</head>

<body>

    <div class="login-container">

        <h1>Admin Login</h1>

        <p class="login-message">
            Login to manage students,recruiters and jobs
        </p>

        <form method="POST">
            <div class="form-row">
                <label>Admin ID</label>
                <input type="text" name="admin_id" placeholder="Enter Admin ID">
            </div>

            <div class="form-row">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password">
            </div>

            <div class="button-row">

                <button type="submit" name="login" class="login-btn admin-btn">
                    Login
                </button>

                <a href="../Home/Choose_Login.html">
                    <button type="button" class="login-btn back-btn">
                        Back
                    </button>
                </a>
            </div>
        </form>

</div>

</body>

</html>