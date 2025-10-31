<?php
include "connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <style>
        .container {
            width: 50%;
            margin: 150px auto;
            padding: 20px;
            background:rgb(54, 186, 193);
            border-radius: 10px;
            text-align: center;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        .btn {
            padding: 10px 15px;
            background: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background: darkgreen;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Book</h2>
        <form method="POST" action="insert_book.php" enctype="multipart/form-data">

            <label>Book Name:</label>
            <input type="text" name="name" required>

            <label>Author:</label>
            <input type="text" name="authors" required>

            <label>Edition:</label>
            <input type="text" name="edition" required>

            <label>Status:</label>
            <input type="text" name="status" required>

            <label>Quantity:</label>
            <input type="number" name="quantity" required>

            <label>Department:</label>
            <input type="text" name="department" required>

            <label>Book Cover (Upload Image):</label>
            <input type="file" name="image" accept="image/*" required>

            <label>Book File (Upload PDF):</label>
            <input type="file" name="pdf" accept="application/pdf" required>

            <button type="submit" name="add" class="btn">Add Book</button>
        </form>
    </div>
</body>
</html>
