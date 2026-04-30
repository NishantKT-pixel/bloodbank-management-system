<?php
// config/db.php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "bloodbank_db";

// Create connection using MySQLi
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>