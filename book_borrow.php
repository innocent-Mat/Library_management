<?php  
session_start();  
include("connection.php");  

if (!isset($_GET['book_id'])) {  
    echo "Book ID not provided.";  
    exit;  
}  

$book_id = $_GET['book_id'];  
$sql = "SELECT * FROM books WHERE bid = '$book_id'";  
$result = mysqli_query($db, $sql);  

if (!$result || mysqli_num_rows($result) == 0) {  
    echo "Book not found.";  
    exit;  
}  

$book = mysqli_fetch_assoc($result);  

// Insert into issue_book when the user makes a selection
if (isset($_POST['format']) && isset($_SESSION['login_user'])) {  
    $username = $_SESSION['login_user'];  
    $format = $_POST['format'];  

    $insert_sql = "INSERT INTO issue_book (username, bid, format) VALUES ('$username', '$book_id', '$format')";  
    mysqli_query($db, $insert_sql);  
}  

// Calculate star rating based on downloads & reads
$downloads = $book['downloads'] ?? 0;
$reads = $book['reads'] ?? 0;
$totalActivity = $downloads + $reads;

// Define star count logic
$stars = 1;
if ($totalActivity > 10) $stars = 2;
if ($totalActivity > 50) $stars = 3;
if ($totalActivity > 100) $stars = 4;
if ($totalActivity > 200) $stars = 5;
?>

