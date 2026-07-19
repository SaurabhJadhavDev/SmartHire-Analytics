<?php
session_start();
include("../Database/db_connect.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: Student_Login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$query = "SELECT
            Application.application_id,
            Application.application_date,
            Application.status,
            Job.job_id,
            Job.job_title,
            Job.company_name,
            Job.location
          FROM Application
          INNER JOIN Job
          ON Application.job_id = Job.job_id
          WHERE Application.student_id='$student_id'
          AND Application.status!='Withdrawn'
          ORDER BY Application.application_date DESC";

$result = mysqli_query($conn, $query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Application</title>
    <link rel="stylesheet" href="../CSS/Application.css">
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

    <section class="applications">
        <h2>My Application</h2>
        <p>Track all the jobs you have applied for</p>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="application-card">

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
                        <strong>Applied On:</strong>
                        <?php echo $row['application_date']; ?>
                    </p>

                    <p>
                        <strong>Status:</strong>
                        <?php echo $row['status']; ?>
                    </p>

                    <a href="View_Job.php?job_id=<?php echo $row['job_id']; ?>">
                        <button>View Details</button>
                    </a>

                    <a href="Withdraw_Application.php?application_id=<?php echo $row['application_id']; ?>" class="withdraw-btn"
                        onclick="return confirm('Are you sure you want to withdraw this application?');">
                        Withdraw
                    </a>

                </div>

                <?php
            }
        } else {
            echo "<h3>No Applications Yet</h3>";
        }
        ?>
    </section>
</body>

</html>