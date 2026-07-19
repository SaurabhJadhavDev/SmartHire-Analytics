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

if (isset($_POST['update'])) {
    $company_name = $_POST['company_name'];
    $industry = $_POST['industry'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $location = $_POST['location'];
    $established = $_POST['established'];
    $employees = $_POST['employees'];

    if ($_FILES['company_logo']['name'] != "") {
        $company_logo = $_FILES['company_logo']['name'];

        move_uploaded_file(
            $_FILES['company_logo']['tmp_name'],
            "../Uploads/" . $company_logo
        );
    } else {
        $company_logo = $row['company_logo'];
    }

    $update = "UPDATE Recruiter SET
    company_name='$company_name',
    industry='$industry',
    phone='$phone',
    website='$website',
    location='$location',
    established='$established',
    employees='$employees',
    company_logo='$company_logo'

    WHERE recruiter_id='$recruiter_id'";

    if (mysqli_query($conn, $update)) {
        header("Location: Company_Profile.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit_Company_Profile</title>
    <link rel="stylesheet" href="../CSS/Edit_Company_Profile.css">
</head>

<body>
    <h1>Edit Company Profile</h1>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-row">
            <label>Company Name</label>
            <input type="text" name="company_name" value="<?php echo $row['company_name']; ?>">
        </div>

        <div class="form-row">
            <label>Industry</label>
            <input type="text" name="industry" value="<?php echo $row['industry']; ?>">
        </div>

        <div class="form-row">
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo $row['phone']; ?>">
        </div>

        <div class="form-row">
            <label>Website</label>
            <input type="text" name="website" value="<?php echo $row['website']; ?>">
        </div>

        <div class="form-row">
            <label>Location</label>
            <input type="text" name="location" value="<?php echo $row['location']; ?>">
        </div>

        <div class="form-row">
            <label>Established</label>
            <input type="number" name="established" value="<?php echo $row['established']; ?>">
        </div>

        <div class="form-row">
            <label>Employees</label>
            <input type="number" name="employees" value="<?php echo $row['employees']; ?>">
        </div>

        <div class="form-row">
            <label>Company Logo</label>
            <input type="file" name="company_logo">
        </div>

        <div class="button-row">

            <button type="submit" name="update" class="save-btn">
                Save Changes
            </button>

            <a href="Company_Profile.php" class="cancel-btn">
                Back
            </a>

        </div>

    </form>
</body>

</html>