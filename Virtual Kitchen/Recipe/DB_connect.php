<?php
$servername = "localhost";
$username = "u-230107571";
$password = "NmjF0efeeLkncRQ"; 
$dbname = "u_230107571_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection FAILED: " . $conn->connect_error);
}
?>