<?php
// about.php - About Page for Library Management System
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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
            padding: 28px 0;
            margin: 0px auto;
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
    </style>
</head>
<body>
    <div class="header">
        <h2>Library Management System</h2>
    </div>
    
    <div class="container" id="aboutSection">
        <h1>About Our Library Management System</h1>
        <p>Welcome to our digital library! Our system provides students with easy access to books for reading online or downloading eBooks with admin approval. The platform ensures efficient book management, borrowing, and user-friendly experiences.</p>
        <p>Our goal is to make learning accessible, interactive, and seamless for students and administrators alike.</p>
    </div>
    
    <div class="footer">
        <p>&copy; 2025 Library Management System. All rights reserved.</p>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let aboutSection = document.getElementById("aboutSection");
            aboutSection.style.opacity = "1";
            aboutSection.style.transform = "translateY(0)";
        });
    </script>
</body>
</html>
