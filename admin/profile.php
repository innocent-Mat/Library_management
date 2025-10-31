<?php
include "connection.php";
include "navbar.php";

$q = mysqli_query($db, "SELECT * FROM admin WHERE email='$_SESSION[login_user]';");
$row = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        /* Profile Container */
.profile-container {
    width: 60%;
    margin: 160px auto;
    background: #fff;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    
}

.dark .profile-container {
    background: #333;
    color: #fff;
}

/* Header */
.profile-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #ccc;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

/* Profile Image */
.profile-img {
    text-align: center;
    margin-bottom: 20px;
}

.profile-img img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 3px solid #007bff;
}

/* Table */
.profile-table {
    width: 100%;
    border-collapse: collapse;
}

.profile-table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.dark .profile-table td {
    border-bottom: 1px solid #666;
}

/* Buttons */
.profile-btn {
    display: block;
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
}

.profile-btn:hover {
    background: #0056b3;
}

/* Theme Toggle */
.theme-toggle {
    font-size: 20px;
    cursor: pointer;
}

    </style>
</head>
<body>

<div class="profile-container">
    <div class="profile-header">
        <h2><i class="fa fa-user"></i> My Profile</h2>
        <i id="theme-toggle" class="fa fa-moon theme-toggle"></i>
    </div>

    <div class="profile-content">
        <!-- Profile Image -->
        <div class="profile-img">
            <img src="images/<?php echo $_SESSION['pic']; ?>" alt="Profile Picture">
        </div>

        <!-- User Information -->
        <table class="profile-table">
            <tr>
                <td><i class="fa fa-user"></i> <strong>Username:</strong></td>
                <td><?php echo $row['username']; ?></td>
            </tr>
            <tr>
                <td><i class="fa fa-envelope"></i> <strong>Email:</strong></td>
                <td><?php echo $row['email']; ?></td>
            </tr>
            <tr>
                <td><i class="fa fa-lock"></i> <strong>Password:</strong></td>
                <td><?php echo str_repeat("*", strlen($row['password'])); ?></td>
            </tr>
        </table>

        <!-- Edit Button -->
        <form action="edit.php" method="post">
            <button type="submit" class="profile-btn"><i class="fa fa-edit"></i> Edit Profile</button>
        </form>
    </div>
</div>

<script >
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
