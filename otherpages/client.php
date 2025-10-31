<?php  
include "../connection.php";
session_start();  

// Handle form submission  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $name = $_POST['name'];  
    $email = $_POST['email'];  
    $phone = $_POST['phone'];  

    // Prepare and bind  
    $stmt = $db->prepare("INSERT INTO clients (name, email, phone) VALUES (?, ?, ?)");  
    $stmt->bind_param("sss", $name, $email, $phone);  

    // Execute statement  
    if ($stmt->execute()) {  
        echo "<div class='alert alert-success'>Client registration successful!</div>";  
    } else {  
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";  
    }  

    $stmt->close();  
}  
?>  

<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Client Registration</title>  
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  
    <style>  
        body {  
            background-color: #f8f9fa;  
        }  
        .container {  
            margin-top: 20px;  
        }  
    </style>  
</head>  
<body>  

<div class="container">  
    <h1 class="text-center">Client Registration</h1>  

    <form method="POST" action="">  
        <div class="form-group">  
            <label for="name">Your Name:</label>  
            <input type="text" class="form-control" id="name" name="name" required>  
        </div>  
        <div class="form-group">  
            <label for="email">Email Address:</label>  
            <input type="email" class="form-control" id="email" name="email" required>  
        </div>  
        <div class="form-group">  
            <label for="phone">Phone Number:</label>  
            <input type="tel" class="form-control" id="phone" name="phone">  
        </div>  
        <button type="submit" class="btn btn-primary">Register</button>  
    </form>  
</div>  

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  

</body>  
</html>  

<?php  
$db->close();  
?>  