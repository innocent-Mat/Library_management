<?php
include "connection.php";
include "navbar.php";

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
    <title><?php echo $row['name']; ?> - Book Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 86%;
            margin: 140px auto;
            background: white;
            padding: 20px;
            display: flex;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .book-image {
            flex: 1;
            padding: 20px;
            text-align: center;
        }
        .book-image img {
            width: 250px;
            height: 350px;
            object-fit: cover;
            border-radius: 5px;
        }
        .book-info {
            flex: 2;
            padding: 20px;
        }
        .book-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .book-author {
            font-size: 18px;
            color: gray;
            margin-bottom: 10px;
        }
        .book-details {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .book-options {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .btn {
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
        }
        .btn-blue {
            background: #0073e6;
            color: white;
            border: none;
        }
        .btn-blue:hover {
            background:rgb(2, 30, 58);
            color: white;


        }
        .btn-green {
            background: #28a745;
            color: white;
            border: none;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .price-section {
            width: 300px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            text-align: center;
            margin-left: 20px;
        }
        .price {
            font-size: 24px;
            font-weight: bold;
            color: #0073e6;
        }
        .wishlist {
            color: green;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Book Image Section -->
        <div class="book-image">
            <?php if (!empty($row['image_path'])) { ?>
                <img src="<?php echo $row['image_path']; ?>" alt="Book Cover">
            <?php } else { ?>
                <p>No Image Available</p>
            <?php } ?>
        </div>

        <!-- Book Details Section -->
        <div class="book-info">
            <div class="book-title"><?php echo $row['name']; ?></div>
            <div class="book-author">by <?php echo $row['authors']; ?></div>
            <div class="book-details"><strong>Edition:</strong> <?php echo $row['edition']; ?></div>
            <div class="book-details"><strong>Status:</strong> <?php echo $row['status']; ?></div>
            <div class="book-details"><strong>Quantity:</strong> <?php echo $row['quantity']; ?></div>
            <div class="book-details"><strong>Department:</strong> <?php echo $row['department']; ?></div>

            <div class="book-options">
                <?php if (!empty($row['pdf_path'])) { ?>
                    <a href="<?php echo $row['pdf_path']; ?>" class="btn btn-blue" target="_blank">Read PDF</a>
                <?php } else { ?>
                    <button class="btn btn-blue" disabled>No PDF Available</button>
                <?php } ?>
                
                <a href="edit_book.php?bid=<?php echo $row['bid']; ?>" class="btn btn-green">Edit Book</a>
            </div>
        </div>

        <!-- Price & Wishlist Section -->
        <div class="price-section">
            <div class="price">$24.03 USD</div>
            <p>Obtain a digital book from our friends at eBooks.com</p>
            <a href="#" class="btn btn-blue">eBooks.com</a>
            <p class="wishlist">💚 Add to Wishlist</p>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "<p>Book not found.</p>";
    }
} else {
    echo "<p>Invalid book selection.</p>";
}
?>
