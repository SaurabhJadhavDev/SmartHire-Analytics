<?php
session_start();

include("../Database/db_connect.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$query = "SELECT * FROM Job ORDER BY posted_date DESC";

$result = mysqli_query($conn, $query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs</title>
    <link rel="stylesheet" href="../CSS/Jobs.css">
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

    <section class="search-section">
        <h2>Find Your Dream Job</h2>

        <div class="search-box">
            <input type="text" placeholder="Search Jobs">
            <button>Search</button>
        </div>

        <div class="filter">
            <label for="location">Location</label>
            <select id="location">
                <option>Location</option>
                <option>Pune</option>
                <option>Mumbai</option>
            </select>

            <label for="jobType">Job Type</label>
            <select id="jobType">
                <option>Job type</option>
                <option>Intership</option>
                <option>Full Time</option>
            </select>

            <label for="salary">Salary</label>
            <select id="salary">
                <option>Salary</option>
                <option>$10k - $20k</option>
                <option>$20k -$30k</option>
            </select>
        </div>
    </section>

    <section class="jobs">

        <?php

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>

                <div class="job-card">

                    <h3><?php echo $row['job_title']; ?></h3>

                    <p>
                        <strong>Company:</strong>
                        <?php echo $row['company_name']; ?>
                    </p>

                    <p>
                        <strong>Location:</strong>
                        <?php echo $row['location']; ?>
                    </p>

                    <p>
                        <strong>Salary:</strong>
                        <?php echo $row['salary']; ?>
                    </p>

                    <p>
                        <?php echo $row['job_description']; ?>
                    </p>

                    <a href="Apply_Job.php?job_id=<?php echo $row['job_id']; ?>" class="apply-btn">
                        Apply Now
                    </a>

                </div>

                <?php
            }

        } else {

            echo "<h3>No Jobs Available</h3>";
        }
        ?>
    </section>

</body>

</html>