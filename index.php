<?php
  session_start();
  include ("connection.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <title>student registration</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <style>
       
        .container {
            margin: 90px auto;
            flex: 1;
            padding: 1rem;
        }
        body {
            display: block;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            color: #4B382A; /* Brown */
            background-color: #FAF3E0; /* Light Beige */
            height:1600px;
            text-align: center;
        }

        header {
            background-color: #2D6A4F; /* Moss Green */
            color: white;
            padding: 1rem 2rem;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2rem;
        }
        h4 {
            font-size: 30px;
            font-weight: bold;
            background-image: linear-gradient(45deg, red, yellow, black, purple);
            background-size: 300%;
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            animation: colorAnimation 5s infinite linear;
        }

        @keyframes colorAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 70% 30%; }
            100% { background-position: 0% 50%; }
        }
        .glyphicon:hover
        {
            color:#2D6A4F;
        }

        nav {
            background-color: #D4A373; /* Soft Gold */
            padding: 0.5rem 2rem;
            text-align: center;
        }

        nav a {
            text-decoration: none;
            color: white;
            margin: 0 1rem;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }
        /*------------------------icons-------------------------*/
.icons-section {  
    display: flex;  
    justify-content: space-around;  
    align-items: center;  
    padding: 20px;  
    background-color: #f9f9f9; /* Light grey background */  
    opacity: .9;
    border-bottom: 1px solid #eee; /* Subtle border */  
}  

.icon-item {  
    display: flex;  
    flex-direction: column;  
    align-items: center;  
    color: #2D6A4F; /* Teal color, adjust as needed */  
    transition: transform 0.2s ease-in-out;  
}  

.icon-item:hover {  
    transform: scale(1.1);  
}  

.icon-item i {  
    font-size: 24px; /* Adjust icon size */  
    margin-bottom: 5px;  
}  

