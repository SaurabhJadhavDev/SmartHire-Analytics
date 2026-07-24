<?php

session_start();

include("../Database/db_connect.php");

$job_id = $_GET['job_id'];

$query = "
SELECT * FROM Job
WHERE job_id='$job_id'";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Job not found.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Job</title>
    <link rel="stylesheet" href="../CSS/Admin_View_Job.css">
</head>

<body>
    <div class="container">

        <h2>Job Details</h2>

        <div class="job-card">
            <div class="job-info">

                <p><strong>Company:</strong> <?php echo $row['company_name']; ?></p>

                <p><strong>Job Title:</strong> <?php echo $row['job_title']; ?></p>

                <p><strong>Location:</strong> <?php echo $row['location']; ?></p>

                <p><strong>Job Type:</strong> <?php echo $row['job_type']; ?></p>

                <p><strong>Salary:</strong> <?php echo $row['experience']; ?></p>

                <p><strong>Experience:</strong> <?php echo $row['qualification']; ?></p>

                <p><strong>Qualification:</strong> <?php echo $row['application_deadline']; ?></p>

                <p><strong>Application Deadline:</strong><?php echo $row['application_deadline']; ?></p>

                <p><strong>Posted Date:</strong> <?php echo $row['posted_date']; ?></p>
            </div>
        </div>
        <div class="description-card">

            <h3>Required Skills</h3>

            <p><?php echo nl2br($row['required_skills']); ?></p>
        </div>

        <div class="description-card">
            <h3>Job Description</h3>
            <p><?php echo nl2br($row['job_description']); ?></p>
        </div>

        <div class="button-group">
            <a href="Manage_Jobs.php" class="back-btn">
                Back
            </a>

            <a href="Delete_Job.php?job_id=<?php echo $row['job_id']; ?>" class="delete-btn"
                onclick="return confirm('Delete this job?');">
                Delete Job
            </a>
        </div>
    </div>
</body>

</html>