<?php
session_start();
include("connection.php");

if (!isset($_GET['book_id'])) {
    echo "Book ID not provided.";
    exit;
}

$book_id = $_GET['book_id'];
$sql = "SELECT * FROM books WHERE bid = '$book_id'";
$result = mysqli_query($db, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Book not found.";
    exit;
}

$book = mysqli_fetch_assoc($result);
$pdf_path = "../admin/pdfs/" . basename($book['pdf_path']); // Ensure correct path

if(isset($_POST['login_user']))
{
// Check if file exists
if (!file_exists($pdf_path)) {
    echo "The file does not exist: " . realpath($pdf_path);
    exit;
}
}
else
{
    ?>
    <script>
        alert("you need to login first");
    </script>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Book</title>
</head>
<body>
    <h2><?php echo htmlspecialchars($book['name']); ?></h2>
    <iframe src="<?php echo htmlspecialchars($pdf_path); ?>" width="100%" height="600px"></iframe>
</body>
</html>
