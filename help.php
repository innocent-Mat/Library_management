<?php
session_start();
include('connection.php'); // Connect to database

if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit();
}

$login_user = $_SESSION['login_user'];

// Fetch student details
$query = "SELECT username, email FROM student WHERE email = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $login_user);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $help_message = $_POST['help_message'];

    // Insert help request into the database
    $query = "INSERT INTO help_requests (student_email, student_name, message) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("sss", $student['email'], $student['username'], $help_message);

    if ($stmt->execute()) {
        $message = "✅ Your request has been submitted!";
    } else {
        $message = "❌ Error submitting your request. Please try again.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2><i class="fa fa-question-circle"></i> Help & Support</h2>
        <p>If you have any issues, please submit your request below. Our team will assist you soon.</p>

        <form method="POST" id="helpForm">
            <label for="name"><i class="fa fa-user"></i> Name:</label>
            <input type="text" value="<?php echo $student['username']; ?>" readonly>

            <label for="email"><i class="fa fa-envelope"></i> Email:</label>
            <input type="email" value="<?php echo $student['email']; ?>" readonly>

            <label for="message"><i class="fa fa-comment"></i> Your Message:</label>
            <textarea name="help_message" id="message" required></textarea>

            <button type="submit"><i class="fa fa-paper-plane"></i> Submit Request</button>
        </form>

        <p class="message"><?php echo $message; ?></p>
    </div>

    <script>
        document.getElementById("helpForm").addEventListener("submit", function(event) {
            let confirmSubmit = confirm("Are you sure you want to submit this request?");
            if (!confirmSubmit) {
                event.preventDefault();
            }
        });
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }

        .container {
            background: white;
            padding: 20px;
            width: 50%;
            margin: auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        h2 {
            color: #007bff;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, textarea {
            padding: 10px;
            width: 80%;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            height: 100px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</body>
</html>
