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
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
            padding: 16px;
            margin: 60px auto;
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
                border-radius: 20px;
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
                height:400px;
                overflow:auto;
            }
            th,td
            {
                width: 10%;
            }
            .displayed:hover
            {
                color: black;
            }
        </style>
    </head>
    <body>
          <!------------- sidebar----------------------------->
          <br><br>        
          <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="h"><a href="index.php"><i class="fa fa-home"></i>&nbsp;Home</a></div>
        <div class="h"><a href="books.php"><i class="fa fa-book"></i>&nbsp;Books</a></div>
        <div class="h"><a href="request.php"><i class="fa fa-cart-arrow-down"></i>&nbsp;Books request</a></div>
        <div class="h"><a href="issue_info.php"><i class="fa fa-envelope"></i>&nbsp;Issue Information</a></div>
        <div class="h"><a href="expired.php"><i class="fa fa-hourglass-2"></i>&nbsp;Expired list</a></div>
        <div class="h"><a href="profile.php"><i class="fa fa-gear">&nbsp;</i>Setting</a></div>

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
                <?php
                if(isset($_SESSION['login_user']))
                {
                    $user_email = $_SESSION['login_user']; // Get the logged-in user's email
                    ?>
                    <div  style="float: left; padding-left:5px; padding-top:20px">
                    <form method="post" action="">
                        <button name="submit2" type="submit" class="btn btn-default" style="background-color:green; color:yellow">RETURNED<button>&nbsp;&nbsp;
                        <button name="submit3" type="submit" class="btn btn-default" style="background-color:red; color:yellow">EXPIRED<button>
                    </form>                
                    </div>
                    <div style="float:right;padding-top: 10px">
                        <?php
                            $var=0;
                            $result=mysqli_query($db,"SELECT * FROM `fine`  where email='$_SESSION[login_user]' and `status`='not paid'; ");
                            while($r=mysqli_fetch_assoc($result))
                            {
                                $var=$var+$r['fine'];
                            }
                            $var2=$var;
                        ?>
                        <h4> your fine is:
                            <?php
                                echo "$ ".$var2;
                            ?>
                        </h4>
                    </div><br><br><br>
                        
                    <?php
                    if(isset($_POST['submit']))
                    {
                        $var1='<p style="color: Yellow; background-color: green">RETURNED</p>';
                        mysqli_query($db,"UPDATE issue_book SET approve='$var1' where username='$_POST[username]' and bid='$_POST[bid]' ");

                        mysqli_query($db,"UPDATE books SET quantity=quantity+1 where bid='$_POST[bid]'");
                    }
                }

                ?>
           <!--- <h3 style="text-align: center;">Date expired list</h3>--><br>
            <?php
                $c=0;
                if(isset($_SESSION['login_user']))
                {
                    $ret='<p style="color: Yellow; background-color: green">RETURNED</p>';
                    $exp='<p style="color: Yellow; background-color: red">EXPIRED</p>';

                    if(isset($_POST['submit2']))
                    {
                        $sql="SELECT student.email,books.bid,name,authors,edition,approve,issue,issue_book.return FROM student INNER JOIN issue_book ON student.email=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approve ='$ret' and  student.email = '$user_email'  ORDER BY `issue_book`.`return` DESC;";
                        $res=mysqli_query($db,$sql);
                    }
                    else if(isset($_POST['submit3']))
                    {
                        $sql="SELECT student.email,books.bid,name,authors,edition,approve,issue,issue_book.return FROM student INNER JOIN issue_book ON student.email=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approve ='$exp'and  student.email = '$user_email'  ORDER BY `issue_book`.`return` DESC;";
                        $res=mysqli_query($db,$sql);
                    }
                    else
                    {
                        $sql="SELECT student.email,books.bid,name,authors,edition,approve,issue,issue_book.return FROM student INNER JOIN issue_book ON student.email=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approve !='' and student.email = '$user_email'  and issue_book.approve !='yes'  ORDER BY `issue_book`.`return` DESC;";
                        $res=mysqli_query($db,$sql);
                    }

                    echo "<table class='table table-bordered table-hover'; style='width:100%' >";
                    echo "<tr style='background-color:green;'>";
                    // Table header 
                    echo "<th>"; echo "Email"; echo "</th>";
                    echo "<th>"; echo "Book Id"; echo "</th>";
                    echo "<th>"; echo "Book name"; echo "</th>";
                    echo "<th>"; echo "Authors name"; echo "</th>";
                    echo "<th>"; echo "Edition"; echo "</th>";
                    echo "<th>"; echo "Status"; echo "</th>";
                    echo "<th>"; echo "Issue Date"; echo "</th>";
                    echo "<th>"; echo "Return Date"; echo "</th>";

                  
                    echo "</tr>";
                    echo "</table>";

                    echo "<div class='scroll'>";                
                    echo "<table class='table table-bordered table-hover' style='width:99%' >";
                    while($row=mysqli_fetch_assoc($res))
                    {
                    echo "<tr class='displayed'>";
                    echo "<td>";echo $row['email'];echo "</td>";
                    echo "<td>";echo $row['bid'];echo "</td>";
                    echo "<td>";echo $row['name'];echo "</td>";
                    echo "<td>";echo $row['authors'];echo "</td>";
                    echo "<td>";echo $row['edition'];echo "</td>";
                    echo "<td>";echo $row['approve'];echo "</td>";
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