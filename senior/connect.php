<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "osca";

// Gumawa ng koneksyon
$conn = new mysqli($servername, $username, $password, $dbname);

// I-check kung may error ang koneksyon
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
