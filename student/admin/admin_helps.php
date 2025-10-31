<?php
session_start();
include('connection.php'); // Connect to database

// Check if admin is logged in
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle request resolution
if (isset($_POST['resolve'])) {
    $id = $_POST['id'];
    $query = "UPDATE help_requests SET status = 'Resolved' WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Handle request deletion
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM help_requests WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch all help requests
$query = "SELECT * FROM help_requests ORDER BY created_at DESC";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Help Requests</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2><i class="fa fa-life-ring"></i> Student Help Requests</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['student_name']; ?></td>
                <td><?php echo $row['student_email']; ?></td>
                <td><?php echo $row['message']; ?></td>
                <td>
                    <?php if ($row['status'] == 'Pending') { ?>
                        <span class="pending">Pending</span>
                    <?php } else { ?>
                        <span class="resolved">Resolved</span>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($row['status'] == 'Pending') { ?>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="resolve" class="resolve-btn">
                                <i class="fa fa-check"></i> Mark Resolved
                            </button>
                        </form>
                    <?php } ?>
                    <form method="POST" onsubmit="return confirmDelete();">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete" class="delete-btn">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this request?");
        }
    </script>

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
            width: 80%;
            margin: auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        h2 {
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .pending {
            color: red;
            font-weight: bold;
        }

        .resolved {
            color: green;
            font-weight: bold;
        }

        .resolve-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-btn {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .resolve-btn:hover {
            background-color: #218838;
        }

        .delete-btn:hover {
            background-color: #c9302c;
        }
    </style>
</body>
</html>
