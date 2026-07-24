<?php

session_start();

include("../Database/db_connect.php");

$student_id = $_GET['student_id'];

$query = "
SELECT * FROM Student WHERE student_id='$student_id'";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student</title>
    <link rel="stylesheet" href="../CSS/Admin_View_Student.css">
</head>

<body>
    <div class="container">

        <h2>Student Details</h2>

        <div class="student-card">

            <div class="student-info">

                <p><strong>Name:</strong> <?php echo $row['full_Name']; ?></p>

                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>

                <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>

                <p><strong>College:</strong> <?php echo $row['college']; ?></p>

                <p><strong>Degree:</strong> <?php echo $row['degree']; ?></p>

                <p><strong>Year:</strong> <?php echo $row['year']; ?></p>

                <p><strong>CGPA:</strong> <?php echo $row['cgpa']; ?></p>

                <p><strong>City:</strong> <?php echo $row['city']; ?></p>

            </div>

        </div>

        <div class="about-card">

            <h3>About Me</h3>

            <p><?php echo $row['about_me']; ?></p>

        </div>

        <div class="button-group">

            <?php
            if (!empty($row['resume'])) {
                ?>

                <a href="../Uploads/<?php echo $row['resume']; ?>" target="_blank" class="resume-btn">
                    View Resume
                </a>

                <?php
            } else {
                ?>

                <p class="no-resume">No Resume Uploaded</p>

                <?php
            }
            ?>

            <a href="Manage_Students.php" class="back-btn">
                Back
            </a>

        </div>

    </div>
</body>

</html>