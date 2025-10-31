<?php
session_start();
include("../connection.php"); // Adjust the path to your DB connection

// Simulate login for demo
// $_SESSION['admin_email'] = 'your_admin_email@example.com';

$msg = "";

// Handle account deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $email = $_SESSION['login_user'];

    // Fetch admin details
    $query = mysqli_query($db, "SELECT * FROM admin WHERE email='$email'");
    $admin = mysqli_fetch_assoc($query);

    if ($admin) {
        // Send email
        $subject = "Account Deletion Confirmation";
        $message = "Dear " . $admin['username'] . ",\n\nYour admin account has been successfully deleted from the system.\n\nThank you.";
        $headers = "From: ditnrb531724@spu.ac.ke.";

        if (mail($email, $subject, $message, $headers)) {
            // Delete the account
            mysqli_query($db, "DELETE FROM admin WHERE email='$email'");
            $msg = "<div class='alert alert-success'>Account deleted and email sent successfully.</div>";
            header("location: ../index.php");
            session_destroy();
        } else {
            $msg = "<div class='alert alert-danger'>Failed to send confirmation email. Account not deleted.</div>";
        }
    } else {
        $msg = "<div class='alert alert-warning'>Admin account not found.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Admin Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .delete-box {
            max-width: 500px;
            margin: 60px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .delete-icon {
            font-size: 60px;
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="delete-box text-center">
        <i class="fas fa-user-times delete-icon mb-4"></i>
        <h3 class="mb-3">Delete Your Account</h3>
        <p>Are you sure you want to delete your admin account? This action cannot be undone.</p>

        <?= $msg ?>

        <form method="POST">
            <button type="submit" name="delete" class="btn btn-danger btn-block">
                <i class="fas fa-trash-alt"></i> Yes, Delete My Account
            </button>
            <a href="dashboard.php" class="btn btn-secondary btn-block mt-2">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>
