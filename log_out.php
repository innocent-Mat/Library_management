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
        <style>
            label
            {
                font-size: 18px;
                font-weight: 600;
            }
        </style>
    </head>
    <body>
        <header>
            <h2 class="logo"></h2>
            <nav class="navigation">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="service.php">Services</a>
                <a href="contact.php">Contact</a>
                <button class="btnLogin-popup">Login</button>
            </nav>
        </header>
        <div class="wrapper ">
            <span class="icon-close"><ion-icon name="close-circle"></ion-icon></span>
            <div class="form-box login">
                <h2>Login as</h2>
                <form action="#" name="login" method="post" >
                    <input style="margin-left: 50px; width:18px;" type="radio" name="user" id="admin" value="admin">
                    <label for="admin"  style="color: white">Admin</label>
                    <input style="margin-left: 50px; width:18px;"  type="radio" name="user" id="student" value="student" checked="">
                    <label for="student" style="color: white">Student</label>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" name="email" required="">
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" name="password" required="" >
                        <label>Password</label>
                    </div>
                    <div class="remember-forget">
                        <label><input type="checkbox" >Remember me</label>
                        <a href="student/update_password.php">Forget Password?</a>
                    </div>
                    <button class="btn" type="submit" name="login">Login</button>
                    <div class="login-register">
                        <p> Don't have an Account?<a href="#" class="register-link">Register</a></p>

                    </div>
                </form>

            </div>
            <div class="form-box register">
                <h2>Registration as</h2>
                <form action="#" name="registration" method="post">
                    <input style="margin-left: 50px; width:18px;" type="radio" name="user" id="admin" value="admin">
                    <label for="admin"  style="color: white">Admin</label>
                    <input style="margin-left: 50px; width:18px;"  type="radio" name="user" id="student" value="student" checked="">
                    <label for="student"  style="color: white">Student</label>
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
          if($_POST['user']== 'admin')
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
          else
          {
            $status=0;
            $sql="SELECT email from `student`";
            $res=mysqli_query($db,$sql);

            while($row=mysqli_fetch_assoc($res))
            {
                if($row['email']==$_POST['email'])
                {
                    $status=$status+1;
                }
            }
            if($status==0)
            {
               mysqli_query($db,"INSERT INTO `STUDENT` VALUES('$_POST[username]', '$_POST[email]','0', '$_POST[password]', 'p.jpg');");
                $otp=rand(1000,99999);
                $date=date("y-m-d");
                mysqli_query($db,"INSERT INTO verify VALUES('$_POST[username]', '$otp','$date'); ");
                $msg="hello your OTP code is: ".$otp." .";
                $from="From: ditnrb531724@spu.ac.ke";
                if (mail($_POST['email'], "OTP", $msg, $from))
                {
                ?>  
                <script type="text/javascript">
                    window.location="verify.php";
                </script>
                <?php 
                }
                else
                {
                    ?>  
                    <script type="text/javascript">
                        alert("Email not sent. 🤦‍♂️");
                    </script>
                    <?php   
                }
                
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
        }
        if(isset($_POST['login'])) 
        {
            if($_POST['user']=='admin')
            {
                $count=0;
                $res=mysqli_query($db,"SELECT * FROM `admin` WHERE email='$_POST[email]' and password='$_POST[password]' and status='yes';");
                $row= mysqli_fetch_assoc($res);
                $count=mysqli_num_rows($res);
                $_SESSION['email']='';
    
                if($count==0)
                {
                    ?>
                    <script>
                        alert("The email and password does'nt match.");
                    </script>
                    <?php
                }
                else
                {
                    /* if username & password matches----*/
    
                    $_SESSION['login_user']=$_POST['email'];
                    $_SESSION['pic']=$row['pic'];
    
                    ?>
                    <script type="text/javascript">
                       window.location="admin/index.php";
                    </script>
                    <?php 
                }
            }
            else
            {
            $status=0;
            $res=mysqli_query($db,"SELECT * FROM `student` WHERE email='$_POST[email]' && password='$_POST[password]';");
            $row=mysqli_fetch_assoc($res);
            $status=mysqli_num_rows($res);

            if($status==0)
            {
                ?>
                <script type="text/javascript">
                    alert("The email and password does'nt match.");
                </script>
>
                <?php
            }
            else
            {
                if($row['status']==1)
                {
                $_SESSION['login_user']=$_POST['email'];
                $_SESSION['pic']=$_row['pic'];

                ?>
                <script type="text/javascript">
                   window.location="student/index.php";
                </script>
                <?php 
                }
                else
                {
                    ?>
                <script type="text/javascript">
                    alert("verify your email by OTP before login");
                </script>
                <?php  
                }
            }
        }
        }
        ?>
    </body>
</html>