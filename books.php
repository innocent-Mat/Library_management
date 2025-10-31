<?php
   include "connection.php";
   include "navbar.php";

?>
<DOCTYPE html>
<html>
    <head>
        <title>books</title>
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
            padding: 10px;
            margin:0px auto;

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
                border-radius:20px
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
                background-color: green;
                color:white;
                text-align:center;
            }
            .btn-default:hover {
                background-color:white;
                color:green;
            }
           
            .displayed:hover
            {
                color: #333;
            }
            .book-list-container {
                max-height: 350px; /* Set max height for scroll */
                overflow-y: auto;
                border: 1px solid white;
                padding: 10px;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
         <!------------- sidebar----------------------------->
         <?php
         $b=mysqli_query($db,"SELECT * FROM `books` ORDER BY bcount DESC limit 0,3 ;");
     
         ?>
         <div style="width:100%; height:50px; margin-top:150px;">
            <div style="width:10%; height:50px; background-color:#f44336; padding10x; float:left;">
                <h3 style="color:white; margin-top:0px;">Trending:</h3>
            </div>

            <div style="background-color:#ffcccc;width:90%;height:50px;float:left;padding:10px">
                <table>
                    <?php
                        while($b2=mysqli_fetch_assoc($b))
                        {
                        echo "<tr style='color:black; width:400px; margin-top: 0px; float:left; display:flex'>";
                            echo "<td>";echo "[".$b2['bid']."]&nbsp&nbsp";echo "</td>";
                            echo "<td>";echo $b2['name'];echo "</td>";
                        echo "</tr>";

                        }
                    ?>
                </table>
            </div>
        </div>        
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="h"><a href="index.php"><i class="fa fa-home"></i>&nbsp;Home</a></div>
        <div class="h"><a href="books.php"><i class="fa fa-book"></i>&nbsp;Books</a></div>
        <div class="h"><a href="language.php"><i class="fa fa-globe"></i>&nbsp;Language</a></div>


     
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
                <label for="department">choose a Department</label>
                <select style="background-color:black" name="department">
                    <optgroup label="medical_resources">
                        <option value="books">books and journal</option>
                        <option value="workshops">workshops and health awareness</option>
                        <option value="medical">medical technology </option>
                    </optgroup>
                    <optgroup label="Entertainment">
                        <option value="history">History</option>
                        <option value="comedy">comedy</option>
                        <option value="horror">horror</option>
                        <option value="nature">Nature</option>
                        <option value="literature">Literature</option>
                    </optgroup>
            </select>
                <br><br>
                    <input class="form-control" type="text" name="search" placeholder="search books..." required="">
                    <button  type="submit" name="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                
            </form>
            <!----------- request -------------->
            <form class="navbar-form" method="post" name="form1">
                
                <input class="form-control" type="text" name="bid" placeholder="Enter the book Id..." required="">
                <button  type="submit" name="submit1" class="btn btn-default"><i class="fa fa-upload"></i>&nbsp;request</button>
            
        </form>

        </div>
        <h2>List of Books</h2>
        <div class="book-list-container">
        <?php
            if(isset($_POST['submit']))
            {
                $q=mysqli_query($db,"SELECT * FROM books where name like  '%$_POST[search]%' and department='$_POST[department]' " );

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
                    $sql1=mysqli_query($db,"SELECT * FROM `books` WHERE bid='$_POST[bid]'; ");
                    $row1=mysqli_fetch_assoc($sql1);
                    $count1=mysqli_num_rows($sql1);
                    if($count1!=0)
                    {
                    mysqli_query($db,"INSERT INTO issue_book Values('$_SESSION[login_user]', '$_POST[bid]', '', '', '','');");

                    ?>
                    <script type="text/javascript">
                        window.location="request.php";
                    </script>
                <?php
                    }
                    else
                    {
                        ?>
                          <script type="text/javascript">
                            alert("⚠️the books not available in the library⚠️");
                    </script>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <script type="text/javascript">
                            alert("⚠️you need to login first to request⚠️");
                        </script>
                    <?php
                }
            }
            //include "footer.php";
        ?>
        </div>
        </div>
    </body>
</html>