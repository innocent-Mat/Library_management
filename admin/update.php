<?php
include "connection.php";
session_start();

if (!isset($_SESSION['login_user'])) {
    echo "<script>alert('⚠️ Please log in first!'); window.location='login.php';</script>";
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('⚠️ Book ID is missing!'); window.location='edit.php';</script>";
    exit;
}

$bid = mysqli_real_escape_string($db, $_GET['id']);
$query = mysqli_query($db, "SELECT * FROM books WHERE bid='$bid'");

if (mysqli_num_rows($query) == 0) {
    echo "<script>alert('⚠️ Book not found!'); window.location='edit.php';</script>";
    exit;
}

$book = mysqli_fetch_assoc($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $authors = mysqli_real_escape_string($db, $_POST['authors']);
    $edition = mysqli_real_escape_string($db, $_POST['edition']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $quantity = mysqli_real_escape_string($db, $_POST['quantity']);
    $department = mysqli_real_escape_string($db, $_POST['department']);

    $image_path = $book['image_path'];
    $pdf_path = $book['pdf_path'];

    // Handle image upload
    if (!empty($_FILES['book_image']['name'])) {
        $image_name = $_FILES['book_image']['name'];
        $image_tmp = $_FILES['book_image']['tmp_name'];
        $image_path = "images/" . basename($image_name);
        move_uploaded_file($image_tmp, $image_path);
    }

    // Handle PDF upload
    if (!empty($_FILES['book_pdf']['name'])) {
        $pdf_name = $_FILES['book_pdf']['name'];
        $pdf_tmp = $_FILES['book_pdf']['tmp_name'];
        $pdf_path = "pdfs/" . basename($pdf_name);
        move_uploaded_file($pdf_tmp, $pdf_path);
    }

    $update_sql = "UPDATE books SET name='$name', authors='$authors', edition='$edition', 
                   status='$status', quantity='$quantity', department='$department', 
                   image_path='$image_path', pdf_path='$pdf_path' WHERE bid='$bid'";

    if (mysqli_query($db, $update_sql)) {
        echo "<script>alert('✅ Book updated successfully!'); window.location='books.php';</script>";
    } else {
        echo "<script>alert('❌ Error updating book. Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { background-color: #f4f4f4; font-family: Arial, sans-serif; }
        .container { width: 50%; margin: auto; background: white; padding: 20px; border-radius: 8px; }
        img { max-width: 150px; display: block; margin-bottom: 10px; }
        .form-control { width: 100%; padding: 10px; margin: 5px 0; }
        .btn { background: green; color: white; padding: 10px; cursor: pointer; border: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Book</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="bid" value="<?php echo $bid; ?>">

            <label>Book Image:</label>
            <img src="<?php echo $book['image_path']; ?>" alt="Book Image">
            <input class="form-control" name="book_image" type="file" accept="image/*">
            
            <label>Book PDF:</label>
            <a href="<?php echo $book['pdf_path']; ?>" target="_blank">View PDF</a>
            <input class="form-control" name="book_pdf" type="file" accept=".pdf">
            
            <label>Book Name:</label>
            <input class="form-control" name="name" value="<?php echo $book['name']; ?>" required>
            
            <label>Authors:</label>
            <input class="form-control" name="authors" value="<?php echo $book['authors']; ?>" required>
            
            <label>Edition:</label>
            <input class="form-control" name="edition" value="<?php echo $book['edition']; ?>" required>
            
            <label>Status:</label>
            <input class="form-control" name="status" value="<?php echo $book['status']; ?>" required>
            
            <label>Quantity:</label>
            <input class="form-control" name="quantity" type="number" value="<?php echo $book['quantity']; ?>" required>
            
            <label>Department:</label>
            <input class="form-control" name="department" value="<?php echo $book['department']; ?>" required>
            
            <button type="submit" name="update" class="btn">Update</button>
        </form>
    </div>
</body>
</html>
