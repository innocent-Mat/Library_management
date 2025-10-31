<?php
include("connection.php");

$books_per_page = 8; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
$offset = ($page - 1) * $books_per_page;

$sql = "SELECT * FROM books ORDER BY release_date DESC LIMIT $books_per_page OFFSET $offset";
$result = mysqli_query($db, $sql);


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="book-card">';
        echo '<img src="' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["name"]) . '">';
        echo '<h3>' . htmlspecialchars($row["name"]) . '</h3>';
        echo '<p>By ' . htmlspecialchars($row["authors"]) . '</p>';
        $downloads = $row['downloads'];
        $reads = $row['reads'];
        
         // Calculate rating based on downloads and reads
         $total_interactions = $downloads + $reads;
         $stars = round(min(5, $total_interactions / 10)); // Adjust divisor as needed
        
         // Display stars dynamically
        echo "<div class='stars'>";
        for ($i = 0; $i < $stars; $i++) {
            echo "<span class='star'>&#9733;</span>"; // Filled star
        }
        for ($i = $stars; $i < 5; $i++) {
            echo "<span class='star empty'>&#9734;</span>"; // Empty star
        }
        echo "</div>";

        echo '<a href="see_detail.php?bid='.$row['bid'].'" class="details-btn">See Details</a>';
        echo '</div>';
    }
} else {
    echo "<p>No books available.</p>";
}
?>
