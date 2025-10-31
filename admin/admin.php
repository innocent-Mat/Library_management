<?php
session_start();
include 'connection.php'; // Database connection file

// Fetch logged-in admin details
$logged_in_admin = $_SESSION['login_user'];

// Fetch all admins except the logged-in admin
$sql = "SELECT * FROM admin WHERE username != '$logged_in_admin'";
$result = mysqli_query($db, $sql);

// Fetch online admins
$online_sql = "SELECT * FROM admin WHERE status='yes' AND username != '$logged_in_admin'";
$online_result = mysqli_query($db, $online_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .container {
    width: 80%;
    margin: auto;
    text-align: center;
    font-family: Arial, sans-serif;
}
h2, h3 {
    color: #333;
}
.admin-list ul, .online-admins ul {
    list-style: none;
    padding: 0;
}
.admin-list li, .online-admins li {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f4f4f4;
    padding: 10px;
    margin: 5px 0;
    border-radius: 5px;
}
.admin-list img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.message-btn {
    background: #007BFF;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}
.message-btn:hover {
    background: #0056b3;
}
.online {
    color: green;
}
.message-form {
    display: none;
    margin-top: 20px;
    padding: 10px;
    border: 1px solid #ddd;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        
        <!-- Admin List -->
        <div class="admin-list">
            <h3>All Admins</h3>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <li>
                        <img src="images/<?php echo $row['pic']; ?>" alt="Admin Pic">
                        <span><?php echo $row['username']; ?></span>
                        <button class="message-btn" onclick="openMessageForm('<?php echo $row['username']; ?>')">
                            <i class="fa fa-envelope"></i> Message
                        </button>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <!-- Online Admins -->
        <div class="online-admins">
            <h3>Online Admins</h3>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($online_result)) { ?>
                    <li>
                        <i class="fa fa-circle online"></i> <?php echo $row['username']; ?>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <!-- Message Form -->
        <div class="message-form" id="messageForm">
            <h3>Send Message</h3>
            <select id="adminSelect">
                <option value="all">All Admins</option>
                <?php 
                mysqli_data_seek($result, 0); // Reset result set
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['username']; ?>"><?php echo $row['username']; ?></option>
                <?php } ?>
            </select>
            <textarea id="messageText" placeholder="Type your message here..."></textarea>
            <button onclick="sendMessage()"><i class="fa fa-paper-plane"></i> Send</button>
        </div>
    </div>

    <script>
        function openMessageForm(admin) {
            $('#adminSelect').val(admin);
            $('#messageForm').fadeIn();
        }

        function sendMessage() {
            let recipient = $('#adminSelect').val();
            let message = $('#messageText').val();
            if (message.trim() === '') {
                alert("Message cannot be empty!");
                return;
            }
            $.post('send_message.php', { recipient: recipient, message: message }, function(response) {
                alert(response);
                $('#messageForm').fadeOut();
            });
        }
    </script>
</body>
</html>
