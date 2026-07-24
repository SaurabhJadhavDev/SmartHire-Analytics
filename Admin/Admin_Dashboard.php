<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/Admin_Dashboard.css">
</head>

<body>
    <header>
        <h1>CareerConnect Admin</h1>

        <nav>
            <a href="Admin_Dashboard.php">Dashboard</a>
            <a href="Manage_Students.php">Students</a>
            <a href="Manage_Recruiters.php">Recruiters</a>
            <a href="Manage_Jobs.php">Jobs</a>
            <a href="Manage_Applications.php">Applications</a>
            <a href="../Home/index.html">Logout</a>
        </nav>
    </header>

    <section class="dashboard">
        <h2>Welcome Admin 👋</h2>

        <div class="cards">
            <div class="card">
                <h3>Totla Students</h3>
                <h1>0</h1>
            </div>
            <div class="card">
                <h3>Total Recruiters</h3>
                <h1>0</h1>
            </div>

            <div class="card">
                <h3>Total Jobs</h3>
                <h1>0</h1>
            </div>

            <div class="card">
                <h3>Total Applications</h3>
                <h1>0</h1>
            </div>

            <div class="tables">
                <div class="table-box">
                    <h3>Recent Students</h3>

                    <table>

                        <tr>
                            <th>Name</th>
                            <th>College</th>
                        </tr>

                        <tr>
                            <th>Rahul</th>
                            <th>ABC College</th>
                        </tr>

                        <tr>
                            <td>Priya</td>
                            <td>XYZ College</td>
                        </tr>
                    </table>
                </div>

                <div class="table-box">
                    <h3> Recent Recruiters</h3>

                    <table>
                        <tr>
                            <th>Company</th>
                            <th>Recruiter</th>
                        </tr>

                        <tr>

                            <th>TCS</th>
                            <th>Amit</th>
                        </tr>

                        <tr>
                            <td>Infosys</td>
                            <td>Neha</td>
                        </tr>
                        
                    </table>
                </div>
            </div>

        </div>

    </section>
</body>

</html>