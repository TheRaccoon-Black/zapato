<?php
$hostname = "localhost";
$username = "root";
$password = "admin";
$dbname = "pemweb";

$conn = mysqli_connect($hostname, $username, $password, $dbname) or die("gagal terhubung ke database");
?>