<?php
include "connection.php";
include "navbar.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = mysqli_real_escape_string($db, $_POST['message']);

    // Insert notification for all students
    $query = "INSERT INTO notifications (user_email, message, status, created_at) 
              SELECT email, '$message', 'unread', NOW() FROM student";
    
    if (mysqli_query($db, $query)) {
        echo "<script>alert('Notification sent successfully to all students!');</script>";
    } else {
        echo "<script>alert('Error sending notification!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background:rgb(8, 85, 42);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .container {
            max-width: 600px;
            padding: 20px;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            text-align: center;
            margin-top: 160px;
        }

        h2 {
            color: #333;
        }

        /* Form */
        .notification-form {
            margin-top: 20px;
        }

        textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }

        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #218838;
        }

        /* Notification Table */
        .notifications-table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .notifications-table th, .notifications-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .notifications-table th {
            background: #28a745;
            color: white;
        }
        .scroll{
            max-height: 2px; /* Set max height for scroll */
                overflow-y: auto;
                border: 1px solid white;
                padding: 10px;
                margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
    <h2><a href="admin_settings.php"><i class="fa fa-mail-reply" style="width:20px;height: 20px;margin-left:-550px;"></i></a></h2>
        <h2><i class="fas fa-bell"></i> Send Notification</h2>
        
        <form action="" method="POST" class="notification-form">
            <textarea name="message" placeholder="Enter notification message..." required></textarea>
            <br>
            <button type="submit"><i class="fas fa-paper-plane"></i> Send Notification</button>
        </form>
    </div>

    <!-- Notification History -->
    <div class="container">
        <h2><i class="fas fa-list"></i> Notification History</h2>

        <table class="notifications-table">
            <tr>
                <th>ID</th>
                <th>User Email</th>
                <th>Message</th>
                <th>Status</th>
                <th>Sent At</th>
            </tr>

            <?php
            $query = "SELECT * FROM notifications ORDER BY created_at DESC";
            $result = mysqli_query($db, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr class='scroll'>
                        <td>{$row['id']}</td>
                        <td>{$row['user_email']}</td>
                        <td>{$row['message']}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['created_at']}</td>
                      </tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>
