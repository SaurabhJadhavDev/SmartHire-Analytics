<?php

session_start();

include("../Database/db_connect.php");

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $search = $_GET['search']);
}

$query = "
SELECT * 
FROM Job
WHERE company_name LIKE '%$search%'
OR job_title LIKE '%$search%'
ORDER BY job_id DESC";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Jobs</title>

    <link rel="stylesheet" href="../CSS/Manage_Students.css">

</head>

<body>

    <h1>Manage Jobs</h1>

    <form method="GET" class="search-form">

        <input type="text" name="search" placeholder="Search Job" value="<?php echo htmlspecialchars($search); ?>">

        <button type="submit">Search</button>

    </form>

    <div class="button-row">

        <a href="Admin_Dashboard.php" class="back-btn">

            ← Back to Dashboard

        </a>

    </div>

    <table>

        <tr>

            <th>Company</th>
            <th>Job Title</th>
            <th>Location</th>
            <th>Salary</th>
            <th>Action</th>

        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['company_name']; ?></td>

                <td><?php echo $row['job_title']; ?></td>

                <td><?php echo $row['location']; ?></td>

                <td><?php echo $row['salary']; ?></td>

                <td>

                    <div class="action-buttons">
                        <a href="Admin_View_Job.php?job_id=<?php echo $row['job_id']; ?>" class="action-btn view-btn">
                            View
                        </a>

                        <a href="Delete_Job.php?job_id=<?php echo $row['job_id']; ?>" class="action-btn delete-btn"
                            onclick="return confirm('Delete this job?');">
                            Delete</a>
                    </div>
                </td>
            </tr>
        <?php } ?>

    </table>