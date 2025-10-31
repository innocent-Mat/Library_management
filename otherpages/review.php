<?php 
include "../connection.php";
session_start();  

// Handle form submission  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $name = $_POST['name'];  
    $review = $_POST['review'];  
    $rating = $_POST['rating'];  

    // Prepare and bind  
    $stmt = $db->prepare("INSERT INTO reviews (name, review, rating) VALUES (?, ?, ?)");  
    $stmt->bind_param("ssi", $name, $review, $rating);  

    // Execute statement  
    if ($stmt->execute()) {  
        echo "<div class='alert alert-success'>Review submitted successfully!</div>";  
    } else {  
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";  
    }  

    $stmt->close();  
}  

// Fetch existing reviews  
$reviews = $db->query("SELECT * FROM reviews ORDER BY created_at DESC");  

?>  
<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Library System - Reviews</title>  
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">  
    <style>  
        body {  
            background-color: #f8f9fa;  
        }  
        .container {  
            margin-top: 20px;  
        }  
        .card {  
            margin-bottom: 20px;  
        }  
    </style>  
</head>  
<body>  

<div class="container">  
    <h1 class="text-center">Library System Reviews</h1>  
    
    <div class="card">  
        <div class="card-header">  
            <h5><i class="fas fa-book"></i> What is the Library System?</h5>  
        </div>  
        <div class="card-body">  
            <p>The Library System streamlines borrowing and returning books. It offers users the ability to search for books, check availability, and leave reviews.</p>  
        </div>  
    </div>  

    <div class="card">  
        <div class="card-header">  
            <h5><i class="fas fa-star"></i> User Reviews</h5>  
        </div>  
        <div class="card-body">  
            <?php if ($reviews->num_rows > 0): ?>  
                <?php while ($row = $reviews->fetch_assoc()): ?>  
                    <h6><?php echo htmlspecialchars($row['name']); ?></h6>  
                    <p><?php echo htmlspecialchars($row['review']); ?></p>  
                    <p><strong>Rating:</strong> <?php echo str_repeat('⭐', $row['rating']); ?></p>  
                    <hr>  
                <?php endwhile; ?>  
            <?php else: ?>  
                <p>No reviews found.</p>  
            <?php endif; ?>  
        </div>  
    </div>  

    <div class="card">  
        <div class="card-header">  
            <h5><i class="fas fa-comments"></i> Leave Your Review</h5>  
        </div>  
        <div class="card-body">  
            <form method="POST" action="">  
                <div class="form-group">  
                    <label for="name">Your Name:</label>  
                    <input type="text" class="form-control" id="name" name="name" required>  
                </div>  
                <div class="form-group">  
                    <label for="review">Your Review:</label>  
                    <textarea class="form-control" id="review" name="review" rows="3" required></textarea>  
                </div>  
                <div class="form-group">  
                    <label for="rating">Rating:</label>  
                    <select class="form-control" id="rating" name="rating" required>  
                        <option value="5">⭐⭐⭐⭐⭐</option>  
                        <option value="4">⭐⭐⭐⭐</option>  
                        <option value="3">⭐⭐⭐</option>  
                        <option value="2">⭐⭐</option>  
                        <option value="1">⭐</option>  
                    </select>  
                </div>  
                <button type="submit" class="btn btn-primary">Submit Review</button>  
            </form>  
        </div>  
    </div>  
</div>  

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  

</body>  
</html>  

<?php  
$db->close();  
?>  