<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>change password</title>
        <style>
            body{
                height: 570px;
                background-image: url('img.avif');
                background-repeat: no-repeat;
            }
            .wrapper{
                width: 400px;
                height:300px;
                background-color: blue;
                opacity: .8;
                margin: 300px auto;
                color: white;
                padding: 27px 15px;
            }
            .form-control{
                width: 300px;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div style="text-align:center;">
                    <h1  style="text-align: center; font-size: 30px; font-family: lucida console;" >change your password</h1>
            </div>
            <div style="padding-left: 30px">
                <form action="" method="post">
                    <input type="text" name="username" placeholder="username"  class="form-control" require=""><br>
                    <input type="text" name="email" placeholder="email"  class="form-control" require=""><br>
                    <input type="text" name="password" placeholder="new password"  class="form-control" require=""><br>
                    <button class="btn btn-default" name="submit" type="submit">Update</button>
                </form>
            </div>
        </div>
        <?php
            if(isset($_POST['submit']))
            {
                if(mysqli_query($db,"UPDATE admin SET password='$_POST[password]' WHERE username='$_POST[username]' AND email='$_POST[email]';"))
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
