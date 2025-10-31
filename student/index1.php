<?php
include('languages.php');
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo $translations["welcome"]; ?></title>
</head>
<body>
    <h1><?php echo $translations["welcome"]; ?></h1>
    <a href="borrow.php"><?php echo $translations["borrow_book"]; ?></a>
    <a href="settings.php"><?php echo $translations["settings"]; ?></a>
    <a href="logout.php"><?php echo $translations["logout"]; ?></a>
</body>
</html>
