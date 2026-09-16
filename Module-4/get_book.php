<?php
/**
 * Module 4 - Get Single Book Record
 * Fetches a single book by ID for editing
 */

header('Content-Type: application/json');
include 'db_connect.php';

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid book ID.']);
    exit;
}

$sql    = "SELECT * FROM books WHERE id = $id LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows === 1) {
    $book = $result->fetch_assoc();
    echo json_encode(['success' => true, 'data' => $book]);
} else {
    echo json_encode(['success' => false, 'message' => 'Book not found.']);
}

$conn->close();
?>
