<?php
$db = new mysqli("localhost", "root", "", "library");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$sql = "SELECT * FROM admin ORDER BY id ASC";
$result = $db->query($sql);

while ($admin = $result->fetch_assoc()) {
    echo '<li class="admin-item">
            <img src="images/' . $admin['pic'] . '" alt="Admin" class="admin-pic">
            <div class="admin-info">
                <strong>' . htmlspecialchars($admin['username']) . '</strong><br>
                <small>' . htmlspecialchars($admin['email']) . '</small>
            </div>
            <div class="admin-icons">
                <a href="#"><i class="fa fa-edit"></i></a>
                <a href="#"><i class="fa fa-trash"></i></a>
            </div>
          </li>';
}
$db->close();
?>
