<?php
session_start();
$user = [
    "name" => "John Doe",
    "email" => "johndoe@example.com"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Settings</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #f4f4f4;
    transition: background 0.3s, color 0.3s;
}

/* Dark Mode */
body.dark {
    background: #222;
    color: #fff;
}

/* Container */
.settings-container {
    width: 60%;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.dark .settings-container {
    background: #333;
}

/* Header */
.settings-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #ccc;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

/* Form */
.settings-form label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

.settings-form input, .settings-form select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.dark .settings-form input {
    background: #444;
    color: #fff;
    border: 1px solid #666;
}

/* Buttons */
.settings-btn {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 20px;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.settings-btn:hover {
    background: #0056b3;
}

.logout-btn {
    background: red;
}

.theme-toggle {
    font-size: 20px;
    cursor: pointer;
}

    </style>
</head>
<body>

<div class="settings-container">
    <div class="settings-header">
        <h2>Settings</h2>
        <i id="theme-toggle" class="fa fa-moon theme-toggle"></i>
    </div>

    <form class="settings-form" action="update_settings.php" method="POST">
        <!-- Name -->
        <label for="name"><i class="fa fa-user"></i> Name</label>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>">

        <!-- Email -->
        <label for="email"><i class="fa fa-envelope"></i> Email</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>">

        <!-- Password -->
        <label for="password"><i class="fa fa-lock"></i> Password</label>
        <input type="password" id="password" name="password">

        <!-- Notifications -->
        <label for="notifications"><i class="fa fa-bell"></i> Notifications</label>
        <select id="notifications" name="notifications">
            <option value="on">On</option>
            <option value="off">Off</option>
        </select>

        <!-- Submit Button -->
        <button type="submit" class="settings-btn"><i class="fa fa-save"></i> Save Changes</button>

        <!-- Logout Button -->
        <a href="logout.php" class="settings-btn logout-btn"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </form>
</div>

<script>
    // Theme Toggle
document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById("theme-toggle");
    const body = document.body;

    // Check local storage for theme preference
    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark");
    }

    themeToggle.addEventListener("click", function () {
        body.classList.toggle("dark");
        localStorage.setItem("theme", body.classList.contains("dark") ? "dark" : "light");
    });
});

</script>
</body>
</html>
