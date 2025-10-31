<?php
session_start();
include '../connection.php'; // assumes you have DB connection here

if (!isset($_SESSION['login_user'])) {
    ?>
      <script>
        window.location="../log_out.php"
      </script>
    <?php
    exit();
}

$username = $_SESSION['login_user'];

$query = "SELECT * FROM issue_book WHERE username = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Issued Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4"><i class="fas fa-book-reader"></i> My Issued Books</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Book ID</th>
                    <th>Approval</th>
                    <th>Issue Status</th>
                    <th>Return Status</th>
                    <th>Format</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['bid']) ?></td>
                        <td><?= htmlspecialchars($row['approve']) ?></td>
                        <td><?= htmlspecialchars($row['issue']) ?></td>
                        <td><?= htmlspecialchars($row['return']) ?></td>
                        <td><?= htmlspecialchars($row['format']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No books issued yet.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
