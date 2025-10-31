<?php
   include "connection.php";
   include "navbar.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>book request</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style type="text/css">
            .search{
                padding-left: 850px;
            }
            .form-control
            {
                width:250px;
                height: 35px;
                background-color: white;
                color:black;
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
                background-color:#333;
                color: white;
                border-radius:20px;
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
            .displayed:hover
            {
                color:black;
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
                    {    echo "<img class='img-circle profile_img' width='35px' height='35px' src='images/".$_SESSION['pic']."'>";
                        echo "</br></br>";
                        echo " ".$_SESSION['login_user'];
                    }
                ?>
            </div>
            <div class="h"><a href="index.php"><i class="fa fa-home"></i>&nbsp;Home</a></div>
        <div class="h"><a href="books.php"><i class="fa fa-book"></i>&nbsp;Books</a></div>
        <div class="h"><a href="request.php"><i class="fa fa-cart-arrow-down"></i>&nbsp;Books request</a></div>
        <div class="h"><a href="issue_info.php"><i class="fa fa-envelope"></i>&nbsp;Issue Information</a></div>
        <div class="h"><a href="expired.php"><i class="fa fa-hourglass-2"></i>&nbsp;Expired list</a></div>
        <div class="h"><a href="admin_settings.php"><i class="fa fa-gear">&nbsp;</i>Setting</a></div>

        </div>

        <div id="main">
            <span style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776; open</span>
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
            <br>
        <div class="container">
            <div class="search">
                <form method="post" action="" name="form1">
                    <input type="text" name="username" class="form-control" placeholder="username" required=""><br>
                    <input type="text" name="bid" class="form-control" placeholder="BID" required=""><br>
                    <button class="btn btn-default" name="submit" type="submit"><i class="fa fa-save"></i>&nbsp;submit</button><br>
                </form>
            </div>
            <h3 style=" text-align: center;">Request of Books</h3>
        <?php
        if(isset($_SESSION['login_user']))
        {
            $sql= "SELECT student.email,books.bid,name,authors,edition FROM student INNER JOIN issue_book ON student.email=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approve = ''";
            $res=mysqli_query($db,$sql);

            if(mysqli_num_rows($res)==0)
            {
                echo "<h2><br>";
                echo "sorry!🤦‍♂️ There's no pending request.";
                echo "</h2></br>";

            }
            else
            {
                echo "<table class='table table-bordered table-hover' >";
                echo "<tr style='background-color:green;'>";
                    // Table header                 
                    echo "<th>"; echo "Email"; echo "</th>";
                    echo "<th>"; echo "Book Id"; echo "</th>";
                    echo "<th>"; echo "Book name"; echo "</th>";
                    echo "<th>"; echo "Authors name"; echo "</th>";
                    echo "<th>"; echo "Edition"; echo "</th>";

                  
                echo "</tr>";
                while($row=mysqli_fetch_assoc($res))
                {
                    echo "<tr class='displayed'>";
                    echo "<td>";echo $row['email'];echo "</td>";
                    echo "<td>";echo $row['bid'];echo "</td>";
                    echo "<td>";echo $row['name'];echo "</td>";
                    echo "<td>";echo $row['authors'];echo "</td>";
                    echo "<td>";echo $row['edition'];echo "</td>";
                  
                    echo "</tr>";
                }
            echo "</table>";
            }
        }
        else
        {
            ?><br>
            <h4 style=" text-align: center; color: yellow">you need to login first to see the request </h4>
            <?php
        }
        if(isset($_POST['submit']))
        {
            $_SESSION['name']=$_POST['username'];
            $_SESSION['bid']=$_POST['bid'];

            ?>
            <script type="text/javascript">
                window.location="approve.php"
            </script>
            <?php
        }
        ?>
        </div>
    </body>
</html>