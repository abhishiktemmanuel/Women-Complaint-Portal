<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "complaint_portal";

$conn = mysqli_connect($server, $username, $password , $database);
if(!$conn){
    die("Connection error". mysqli_connect_error());
}

?>