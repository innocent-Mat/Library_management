<?php
include "connection.php";

if(isset($_POST['update'])) {
    $bid = $_POST['bid'];
    $name = $_POST['name'];
    $authors = $_POST['authors'];
    $edition = $_POST['edition'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    $department = $_POST['department'];

    // Handle File Uploads
    $image_path = $_FILES['image']['name'] ? "uploads/" . $_FILES['image']['name'] : "";
    $pdf_path = $_FILES['pdf']['name'] ? "uploads/" . $_FILES['pdf']['name'] : "";

    if($image_path) move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    if($pdf_path) move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf_path);

    $query = "UPDATE books SET 
                name='$name', authors='$authors', edition='$edition', status='$status', 
                quantity='$quantity', department='$department' ";

    if ($image_path) $query .= ", image_path='$image_path' ";
    if ($pdf_path) $query .= ", pdf_path='$pdf_path' ";

    $query .= " WHERE bid='$bid'";

    if(mysqli_query($db, $query)) {
        echo "<script>alert('Book updated successfully!'); window.location='see_detail.php?bid=$bid';</script>";
    } else {
        echo "<script>alert('Update failed!');</script>";
    }
}
?>
