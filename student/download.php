<?php 
session_start();
include("connection.php");

if (!isset($_SESSION['login_user'])) {
    echo "You must be logged in to download a book.";
    exit;
}

if (!isset($_GET['book_id'])) {
    echo "Book ID not provided.";
    exit;
}

$book_id = $_GET['book_id'];
$username = $_SESSION['login_user']; // Get logged-in student username
$format = "eBook"; // Since this is a download, format is always eBook

// Fetch book details
$sql = "SELECT * FROM books WHERE bid = '$book_id'";
$result = mysqli_query($db, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Book not found.";
    exit;
}

$book = mysqli_fetch_assoc($result);
$pdf_path = "../admin/uploads/" . basename($book['pdf_path']); // Ensure correct path

// Check if file exists
if (!file_exists($pdf_path)) {
    echo "The file does not exist: " . realpath($pdf_path);
    exit;
}

// Insert record into issue_book
$insert_sql = "INSERT INTO issue_book (username, bid, format) VALUES ('$username', '$book_id', '$format')";
if (!mysqli_query($db, $insert_sql)) {
    echo "Error inserting record: " . mysqli_error($db);
    exit;
}

// **UPDATE the downloads count in the books table**
$update_sql = "UPDATE books SET downloads = downloads + 1 WHERE bid = '$book_id'";
if (!mysqli_query($db, $update_sql)) {
    echo "Error updating downloads count: " . mysqli_error($db);
    exit;
}

// Force download
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"" . basename($pdf_path) . "\"");
readfile($pdf_path);
exit;
?>
