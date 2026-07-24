<?php

session_start();

include("../Database/db_connect.php");

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

$query = "
SELECT
Application.*,
Student.full_Name,
Job.job_title,
Job.company_name
FROM Application

INNER JOIN Student
ON Application.student_id = Student.student_id
INNER JOIN Job ON Application.job_id = Job.job_id
WHERE Student.full_Name LIKE '%$search%'
OR Job.job_title LIKE '%$search%'
OR Job.company_name LIKE '%$search%'

ORDER BY application_id DESC";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application</title>
    <link rel="stylesheet" href="../CSS/Manage_Application.css">
</head>

<body>
    <table>

        <tr>
            <th>Student</th>
            <th>Company</th>
            <th>Job</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['full_Name']; ?></td>
                <td><?php echo $row['company_name']; ?></td>
                <td><?php echo $row['job_title']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['application_date']; ?></td>
                <td>
                    <div class="action-buttons">
                        <a href="Admin_View_Application.php?application_id=<?php echo $row['application_id']; ?>"
                            class="action-btn view-btn">
                            View
                        </a>

                        <a href="Delete_Application.php?application_id=<?php echo $row['application_id']; ?>"
                            class="action-btn delete-btn" onclick="return confirm('Delete this application?');">
                            Delete</a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>