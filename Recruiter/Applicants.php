<?php

session_start();
include("../Database/db_connect.php");

$recruiter_id = $_SESSION['recruiter_id'];

$query = "SELECT Application.application_id,Application.status,Application.application_date,
Student.student_id,Student.full_Name,Student.email,Student.phone,Student.college,Student.degree,Student.resume,
Job.job_title FROM Application INNER JOIN Student ON Application.student_id = Student.student_id
INNER JOIN Job ON Application.job_id = Job.job_id WHERE Application.recruiter_id = '$recruiter_id'
ORDER BY Job.job_title,Application.application_date DESC";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants</title>
    <link rel="stylesheet" href="../CSS/Recruiter_Application.css">
    <link rel="stylsheet" href="../CSS/Recruiter_Dashboard.css">
</head>

<body>
    <header>
        <header>
            <h1>CareerConnect Recruiter</h1>

            <nav>
                <a href="Recruiter_Dashboard.php">Home</a>
                <a href="Post_Jobs.php">Post Job</a>
                <a href="Applicants.html">Applicants</a>
                <a href="Company_Profile.php">Company Profile</a>
                <a href="../Home/index.html">Logout</a>
            </nav>
        </header>
    </header>

    <section class="application-header">
        <h2>Applications</h2>
        <div class="search-box">
            <input type="text" placeholder="Search Applicant">
            <button>Search</button>
        </div>
    </section>
    <div class="title">
        <p>💼Software Developer Intern </p>
        <span>10 Applicants </span>
    </div>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {

        ?>

        <div class="application-card">
            <span class="status">
                <?php echo $row['status']; ?>
            </span>

            <h3>
                <?php echo $row['full_Name']; ?>
            </h3>

            <p>
                <strong>Applied For:</strong>
                <?php echo $row['job_title']; ?>
            </p>

            <p>
                <strong>Degree:</strong>
                <?php echo $row['degree']; ?>
            </p>

            <p>
                <strong>College:</strong>
                <?php echo $row['college']; ?>
            </p>

            <p>
                <strong>Email:</strong>
                <?php echo $row['email']; ?>
            </p>

            <p>
                <strong>Phone:</strong>
                <?php echo $row['phone']; ?>
            </p>

            <div class="button-row">
                <a href="View_Student.php? student_id=<?php echo $row['student_id']; ?>">
                    <button class="view-btn">View Profile</button>
                </a>

                <a href="../Resume/<?php echo $row['resume']; ?>" target="_blank">
                    <button class="resume-btn">Resume</button>
                </a>

                <a href="Shortlist.php? application_id=<?php echo $row['application_id']; ?>">
                    <button class="shortlist-btn">Shortlist</button>
                </a>

                <a href="Reject.php?application_id=<?php echo $row['application_id']; ?>">
                    <button class="reject-btn">Reject</button>
                </a>
            </div>
        </div>

        <?php

    }

    ?>

</body>

</html>