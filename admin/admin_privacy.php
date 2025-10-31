<?php
// Include database connection
include('connection.php');

// Assuming the admin is logged in, get their ID (change this according to your session system)
session_start();
$admin_id = $_SESSION['admin_id'] ?? 0;

// Fetch admin details (username & email)
$adminQuery = "SELECT username, email FROM admin WHERE id = $admin_id";
$adminResult = mysqli_query($db, $adminQuery);
$admin = mysqli_fetch_assoc($adminResult);

// Check if settings exist for this admin
$query = "SELECT * FROM privacy_admin WHERE admin_id = $admin_id";
$result = mysqli_query($db, $query);
$privacy = mysqli_fetch_assoc($result);

// If no data is found, insert default values
if (!$privacy) {
    $insertQuery = "INSERT INTO privacy_admin (admin_id, hide_profile, two_factor_auth, restrict_access) 
                    VALUES ($admin_id, 0, 0, 0)";
    mysqli_query($db, $insertQuery);
    $result = mysqli_query($db, $query);
    $privacy = mysqli_fetch_assoc($result);
}

// Update settings when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hide_profile = isset($_POST['hide_profile']) ? 1 : 0;
    $two_factor_auth = isset($_POST['two_factor_auth']) ? 1 : 0;
    $restrict_access = isset($_POST['restrict_access']) ? 1 : 0;

    $updateQuery = "UPDATE privacy_admin SET 
        hide_profile = $hide_profile, 
        two_factor_auth = $two_factor_auth, 
        restrict_access = $restrict_access 
        WHERE admin_id = $admin_id";

    if (mysqli_query($db, $updateQuery)) {
        echo "<script>alert('Privacy settings updated successfully!'); window.location='admin_privacy.php';</script>";
    } else {
        echo "SQL Error: " . mysqli_error($db);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin Privacy Settings</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(9, 82, 46);
            margin: 0;
            padding: 0;
        }

        .privacy-container {
            width: 50%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .admin-info {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #555;
        }

        .privacy-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 15px 0;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 5px;
        }

        .privacy-option i {
            font-size: 20px;
            margin-right: 10px;
            color: #555;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="privacy-container">
<h4><a href="admin_settings.php"><i class="fa fa-mail-reply" style="margin-left:-600px;"></i></a></h4>
    <h2><i class="fas fa-user-shield"></i> Admin Privacy Settings</h2>

    <div class="admin-info">
        <i class="fa fa-user"></i> <strong>Admin:</strong> <?= $admin['username'] ?? 'Unknown' ?><br>
        <i class="fa fa-envelope"></i> <strong>Email:</strong> <?= $admin['email'] ?? 'Unknown' ?>
    </div>

    <form method="POST" id="privacyForm">
        <div class="privacy-option">
            <i class="fa fa-eye-slash"></i>
            <label>Hide Profile</label>
            <input type="checkbox" name="hide_profile" id="hide_profile" <?= isset($privacy['hide_profile']) && $privacy['hide_profile'] ? 'checked' : '' ?>>
        </div>

        <div class="privacy-option">
            <i class="fa fa-lock"></i>
            <label>Enable Two-Factor Authentication</label>
            <input type="checkbox" name="two_factor_auth" id="two_factor_auth" <?= isset($privacy['two_factor_auth']) && $privacy['two_factor_auth'] ? 'checked' : '' ?>>
        </div>

        <div class="privacy-option">
            <i class="fa fa-lock"></i>
            <label>Restrict Access to Certain Users</label>
            <input type="checkbox" name="restrict_access" id="restrict_access" <?= isset($privacy['restrict_access']) && $privacy['restrict_access'] ? 'checked' : '' ?>>
        </div>

        <button type="submit" id="saveBtn"><i class="fa fa-save"></i> Save Settings</button>

    </form>
</div>

<script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("privacyForm");
    const saveBtn = document.getElementById("saveBtn");

    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent page refresh

        // Show loading animation
        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
        saveBtn.disabled = true;

        // Create FormData object
        let formData = new FormData(form);

        // Send AJAX request to update settings
        fetch("admin_privacy.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert("Settings updated successfully!"); // Show success message
            console.log(data);
            saveBtn.innerHTML = '<i class="fas fa-save"></i> Save Settings';
            saveBtn.disabled = false;
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error updating settings!");
            saveBtn.innerHTML = '<i class="fas fa-save"></i> Save Settings';
            saveBtn.disabled = false;
        });
    });
});
</script>

</script>

</body>
</html>
