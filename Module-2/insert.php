<?php
/**
 * Module 2 - Insert New Book
 * Handles POST request, validates inputs, inserts into DB
 */

header('Content-Type: application/json');
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$title  = trim($_POST['title']  ?? '');
$author = trim($_POST['author'] ?? '');
$price  = trim($_POST['price']  ?? '');

// --- Backend Validation ---
$errors = [];

// Title: alphabetic and spaces only
if (empty($title)) {
    $errors[] = 'Book title is required.';
} elseif (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
    $errors[] = 'Title must contain only alphabetic characters and spaces.';
}

// Author: alphabetic characters only
if (empty($author)) {
    $errors[] = 'Author name is required.';
} elseif (!preg_match('/^[a-zA-Z\s]+$/', $author)) {
    $errors[] = 'Author name must contain only alphabetic characters.';
}

// Price: number greater than 0
if (empty($price)) {
    $errors[] = 'Price is required.';
} elseif (!is_numeric($price) || floatval($price) <= 0) {
    $errors[] = 'Price must be a number greater than 0.';
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

// Sanitize
$title  = $conn->real_escape_string($title);
$author = $conn->real_escape_string($author);
$price  = floatval($price);

$sql = "INSERT INTO books (title, author, price) VALUES ('$title', '$author', $price)";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        'success' => true,
        'message' => 'Book added successfully!',
        'id'      => $conn->insert_id
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
}

$conn->close();
?>
