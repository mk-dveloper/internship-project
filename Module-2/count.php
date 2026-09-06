<?php
/**
 * Module 2 - Book Count Helper
 */
header('Content-Type: application/json');
include 'db_connect.php';
$result = $conn->query("SELECT COUNT(*) as count FROM books");
$row    = $result->fetch_assoc();
echo json_encode(['count' => $row['count']]);
$conn->close();
?>
