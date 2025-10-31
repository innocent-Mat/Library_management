<?php
   include "connection.php";
   include "navbar.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Approve request</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            .search{
                padding-left: 850px;
            }
            .form-control
            {
                width:300px;
                height: 40px;
                background-color: black;
                color:white;
            }
            .search{
                padding-left: 750px;
            }
            body {
            color: white;
            font-family: "Lato", sans-serif;
            }

            .sidenav {
            height: 100%;
            margin-top: 140px;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            }

            .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
            }

            .sidenav a:hover {
            color: #f1f1f1;
            }

            .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
            }

            #main {
            transition: margin-left .5s;
            padding: 46px;
            margin: 90px auto;
            }

            @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
            }
            .img-circle{
                margin-left: 60px;
            }
            .h:hover{
                width: 300px;
                height:50px;
                background-color:green;
                border-radius:20px;
                color: white;
            }
            .container
            {
                height: 600px;
                border: 2px solid rgba(225, 255, 255);
                background:  black;
                border-radius: 20px;
                align-items: center;
                justify-content: center;
                backdrop-filter: blur(20px);
                opacity: .9.2;
                color: white;
            }
            .approve
            {
                margin-left: 420px;
            }
            .btn-default {
                background-color:green;
                color:white;
                text-align:center;
                width: 90px;
                
            }
            .btn-default:hover {
                background-color:white;
                color:green;
                text-align:center;
                width: 90px;
                
            }

        </style>
    </head>
    <body>
          <!------------- sidebar----------------------------->
          <br><br>        
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div style="color: white; margin-left: 30px; ">
                <?php 
                    if(isset($_SESSION['login_user']))
                    {    echo "<img class='img-circle profile_img' width='100px' height='100px' src='images/".$_SESSION['pic']."'>";
                        echo "</br></br>";
                        echo " ".$_SESSION['login_user'];
                    }
                ?>
            </div>
           
            <div class="h"><a href="books.php">Books</a></div>
            <div class="h"><a href="add_books.php">Add Books</a></div>
            <div class="h"><a href="request.php">Books Request</a></div>
            <div class="h"><a href="issue_info.php">Issue Information</a></div>
            <div class="h"><a href="expired.php">Expired List</a></div>
        </div>

        <div id="main">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
            <script>
                function openNav() {
                document.getElementById("mySidenav").style.width = "300px";
                document.getElementById("main").style.marginLeft = "0px";
                }

                function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
                }
            </script>
        <div class="container">
            <h3 style="text-align:center">Approve Request</h3>
            <form class="approve" method="post" action="" name="form1">
                    <input type="text" name="approve" class="form-control" placeholder="yes or not" required=""><br>
                    <input type="text" name="issue" class="form-control" placeholder="issue date yyyy-mm-dd" required=""><br>
                    <input type="text" name="return" class="form-control" placeholder="Return date yyyy-mm-dd" required=""><br>
                    <input type="text" name="tm" class="form-control" placeholder="Return date   Feb 22, 2025 15:00:00" required=""><br>
                    <button class="btn btn-default" name="submit" type="submit">submit</button><br>
                </form>
        </div>
        </div>
        <?php
        if(isset($_POST['submit']))
        {
            mysqli_query($db,"INSERT INTO timer VALUES('$_SESSION[name]', '$_SESSION[bid]', '$_POST[tm]');");
            mysqli_query($db,"UPDATE `issue_book` SET `approve`= '$_POST[approve]', `issue` = '$_POST[issue]', `return`='$_POST[return]'  WHERE username='$_SESSION[name]' AND bid='$_SESSION[bid]';");

            mysqli_query($db,"UPDATE books SET quantity= quantity-1   WHERE  bid='$_SESSION[bid]';");

            mysqli_query($db,"UPDATE books SET bcount= bcount+1   WHERE  bid='$_SESSION[bid]';");

            $res=mysqli_query($db,"SELECT quantity from books where bid='$_SESSION[bid]' ;");

            while($row=mysqli_fetch_assoc($res))
            {
                if($row['quantity']==0)
                {
                    mysqli_query($db, "UPDATE books SET status='not-available' where bid='$_SESSION[bid]';");
                }
            }
            ?>
            <script type="text/javascript">
                alert("Updated successfully!");
                window.location="request.php"
            </script>
            <?php
        }
        ?>
    </body>
</html>