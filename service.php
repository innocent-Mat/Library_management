<?php
// service.php - Services Page for Library Management System
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
    <script defer src="script.js"></script> <!-- Link to external JavaScript file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .header, .footer {
            background: #343a40;
            color: white;
            text-align: center;
            padding: 15px 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.5s ease-in-out;
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
            line-height: 1.6;
        }
        .service-list {
            list-style: none;
            padding: 0;
        }
        .service-list li {
            background: #e9ecef;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Library Management System</h2>
    </div>
    
    <div class="container" id="serviceSection">
        <h1>Our Services</h1>
        <p>We provide a variety of services to enhance your reading experience and manage books efficiently.</p>
        <ul class="service-list">
            <li>Online Book Browsing</li>
            <li>Borrowing and Returning Books</li>
            <li>eBook Downloads with Admin Approval</li>
            <li>Hardcover Book Reading Online</li>
            <li>User-Friendly Book Management</li>
        </ul>
    </div>
    
    <div class="footer">
        <p>&copy; 2025 Library Management System. All rights reserved.</p>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let serviceSection = document.getElementById("serviceSection");
            serviceSection.style.opacity = "1";
            serviceSection.style.transform = "translateY(0)";
        });
    </script>
</body>
</html>
