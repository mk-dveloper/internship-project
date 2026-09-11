<?php
/**
 * Module 3 - Search & Filter Books
 * Accepts a search query and returns matching book records
 */

header('Content-Type: application/json');
include 'db_connect.php';

$query = trim($_GET['q'] ?? '');

if (empty($query)) {
    // Return all books if no search query
    $sql = "SELECT * FROM books ORDER BY created_at DESC";
} else {
    // Search by title or author
    $query = $conn->real_escape_string($query);
    $sql   = "SELECT * FROM books 
              WHERE title LIKE '%$query%' 
              OR author LIKE '%$query%' 
              ORDER BY created_at DESC";
}

$result = $conn->query($sql);
$books  = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

echo json_encode([
    'success' => true,
    'data'    => $books,
    'count'   => count($books),
    'query'   => $query
]);

$conn->close();
?>
