<?php
session_start();
include("../Database/db_connect.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: Student_Login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

if (!isset($_GET['job_id'])) {
    header("Location: Jobs.php");
    exit();
}

$job_id = $_GET['job_id'];

$query = "SELECT recruiter_id
          FROM Job
          WHERE job_id='$job_id'";

$result = mysqli_query($conn, $query);

$job = mysqli_fetch_assoc($result);

$recruiter_id = $job['recruiter_id'];

$check = "SELECT *
          FROM Application
          WHERE job_id='$job_id'
          AND student_id='$student_id'";

$check_result = mysqli_query($conn, $check);

if (mysqli_num_rows($check_result) > 0) {
    $application = mysqli_fetch_assoc($check_result);

    if ($application['status'] == "Pending") {
        echo "<script>
                alert('You have already applied for this job.');
                window.location='Jobs.php';
              </script>";
        exit();
    }

    if ($application['status'] == "Withdrawn") {
        $update = "UPDATE Application
                   SET status='Pending',
                       application_date=NOW()
                   WHERE application_id='" . $application['application_id'] . "'";

        mysqli_query($conn, $update);

        echo "<script>
                alert('Application Submitted Successfully!');
                window.location='Jobs.php';
              </script>";

        exit();
    }
}

$insert = "INSERT INTO Application
(job_id, recruiter_id, student_id)

VALUES

('$job_id','$recruiter_id','$student_id')";

if (mysqli_query($conn, $insert)) {

    echo "<script>

        alert('Application Submitted Successfully!');

        window.location='Jobs.php';

    </script>";

} else {

    echo "Error : " . mysqli_error($conn);

}
?>