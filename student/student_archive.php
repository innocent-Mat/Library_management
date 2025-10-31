<?php
session_start();
include('connection.php');

// Ensure student is logged in
if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit();
}

$student_email = $_SESSION['login_user'];

// Restore Book
if (isset($_POST['restore'])) {
    $bid = $_POST['bid'];
    $query = "DELETE FROM archived_books WHERE bid = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $bid);
    $stmt->execute();
    $stmt->close();
}

// Fetch archived books for this student
$query = "SELECT * FROM archived_books WHERE email = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $student_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Archive</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2><i class="fa fa-archive"></i> Archived Books</h2>

        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Date Archived</th>
                <th>Action</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['author']; ?></td>
                <td><?php echo $row['date_archived']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="bid" value="<?php echo $row['bid']; ?>">
                        <button type="submit" name="restore" class="restore-btn">
                            <i class="fa fa-undo"></i> Restore
                        </button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; margin: 50px; }
        .container { background: white; padding: 20px; width: 80%; margin: auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); border-radius: 10px; }
        h2 { color: #007bff; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        .restore-btn { background-color: #28a745; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 5px; }
        .restore-btn:hover { background-color: #218838; }
    </style>
</body>
</html>
