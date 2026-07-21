<?php 

include("../Database/db_connect.php");

$application_id=$_GET['application_id'];

$query="UPDATE Application 
SET status='Rejected' WHERE
application_id='$application_id'";

mysqli_query($conn,$query);

header("Location: Applicants.php");

?>