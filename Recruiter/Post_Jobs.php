<?php
session_start();
include("../Database/db_connect.php");

if (!isset($_SESSION['recruiter_id'])) {
    header("Location: Recruiter_Login.php");
    exit();
}

$recruiter_id = $_SESSION['recruiter_id'];

if (isset($_POST['post_job'])) {

    $job_title = $_POST['job_title'];
    $company_name = $_POST['company_name'];
    $location = $_POST['location'];
    $job_type = $_POST['job_type'];
    $salary = $_POST['salary'];
    $required_skills = $_POST['required_skills'];
    $job_description = $_POST['job_description'];
    $application_deadline = $_POST['application_deadline'];
    $experience = $_POST['experience'];
    $qualification = $_POST['qualification'];

    $query = "INSERT INTO Job
    (
        recruiter_id,
        company_name,
        job_title,
        location,
        job_type,
        salary,
        required_skills,
        job_description,
        application_deadline,
        experience,
        qualification
    )
    VALUES
    (
        '$recruiter_id',
        '$company_name',
        '$job_title',
        '$location',
        '$job_type',
        '$salary',
        '$required_skills',
        '$job_description',
        '$application_deadline',
        '$experience',
        '$qualification'
    )";

    if(mysqli_query($conn,$query))
    {
        echo "<script>
            alert('Job Posted Successfully');
            window.location='Recruiter_Dashboard.php';
        </script>";
    }
    else
    {
        echo "Error : ".mysqli_error($conn);
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psot Jobs</title>
    <link rel="stylesheet" href="../CSS/Post.css">
</head>

<body>
    <div class="post-job-container">
        <h1>📝Post a New Job</h1>
        <p>Create a new job opportunity for studnets.</p>

        <form action="" method="POST">
            <div class="form-row">
                <label>Job Title</label>
                <input type="text" name="job_title" placeholder="Software Devloper Intern">
            </div>

            <div class="form-row">
                <label>Comapny Name</label>
                <input type="text" name="company_name" placeholder="ABC Technology">
            </div>

            <div class="form-row">
                <label>Location</label>
                <input type="text" name="location" placeholder="Pune">
            </div>

            <div class="form-row">
                <label for="jobtype">Job Type</label>

                <select id="jobtype" name="job_type">
                    <option>Internship</option>
                    <option>Full Time</option>
                    <option>Part Time</option>
                </select>
            </div>

            <div class="form-row">
                <label>Salary</label>
                <input type="text" name="salary" placeholder="$20,000/month">
            </div>

            <div class="form-row">
                <label>Required Skills</label>
                <input type="text" name="required_skills" placeholder="Java,SQL,HTMl,CSS">
            </div>

            <div class="form-row">
                <label for="Description">Job Description</label>
                <textarea id="Description" name="job_description" rows="6" placeholder="Describe the job responsibilities"></textarea>
            </div>

            <div class="form-row">
                <label for="Deadline">Appplication Deadline</label>
                <input id="Deadline" name="application_deadline" type="date">
            </div>

            <div class="form-row">
                <label for="Experience">Experience</label>
                <select id="Experience" name="experience">
                    <option>Fresher</option>
                    <option>0-1 Years</option>
                    <option>1-3 Years</option>
                </select>
            </div>

            <div class="form-row">
                <label for="Qualification">Qualification</label>

                <select id="Qualification" name="qualification">
                    <option>BCA</option>
                    <option>B.Tech</option>
                    <option>B.sc</option>
                    <option>MCA</option>
                </select>
            </div>

            <div class="button-row">

                <button type="submit" class="post-btn" name="post_job">
                    Post Job
                </button>


                <a href="Recruiter_Dashboard.php" class="back-btn">
                    Back
                </a>
            </div>
        </form>
    </div>
</body>

</html>