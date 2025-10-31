<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>change password</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <style>
            body{
                height: 570px;
                background-image: url('img.avif');
                background-repeat: no-repeat;
            }
            *{
                box-sizing: border-box;
                padding: 0;
                margin: 0;
                font-size:11;
            }
            form
            {
                box-shadow: 0 0 10px #000;
                padding: 30px 20px 35px 20px;
                border-radius:10px;
                display: flex;
                flex-direction:column;
                gap: 2rem;
                
            }
           
            .wrapper{
                width: 600px;
                height:500px;
                background: transparent solid #162938;
                border: 2px solid #162938;
                border-radius: 20px;
                backdrop-filter: blur(20px);
                box-shadow: 0 0 30px rgba(0, 0, .5);
                display: flex;
                justify-content: center;
                align-items: center;
                opacity: .9;
                margin: 300px auto;
                color: white;
                padding: 27px 15px;
               
            }
            .wrapper:hover {
                transform: translateY(-5px);
            }
            .form-control{
                width: 300px;
            }
            input
            {
                padding: 0.5em 1em;
                border: 0;
                background-color:transparent;
                color: #fff;
                font-size: 1.2em;
                width: 220px;
            }
            input:focus
            {
                outline: 0;
            }
            fieldset
            {
                padding:0;
                border: 4px;
                border-radius: 4px;
            }
            fieldset:focus-within
            {
                border-color:#b02727;
            }
            legend
            {
                margin-left:0.75em;
                padding-inline:0.5em;
                font-size: 1.25em;
                
            }
            .btn-default
            {
                background:#162938;
                color:white;
            }
            .btn-default:hover
            {
                background:#162938;
                color:white;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div style="text-align:center;">
                    <h1  style="text-align: center; font-size: 30px; font-family: lucida console;" >change your password</h1>
                    <img src="logo.jpg" alt="logo">

            </div>
            <div style="padding-left: 30px">
                <form action="" method="post">
                    <fieldset>
                    <legend>Username *</legend>
                    <input type="text" name="username" placeholder="username"  class="form-control" required="">
                    </fieldset>

                    <fieldset>
                    <legend>Email *</legend>                       
                    <input type="email" name="email" placeholder="email"  class="form-control" required="">
                    </fieldset>

                    <fieldset>
                    <legend>Password *</legend>
                    <input type="text" name="password" placeholder="new password"  class="form-control" required="">
                    </fieldset>

                    <button class="btn btn-default" name="submit" type="submit">Update</button>
                </form>
            </div>
        </div>
        <?php
            if(isset($_POST['submit']))
            {
                if(mysqli_query($db,"UPDATE student SET password='$_POST[password]' WHERE username='$_POST[username]' AND email='$_POST[email]';"))
                {
                    ?>
                     <script type="text/javascript">
                    alert("The password has been updated successfully.");
                </script>
                <?php
                }
            }
        
        ?>
    </body>
</html>
