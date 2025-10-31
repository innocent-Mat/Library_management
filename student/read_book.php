<?php 
session_start();
include("connection.php");

if (!isset($_SESSION['login_user'])) {
    echo "You must be logged in to read a book.";
    exit;
}

if (!isset($_GET['book_id'])) {
    echo "Book ID not provided.";
    exit;
}

$book_id = $_GET['book_id'];
$username = $_SESSION['login_user']; // Get logged-in student username
$format = "Hardcover"; // Since this is reading online, format is Hardcover

// Fetch book details
$sql = "SELECT * FROM books WHERE bid = '$book_id'";
$result = mysqli_query($db, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Book not found.";
    exit;
}

$book = mysqli_fetch_assoc($result);
$pdf_path = "../admin/uploads/" . basename($book['pdf_path']); // Ensure correct path

// Insert record into issue_book for tracking
$insert_sql = "INSERT INTO issue_book (username, bid, format) VALUES ('$username', '$book_id', '$format')";
if (!mysqli_query($db, $insert_sql)) {
    echo "Error inserting record: " . mysqli_error($db);
    exit;
}

// **UPDATE the reads count in the books table**
$update_sql = "UPDATE books SET `reads` = `reads` + 1 WHERE bid = '$book_id'";
if (!mysqli_query($db, $update_sql)) {
    echo "Error updating reads count: " . mysqli_error($db);
    exit;
}

// Display the book for reading online
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Book</title>
</head>
<body>
    <h2><?php echo htmlspecialchars($book['name']); ?></h2>
    <iframe src="<?php echo $pdf_path; ?>" width="100%" height="600px"></iframe>
</body>
</html>
