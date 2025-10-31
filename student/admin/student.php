
<?php
   include "connection.php";
   include "navbar.php";
?>
<DOCTYPE html>
<html>
    <head>
        <title>student information</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            .search{
                padding-left: 850px;
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
                background-color:green;
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
            .btn-default
            {
                background-color: green;
                color: white;
                width: 50px;
                height: 35px;

            }
            .btn-default:hover
            {
                background-color:white;
                color: green;
                
            }
            .displayed
            {
                color:white;
            }
            .displayed:hover
            {
                color:black;
            }
        </style>
    </head>
    <body>
        <!------------- sidebar ----------------------------->
        <br><br>        
        <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <div style="color: white; margin-left: 30px; ">
            <?php 
                if(isset($_SESSION['login_user']))
                { 
                    echo "<img class='img-circle profile_img' width='100px' height='100px' src='images/".$_SESSION['pic']."'>";
                    echo "</br></br>";
                    echo " ".$_SESSION['login_user'];
                    
                }
            ?>
        </div>
        <div class="h"><a href="profile.php">Profile</a></div>
        <div class="h"><a href="books.php">Books</a></div>
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
        <!------------ search bar--------------------------->
        <div class="container">
        <div class="search">
            <form class="navbar-form" method="post" name="form1">
                
                    <input class="form-control" type="text" name="search" placeholder="student username..." required="">
                    <button  type="submit" name="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                
            </form>
        </div>
        <h2>List of students</h2>
        <?php
            if(isset($_POST['submit']))
            {
                $q=mysqli_query($db,"SELECT username, email  FROM `student` where username like  '%$_POST[search]%' " );

                if(mysqli_num_rows($q)==0)
                {
                    echo "<h4 style='color:red'>sorry!🤦‍♂️ no student found with that username. please try searching again.</h4>";
                }
                else
                {
                    echo "<table class='table table-bordered table-hover' >";
                    echo "<tr style='background-color:green;'>";
                        // Table header
                        echo "<th>"; echo "User-name"; echo "</th>";
                        echo "<th>"; echo "Email"; echo "</th>";
                    echo "</tr>";
                    while($row=mysqli_fetch_assoc($q))
                    {
                        echo "<tr class='displayed'>";
                        echo "<td>";echo $row['username'];echo "</td>";
                        echo "<td>";echo $row['email'];echo "</td>";
                        echo "</tr>";
                    }
                echo "</table>";  
                }
            }
            else /* if the button isn't pressed. */
            {
                
           $res=mysqli_query($db,"SELECT username, email  FROM `student`;");
           echo "<table class='table table-bordered table-hover' >";
               echo "<tr style='background-color:green;'>";
                   // Table header
                   echo "<th>"; echo "User-name"; echo "</th>";
                   echo "<th>"; echo "Email"; echo "</th>";
               echo "</tr>";
               while($row=mysqli_fetch_assoc($res))
               {
                   echo "<tr class='displayed'>";
                   echo "<td>";echo $row['username'];echo "</td>";
                   echo "<td>";echo $row['email'];echo "</td>";
                   echo "</tr>";
               }
           echo "</table>";
            }
            //include "footer.php";
        ?>
        </div>
    </body>
</html>