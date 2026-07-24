<?php

session_start();

include("../Database/db_connect.php");

$search = "";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

$query = "
SELECT * FROM Student
WHERE full_Name LIKE '%$search%'
ORDER BY student_id DESC";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage_Students</title>
    <link rel="stylesheet" href="../CSS/Manage_Students.css">
</head>

<body>

    <div class="page-title">
        <h2>Manage Students</h2>
    </div>
    <form method="GET" class="search-box">
        <input type="text" name="search" placeholder="Search Student" value="<?php echo $search; ?>">

        <button type="submit">
            Search
        </button>
    </form>

    <div class="button-row">
        <a href="Admin_Dashboard.php" class="back-btn">
            Back to Dashboard
        </a>
    </div>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>College</th>
            <th>Degree</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['full_Name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['college']; ?></td>
                <td><?php echo $row['degree']; ?></td>

                <td>

                    <div class="action-buttons">

                        <a href="Admin_View_Student.php?student_id=<?php echo $row['student_id']; ?>"
                            class="action-btn delete-btn">View
                        </a>

                        <a href="Delete_Student.php?student_id=<?php echo $row['student_id']; ?>"
                            class="action-btn view-btn">
                            Delete
                        </a>

                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>