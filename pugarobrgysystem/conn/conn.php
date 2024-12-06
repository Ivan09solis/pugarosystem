<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pugarobrgysystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("CONNECTION FAILE: " . $conn->connect_error);
}

?>