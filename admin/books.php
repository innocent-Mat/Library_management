<?php
   include "connection.php";
   include "navbar.php";
?>
<DOCTYPE html>
<html>
    <head>
        <title>books</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                padding-left: 800px;
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
            margin: 80px auto;
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
            .displayed:hover
            {
                color: black;
            }
            .book-list-container {
                max-height: 400px; /* Set max height for scroll */
                overflow-y: auto;
                border: 1px solid white;
                padding: 10px;
                margin-top: 10px;
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
        <div class="h"><a href="add_books.php"><i class="fa fa-book"></i>&nbsp;ADD</a></div>
        <div class="h"><a href="request.php"><i class="fa fa-cart-arrow-down"></i>&nbsp;Books request</a></div>
        <div class="h"><a href="issue_info.php"><i class="fa fa-envelope"></i>&nbsp;Issue Information</a></div>
        <div class="h"><a href="expired.php"><i class="fa fa-hourglass-2"></i>&nbsp;Expired list</a></div>
        <div class="h"><a href="admin_settings.php"><i class="fa fa-gear">&nbsp;</i>Setting</a></div>

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
            <!------------ search bar--------------------------->
            <div class="container">
            <div class="search">
                <form class="navbar-form" method="post" name="form1">
                    
                        <input class="form-control" type="text" name="search" placeholder="search books..." require="">
                        <button style="background-color:green; color:white" type="submit" name="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search" style="color: white"></span>
                        </button>
                    
                </form>
                <form class="navbar-form" method="post" name="form1">
                    
                    <input class="form-control" type="text" name="bid" placeholder="delete books id.." require="">
                    <button style="background-color:red;color:white" type="submit" name="submit1" class="btn btn-default"><i class="fa fa-trash-o"></i>&nbsp;Delete</button>
                
            </form>
            </div>
            <h2>List of Books</h2>
            <div class="book-list-container">
            <?php
                if(isset($_POST['submit']))
                {
                    $q=mysqli_query($db,"SELECT * FROM books where name like  '%$_POST[search]%' " );
                    if(mysqli_num_rows($q)==0)
                    {
                        echo "<h4 style='color:red'>sorry!🤦‍♂️ no book found. please try searching again.</h4>";
                    }
                    else
                    {
                        echo "<table class='table table-bordered table-hover' >";
                            echo "<tr style='background-color:green;'>";
                           // Table header
                                echo "<th>"; echo "ID"; echo "</th>";
                                echo "<th>"; echo "Book-Name"; echo "</th>";
                                echo "<th>"; echo "Authors Name"; echo "</th>";
                                echo "<th>"; echo "Edition"; echo "</th>";
                                echo "<th>"; echo "Status"; echo "</th>";
                                echo "<th>"; echo "Quantity"; echo "</th>";
                                echo "<th>"; echo "Department"; echo "</th>";
                            echo "</tr>";
                            while($row=mysqli_fetch_assoc($q))
                            {
                                echo "<tr>";
                                    echo "<td>";echo $row['bid'];echo "</td>";
                                    echo "<td>";echo $row['name'];echo "</td>";
                                    echo "<td>";echo $row['authors'];echo "</td>";
                                    echo "<td>";echo $row['edition'];echo "</td>";
                                    echo "<td>";echo $row['status'];echo "</td>";
                                    echo "<td>";echo $row['quantity'];echo "</td>";
                                    echo "<td>";echo $row['department'];echo "</td>";
                                echo "</tr>";
                            }
                        echo "</table>";  
                    }
                }
                else /* if the button isn't pressed. */
                {
                
                    $res=mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`name` ASC;");
                    echo "<table class='table table-bordered table-hover' >";
                        echo "<tr style='background-color:green;'>";
                        // Table header
                            echo "<th>"; echo "ID"; echo "</th>";
                            echo "<th>"; echo "Book-Name"; echo "</th>";
                            echo "<th>"; echo "Authors Name"; echo "</th>";
                            echo "<th>"; echo "Edition"; echo "</th>";
                            echo "<th>"; echo "Status"; echo "</th>";
                            echo "<th>"; echo "Quantity"; echo "</th>";
                            echo "<th>"; echo "Department"; echo "</th>";
                        echo "</tr>";
                        while($row=mysqli_fetch_assoc($res))
                        {
                            echo "<tr class='displayed'>";
                                echo "<td>";echo $row['bid'];echo "</td>";
                                echo "<td>";echo $row['name'];echo "</td>";
                                echo "<td>";echo $row['authors'];echo "</td>";
                                echo "<td>";echo $row['edition'];echo "</td>";
                                echo "<td>";echo $row['status'];echo "</td>";
                                echo "<td>";echo $row['quantity'];echo "</td>";
                                echo "<td>";echo $row['department'];echo "</td>";
                            echo "</tr>";
                        }
                    echo "</table>";
                }
                if(isset($_POST['submit1']))
                {
                    if(isset($_SESSION['login_user']))
                    {
                        mysqli_query($db,"DELETE FROM `books` where bid='$_POST[bid]'; ");

                        ?>
                            <script type="text/javascript">
                                alert("book deleted successfully!");
                            </script>
                        <?php
                    }
                    else
                    {
                        ?>
                            <script type="text/javascript">
                                alert("⚠️please login first⚠️");
                            </script>
                        <?php
                    }
                }
                //include "footer.php";
            ?>
            </div>
        </div>
        </div>
    </body>
</html>