<?php 
include "connection.php";
include "navbar.php";

// Fetch user email
$email = $_SESSION['login_user'];

// Handle form submission
if (isset($_POST['submit'])) {
    $subject = mysqli_real_escape_string($db, $_POST['subject']);
    $message = mysqli_real_escape_string($db, $_POST['message']);

    if (!empty($subject) && !empty($message)) {
        $query = "INSERT INTO support (user_email, subject, message) VALUES ('$email', '$subject', '$message')";
        mysqli_query($db, $query);
        $successMessage = "Your support request has been submitted!";
    } else {
        $errorMessage = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #121212;
    color: white;
    text-align: center;
    margin: 0;
    padding: 0;
}

.support-container {
    width: 50%;
    margin: 120px auto;
    background: black;
    border: 2px solid rgba(225, 255, 255, 0.2);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
}

.support-header {
    font-size: 24px;
    margin-bottom: 20px;
    color: white;
}

.support-form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.support-input {
    width: 90%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid white;
    border-radius: 5px;
    background: black;
    color: white;
}

.support-textarea {
    width: 90%;
    height: 100px;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid white;
    border-radius: 5px;
    background: black;
    color: white;
}

.support-btn {
    background-color: green;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
}

.support-btn:hover {
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

<div class="support-container">
    <h2 class="support-header"><i class="fa fa-headset"></i> Support</h2>

    <?php if (isset($successMessage)) { ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php } elseif (isset($errorMessage)) { ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php } ?>

    <form method="post" class="support-form">
        <input type="text" name="subject" class="support-input" placeholder="Enter subject..." required>
        <textarea name="message" class="support-textarea" placeholder="Describe your issue..." required></textarea>
        <button type="submit" name="submit" class="support-btn"><i class="fa fa-paper-plane"></i> Submit</button>
    </form>

    <div class="back-link">
        <a href="profile.php"><i class="fa fa-arrow-left"></i> Back to Settings</a>
    </div>
</div>

</body>
</html>
