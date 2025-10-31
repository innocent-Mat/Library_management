<?php
include 'connection.php'; // Database connection

// Handle message deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM support WHERE id = $id";
    if (mysqli_query($db, $sql)) {
        echo "<script>alert('Message deleted successfully');</script>";
    }
}

// Fetch support messages
$query = "SELECT * FROM support ORDER BY created_at DESC";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Support Messages</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="style.css" type="text/css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        body {
    font-family: Arial, sans-serif;
    background:rgb(11, 71, 40);
    padding: 20px;
}

.support-container {
    width: 90%;
    max-width: 900px;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px #ccc;
    margin: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

th {
    background: #007BFF;
    color: white;
}

button, .delete {
    padding: 8px 12px;
    border: none;
    color: white;
    cursor: pointer;
    text-decoration: none;
    border-radius: 4px;
}

button {
    background: #28a745;
}

.delete {
    background: #dc3545;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    background: white;
    padding: 20px;
    box-shadow: 0px 0px 10px #aaa;
    border-radius: 8px;
}

.modal-content {
    display: flex;
    flex-direction: column;
}

.close {
    font-size: 20px;
    color: red;
    cursor: pointer;
    text-align: right;
}

input, textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
    border: 1px solid #ccc;
}

button:hover {
    opacity: 0.8;
}

    </style>
</head>
<body>

    <div class="support-container">
        <h4><a href="admin_settings.php"><i class="fa fa-mail-reply"></i></a></h4>
        <h2><i class="fas fa-headset"></i> Support Messages</h2>
        
        <table>
            <tr>
                <th>User Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['user_email'] ?></td>
                    <td><?= $row['subject'] ?></td>
                    <td><?= $row['message'] ?></td>
                    <td><?= ucfirst($row['status']) ?></td>
                    <td>
                        <button onclick="openEmailModal('<?= $row['user_email'] ?>', '<?= $row['subject'] ?>')">
                            <i class="fa fa-envelope"></i> Reply
                        </button>
                        <a class="delete" href="support.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this message?');">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!-- Email Modal -->
    <div id="emailModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEmailModal()">&times;</span>
            <h3>Send Email</h3>
            <form id="emailForm">
                <label>User Email:</label>
                <input type="email" id="emailTo" readonly>

                <label>Subject:</label>
                <input type="text" id="emailSubject" readonly>

                <label>Message:</label>
                <textarea id="emailMessage" required></textarea>

                <button type="submit"><i class="fas fa-paper-plane"></i> Send</button>
            </form>
        </div>
    </div>

    <script >
        // Open Email Modal
function openEmailModal(email, subject) {
    document.getElementById("emailModal").style.display = "block";
    document.getElementById("emailTo").value = email;
    document.getElementById("emailSubject").value = subject;
}

// Close Email Modal
function closeEmailModal() {
    document.getElementById("emailModal").style.display = "none";
}

// Send Email using AJAX
document.getElementById("emailForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let emailTo = document.getElementById("emailTo").value;
    let emailMessage = document.getElementById("emailMessage").value;

    fetch("send_email.php", {
        method: "POST",
        body: JSON.stringify({ email: emailTo, message: emailMessage }),
        headers: { "Content-Type": "application/json" }
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        closeEmailModal();
    })
    .catch(error => console.error("Error:", error));
});

    </script>
</body>
</html>
