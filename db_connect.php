<?php
/**
 * Module 1 - Database Connection
 * Library Book Management System
 */

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "internship_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
