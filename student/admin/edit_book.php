<?php
include "connection.php";

if(isset($_GET['bid'])) {
    $bid = $_GET['bid'];
    $query = "SELECT * FROM books WHERE bid = '$bid'";
    $result = mysqli_query($db, $query);

    if($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <style>
        body
        {
            background-color:rgb(3, 33, 20);
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background:rgb(92, 138, 134);
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
        }
        .btn:hover {
            background: green;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Book Details</h2>
        <form method="POST" action="update_book.php" enctype="multipart/form-data">
            <input type="hidden" name="bid" value="<?php echo $row['bid']; ?>">

            <label>Book Name:</label>
            <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

            <label>Author:</label>
            <input type="text" name="authors" value="<?php echo $row['authors']; ?>" required>

            <label>Edition:</label>
            <input type="text" name="edition" value="<?php echo $row['edition']; ?>" required>

            <label>Status:</label>
            <input type="text" name="status" value="<?php echo $row['status']; ?>" required>

            <label>Quantity:</label>
            <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required>

            <label>Department:</label>
            <input type="text" name="department" value="<?php echo $row['department']; ?>" required>

            <label>Book Cover (Upload New):</label>
            <input type="file" name="image">

            <label>Book File (Upload New PDF):</label>
            <input type="file" name="pdf">

            <button type="submit" name="update" class="btn">Update Book</button>
        </form>
    </div>
</body>
</html>
<?php
    }
}
?>
