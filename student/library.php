// deals.php
<?php
include('connection.php');
$query = "SELECT * FROM books WHERE discount > 0 ORDER BY discount DESC";
$result = mysqli_query($db, $query);
?>
<h2>Deals & Discounts</h2>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <p><?php echo $row['name']; ?> - Discount: <?php echo $row['discount']; ?>%</p>
<?php } ?>

// rewards.php
<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    echo "Login to view rewards.";
    exit;
}
// Fetch user rewards here
?>
<h2>Your Rewards</h2>

// mission.php
<?php
?>
<h2>Our Mission</h2>
<p>Providing quality books to all readers at affordable prices.</p>

// gifts.php
<?php
?>
<h2>Gift Books</h2>
<p>Buy books as gifts for your loved ones.</p>

// bestsellers.php
<?php
include('connection.php');
$query = "SELECT * FROM books ORDER BY sales DESC LIMIT 10";
$result = mysqli_query($db, $query);
?>
<h2>Bestselling Books</h2>
<?php while ($row = mysqli_fetch_assoc($result)) { ?>