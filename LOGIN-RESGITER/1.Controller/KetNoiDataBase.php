<?php 
$ServerName = "localhost";
$username = "root";
$password = "";
$dbname = "nguoidung";
$conn = new mysqli($ServerName, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connent Fail  . $conn->connect_error");
}
?>