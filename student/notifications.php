<?php 
include "connection.php";
include "navbar.php";

// Fetch notifications for the logged-in user
$email = $_SESSION['login_user'];
$query = "SELECT * FROM notifications WHERE user_email='$email' ORDER BY created_at DESC";
$result = mysqli_query($db, $query);

// Mark notification as read when the "Mark as Read" button is clicked
if (isset($_POST['mark_read'])) {
    $notif_id = $_POST['notif_id'];
    mysqli_query($db, "UPDATE notifications SET status='read' WHERE id='$notif_id'");
    header("Location: notifications.php"); // Refresh the page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #121212;
    color: white;
    text-align: center;
    margin: 0;
    padding: 0;
}

.notifications-container {
    width: 50%;
    margin: 120px auto;
    background: black;
    border: 2px solid rgba(225, 255, 255, 0.2);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
}

.notifications-header {
    font-size: 24px;
    margin-bottom: 20px;
    color: white;
}

.notification-list {
    list-style: none;
    padding: 0;
}

.notification-item {
    background: #222;
    padding: 15px;
    margin: 10px 0;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.notification-item.unread {
    border-left: 4px solid green;
    font-weight: bold;
}

.notification-item.read {
    opacity: 0.7;
}

.notification-text {
    flex-grow: 1;
    text-align: left;
}

.notification-time {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.5);
}

.mark-read-btn {
    background-color: green;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.mark-read-btn:hover {
    background-color: white;
    color: green;
}

.back-link {
    margin-top: 15px;
}

.back-link a {
    color: green;
    text-decoration: none;
    font-size: 16px;
}

.back-link a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>

<div class="notifications-container">
    <h2 class="notifications-header"><i class="fa fa-bell"></i> Notifications</h2>

    <ul class="notification-list">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <li class="notification-item <?php echo $row['status']; ?>">
                <div class="notification-text"><?php echo $row['message']; ?></div>
                <div class="notification-time"><?php echo date("M d, Y H:i", strtotime($row['created_at'])); ?></div>
                <?php if ($row['status'] == 'unread') { ?>
                    <form method="post" style="margin-left: 10px;">
                        <input type="hidden" name="notif_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="mark_read" class="mark-read-btn"><i class="fa fa-check"></i></button>
                    </form>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>

    <div class="back-link">
        <a href="profile.php"><i class="fa fa-arrow-left"></i> Back to Settings</a>
    </div>
</div>

</body>
</html>
