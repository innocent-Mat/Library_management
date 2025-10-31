<?php 
include "connection.php";
include "navbar.php";

// Fetch user privacy settings
$email = $_SESSION['login_user'];
$query = "SELECT * FROM privacy_settings WHERE user_email='$email'";
$result = mysqli_query($db, $query);
$privacy = mysqli_fetch_assoc($result);

// If no privacy settings exist, insert default values
if (!$privacy) {
    mysqli_query($db, "INSERT INTO privacy_settings (user_email) VALUES ('$email')");
    $privacy = [
        'profile_visibility' => 'public',
        'email_visibility' => 'visible',
        'last_seen' => 'everyone'
    ];
}

// Update privacy settings
if (isset($_POST['save'])) {
    $profile_visibility = $_POST['profile_visibility'];
    $email_visibility = $_POST['email_visibility'];
    $last_seen = $_POST['last_seen'];

    $updateQuery = "UPDATE privacy_settings SET 
        profile_visibility='$profile_visibility',
        email_visibility='$email_visibility',
        last_seen='$last_seen'
        WHERE user_email='$email'";

    mysqli_query($db, $updateQuery);
    header("Location: privacy.php"); // Refresh the page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Settings</title>

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #121212;
    color: white;
    text-align: center;
    margin: 0;
    padding: 0;
}

.privacy-container {
    width: 50%;
    margin: 120px auto;
    background: black;
    border: 2px solid rgba(225, 255, 255, 0.2);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
}

.privacy-header {
    font-size: 24px;
    margin-bottom: 20px;
    color: white;
}

.privacy-form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.privacy-option {
    display: flex;
    justify-content: space-between;
    width: 100%;
    background: #222;
    padding: 15px;
    margin: 10px 0;
    border-radius: 8px;
    align-items: center;
}

.privacy-label {
    font-size: 16px;
}

.privacy-select {
    padding: 8px;
    background: black;
    color: white;
    border: 1px solid white;
    border-radius: 5px;
}

.privacy-btn {
    background-color: green;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
}

.privacy-btn:hover {
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

<div class="privacy-container">
    <h2 class="privacy-header"><i class="fa fa-lock"></i> Privacy Settings</h2>

    <form method="post" class="privacy-form">
        <div class="privacy-option">
            <label class="privacy-label"><i class="fa fa-user"></i> Profile Visibility:</label>
            <select name="profile_visibility" class="privacy-select">
                <option value="public" <?php if ($privacy['profile_visibility'] == 'public') echo 'selected'; ?>>Public</option>
                <option value="private" <?php if ($privacy['profile_visibility'] == 'private') echo 'selected'; ?>>Private</option>
            </select>
        </div>

        <div class="privacy-option">
            <label class="privacy-label"><i class="fa fa-envelope"></i> Email Visibility:</label>
            <select name="email_visibility" class="privacy-select">
                <option value="visible" <?php if ($privacy['email_visibility'] == 'visible') echo 'selected'; ?>>Visible</option>
                <option value="hidden" <?php if ($privacy['email_visibility'] == 'hidden') echo 'selected'; ?>>Hidden</option>
            </select>
        </div>

        <div class="privacy-option">
            <label class="privacy-label"><i class="fa fa-clock"></i> Last Seen:</label>
            <select name="last_seen" class="privacy-select">
                <option value="everyone" <?php if ($privacy['last_seen'] == 'everyone') echo 'selected'; ?>>Everyone</option>
                <option value="friends" <?php if ($privacy['last_seen'] == 'friends') echo 'selected'; ?>>Friends</option>
                <option value="nobody" <?php if ($privacy['last_seen'] == 'nobody') echo 'selected'; ?>>Nobody</option>
            </select>
        </div>

        <button type="submit" name="save" class="privacy-btn"><i class="fa fa-save"></i> Save Changes</button>
    </form>

    <div class="back-link">
        <a href="profile.php"><i class="fa fa-arrow-left"></i> Back to Settings</a>
    </div>
</div>

</body>
</html>
