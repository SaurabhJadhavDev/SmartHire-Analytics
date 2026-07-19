<?php
session_start();
include("../Database/db_connect.php");

if (!isset($_SESSION['recruiter_id'])) {
    header("Location: Recruiter_Login.php");
    exit();
}

$recruiter_id = $_SESSION['recruiter_id'];

$query = "SELECT * FROM Recruiter
          WHERE recruiter_id='$recruiter_id'";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

$job_query = "SELECT COUNT(*) AS total_jobs
              FROM Job
              WHERE recruiter_id='$recruiter_id'";

$job_result = mysqli_query($conn, $job_query);

if (!$job_result) {
    die("SQL Error: " . mysqli_error($conn));
}

$job_row = mysqli_fetch_assoc($job_result);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comapny_Profile</title>
    <link rel="stylesheet" href="../CSS/Company_Profile.css">
    <link rel="stylesheet" href="../CSS/Recruiter_Dashboard.css">
</head>

<body>
    <header>
        <h1>CareerConnect Recruiter</h1>

        <nav>
            <a href="Recruiter_Dashboard.php">Home</a>
            <a href="Post_Jobs.html">Post Job</a>
            <a href="Applicants.html">Applicants</a>
            <a href="Comapny_Profile.php">Company Profile</a>
            <a href="../Home/index.html">Logout</a>
        </nav>
    </header>

    <section class="profile">
        <h2>🏢 Comapny Profile</h2>

        <div class="logo-container">

            <?php
            if (!empty($row['company_logo'])) {
                ?>
                <img src="../Uploads/<?php echo $row['company_logo']; ?>" width="150">
                <?php
            } else {
                ?>
                <p>No Company Logo</p>
                <?php
            }
            ?>

        </div>
        <div class="card">

            <p><strong>Company:</strong> <?php echo $row['company_name']; ?></p>
            <p><strong>Industry:</strong><?php echo $row['industry']; ?></p>
            <p><strong>Email:</strong><?php echo $row['email']; ?></p>
            <p><strong>Phone:</strong><?php echo $row['phone']; ?></p>
            <p><strong>Website:</strong><?php echo $row['website']; ?></p>
            <p><strong>Location:</strong><?php echo $row['location']; ?></p>
        </div>

        <div class="card">
            <h3>Company Statistics</h3>

            <p><strong>Established:</strong><?php echo $row['established']; ?></p>
            <p><strong>Employees:</strong><?php echo $row['employees']; ?></p>
            <p><strong>Open Jobs:</strong> <?php echo $job_row['total_jobs']; ?></p>
        </div>
        <div class="edit-container">
            <a href="Edit_Company_Profile.php" class="edit-btn">
                Edit Profile
            </a>
        </div>
        <div class="back-container">
            <a href="Recruiter_Dashboard.php" class="back-btn">
                Back
            </a>
        </div>
    </section>
</body>

</html>