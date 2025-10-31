<?php
include "connection.php"; // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    if (isset($_POST['approve'])) {
        $updateQuery = "UPDATE admin SET status='yes' WHERE username='$username'";
        if (mysqli_query($db, $updateQuery)) {
            $subject = "Admin Approval Notification";
            $message = "Hello, welcome among Admin!";
            $headers = "From: ditnrb531724@spu.ac.ke\r\n";
            $headers .= "Reply-To: ditnrb531724@spu.ac.ke\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            if (mail($email, $subject, $message, $headers)) {
                echo "<script>alert('Admin approved and email sent!'); window.location.href='app_admin.php';</script>";
            } else {
                echo "<script>alert('Admin approved, but email failed!'); window.location.href='app_admin.php';</script>";
            }
        }
    } elseif (isset($_POST['remove'])) {
        $deleteQuery = "DELETE FROM admin WHERE username='$username'";
        if (mysqli_query($db, $deleteQuery)) {
            echo "<script>alert('Admin request removed!'); window.location.href='app_admin.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <title>Approve Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: rgb(7, 106, 40);
            text-align: center;
        }
        h2 {
            margin-top: 90px;
            color: white;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #007BFF;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
        button {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            color: white;
            font-weight: bold;
            border-radius: 4px;
        }
        .approve {
            background: #28a745;
        }
        .approve:hover {
            background: #218838;
        }
        .remove {
            background: #dc3545;
        }
        .remove:hover {
            background: #c82333;
        }
        @media (max-width: 768px) {
            table {
                width: 100%;
            }
        }
    </style>
    <script>
        function confirmAction(event, action) {
            if (!confirm("Are you sure you want to " + action + " this request?")) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body>

    <h2>Admin Approval Requests</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
        $res = mysqli_query($db, "SELECT username, email FROM admin WHERE status=''");
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <form method='post'>
                            <input type='hidden' name='username' value='{$row['username']}'>
                            <input type='hidden' name='email' value='{$row['email']}'>
                            <button type='submit' class='approve' name='approve' onclick='confirmAction(event, \"approve\")'><i class='fa fa-cloud-upload'></i>&nbsp;&nbsp;Approve</button>
                            <button type='submit' class='remove' name='remove' onclick='confirmAction(event, \"remove\")'><i class='fa fa-trash' style='colore red;'></i>&nbsp;&nbsp;Remove</button>
                        </form>
                    </td>
                </tr>";
        }
        ?>
    </table>

</body>
</html>
