<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['language'] = $_POST['language'];
    echo "Language changed to " . $_POST['language'];
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Language Settings</title>
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
    width: 50%;
    margin: auto;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
}

h2 {
    color: #007bff;
}

select {
    padding: 10px;
    width: 80%;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.btn {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.btn:hover {
    background-color: #218838;
}

#statusMessage {
    margin-top: 15px;
    color: green;
    font-weight: bold;
}

    </style>
</head>
<body>
    <h2>🌍 Change Language</h2>
    <select id="languageSelect">
        <option value="en">🇬🇧 English</option>
        <option value="fr">🇫🇷 Français</option>
        <option value="es">🇪🇸 Español</option>
    </select>
    <button onclick="saveLanguage()">Save</button>
    <p id="statusMessage"></p>

    <script>
        function saveLanguage() {
            const selectedLang = document.getElementById("languageSelect").value;
            fetch("language.php", {
                method: "POST",
                body: new URLSearchParams({ language: selectedLang }),
                headers: { "Content-Type": "application/x-www-form-urlencoded" }
            }).then(() => {
                document.getElementById("statusMessage").innerText = "Language Saved!";
                setTimeout(() => location.reload(), 500);
            });
        }
    </script>
</body>
</html>