.icon-item span {  
    font-size: 12px;  
    text-transform: uppercase;  
    letter-spacing: 1px;  
}  
/*----------------------books zone------------------------*/
        .search-bar {
            margin: 30px auto;
            width: 700px;
            display: flex;
            justify-content: center;
            border-radius:50px;
        }
        .search-bar1 {
            margin: 70px auto;
            width: 500px;
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
            background-color:rgb(63, 63, 63);
            color:rgb(28, 203, 72) ;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1rem;

        }

        .search-bar button:hover {
            background-color:rgb(63, 64, 63);
            color:rgb(230, 233, 231) ;
            border: none;
            border-radius: 50px;
            font-size: 1rem;



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


/*------------------- after section----------------*/

.wrapper{  
        display: flex;  
        justify-content: space-between;  
        flex-wrap: wrap;
        width: 100%;
        height: 450px;
        margin-top:30px;
        background-color:white;
        padding:70px auto;


        }
        .features {
            display: flex;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 2rem;
            }

            .features div {
            background-color:rgb(233, 239, 237); ;
            padding: 1rem;
            border: 2px solid rgb(29, 152, 152);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(46, 184, 161, 0.1);
            height: 340px;
            width: 270px;
            margin-left: 30px;
            color: #2D6A4F;
            animation: animate 20s linear infinite;
            
            }
            .features div:hover
            {
                box-shadow: 2px 2px 10px rgba(53, 169, 165, 0.1);
                border-radius: 10px;
                transform: translateY(-5px);


            }

            @media (max-width: 768px) {
            .features {
                grid-template-columns: 1fr;
            }
        }
/*---------------------footer-------------------------------*/
    footer {  
        background-color:black; /* Change to desired color */  
        padding: 20px;  
        text-align: left;  
    }  

    .footer-container {  
        display: flex;  
        justify-content: space-between;  
        flex-wrap: wrap;  
    }  

    .footer-section {  
        flex: 1 1 200px; /* Adjust width as needed */  
        margin: 10px;  
    }  

    .footer-section h3 {  
        margin-bottom: 10px; 
        color:white; 
    }  

    .footer-section ul {  
        list-style: none;  
        padding: 0;  
    }  

    .footer-section li {  
        margin: 5px 0;  
    }  

    .footer-section a {  
        text-decoration: none;  
        color: #0073e6; /* Change to desired link color */  
    }  

    .footer-subscribe {  
        margin: 20px 0;  
        text-align: center;  
    }  

    .footer-bottom {  
        text-align: center;  
        margin-top: 20px;  
    }  

    .social-media a {  
        margin: 0 10px;  
    }  
    .fa {
        padding: 5px;
        font-size: 20px;
        width: 20px;
        text-align: center;
        text-decoration: none;
        margin: 2px 1px;
        border-radius:60px;
        }

    .fa:hover {
        opacity: 0.7;
        text-decoration: none;

    }

    .fa-facebook {
    color: #3B5998;
    }

    .fa-twitter {
        color: #55ACEE;
    }

    .fa-google {
        color: #dd4b39;
    }

    .fa-linkedin {
        color: #007bb5;
    }

    .fa-youtube {
        color: #bb0000;
    }

    .fa-instagram {
        color: #125688;
    }
    .star-rating {
            color: #FFD700; /* Gold color for stars */
            font-size: 20px;
            margin-top: 5px;
        }
        
    </style>
        
    </head>
    <body>
        <header>
            <div class="logo"></div>
            <?php
                if(isset($_SESSION['login_user']))
                {
                    ?>
                          <nav class="navigation">
                                <div class="center-links">
                                    <a href="index.php">HOME</a>
                                    <a href="books.php">BOOKS</a>
                                    <a href="feedback.php">FEEDBACK</a>
                                </div>
                                <div class="right-links">
                                    <ul><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></ul>
                                </div>
                            </nav>
                    <?php
                }
                else
                {
                    ?>
                        <nav class="navigation">
                            <div class="center-links">
                                
                            <a href="index.php"><i class="fa fa-home"></i>&nbsp;&nbsp;HOME</a>
                                    <a href="books.php"><i class="fa fa-book"></i>&nbsp;&nbsp;BOOKS</a>
                                    <a href="about.php"><i class="fa fa-bank"></i>&nbsp;&nbsp;about</a>
                                    <a href="feedback.php"><i class="fa fa-mail-forward"></i>&nbsp;&nbsp;FEEDBACK</a>
                            </div>
                            <div class="right-links">
                                <ul><a href="log_out.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></ul>
                                <ul><a href="log_out.php"><span class="glyphicon glyphicon-user"> SIGN UP</span></a></ul>
                            </div>
                        </nav>
                    <?php
                }
            ?>
            <div class="navbar-header">
                <h4 >LIBRARY MANAGEMENT</h4>
            </div>
        </header>
       
        <section>  
    <div class="container">
    <div class="search-bar1">
                </div>
        <form class="search-bar" action="seach.php" method="POST">
            <input type="text" name="search" placeholder="Search by book name" required="">&nbsp;
            <button class="btn btn-default" type="submit" name="submit"><span class="glyphicon glyphicon-search"></span></button>
        </form>
                <div class="icons-section">  
        <div class="icon-item">  
            <i class="fas fa-percent"></i>  
            <span>Deals</span>  
        </div>  
        <div class="icon-item">  
            <i class="fas fa-heart"></i>  
            <span>Rewards</span>  
        </div>  
        <div class="icon-item">  
            <i class="fas fa-mountain"></i>  
            <span>Mission</span>  
        </div>  
        <div class="icon-item">  
            <i class="fas fa-gift"></i>  
            <span>Gifts</span>  
        </div>  
        <div class="icon-item">  
            <i class="fas fa-chart-bar"></i>  
            <span>Bestsellers</span>  
        </div>  
        <div class="icon-item">  
            <i class="fas fa-book"></i>  
            <span>Trending</span>  
        </div>  
        <div class="icon-item">  
            <i class="fas fa-tag"></i>  
            <span>Shelf Steals</span>  
        </div>  
    </div>  
        <?php  
            // Fetch books from the database  
            $sql = "SELECT * FROM books";  
            $result = mysqli_query($db, $sql);  // Use $db (as defined in connection.php)  

            // Check if the query was successful  
            if (!$result) {  
                echo "Error fetching books: " . mysqli_error($db);  
            }  
        ?>  

        <!--  Rest of your content, including the book display -->  
        
        <div class="featured-books">
    <h2 style="color: white;">Available Books</h2>
    <div class="books-grid"> 
        <?php  
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
                echo '<img src="'. htmlspecialchars($image_url) .' " alt="' . htmlspecialchars($title) . ' ">';  
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
        ?>
    </div>
    <div class="view-all-container">
        <a href="literature.php" class="view-all-link">View All Books</a>
    </div>
</div>
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

    </section><br>
    
    <section class="wrapper">
    <div class="features">
      <div>
        <h3>Search for Books</h3>
        <p>Find your favorite books by title, author, or category in just a few clicks.</p>
      </div>
      <div>
        <h3>Check Availability</h3>
        <p>Quickly see if the books you want are available in the library.</p>
      </div>
      <div>
        <h3>Reserve and Borrow</h3>
        <p>Reserve books online and pick them up at your convenience.</p>
      </div>
      <div>
        <h3>Track Borrowing History</h3>
        <p>View your borrowing history and keep track of due dates to avoid fines.</p>
      </div>
    </div> 
    </section>
    <footer>  
    <div class="footer-container">  
        <div class="footer-section">  
            <h3>SUPPORT</h3>  
            <ul>  
                <li><a href="otherpages/order_status.php">Order Status</a></li>  
                <li><a href="otherpages/shipping.php">Shipping</a></li>  
                <li><a href="otherpages/return_policy.php">Return Policy</a></li>  
                <li><a href="otherpages/support_center.php">Support Center</a></li>  
                <li><a href="otherpages/index.php">FAQs</a></li>  
                <li><a href="otherpages/payment_methods.php">Payment Methods</a></li>  
                <li><a href="otherpages/settings.php">Cookie Settings</a></li>  
                <li><a href="otherpages/do_not.php">Do Not Sell or Share My Personal Information</a></li>  
                <li><a href="otherpages/accessibility.php">Accessibility Menu</a></li>  
            </ul>  
        </div>  
        
        <div class="footer-section">  
            <h3>SHOP</h3>  
            <ul>  
                <li><a href="otherpages/gift_certificate.php">Gift Certificate</a></li>  
                <li><a href="otherpages/wholesale.php">Wholesale</a></li>  
                <li><a href="otherpages/affiliates.php">Affiliates Program</a></li>  
                <li><a href="otherpages/deals_discounts.php">Deals & Discounts</a></li>  
                <li><a href="otherpages/review.php">Reviews</a></li>  
            </ul>  
        </div>  

        <div class="footer-section">  
            <h3>OUR SERVICES</h3>  
            <ul>  
                <li><a href="otherpages/find_drop.php">Find a Drop Box</a></li>  
                <li><a href="../index.php">Libraries</a></li>  
                <li><a href="../index.php">Campus</a></li>  
                <li><a href="../student/admin_teams.php">Booksellers</a></li>  
                <li><a href="otherpages/host_drop_box.php">Host a Drop Box</a></li>  
                <li><a href="otherpages/client.php">Client Portal</a></li>  
            </ul>  
        </div>  

        <div class="footer-section">  
            <h3>ABOUT US</h3>  
            <ul>  
                <li><a href="../about.php">Our Mission</a></li>  
                <li><a href="#">B Corp</a></li>  
                <li><a href="#">Sustainability</a></li>  
                <li><a href="#">History</a></li>  
                <li><a href="#">Internet Archive</a></li>  
                <li><a href="#">Blog</a></li>  
                <li><a href="#">Press & Media</a></li>  
                <li><a href="#">Careers</a></li>  
            </ul>  
        </div>  
    </div>  

    <div class="footer-subscribe">  
        <h4>GET OUR DEALS IN YOUR INBOX</h4>  
        <form action="subscribe.php" method="POST">  
            <input type="email" name="email" placeholder="Enter your email" required>  
            <button type="submit">Subscribe</button>  
        </form>  
    </div>  

    <div class="footer-bottom">  
        <p style="color:white;">&copy; <?php echo date("Y"); ?> BetterWorldBooks</p>  
        <div class="social-media">  
            <a href="#"  class="fa fa-instagram"></a>  
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-google"></a> 
            <a href="#" class="fa fa-linkedin"></a> 
            <a href="#" class="fa fa-twitter"></a> 
            <a href="#" class="fa fa-youtube"></a>   
        </div>  
    </div>  
</footer> 
    <script src="script1.js"></script>
    </body>
</html>