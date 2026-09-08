<?php
/**
 * Module 3 - Fetch All Books
 * Returns all book records from the database as JSON
 */

header('Content-Type: application/json');
include 'db_connect.php';

$sql    = "SELECT * FROM books ORDER BY created_at DESC";
$result = $conn->query($sql);

$books = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// Calculate stats
$total_value = array_sum(array_column($books, 'price'));
$avg_price   = count($books) ? $total_value / count($books) : 0;

echo json_encode([
    'success'     => true,
    'data'        => $books,
    'count'       => count($books),
    'total_value' => round($total_value, 2),
    'avg_price'   => round($avg_price, 2)
]);

$conn->close();
?>
