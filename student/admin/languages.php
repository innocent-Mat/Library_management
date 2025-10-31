<?php
session_start();
include('connection.php'); // Connect to MySQL database

// Default language (English)
$lang = isset($_SESSION['language']) ? $_SESSION['language'] : "en";

// Fetch translations from the database
$query = "SELECT keyword, translation FROM language WHERE language_code = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $lang);
$stmt->execute();
$result = $stmt->get_result();

$translations = [];
while ($row = $result->fetch_assoc()) {
    $translations[$row['keyword']] = $row['translation'];
}

$stmt->close();
?>
