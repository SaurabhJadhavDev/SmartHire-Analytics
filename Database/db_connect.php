<?php

$host = "localhost";
$username = "root";
$password = "root";
$database = "Carrer_Connect";
$port = "3306";

$conn = new mysqli($host,$username,$password,$database,$port);

if($conn->connect_error){
    die("Database Connection Failed");
}

?>