<?php
include("../Database/db_connect.php");

$student_id = $_GET['student_id'];

$query = "SELECT * FROM Student WHERE student_id='$student_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("Student not found.");
}

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="../CSS/Student_Profile.css">
</head>

<body>

    <div class="profile-card">

        <h2><?php echo $row['full_Name']; ?></h2>

        <p><b>Email:</b> <?php echo $row['email']; ?></p>

        <p><b>Phone:</b> <?php echo $row['phone']; ?></p>

        <p><b>College:</b> <?php echo $row['college']; ?></p>

        <p><b>Degree:</b> <?php echo $row['degree']; ?></p>

        <p><b>CGPA:</b> <?php echo $row['cgpa']; ?></p>

        <p><b>Year:</b> <?php echo $row['year']; ?></p>

        <p><b>About:</b> <?php echo $row['about_me']; ?></p>

        <a href="../Uploads/<?php echo $row['resume']; ?>" target="_blank" class="resume-btn">
            View Resume
        </a>

        <a href="Applicants.php" class="back-btn">
            Back
        </a>

    </div>
</body>

</html>