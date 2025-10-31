<?php  
session_start();  

// Assume these are the drop box locations stored in a database.  
$dropBoxes = [  
    ['location' => 'Main Branch', 'address' => '123 Library St, Cityville', 'hours' => '9 AM - 5 PM'],  
    ['location' => 'East Side Branch', 'address' => '456 East St, Cityville', 'hours' => '10 AM - 6 PM'],  
    ['location' => 'West Side Branch', 'address' => '789 West St, Cityville', 'hours' => '11 AM - 7 PM'],  
];  
?>  

<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Library System - Find Drop Box</title>  
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
    <h1 class="text-center">Find Drop Boxes</h1>  

    <div class="card">  
        <div class="card-header">  
            <h5><i class="fas fa-map-marker-alt"></i> Available Drop Box Locations</h5>  
        </div>  
        <div class="card-body">  
            <?php if (!empty($dropBoxes)): ?>  
                <ul class="list-group">  
                    <?php foreach ($dropBoxes as $box): ?>  
                        <li class="list-group-item">  
                            <h6><?php echo htmlspecialchars($box['location']); ?></h6>  
                            <p><strong>Address:</strong> <?php echo htmlspecialchars($box['address']); ?></p>  
                            <p><strong>Hours:</strong> <?php echo htmlspecialchars($box['hours']); ?></p>  
                        </li>  
                    <?php endforeach; ?>  
                </ul>  
            <?php else: ?>  
                <p>No drop boxes available at this time.</p>  
            <?php endif; ?>  
        </div>  
    </div>  
</div>  

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  

</body>  
</html>  