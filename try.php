<?php

?>
<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Service Cards</title>  
    <style>
        body {  
    font-family: Arial, sans-serif;  
    background-color: #f4f4f4;  
    display: flex;  
    justify-content: center;  
    align-items: center;  
    height: 100vh;  
}  

.container1 {  
    display: flex;  
    gap: 20px;  
}  

.card1 {  
    background: white;  
    border-radius: 8px;  
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);  
    padding: 20px;  
    text-align: center;  
    width: 200px;  
    transition: background 0.3s;  
}  

.icon {  
    font-size: 40px;  
}  

h3 {  
    margin: 15px 0;  
}  

button {  
    background-color: #007bff;  
    color: white;  
    border: none;  
    border-radius: 5px;  
    padding: 10px 15px;  
    cursor: pointer;  
}  

button:hover {  
    background-color: #0056b3;  
}  
    </style>  
</head>  
<body>  
    <div class="container">  
        <div class="card" onclick="changeColor(this)">  
            <div class="icon">🍃</div>  
            <h3>SERVICE ONE</h3>  
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>  
            <button onclick="learnMore('Service One')">LEARN MORE</button>  
        </div>  
        <div class="card" onclick="changeColor(this)">  
            <div class="icon">🏰</div>  
            <h3>SERVICE TWO</h3>  
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>  
            <button onclick="learnMore('Service Two')">LEARN MORE</button>  
        </div>  
        <div class="card" onclick="changeColor(this)">  
            <div class="icon">⚖️</div>  
            <h3>SERVICE THREE</h3>  
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>  
            <button onclick="learnMore('Service Three')">LEARN MORE</button>  
        </div>  
    </div>  
    <script>
        function learnMore(serviceName) {  
    alert(`Learn more about ${serviceName}!`);  
}  

function changeColor(card) {  
    const colors = ['#e57373', '#64b5f6', '#81c784', '#ffd54f', '#ffb74d', '#7986cb'];  
    const randomColor = colors[Math.floor(Math.random() * colors.length)];  
    card.style.backgroundColor = randomColor;  
}  
    </script>  
</body>  
</html>  