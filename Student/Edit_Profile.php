<?php
session_start();

if (!isset($_SESSION['student_email'])) {
    header("Location: login.php");
    exit();
}

include("../Database/db_connect.php");

$email = $_SESSION['student_email'];
$old_email = $_SESSION['student_email'];


$query = "SELECT * FROM Student WHERE email = '$email'";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

if (isset($_POST['save'])) {
    $full_Name = $_POST['full_Name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $city = $_POST['city'];
    $college = $_POST['college'];
    $degree = $_POST['degree'];
    $year = $_POST['year'];
    $cgpa = $_POST['cgpa'];

    $update_query = "UPDATE Student SET full_Name='$full_Name', email='$email', phone='$phone', 
    date_of_birth='$dob', city='$city', college='$college', degree='$degree', year='$year',
    cgpa='$cgpa' WHERE email='$old_email'";

    if (mysqli_query($conn, $update_query)) {
        $_SESSION['student_email'] = $email;
        echo "<script>alert('Profile updated successfully!'); window.location.href='Profile.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating profile: " . mysqli_error($conn) . "');</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit_Profile</title>
    <link rel="stylesheet" href="../CSS/Edit_Profile.css">
</head>

<body>
    <div class="edit-container">
        <h1 class="page-title">Edit Profile</h1>
        <p class="page-subtitle">
            Update your personal information
        </p>
        <form action="Edit_Profile.php" method="POST" enctype="multipart/form-data">

            <div class="card">
                <h2>Personal Information</h2>

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_Name" value="<?php echo $row['full_Name']; ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>">
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" value="<?php echo $row['phone']; ?>">
                </div>

                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" value="<?php echo $row['date_of_birth']; ?>">
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" value="<?php echo $row['city']; ?>">
                </div>
            </div>

            <div class="card">
                <h2>Education</h2>

                <div class="form-grid">

                    <div class="form-group">
                        <label>College</label>
                        <input type="text" name="college" value="<?php echo $row['college']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Degree</label>
                        <input type="text" name="degree" value="<?php echo $row['degree']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Year</label>
                        <input type="text" name="year" value="<?php echo $row['year']; ?>">
                    </div>

                    <div class="form-group">
                        <label>CGPA</label>
                        <input type="text" name="cgpa" value="<?php echo $row['cgpa']; ?>">
                    </div>
                </div>
            </div>

            <div class="card">

                <h2>Resume</h2>

                <div class="form-group">
                    <label>Resume (PDF)</label>
                    <input type="file" name="resume">

                    <p class="resume-note">Only PDF files are allowed. Maximum file size is 2MB.</p>

                </div>

            </div>

            <div class="button-group">
                <button class="save-btn" name="save">
                    Save Changes
                </button>

                <a href="Profile.php" class="cancel-btn">
                    Cancel
                </a>
            </div>
        </form>

    </div>
</body>

</html>