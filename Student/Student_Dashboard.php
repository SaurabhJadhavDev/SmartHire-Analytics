<?php
session_start();

include("../Database/db_connect.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$job_query = "SELECT * FROM Job Order BY posted_date DESC";

$job_result = mysqli_query($conn, $job_query);

$student_name = $_SESSION['student_name'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../CSS/Studetnt_Dashboard.css">
</head>

<body>
    <header>
        <h1>CareerConnect</h1>

        <nav>
            <a href="Student_Dashboard.php">Home</a>
            <a href="Jobs.php">Jobs</a>
            <a href="Application.php">My Applications</a>
            <a href="Profile.php">Profile</a>
            <a href="Logout.php">Logout</a>
        </nav>
    </header>

    <section class="welcome">
        <h2>Welcome <?php echo htmlspecialchars($student_name); ?>👋🏻</h2>

        <p>
            Search and apply for jobs posting by recruters
        </p>
    </section>

    <section class="jobs">
        <h2>Available Jobs</h2>

        <div class="job-container">
            <?php
            if (mysqli_num_rows($job_result) > 0) {
                while ($job = mysqli_fetch_assoc($job_result)) {
                    ?>

                    <div class="job-card">

                        <h3><?php echo $job['job_title']; ?></h3>

                        <p>
                            <strong>Company:</strong>
                            <?php echo $job['company_name']; ?>
                        </p>

                        <p>
                            <strong>Location:</strong>
                            <?php echo $job['location']; ?>
                        </p>

                        <p>
                            <strong>Job Type:</strong>
                            <?php echo $job['job_type']; ?>
                        </p>

                        <p>
                            <strong>Salary:</strong>
                            <?php echo $job['salary']; ?>
                        </p>

                        <p>
                            <strong>Experience:</strong>
                            <?php echo $job['experience']; ?>
                        </p>

                        <p>
                            <strong>Qualification:</strong>
                            <?php echo $job['qualification']; ?>
                        </p>

                        <a href="Apply_Job.php?job_id=<?php echo $job['job_id']; ?>" class="apply-btn">
                            Apply
                        </a>

                    </div>



                    <?php


                }
            } else {
                echo "<h3>No Jobs Available</h3>";
            }
            ?>

        </div>
    </section>
</body>

</html>