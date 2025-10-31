<?php
session_start();
include('connection.php'); // Ensure this file connects to your database

if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit();
}

$login_user = $_SESSION['login_user'];
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];

    // Fetch student's current password and email from the database
    $query = "SELECT password, email FROM student WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $login_user);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($stored_password, $email);
    $stmt->fetch();

    // Verify password
    if ($stmt->num_rows > 0 && $password == $stored_password) {
        // Delete student account
        $delete_query = "DELETE FROM student WHERE email = ?";
        $delete_stmt = $db->prepare($delete_query);
        $delete_stmt->bind_param("s", $login_user);

        if ($delete_stmt->execute()) {
            // Send email notification
            $to = $email;
            $subject = "Account Deleted Successfully";
            $message_body = "Dear User,\n\nYour account has been successfully deleted from our system.\nIf you did not request this, please contact support immediately.\n\nBest Regards,\nLibrary Team";
            $headers = "From: ditnrb531724@spu.ac.ke";

            mail($to, $subject, $message_body, $headers);

            // Destroy session and redirect
            session_destroy();
            header("Location: ../index.php");
            exit();
        } else {
            $message = "Error deleting account. Please try again.";
        }
    } else {
        $message = "Incorrect password. Account deletion failed.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    text-align: center;
    margin: 50px;
}

.container {
    background: white;
    padding: 20px;
    width: 50%;
    margin: auto;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
}

h2 {
    color: #d9534f;
}

.warning {
    color: #d9534f;
    font-weight: bold;
}

form {
    margin-top: 20px;
}

label {
    font-size: 18px;
    font-weight: bold;
}

input {
    padding: 10px;
    width: 80%;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color: #d9534f;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #c9302c;
}

.error-message {
    color: red;
    font-weight: bold;
    margin-top: 10px;
}
</style>
</head>
<body>
    <div class="container">
        <h2>Delete Your Account</h2>
        <p class="warning">⚠ Warning: This action cannot be undone.</p>

        <form method="POST" id="deleteForm">
            <label for="password">Confirm Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit" id="deleteBtn">Delete Account</button>
        </form>

        <p class="error-message"><?php echo $message; ?></p>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const deleteForm = document.getElementById("deleteForm");
    const deleteBtn = document.getElementById("deleteBtn");

    deleteForm.addEventListener("submit", function (event) {
        const confirmDelete = confirm("Are you sure you want to delete your account? This action cannot be undone.");
        if (!confirmDelete) {
            event.preventDefault();
        }
    });
});

    </script>
</body>
</html>
