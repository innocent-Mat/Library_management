<?php 
include "connection.php";
include "navbar.php";

// Fetch student details
$q = mysqli_query($db, "SELECT * FROM student WHERE email='$_SESSION[login_user]';");
$row = mysqli_fetch_assoc($q);

// Get profile image from 'images/' folder using 'pic' column
$profileImage = !empty($row['pic']) ? "images/" . $row['pic'] : "images/default.png"; // Default if empty
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Settings</title>
    <link rel="stylesheet" href="css/styles.css"> 
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
            background-color: #121212;
            color: white;
            text-align: center;
            transition: 0.3s ease-in-out;
        }
        .settings-container {
            width: 50%;
            margin: 160px auto;
            background: black;
            border: 2px solid rgba(225, 255, 255, 0.2);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
        .settings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .settings-header h2 {
            color: white;
        }
        .theme-toggle {
            cursor: pointer;
            font-size: 22px;
            transition: transform 0.3s ease;
        }
        .theme-toggle:hover {
            transform: scale(1.2);
        }
        .profile-img img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 2px solid white;
        }
        .settings-list {
            width: 100%;
            margin-top: 20px;
            text-align: left;
        }
        .settings-list li {
            padding: 12px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid white;
            transition: 0.3s;
            cursor: pointer;
        }
        .settings-list li:hover {
            background-color:#333;
            color:white;
        }
        .settings-list i {
            margin-right: 15px;
            color: lightgreen;
            font-size: 20px;
        }
        .settings-btn {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .settings-btn:hover {
            background-color: white;
            color: green;
        }
        /* Dark Mode */
        .dark-mode {
            background-color: white;
            color: black;
        }
        .dark-mode .settings-container {
            background-color: #f0f0f0;
            color: black;
            border-color: rgba(0, 0, 0, 0.2);
        }
        .dark-mode .settings-list li:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="settings-container">
    <div class="settings-header">
        <h2><i class="fa fa-cogs"></i> Library Settings</h2>
        <i id="theme-toggle" class="fa fa-moon theme-toggle"></i>
    </div>

    <div class="profile-img">
        <img src="<?php echo $profileImage; ?>" alt="Profile Picture">
    </div>

    <ul class="settings-list">
        <li onclick="location.href='edit.php';"><i class="fa fa-user-edit"></i> Edit Profile</li>
        <li onclick="location.href='change_password.php';"><i class="fa fa-lock"></i> Change Password</li>
        <li onclick="location.href='notifications.php';"><i class="fa fa-bell"></i> Notifications</li>
        <li onclick="location.href='support.php';"><i class="fa fa-commenting"></i>Message</li>
        <li onclick="location.href='privacy.php';"><i class="fa fa-shield-alt"></i> Privacy Settings</li>
        <li onclick="location.href='admin_teams.php';"><i class="fa fa-user"></i>Admin</li>
        <li onclick="location.href='support.php';"><i class="fa fa-life-ring"></i> Support</li>
        <li onclick="location.href='gift.php';"><i class="fa fa-gift"></i> Gift</li>
        <li onclick="location.href='date.php';"><i class="fa fa-calendar"></i>Date</li>
        <li onclick="location.href='language.php';"><i class="fa fa-globe"></i> Language</li>
        <li onclick="location.href='help.php';"><i class="fa fa-question-circle-o"></i> Help</li>
        <li onclick="location.href='student_archive.php';"><i class="fa fa-archive"></i> Archive</li>
        <li onclick="location.href='update your account.php';"><i class="fa fa-id-badge"></i>Update your Account</li>
        <li onclick="location.href='delete.php';"><i class="fa fa-trash"></i>Delete the Account</li>

    </ul>

    <form action="logout.php" method="post">
        <button type="submit" class="settings-btn"><i class="fa fa-sign-out-alt"></i> Logout</button>
    </form>
</div>

<script>
    // Dark mode toggle
    document.getElementById("theme-toggle").addEventListener("click", function() {
        document.body.classList.toggle("dark-mode");
        this.classList.toggle("fa-sun");
    });
</script>

</body>
</html>
