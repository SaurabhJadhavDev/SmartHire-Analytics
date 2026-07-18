<?php
session_start();

if(!isset($_SESSION['student_email'])){
    header("Location: login.php");
    exit();
}   

include("../Database/db_connect.php");

$email = $_SESSION['student_email'];

$query = "SELECT * FROM Student WHERE email = '$email'";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="../CSS/Jobs.css">
    <link rel="stylesheet" href="../CSS/Profile.css">
</head>

<body>
    <header>
        <h1>CareerConnect</h1>

        <nav>
            <a href="Student_Dashboard.php">Home</a>
            <a href="Jobs.html">Jobs</a>
            <a href="Application.html">My Applications</a>
            <a href="Profile.php">Profile</a>
            <a href="Logout.php">Logout</a>
        </nav>
    </header>

    <section class="profile">

        <div class="profile-header">

            <h2>👤 My Profile</h2>

            <a href="Edit_Profile.php" class="edit-profile-btn">
                <button>Edit Profile</button>
            </a>
        </div>

        <div class="profile-card">

            <h3>Personaly Information</h3>

            <p><strong>Full Name:</strong><?php echo $row['full_Name']; ?></p>

            <p><strong>Email:</strong><?php echo $row['email']; ?></p>
            <p><strong>Phone:</strong><?php echo $row['phone']; ?></p>
            <p><strong>Date of Birth:</strong><?php echo $row['date_of_birth']; ?></p>
            <p><strong>City:</strong><?php echo $row['city']; ?></p>
        </div>

        <div class="profile-card">
            <h3>Education</h3>

            <p><strong>Collage:</strong><?php echo $row['college']; ?></p>
            <p><strong>Degree:</strong><?php echo $row['degree']; ?></p>
            <p><strong>Year:</strong><?php echo $row['year']; ?></p>
            <p><strong>CGPA:</strong><?php echo $row['cgpa']; ?></p>
        </div>

        <div class="profile-card">
            <h3>Skills</h3>

            <ul>
                <li>No Skills Added</li>
            </ul>
        </div>

        <div class="profile-card">
            <h3>Courses & Certifications</h3>

            <ul>
                <li>No Courses Added</li>
            </ul>
        </div>

        <div class="profile-card">
            <h3>Resume</h3>
            <p>No Resume Uploaded</p>
        </div>

        <div class="profile-card">
            <h3>About Me</h3>
            <p>No Description Added</p>
        </div>
    </section>
</body>

</html>