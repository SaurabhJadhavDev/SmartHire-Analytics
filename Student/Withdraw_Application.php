<?php
session_start();
include("../Database/db_connect.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: Student_Login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

if (!isset($_GET['application_id'])) {
    header("Location: Application.php");
    exit();
}

$application_id = $_GET['application_id'];

$query = "UPDATE Application
          SET status='Withdrawn'
          WHERE application_id='$application_id'
          AND student_id='$student_id'";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Application Withdrawn Successfully!');
            window.location='Application.php';
          </script>";
} else {
    echo 'Error : ' . mysqli_error($conn);
}
?>