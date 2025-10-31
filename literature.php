<?php  
include("connection.php");  
include("navbar.php");  

// Pagination variables
$books_per_page = 6; // Number of books per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
$offset = ($page - 1) * $books_per_page;

// Get paginated books
$sql_books = "SELECT * FROM books ORDER BY release_date DESC LIMIT $books_per_page OFFSET $offset";  
$result_books = mysqli_query($db, $sql_books);

// Get total number of books
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
            color: white;
            text-align: center;
            margin: 0;
        }

        .container {
            width: 90%;
            margin: 90px auto;
            padding: 20px;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin: 20px auto;
        }

        .book-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
            position: relative;
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
            text-decoration:none;
        }

        /* Star rating */
        .star-rating {
            margin: 5px auto;
            font-size: 18px;
            color: gold;
        }

        /* Pagination styles */
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
            background-color:rgb(5, 97, 42);
        }
    </style>
    <script>
        function goToPage(page) {
            window.location.href = "?page=" + page;
        }

        // JavaScript for dynamic star ratings
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".star-rating").forEach(function (starDiv) {
                let rating = parseInt(starDiv.getAttribute("data-rating"));
                let stars = "";
                
                for (let i = 1; i <= 5; i++) {
                    if (i <= rating) {
                        stars += "★";  // Filled star
                    } else {
                        stars += "☆";  // Empty star
                    }
                }

                starDiv.innerHTML = stars;
            });
        });
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
                    $downloads = (int)$row["downloads"];
                    $reads = (int)$row["reads"];
                    $total_activity = $downloads + $reads;

                    // Determine rating based on activity
                    $rating = 1; // Default 1 star
                    if ($total_activity > 10) $rating = 2;
                    if ($total_activity > 30) $rating = 3;
                    if ($total_activity > 50) $rating = 4;
                    if ($total_activity > 100) $rating = 5;

                    echo '<div class="book-card">';  
                    echo '<img src="' . $image_url . '" alt="' . $title . '">';  
                    echo '<h3>' . $title . '</h3>';  
                    echo '<p>' . $author . '</p>';  
                    echo '<div class="star-rating" data-rating="' . $rating . '"></div>';  
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
