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
                width:300px;
                height: 40px;
                background-color: white;
                color:white;
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
            padding: 16px;
            margin: 120px auto;
            }

            @media screen and (max-height: 350px) {
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
            .scroll
            {
                width: 100%;
                height:500px;
                overflow:auto;
            }
            th,td
            {
                width: 10%;
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
                    {    echo "<img class='img-circle profile_img' width='40px' height='40px' src='images/".$_SESSION['pic']."'>";
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
            <span style="font-size:30px;cursor:pointer"  onclick="openNav()">&#9776; open</span>
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
            <h3 style="text-align: center;">Information of borrowed books</h3>
            <?php
                if(isset($_SESSION['login_user']))
                {
                    $c=0;

                    $sql="SELECT student.email,books.bid,name,authors,edition,issue,issue_book.return FROM student INNER JOIN issue_book ON student.email=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approve = 'yes' ORDER BY `issue_book`.`return` ASC";
                    $res=mysqli_query($db,$sql);
                                   
                    echo "<table class='table table-bordered table-hover'; style='width:100%' >";
                    echo "<tr style='background-color:green;'>";
                    // Table header 
                    echo "<th>"; echo "Email"; echo "</th>";
                    echo "<th>"; echo "Book Id"; echo "</th>";
                    echo "<th>"; echo "Book name"; echo "</th>";
                    echo "<th>"; echo "Authors name"; echo "</th>";
                    echo "<th>"; echo "Edition"; echo "</th>";
                    echo "<th>"; echo "Issue Date"; echo "</th>";
                    echo "<th>"; echo "Return Date"; echo "</th>";

                  
                    echo "</tr>";
                    echo "</table>";

                    echo "<div class='scroll'>";                
                    echo "<table class='table table-bordered table-hover' style='width:99%' >";
                    while($row=mysqli_fetch_assoc($res))
                    {
                    $d=date("Y-m-d");
                    if($d > $row['return'])
                    {
                        $c=$c+1;
                        $var='<p style="color: Yellow; background-color: red">EXPIRED</p>';
                        mysqli_query($db,"UPDATE issue_book SET approve='$var' where `return`='$row[return]' and approve='Yes' limit $c;");
                        
                        echo $d."</br>";
                    }
                    echo "<tr class='displayed'>";
                    echo "<td>";echo $row['email'];echo "</td>";
                    echo "<td>";echo $row['bid'];echo "</td>";
                    echo "<td>";echo $row['name'];echo "</td>";
                    echo "<td>";echo $row['authors'];echo "</td>";
                    echo "<td>";echo $row['edition'];echo "</td>";
                    echo "<td>";echo $row['issue'];echo "</td>";
                    echo "<td>";echo $row['return'];echo "</td>";
                  
                    echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";

                }
                else
                {
                    ?>
                        <h3 style="text-align: center;">login to see information of borrowed books</h3>
                    <?php
                }
            ?>
            </div>
            </div>
    </body>
</html>