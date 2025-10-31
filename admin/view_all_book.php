<?php
include("connection.php");
include("navbar.php");

// Get total books count
$books_per_page = 8; // Number of books per page
$sql_total_books = "SELECT COUNT(*) AS total FROM books";
$result_total = mysqli_query($db, $sql_total_books);
$total_books = mysqli_fetch_assoc($result_total)['total'];
$total_pages = ceil($total_books / $books_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Books</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            text-align: center;
            padding: 20px;
            margin:100px auto;
        }

        h2 {
            font-size: 2rem;
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        .book-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .book-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 200px;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s ease;
        }

        .book-card:hover {
            transform: scale(1.05);
        }

        .book-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
        }

        .book-card h3 {
            font-size: 1rem;
            margin: 10px 0 5px;
            color: #333;
        }

        .book-card p {
            font-size: 0.9rem;
            color: #777;
        }

        .details-btn {
            display: inline-block;
            margin-top: 10px;
            background-color: green;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .details-btn:hover {
            background-color: darkgreen;
            text-decoration:none;
            color:white;
        }

        /* Pagination */
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .pagination button {
            padding: 8px 12px;
            border: none;
            background-color: #0073e6;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .pagination button.active {
            background-color: #4CAF50;
        }

        .pagination button:hover {
            background-color:rgb(11, 117, 59);
        }
        /* Star Ratings */
        .stars {
            margin: 5px 0;
            color: gold;
            font-size: 16px;
        }

    </style>
    <script>
        $(document).ready(function () {
            function loadBooks(page) {
                $.ajax({
                    url: "fetch_books.php",
                    type: "GET",
                    data: { page: page },
                    success: function (response) {
                        $(".book-list").html(response);
                        $(".pagination button").removeClass("active");
                        $("#page-" + page).addClass("active");
                    }
                });
            }

            // Load first page by default
            loadBooks(1);

            $(".pagination button").click(function () {
                var page = $(this).data("page");
                loadBooks(page);
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>All Books</h2>
        <div class="book-list"></div> <!-- Books will be loaded here -->

        <!-- Pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <button id="page-<?= $i ?>" data-page="<?= $i ?>"><?= $i ?></button>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>
