<?php
  session_start();
  include('connection.php'); // Ensure you have a database connection

  if(isset($_POST['borrow'])) {
      $user_id = $_SESSION['user_id']; // Assume user is logged in
      $book_id = $_POST['book_id'];
      $borrow_date = date('Y-m-d');
      $return_date = date('Y-m-d', strtotime('+14 days')); // 2 weeks loan period
      
      $query = "INSERT INTO borrow_records (user_id, book_id, borrow_date, return_date, status) VALUES ('$user_id', '$book_id', '$borrow_date', '$return_date', 'Borrowed')";
      mysqli_query($db, $query);
      echo "<script>alert('Book borrowed successfully!'); window.location.href='books.php';</script>";
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Borrow Book</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <header>
        <h1>Borrow a Book</h1>
        <nav>
            <a href="index.php">HOME</a>
            <a href="books.php">BOOKS</a>
            <a href="feedback.php">FEEDBACK</a>
        </nav>
    </header>
    <div class="container">
        <h2>Borrow Your Favorite Book</h2>
        <form method="POST" action="borrow.php">
            <label for="book_id">Select Book:</label>
            <select name="book_id" required>
                <?php
                    $books = mysqli_query($db, "SELECT * FROM books WHERE available_copies > 0");
                    while($row = mysqli_fetch_assoc($books)) {
                        echo "<option value='" . $row['book_id'] . "'>" . $row['title'] . "</option>";
                    }
                ?>
            </select>
            <button type="submit" name="borrow">Borrow</button>
        </form>
    </div>
    <footer>
        <p>Library Management System &copy; 2025</p>
    </footer>
</body>
</html>
