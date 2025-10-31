<?php
    session_start();
    include "connection.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <style>
        .badge{
            background-color:red;
        }
        .log_out
        {
            color:white;
        }
        .log_out:hover
        {
            color:green;
        }
        .glyphicon:hover
        {
            color:green;
        }
    </style>
    <body>
    <?php
        $r=mysqli_query($db,"SELECT COUNT(`status`) as total FROM `message` where status='no' and sender='student'");
        $c=mysqli_fetch_assoc($r);

        $sql_app=mysqli_query($db,"SELECT COUNT(`status`) as total FROM `admin` where status='' ;");
        $a=mysqli_fetch_assoc($sql_app);
        ?>
      <header>
      <div class="logo"></div>
            <nav class="navigation">
                
                <div class="center-links">
                <a href="index.php"><i class="fa fa-home"></i>&nbsp;HOME</a>
                <a href="books.php"><i class="fa fa-book"></i>&nbsp;BOOKS</a>
                <a href="feedback.php"><i class="fa fa-mail-forward"></i>&nbsp;FEEDBACK</a>
                
                </div>
                
            <?php

                if(isset($_SESSION['login_user']))
                {?>
                    <ul class="center-links">
                        <a href="student.php">STUDENT_INFORMATION</a>
                        <a href="fine.php">FINE</a>
                        <a href="profile.php">PROFILE</a>
                    </ul>
                    <ul><a class="log_out" href="app_admin.php"><span class="glyphicon glyphicon-user"></span></a></ul><span class="badge bg-green"><?php echo $a['total'];?></span>&nbsp&nbsp
                    <ul><a class="log_out" href="message.php"><span class="glyphicon glyphicon-envelope"></span></a></ul><span class="badge bg-green"><?php echo $c['total'];?></span>&nbsp&nbsp
                    <ul><a style="text-decoration:none" href="profile.php" > <div style="color: white">
                                    <?php 
                                    echo "<img class='img-circle profile_img' width='30px' height='30px' src='images/".$_SESSION['pic']."'>";
                                    echo " ".$_SESSION['login_user'];
                                    ?>
                                    </div>
                        </a></ul>&nbsp;&nbsp;
                    <ul><a class="log_out" href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></ul>

                    <?php
                }
                else
                {
                    ?>
                        <div class="right-links">
                            <ul><a href="admin_log.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></ul>
                            <ul><a href="admin_log.php"><span class="glyphicon glyphicon-user"> SIGN UP</span></a></ul>
                        </div>
                    <?php
                }

            ?>
            </nav>
      </header>
      
    </body>

</html>