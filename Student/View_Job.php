<?php
session_start();
include("../Database/db_connect.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();

}

if (!isset($_GET['job_id'])) {
    header("Location: Application.php");
    exit();
}

$job_id = $_GET['job_id'];

$query = "SELECT * FROM Job WHERE job_id='$job_id'";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

$student_id = $_SESSION['student_id'];

$status_query = "SELECT status FROM Application WHERE job_id= '$job_id'
AND student_id='$student_id'";

$status_result = mysqli_query($conn, $status_query);

$application = mysqli_fetch_assoc($status_result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Job</title>
    <link rel="stylesheet" href="../CSS/Jobs.css">
    <link rel="stylesheet" href="../CSS/View_job.css">
</head>

<body>
    <header>
        <h1>CareerConnect</h1>

        <nav>
            <a href="Student_Dashboard.php">Home</a>
            <a href="Jobs.php">Jobs</a>
            <a href="Application.php">My Application</a>
            <a href="Profile.php">Profile</a>
            <a href="Logout.php">Logout</a>
        </nav>
    </header>

    <div class="job-container">
        <div class="job-card">

            <h2><?php echo $row['job_title']; ?></h2>

            <p><strong>Company:</strong>
                <?php echo $row['company_name']; ?></p>

            <p><strong>Location:</strong>
                <?php echo $row['location']; ?></p>

            <p><strong>Job Type:</strong>
                <?php echo $row['job_type']; ?></p>

            <p><strong>Salary:</strong>
                <?php echo number_format($row['salary']); ?></p>

            <p><strong>Qualification:</strong>
                <?php echo $row['qualification']; ?></p>

            <p><strong>Experience:</strong>
                <?php echo $row['experience']; ?></p>

            <p>
                <strong>Required Skills:</strong>
                <?php echo $row['required_skills']; ?>
            </p>

            <p>
                <strong>Job Description:</strong>
                <?php echo $row['job_description']; ?>
            </p>
            <p><strong>Application Deadline:</strong>
                <?php echo date("d M Y", strtotime($row['application_deadline'])); ?>

            <p><strong>Posted On:</strong>
                <?php echo date("d M Y, h:i A", strtotime($row['posted_date'])); ?>

                <br>

            <p>
                <strong>Application Status:</strong>

                <?php echo $application['status']; ?>
            </p>

            <a href="Application.php" class="back-btn">
                Back
            </a>

        </div>
    </div>

</body>

</html>