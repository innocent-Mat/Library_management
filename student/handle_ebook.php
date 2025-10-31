<?php  
session_start();  
include("connection.php");  

// Check if the user is logged in  
if (!isset($_SESSION['login_user'])) {  
    echo "You must be logged in to borrow a book.";  
    exit;  
}  

// Check if the book ID is set  
if (!isset($_POST['book_id'])) {  
    echo "Book ID not provided.";  
    exit;  
}  

$username = $_SESSION['login_user'];  
$book_id = $_POST['book_id'];  
$format = $_POST['format'];  

// Select the pdf_path from books table  
$pdf_query = "SELECT pdf_path FROM books WHERE bid = ?";  
$pdf_stmt = $db->prepare($pdf_query);  
$pdf_stmt->bind_param("i", $book_id);  
$pdf_stmt->execute();  
$pdf_stmt->bind_result($pdf_path);  

if ($pdf_stmt->fetch()) {  
    // Close the PDF statement  
    $pdf_stmt->close();  

    // Insert into issue_book table with only username, bid, and format  
    $sql = "INSERT INTO issue_book (username, bid, format) VALUES (?, ?, ?)";  
    $insert_stmt = $db->prepare($sql);  
    $insert_stmt->bind_param("sis", $username, $book_id, $format);  

    try {  
        if ($insert_stmt->execute()) {  
            // Redirect to download the PDF  
            header("Location: download.php?file=" . urlencode($pdf_path));   
            exit;  
        } else {  
            echo "Error: " . $insert_stmt->error;  
        }  
    } catch (mysqli_sql_exception $e) {  
        echo "Error: " . $e->getMessage();  
    } finally {  
        $insert_stmt->close(); // Close the prepared statement  
    }  
} else {  
    echo "Book not found or PDF not available.";  
    $pdf_stmt->close(); // Ensure to close the prepared statement if fetch fails  
}  
?>  