<?php
session_start();
include('connection.php'); // Connect to the database

if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit();
}

$login_user = $_SESSION['login_user'];
$message = "";

// Handle Date Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_date = $_POST['selected_date'];

    // Insert selected date into the database
    $query = "INSERT INTO dates (student_email, selected_date) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $login_user, $selected_date);

    if ($stmt->execute()) {
        $message = "✅ Date saved successfully!";
    } else {
        $message = "❌ Error saving date. Try again.";
    }

    $stmt->close();
}

// Fetch user's saved dates
$query = "SELECT selected_date FROM dates WHERE student_email = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $login_user);
$stmt->execute();
$result = $stmt->get_result();

$saved_dates = [];
while ($row = $result->fetch_assoc()) {
    $saved_dates[] = $row['selected_date'];
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Selection</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <div class="container">
        <h2><i class="fa fa-calendar"></i> Select a Date</h2>
        <p>Choose a date and save it for future reference.</p>

        <form method="POST">
            <label for="date">📅 Select Date:</label>
            <input type="date" name="selected_date" id="date" required>
            <button type="submit"><i class="fa fa-save"></i> Save Date</button>
        </form>

        <p class="message"><?php echo $message; ?></p>

        <h3>📌 Your Saved Dates:</h3>
        <ul>
            <?php foreach ($saved_dates as $date) { ?>
                <li>🗓️ <?php echo $date; ?></li>
            <?php } ?>
        </ul>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date().toISOString().split("T")[0];
            document.getElementById("date").setAttribute("min", today);
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
        }

        input {
            padding: 10px;
            width: 80%;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
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

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background: #e9ecef;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
        }
    </style>
</body>
</html>
