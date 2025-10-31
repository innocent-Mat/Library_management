<?php
   include "connection.php";
   session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Library management login and registration</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style1.css">
    </head>
    <body>
        <header>
            <h2 class="logo"></h2>
            <nav class="navigation">
                <a href="index.php">Home</a>
                <a href="#">About</a>
                <a href="#">Services</a>
                <a href="#">Contact</a>
                <button class="btnLogin-popup">Login</button>
            </nav>
        </header>
        <div class="wrapper ">
            <span class="icon-close"><ion-icon name="close-circle"></ion-icon></span>
            <div class="form-box login">
                <h2>Login</h2>
                <form action="#" name="login" method="post" >
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" name="email" required="">
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" name="password" required="">
                        <label>Password</label>
                    </div>
                    <div class="remember-forget">
                        <label><input type="checkbox" >Remember me</label>
                        <a href="update_password.php">Forget Password?</a>
                    </div>
                    <button class="btn" type="submit" name="login">Login</button>
                    <div class="login-register">
                        <p> Don't have an Account?<a href="#" class="register-link">Register</a></p>

                    </div>
                </form>

            </div>
            <div class="form-box register">
                <h2>admin_Registration</h2>
                <form action="#" name="registration" method="post">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="username" required="">
                        <label>Username</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" name="email" required="">
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" name="password" required="">
                        <label>Password</label>
                    </div>
                    <div class="remember-forget">
                        <label><input type="checkbox" >I agree to the terms & conditions</label> 
                    </div>
                    <button type="submit" class="btn" name="register" >Register</button>
                    <div class="login-register">
                        <p> Already have an Account?<a href="#" class="login-link">Login</a></p>

                    </div>
                </form>

            </div>
        </div>
        <script src="script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <?php
          
        if(isset($_POST['register']))
        {
            $count=0;
            $sql="SELECT email from `admin`";
            $res=mysqli_query($db,$sql);

            while($row=mysqli_fetch_assoc($res))
            {
                if($row['email']==$_POST['email'])
                {
                    $count=$count+1;
                }
            }
            if($count==0)
            {
                mysqli_query($db,"INSERT INTO `admin` VALUES('', '$_POST[username]', '$_POST[email]', '$_POST[password]', 'p.jpg', '');");
          
                ?>  
                <script type="text/javascript">
                    alert("registration successful👌");
                </script>
                <?php
            }
            else
            {
                ?>  
                <script type="text/javascript">
                    alert("the email already exist!🤦‍♂️");
                </script>
                <?php   
            }
            
        }
        if(isset($_POST['login'])) 
        {
            $count=0;
            $res=mysqli_query($db,"SELECT * FROM `admin` WHERE email='$_POST[email]' && password='$_POST[password]';");
            $row= mysqli_fetch_assoc($res);
            $count=mysqli_num_rows($res);
            $_SESSION['email']='';

            if($count==0)
            {
                ?>
                <!--<script type="text/javascript">
                    alert("The email and password does'nt match.");
                </script>-->
                <div class="alert alert-danger" style="width:700px; margin-left:0px; background-color:#de1313; color:white">
                    <strong>⚠️The email and password does'nt match⚠️</strong>
                </div>
                <?php
            }
            else
            {
                /* if username & password matches----*/

                $_SESSION['login_user']=$_POST['email'];
                $_SESSION['pic']=$row['pic'];

                ?>
                <script type="text/javascript">
                   window.location="index.php";
                </script>
                <?php 
            }
        }
        ?>
    </body>
</html>