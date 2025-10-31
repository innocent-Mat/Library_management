<?php
include "connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background:rgb(13, 88, 39);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 700px;
        }

        /* Settings Container */
        .container {
            max-width: 600px;
            padding: 20px;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            text-align: center;
            transition: 0.3s ease-in-out;
            margin:160px auto;
        }

        .container:hover {
            transform: scale(1.02);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        /* Settings Options */
        .settings-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            margin: 10px 0;
            background: #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: black;
            font-size: 18px;
            position: relative;
            transition: all 0.3s ease-in-out;
            overflow: hidden;
        }

        .settings-option i {
            font-size: 24px;
            margin-right: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .settings-option:hover {
            background: #4CAF50;
            color: white;
        }

        .settings-option:hover i {
            transform: rotate(360deg);
        }

        /* Tooltip Effect */
        .tooltip {
            display: none;
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            font-size: 14px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            white-space: nowrap;
        }

        .settings-option:hover .tooltip {
            display: block;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Admin Settings</h2>
        
        <a href="admin_notifications.php" class="settings-option">
            <i class="fas fa-bell"></i> Send Notifications
            <span class="tooltip">Send messages to users</span>
        </a>

        <a href="admin_privacy.php" class="settings-option">
            <i class="fas fa-user-shield"></i> Privacy Settings
            <span class="tooltip">Manage privacy settings</span>
        </a>

        <a href="support.php" class="settings-option">
            <i class="fas fa-life-ring"></i> Support
            <span class="tooltip">Get support & help</span>
        </a>
        <a href="admin.php" class="settings-option">
            <i class="fas fa-life-ring"></i> admin
            <span class="tooltip">Get support & help</span>
        </a>
        <a href="delete_account.php" class="settings-option">
            <i class="fa fa-trash-o"></i> Delete Account
            <span class="tooltip">Delete Account</span>
        </a>
    </div>

    <script>
        // JavaScript for hover effect
        document.querySelectorAll(".settings-option").forEach(option => {
            option.addEventListener("mouseenter", () => {
                option.style.transform = "translateX(5px)";
            });
            option.addEventListener("mouseleave", () => {
                option.style.transform = "translateX(0)";
            });
        });
    </script>

</body>
</html>
