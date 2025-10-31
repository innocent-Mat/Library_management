<?php
include "connect.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>search</title>
        <meta name="viewport" content="width=device-width; initial-1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    </head>
    <body>
        <div>
        <form action="seach.php" method="POST">
            <input type="text" name="usersearch" placeholder="search">
            <button class="btn btn-default" type="submit" name="submit">search</button>
        </form>
        </div>
    </body>
    </html>