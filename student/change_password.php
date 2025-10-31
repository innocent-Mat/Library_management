<?php 
include "connection.php";
include "navbar.php";

if (isset($_POST['change'])) {
    $currentPass = $_POST['current_pass'];
    $newPass = $_POST['new_pass'];
    $confirmPass = $_POST['confirm_pass'];

    $q = mysqli_query($db, "SELECT password FROM student WHERE email='$_SESSION[login_user]'");
    $row = mysqli_fetch_assoc($q);

    if ($row['password'] == $currentPass) {
        if ($newPass == $confirmPass) {
            mysqli_query($db, "UPDATE student SET password='$newPass' WHERE email='$_SESSION[login_user]'");
            echo "<script>alert('Password Changed!'); window.location='profile.php';</script>";
        } else {
            echo "<script>alert('Passwords do not match!');</script>";
        }
    } else {
        echo "<script>alert('Current password is incorrect!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #121212;
    color: white;
    text-align: center;
    margin: 0;
    padding: 0;
}

.change-password-container {
    width: 40%;
    margin: 160px auto;
    background: black;
    border: 2px solid rgba(225, 255, 255, 0.2);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
}

.change-password-header {
    font-size: 24px;
    margin-bottom: 20px;
    color: white;
}

.change-password-form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.change-password-form input {
    width: 80%;
    padding: 12px;
    margin: 10px 0;
    border: none;
    border-radius: 5px;
    background-color: #222;
    color: white;
    font-size: 16px;
}

.change-password-form input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.change-password-form button {
    width: 85%;
    background-color: green;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 15px;
    transition: 0.3s;
}

.change-password-form button:hover {
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

<div class="change-password-container">
    <h2 class="change-password-header"><i class="fa fa-key"></i> Change Password</h2>

    <form method="post" class="change-password-form">
        <input type="password" name="current_pass" placeholder="Current Password" required>
        <input type="password" name="new_pass" placeholder="New Password" required>
        <input type="password" name="confirm_pass" placeholder="Confirm New Password" required>
        <button type="submit" name="change"><i class="fa fa-save"></i> Change Password</button>
    </form>

    <div class="back-link">
        <a href="profile.php"><i class="fa fa-arrow-left"></i> Back to Settings</a>
    </div>
</div>

</body>
</html>
