

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Library</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header, .footer {
            background: #343a40;
            color: white;
            text-align: center;
            padding: 15px 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px #ccc;
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.5s ease-in-out;
        }
        h2 {
            text-align: center;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background: #218838;
        }
        .success {
            color: green;
            text-align: center;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Contact Library Support</h2>
    </div>
    
    <div class="container" id="contactForm">
        <h2>Contact Us</h2>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Send Message</button>
            <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);
    
    $conn = new mysqli("localhost", "root", "", "library");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    
    if ($stmt->execute()) {
        echo "<p class='success'>Message sent successfully!</p>";
    } else {
        echo "<p class='error'>Error sending message.</p>";
    }
    
    $stmt->close();
    $conn->close();
}
?>
        </form>
    </div>
    
    <div class="footer">
        <p>&copy; 2025 Library Management System. All rights reserved.</p>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let contactForm = document.getElementById("contactForm");
            contactForm.style.opacity = "1";
            contactForm.style.transform = "translateY(0)";
        });
    </script>
</body>
</html>
