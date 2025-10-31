<?php   
include("connection.php");  
include("navbar.php");  

// Pagination Setup
$books_per_page = 6; // Number of books per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
$offset = ($page - 1) * $books_per_page;

// Fetch paginated books
$sql_books = "SELECT * FROM books ORDER BY release_date DESC LIMIT $books_per_page OFFSET $offset";  
$result_books = mysqli_query($db, $sql_books);

// Get total books for pagination
$sql_total_books = "SELECT COUNT(*) AS total FROM books";
$result_total = mysqli_query($db, $sql_total_books);
$total_books = mysqli_fetch_assoc($result_total)['total'];
$total_pages = ceil($total_books / $books_per_page);
?>

<!DOCTYPE html>  
<html>  
<head>  
    <title>Literature</title>  
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FAF3E0;
            color: #fff;
            text-align: center;
            margin: 0;
            max-height:1300px;
        }

        .container {
            width: 90%;
            margin: 90px auto;
            padding: 20px;
            height: 100%;
        }

        h2 {
            margin-bottom: 20px;
        }

        /* Book Grid */
        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            justify-content: center;
            margin-top: 20px;

        }

        /* Book Card */
        .book-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
        }

        .book-card img {
            width: 150px;  /* Fixed width */
            height: 220px; /* Fixed height */
            object-fit: cover; /* Ensures uniform size without distortion */
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .book-card h3 {
            font-size: 1.2em;
            margin-bottom: 5px;
        }

        .book-card p {
            font-size: 1em;
            color: #555;
        }

        .see-details-btn {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .see-details-btn:hover {
            background-color: darkgreen;
            color: white;
            text-decoration: none;
        }

        /* Pagination */
        .pagination {
            margin-top: 20px;
        }

        .pagination button {
            padding: 8px 15px;
            margin: 5px;
            border: none;
            cursor: pointer;
            background-color: #0073e6;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .pagination button.active {
            background-color: #4CAF50;
        }

        .pagination button:hover {
            background-color:rgb(17, 104, 50);
        }

        /* Hover effect */
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
    </style>
    <script>
        function goToPage(page) {
            window.location.href = "?page=" + page;
        }
    </script>
</head>  
<body>  
    <section class="container">
        <h2>All Books</h2>
        <div class="book-grid">
            <?php  
            if (mysqli_num_rows($result_books) > 0) {  
                while ($row = mysqli_fetch_assoc($result_books)) {  
                    $bid = htmlspecialchars($row["bid"]);  
                    $title = htmlspecialchars($row["name"]);  
                    $author = htmlspecialchars($row["authors"]);  
                    $image_url = htmlspecialchars($row["image_path"]);  

                    echo '<div class="book-card">';  
                    echo '<img src="' . $image_url . '" alt="' . $title . '">';  
                    echo '<h3>' . $title . '</h3>';  
                    echo '<p>' . $author . '</p>';  
                    echo '<a href="book_borrow.php?book_id=' . $bid . '" class="see-details-btn">See Details</a>';  
                    echo '</div>';  
                }  
            } else {  
                echo "<p>No books available.</p>";  
            }  
            ?>  
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <button class="<?= $i == $page ? 'active' : '' ?>" onclick="goToPage(<?= $i ?>)"><?= $i ?></button>
            <?php endfor; ?>
        </div>
    </section>  
</body>  
</html>
