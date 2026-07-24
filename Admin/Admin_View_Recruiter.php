<?php

session_start();

include("../Database/db_connect.php");

$recruiter_id = $_GET['recruiter_id'];

$query = "
SELECT * FROM
Recruiter WHERE recruiter_id='$recruiter_id'";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Recruiter not found";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_View_Recruiter</title>
    <link rel="stylesheet" href="../CSS/Admin_View_Recruiter.css">
</head>

<body>
    <div class="container">
        <h2>Recruiter Details</h2>

        <div class="recruiter-card">
            <?php

            if (!empty($row['company_logo'])) {
                ?>
                <img src="#<?php echo $row['company_logo']; ?>" class="comapny-logo">
                <?php
            }
            ?>
            <div class="recruiter-info">
                <p><strong>Company:</strong> <?php echo $row['company_name']; ?></p>

                <p><strong>Recruiter:</strong> <?php echo $row['recruiter_name']; ?></p>

                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>

                <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>

                <p><strong>Industry:</strong> <?php echo $row['industry']; ?></p>
            </div>

            <div class="button-group">

                <a href="Manage_Recruiters.php" class="back-btn">
                    Back
                </a>

                <a href="Delete_Recruiter.php?recruiter_id=<?php echo $row['recruiter_id']; ?>" class="delete-btn"
                    onclick="return confirm('Are you sure you want to delete this recruiter?');">
                    Delete Recruiter
                </a>

            </div>
        </div>
    </div>
</body>

</html>