<?php
session_start();

include("../Database/db_connect.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: Student_Login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$search = "";
$location = "";
$job_type = "";
$salary = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

if (isset($_GET['location'])) {
    $location = mysqli_real_escape_string($conn, $_GET['location']);
}

if (isset($_GET['job_type'])) {
    $job_type = mysqli_real_escape_string($conn, $_GET['job_type']);
}

if (isset($_GET['salary'])) {
    $salary = mysqli_real_escape_string($conn, $_GET['salary']);
}

$query = "SELECT * FROM Job";

$conditions = [];

if ($search != "") {
    $conditions[] = "(job_title LIKE '%$search%'
                    OR company_name LIKE '%$search%'
                    OR location LIKE '%$search%')";
}

if ($location != "") {
    $conditions[] = "location='$location'";
}

if ($job_type != "") {
    $conditions[] = "job_type='$job_type'";
}

if ($salary != "") {
    $conditions[] = "salary >= '$salary'";
}

if (count($conditions) > 0) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$query .= " ORDER BY posted_date DESC";

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

        <form method="GET" action="Jobs.php">
            <div class="search-form">
                <input type="text" name="search" placeholder="Search by job title, company or location"
                    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

                <button type="submit">Search</button>

            </div>


            <div class="filter">

                <select name="location">
                    <option value="">Location</option>
                    <option value="Pune" <?php if ($location == "Pune")
                        echo "selected"; ?>>Pune</option>
                    <option value="Mumbai" <?php if ($location == "Mumbai")
                        echo "selected"; ?>>Mumbai</option>
                    <option value="Kolhapur" <?php if ($location == "Kolhapur")
                        echo "selected"; ?>>Kolhapur</option>
                </select>

                <select name="job_type">
                    <option value="">Job Type</option>
                    <option value="Full Time" <?php if ($job_type == "Full Time")
                        echo "selected"; ?>>Full Time
                    </option>
                    <option value="Part Time" <?php if ($job_type == "Part Time")
                        echo "selected"; ?>>Part Time
                    </option>
                    <option value="Internship" <?php if ($job_type == "Internship")
                        echo "selected"; ?>>Internship
                    </option>
                </select>

                <select name="salary">
                    <option value="">Salary</option>
                    <option value="10000" <?php if ($salary == "10000")
                        echo "selected"; ?>>Above ₹10,000</option>
                    <option value="20000" <?php if ($salary == "20000")
                        echo "selected"; ?>>Above ₹20,000</option>
                    <option value="50000" <?php if ($salary == "50000")
                        echo "selected"; ?>>Above ₹50,000</option>
                </select>



            </div>

        </form>


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