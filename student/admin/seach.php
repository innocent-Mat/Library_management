<?php 
include "connection.php";
include "navbar.php";

// Check if form is submitted
if (isset($_POST["submit"])) {
    // Get user input and sanitize it
    $usersearch = mysqli_real_escape_string($db, $_POST['search']);

    // Fetch books matching the search term
    $sql = "SELECT * FROM books WHERE name LIKE '%$usersearch%'";
    $result = mysqli_query($db, $sql);

    // Check if the query was successful  
    if (!$result) {  
        echo "Error fetching books: " . mysqli_error($db);  
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
         .search-bar {
            margin: 120px auto;
            width: 700px;
            display: flex;
            justify-content: center;
            border-radius:50px;
        }
        .search-bar input[type="text"] {
            width: 80%;
            padding: 0.8rem;
            border: 2px solid rgb(228, 235, 228);
            border-right: none;
            border-radius: 60px;
            font-size: 1.5rem;
            height:50px;
        }

        .search-bar button {
            padding: 0.8rem 1.5rem;
            background-color:rgb(219, 225, 220);
            color:rgb(28, 203, 72) ;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;

        }

        .search-bar button:hover {
            background-color:rgb(8, 199, 104);
            color:rgb(230, 233, 231) ;

        }
        .search-bar button span
        {
            width: 100%;
            font-size:20px;
            
        }
        .search-bar button span:hover
        {
            color:white;
        }
        .featured-books .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            padding: 1rem;
            justify-content: space-between;

        }

       
        .book-section {
            width: 80%;
            margin: auto;
            background: #f7e7c0;
            padding: 20px;
            border-radius: 10px;
        }

        .carousel {
            display: flex;
            align-items: center;
            position: relative;
        }

        .books-container {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            white-space: nowrap;
            gap: 15px;
            padding: 10px;
            
            /* Hide scrollbar */
            -ms-overflow-style: none;  /* IE & Edge */
            scrollbar-width: none;      /* Firefox */
        }

        .books-container::-webkit-scrollbar {
            display: none;  /* Chrome, Safari */
        }

        .books-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* 5 books per row */
    gap: 20px; /* Space between books */
    justify-content: center;
    padding: 20px;
}

.book-card {
    background: white;
    padding: 15px;
    border-radius: 10px;
    text-align: center;
    transition: transform 0.2s ease-in-out;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

.book-card:hover {
    transform: translateY(-5px);
}

.book-card img {
    width: 120px;
    height: 150px;
    object-fit: cover;
    border-radius: 5px;
    margin-bottom: 10px;
}


        .borrow-btn {
            background-color: green;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            margin-top: 5px;
            border-radius: 5px;
        }

        .borrow-btn:hover {
            background-color:rgb(21, 71, 43);
        }

        .prev-btn, .next-btn {
            background: none;
            border: none;
            font-size: 30px;
            cursor: pointer;
            padding: 10px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.2);
            color: white;
            border-radius: 50%;
        }

        .prev-btn { left: -40px; }
        .next-btn { right: -40px; }

        .prev-btn:hover, .next-btn:hover {
            background: rgba(0, 0, 0, 0.5);
        }

        .book-card:hover
        {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .book-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .book-card p {
            font-size: 0.9rem;
            color: #555;
        }
        .row {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    margin-bottom: 20px;
}
.view-all-container {
    text-align: right;
    margin-top: 20px;
}

.view-all-link {
    display: inline-block;
    padding: 10px 20px;
    background:green;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background 0.3s ease-in-out;
}

.view-all-link:hover {
    background: rgb(21, 71, 43);
    text-decoration:none;
    color:white;
}
.star-rating {
            color: #FFD700; /* Gold color for stars */
            font-size: 20px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
   
    <section>
        <?php
        if (isset($_POST["submit"])) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $bid = $row["bid"];
                    $title = $row["name"];
                    $author = $row["authors"];
                    $image_url = $row["image_path"];
                    $downloads = $row["downloads"];
                    $reads = $row["reads"];
                    
                    // Calculate total activity
                    $totalActivity = $downloads + $reads;

                    // Calculate rating (default is 1 star)
                    $rating = 1;
                    if ($totalActivity > 10) { $rating = 2; }
                    if ($totalActivity > 30) { $rating = 3; }
                    if ($totalActivity > 50) { $rating = 4; }
                    if ($totalActivity > 100) { $rating = 5; }

                    echo '<div class="book-card">';  
                    echo '<img src="'. htmlspecialchars($image_url) .'" alt="' . htmlspecialchars($title) . '">';
                    echo '<h3>' . htmlspecialchars($title) . '</h3>';  
                    echo '<p>' . htmlspecialchars($author) . '</p>';  
                    echo '<a href="book_borrow.php?book_id=' . htmlspecialchars($bid) . '"><button class="borrow-btn">See Details</button></a>';
                    
                    // Add data-rating attribute for JavaScript
                    echo '<div class="star-rating" data-rating="' . $rating . '"></div>';

                    echo '</div>';  
                }
            } else {
                echo "<p>No books found.</p>";
            }
        }
        ?>
    </section>
    <script>
        // JavaScript to generate stars dynamically
        document.addEventListener("DOMContentLoaded", function() {
            let starContainers = document.querySelectorAll(".star-rating");

            starContainers.forEach(container => {
                let rating = parseInt(container.getAttribute("data-rating")); // Get rating from data attribute
                
                for (let i = 1; i <= 5; i++) {
                    let star = document.createElement("i");
                    star.className = (i <= rating) ? "fa fa-star" : "fa fa-star-o";
                    container.appendChild(star);
                }
            });
        });
    </script>  
</div>

</body>
</html>
