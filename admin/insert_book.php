<?php
include "connection.php";

if(isset($_POST['add'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $authors = mysqli_real_escape_string($db, $_POST['authors']);
    $edition = mysqli_real_escape_string($db, $_POST['edition']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $quantity = intval($_POST['quantity']);
    $department = mysqli_real_escape_string($db, $_POST['department']);

    // File upload paths
    $target_dir = "uploads/";
    
    // Handle book cover upload
    if (!empty($_FILES['image']['name'])) {
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $imageName = uniqid() . "." . $imageFileType; 
        $imagePath = $target_dir . $imageName;
        
        // Check if image file is a valid format
        if (!in_array($imageFileType, ["jpg", "png", "jpeg"])) {
            die("Invalid image format. Only JPG, PNG, and JPEG allowed.");
        }
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        $imagePath = ""; // No image uploaded
    }

    // Handle PDF upload
    if (!empty($_FILES['pdf']['name'])) {
        $pdfFileType = strtolower(pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION));
        $pdfName = uniqid() . "." . $pdfFileType; 
        $pdfPath = $target_dir . $pdfName;

        // Check if file is a valid PDF
        if ($pdfFileType != "pdf") {
            die("Invalid file format. Only PDF allowed.");
        }
        move_uploaded_file($_FILES['pdf']['tmp_name'], $pdfPath);
    } else {
        $pdfPath = ""; // No PDF uploaded
    }

    // Insert book details into database
    $query = "INSERT INTO books (name, authors, edition, status, quantity, department, image_path, pdf_path) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "ssssisss", $name, $authors, $edition, $status, $quantity, $department, $imagePath, $pdfPath);
    
    if(mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Book added successfully!'); window.location='books.php';</script>";
    } else {
        echo "<script>alert('Error adding book.'); window.history.back();</script>";
    }
}
?>
