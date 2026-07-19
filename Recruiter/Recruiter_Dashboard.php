<?php
session_start();

include("../Database/db_connect.php");

if (!isset($_SESSION['recruiter_id'])) {
    header("Location: Recruiter_Login.php");
    exit();
}

$recruiter_id = $_SESSION['recruiter_id'];
$recruiter_name = $_SESSION['recruiter_name'];

$recruiter_name = $_SESSION['recruiter_name'];

$active_query = "SELECT COUNT(*) AS total_jobs
                 FROM Job
                 WHERE recruiter_id='$recruiter_id'";

$active_result = mysqli_query($conn, $active_query);

$active_row = mysqli_fetch_assoc($active_result);

$job_query = "SELECT *
              FROM Job
              WHERE recruiter_id='$recruiter_id'
              ORDER BY posted_date DESC
              LIMIT 2";

$job_result = mysqli_query($conn, $job_query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Dashboard</title>
    <link rel="stylesheet" href="../CSS/Recruiter_Dashboard.css">
</head>

<body>
    <header>
        <h1>CareerConnect Recruiter</h1>

        <nav>
            <a href="Recruiter_Dashboard.php">Home</a>
            <a href="Post_Jobs.php">Post Job</a>
            <a href="Applicants.html">Applicants</a>
            <a href="Company_Profile.php">Company Profile</a>
            <a href="/Home/index.html">Logout</a>
        </nav>
    </header>

    <section class="welcome">

        <h2> Welcome <?php echo htmlspecialchars($recruiter_name); ?>👋🏻</h2>

        <p>
            Manage your job postings and hire talented students.
        </p>

    </section>

    <section class="summary">
        <div class="summary-card">
            <h3><?php echo $active_row['total_jobs']; ?></h3>
            <p>Active Jobs</p>
        </div>

        <div class="summary-card">
            <h3>15</h3>
            <p>Shortlisted Students</p>
        </div>
    </section>

    <section class="jobs">
        <h2>Recent Job Posting</h2>

        <?php
        if (mysqli_num_rows($job_result) > 0) {
            while ($job = mysqli_fetch_assoc($job_result)) {
                ?>

                <div class="job-card">

                    <h3><?php echo $job['job_title']; ?></h3>

                    <p><strong>Location:</strong>
                        <?php echo $job['location']; ?>
                    </p>

                    <p><strong>Job Type:</strong>
                        <?php echo $job['job_type']; ?>
                    </p>

                    <p><strong>Salary:</strong>
                        <?php echo $job['salary']; ?>
                    </p>

                    <button>View Applicants</button>

                </div>

                <?php
            }
        } else {
            echo "<p>No Jobs Posted Yet.</p>";
        }
        ?>

        <div class="post-btn-container">
            <a href="Post_Jobs.php" class="post-btn">
                + Post New Job
            </a>
        </div>

    </section>
</body>

</html>