<?php  
include "../connection.php";
session_start();  

// Handle form submission  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $location = $_POST['location'];  
    $address = $_POST['address'];  
    $hours = $_POST['hours'];  

    // Prepare and bind  
    $stmt = $db->prepare("INSERT INTO drop_boxes (location, address, hours) VALUES (?, ?, ?)");  
    $stmt->bind_param("sss", $location, $address, $hours);  

    // Execute statement  
    if ($stmt->execute()) {  
        echo "<div class='alert alert-success'>Drop box request submitted successfully!</div>";  
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
    <title>Host a Drop Box</title>  
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
    <h1 class="text-center">Host a Drop Box</h1>  

    <form method="POST" action="">  
        <div class="form-group">  
            <label for="location">Location Name:</label>  
            <input type="text" class="form-control" id="location" name="location" required>  
        </div>  
        <div class="form-group">  
            <label for="address">Address:</label>  
            <input type="text" class="form-control" id="address" name="address" required>  
        </div>  
        <div class="form-group">  
            <label for="hours">Operating Hours:</label>  
            <input type="text" class="form-control" id="hours" name="hours" required>  
        </div>  
        <button type="submit" class="btn btn-primary">Submit</button>  
    </form>  
</div>  

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  

</body>  
</html>  

<?php  
$db->close();  
?>  