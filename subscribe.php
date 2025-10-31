<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($db, $_POST['email']);

    $sql = "INSERT INTO subscribe ( email) VALUES ('$email')";

    if (mysqli_query($db, $sql)) {
        echo "Subscription successful!";
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