<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Borrow Book</title>  
    <style>  
      /* Header styling */
      .header {  
            background: #dfeefa;  
            padding: 15px 20px;  
            display: flex;  
            align-items: center;  
            justify-content: space-between;  
            font-family: Arial, sans-serif;  
        }  

        .header-logo {  
            display: flex;  
            align-items: center;  
            cursor: pointer;
        }  

        .header-logo img {  
            height: 50px;  
            margin-right: 20px;

        }  

        .header-menu {  
            display: flex;  
            gap: 20px;  
            font-size: 14px;  
        }  
        h4 {
            font-size: 30px;
            font-weight: bold;
            background-image: linear-gradient(45deg, red, yellow, blue, green, purple);
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

        /* Book display styling */
        body {  
            font-family: 'Arial', sans-serif;  
            background-color:rgb(7, 87, 75);  
            display: grid;  
            justify-content: center;  
            align-items: center;  
            flex-direction: column;  
            height: 100vh;  
            margin: 0;  
        }  

        .book-container {  
            display: flex;  
            flex-direction: column;  
            align-items: center;  
            background: white;  
            padding: 25px;  
            border-radius: 10px;  
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);  
            width: 400px;  
            text-align: center;  
            margin-top: 20px;
            margin-left: 32%;  
        }  

        .book-image img {  
            width: 220px;  
            height: auto;  
            border-radius: 5px;  
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);  
        }  

        h2 {  
            font-size: 22px;  
            margin-top: 10px;  
            color: #333;  
        }  

        p {  
            font-size: 16px;  
            color: #666;  
            margin: 5px 0;  
        }  

        .format-selection {  
            margin-top: 15px;  
            display: flex;  
            gap: 15px;  
        }  

        .format-btn {  
            background:rgb(13, 159, 78);  
            color: white;  
            border: none;  
            padding: 10px 16px;  
            font-size: 14px;  
            border-radius: 5px;  
            cursor: pointer;  
            transition: background 0.3s;  
        }  

        .format-btn:hover, .format-btn.selected {  
            background:rgb(5, 67, 41);  
        }  

        .borrow-btn {  
            background:rgb(8, 147, 234);  
            color: white;  
            padding: 12px 18px;  
            border: none;  
            border-radius: 5px;  
            cursor: pointer;  
            font-size: 16px;  
            margin-top: 20px;  
            transition: background 0.3s;  
            width: 100%;  
        }  

        .borrow-btn:hover {  
            background:rgb(10, 50, 114);  
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
            border: 1px solid rgb(29, 152, 152);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(46, 184, 161, 0.1);
            height: 340px;
            color: #2D6A4F;
            
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
        /* Star Rating Styles */
        .stars {
            color: gold;
            font-size: 20px;
            margin-left: 10px;
        }
    </style>    
</head>  
<body> 
    
    <!-- Header -->
    <div class="header">  
        <div class="header-logo">  
            <a href="index.php"><img src="logo.jpg" alt="Logo"> </a>
            <span>Find What to Read Next!</span>  
        </div>  
        <div class="header-search"> 
        <h4 id="libraryText">Library Management</h4>
 
        </div>  
        <div class="header-menu">  
            <a href="index.php"><span>home</span></a>  
            <a href="deals.php"><span>Deals</span></a> 
            <a href="rewards.php"><span>Rewards</span></a>  
            <a href="gifts.php"><span>Gifts</span></a>  
            <a href="shipping.php"><span>Shipping</span></a>  
        </div>  
    </div>   

    <!-- Book Content -->
    <div class="book-container">  
        <div class="book-image">  
            <img src="<?php echo htmlspecialchars($book['image_path']); ?>" alt="<?php echo htmlspecialchars($book['name']); ?>">  
        </div>  
        <h2><?php echo htmlspecialchars($book['name']); ?></h2>  
        <p>by <?php echo htmlspecialchars($book['authors']); ?></p>  
        <p><strong>Availability:</strong> <?php echo ($book['quantity'] > 0) ? "Available" : "Not Available"; ?></p>  

        <div class="format-selection">  
            <button class="format-btn" data-format="Hardcover">Hardcover</button>  
            <button class="format-btn" data-format="eBook">eBook</button>  
        </div>  

        <p id="selected-format">Selected: Hardcover</p>  
        
        <form action="" method="POST" id="borrow-form">  
            <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">  
            <input type="hidden" name="format" id="format-input" value="Hardcover">  
            <button type="submit" class="borrow-btn" id="borrow-button">Read</button>  
            
            <!-- Star Rating Display -->
            <span class="stars">
                <?php echo str_repeat("★", $stars) . str_repeat("☆", 5 - $stars); ?>
            </span>
        </form>  
    </div> 

    <script>  
    document.addEventListener("DOMContentLoaded", function () {  
        const formatButtons = document.querySelectorAll(".format-btn");  
        const formatInput = document.getElementById("format-input");  
        const selectedFormatText = document.getElementById("selected-format");  
        const borrowButton = document.getElementById("borrow-button");  
        const borrowForm = document.getElementById("borrow-form");  

        formatButtons.forEach(button => {  
            button.addEventListener("click", function () {  
                formatButtons.forEach(btn => btn.classList.remove("selected"));  
                this.classList.add("selected");  

                const selectedFormat = this.getAttribute("data-format");  
                formatInput.value = selectedFormat;  
                selectedFormatText.textContent = "Selected: " + selectedFormat;  

                if (selectedFormat === "eBook") {  
                    borrowButton.textContent = "Download";  
                    borrowForm.action = "download.php?book_id=<?php echo $book_id; ?>";  
                } else {  
                    borrowButton.textContent = "Read";  
                    borrowForm.action = "read_book.php?book_id=<?php echo $book_id; ?>";  
                }  
            });  
        });  
    });  
    </script>  
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
            <h3 style="color: white;">SUPPORT</h3>  
            <ul>  
                <li><a href="#">Order Status</a></li>  
                <li><a href="#">Shipping</a></li>  
                <li><a href="#">Return Policy</a></li>  
                <li><a href="#">Support Center</a></li>  
                <li><a href="#">FAQs</a></li>  
                <li><a href="#">Payment Methods</a></li>  
                <li><a href="#">Cookie Settings</a></li>  
                <li><a href="#">Do Not Sell or Share My Personal Information</a></li>  
                <li><a href="#">Accessibility Menu</a></li>  
            </ul>  
        </div>  
        
        <div class="footer-section">  
            <h3 style="color: white;">SHOP</h3>  
            <ul>  
                <li><a href="#">Gift Certificate</a></li>  
                <li><a href="#">Wholesale</a></li>  
                <li><a href="#">Affiliates Program</a></li>  
                <li><a href="#">Deals & Discounts</a></li>  
                <li><a href="#">Reviews</a></li>  
            </ul>  
        </div>  

        <div class="footer-section">  
            <h3 style="color: white;">OUR SERVICES</h3>  
            <ul>  
                <li><a href="#">Find a Drop Box</a></li>  
                <li><a href="#">Libraries</a></li>  
                <li><a href="#">Campus</a></li>  
                <li><a href="#">Booksellers</a></li>  
                <li><a href="#">Host a Drop Box</a></li>  
                <li><a href="#">Client Portal</a></li>  
            </ul>  
        </div>  

        <div class="footer-section">  
            <h3 style="color: white;">ABOUT US</h3>  
            <ul>  
                <li><a href="#">Our Mission</a></li>  
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
        <h4>Subscribe to our Newsletter</h4>
        <p style="color: white;">Stay updated with the latest books and offers!</p>
        <form id="subscribe-form" action="subscribe.php" method="POST">
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <button type="submit" class="subscribe-btn">Subscribe</button>
        </form>
        <p id="subscribe-message"></p>
        <script>
document.getElementById("subscribe-form").addEventListener("submit", function(event) {
    var email = document.getElementById("email").value;
    var message = document.getElementById("subscribe-message");
    
    if (!validateEmail(email)) {
        event.preventDefault(); 
        message.innerHTML = "Please enter a valid email address!";
        message.style.color = "red";
    } else {
        message.innerHTML = "Subscription successful!";
        message.style.color = "green";
    }
});

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
</script>

    </div> 
    <div class="footer-bottom">  
        <p style="color: white;">&copy; <?php echo date("Y"); ?> BetterWorldBooks</p>  
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
</body>  
</html>  
