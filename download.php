<?php
session_start();
include("connection.php");

if (!isset($_SESSION['login_user'])) {
    $error_message = "You must be logged in to download a book.";
} elseif (!isset($_GET['book_id'])) {
    $error_message = "Book ID not provided.";
} else {
    $book_id = $_GET['book_id'];
    $username = $_SESSION['login_user']; // Get logged-in student username
    $format = "eBook"; // Since this is a download, format is always eBook

    // Fetch book details
    $sql = "SELECT * FROM books WHERE bid = '$book_id'";
    $result = mysqli_query($db, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        $error_message = "Book not found.";
    } else {
        $book = mysqli_fetch_assoc($result);
        $pdf_path = "../admin/pdfs/" . basename($book['pdf_path']); // Ensure correct path

        // Check if file exists
        if (!file_exists($pdf_path)) {
            $error_message = "The file does not exist: " . realpath($pdf_path);
        } else {
            // Insert record into issue_book
            $insert_sql = "INSERT INTO issue_book (username, bid, format) VALUES ('$username', '$book_id', '$format')";
            if (!mysqli_query($db, $insert_sql)) {
                $error_message = "Error inserting record: " . mysqli_error($db);
            } else {
                // Force download
                header("Content-Type: application/pdf");
                header("Content-Disposition: attachment; filename=\"" . basename($pdf_path) . "\"");
                readfile($pdf_path);
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Book</title>
    <style>
        /* General Styling */
body {
    font-family: Arial, sans-serif;
    background: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Container */
.container {
    text-align: center;
    max-width: 400px;
    width: 100%;
}

/* Card */
.card {
    background: white;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

/* Title */
h2 {
    color: #333;
}

/* Error Message */
.error {
    color: red;
    font-weight: bold;
    background: #ffe6e6;
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Download Book</h2>
            <?php if (isset($error_message)): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
