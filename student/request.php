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
                padding-left: 1000px;
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
            margin: 70px auto;
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
            td,th,input
            {
                width:100px;
            }
            .displayed:hover
            {
                color:black;
            }
            .btn-success {
                color: #fff;
                background-color: #f2140c;
                border-color: #fe110d;
            }
            .btn-success:hover {
                color: #fff;
                background-color:rgb(137, 59, 28);
                border-color:rgb(137, 59, 28);
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
            <div class="container"><br><br>
        <?php
        if(isset($_SESSION['login_user']))
        {    
        
            $q=mysqli_query($db,"SELECT * FROM issue_book where username='$_SESSION[login_user]' and approve=' '; " );

            if(mysqli_num_rows($q)==0)
            {
                
                echo "<h1>sorry!🤦‍♂️ There's no pending request.</h1>";

            }
            else
            {?>
                <form method="post">
            <?php
                echo "<table class='table table-bordered table-hover' >";
                echo "<tr style='background-color:green;'>";
                    // Table header
                    echo "<th>"; echo "Select"; echo "</th>";                 
                    echo "<th>"; echo "Book-Id"; echo "</th>";
                    echo "<th>"; echo "Approve status"; echo "</th>";
                    echo "<th>"; echo "Issue Date"; echo "</th>";
                    echo "<th>"; echo "Return Date"; echo "</th>";
                  
                echo "</tr>";
                while($row=mysqli_fetch_assoc($q))
                {
                    echo "<tr class='displayed'>";
                    ?>
                    <td><input style="color:green" type="checkbox" name="check[]" value="<?php echo $row["bid"] ?>"></td>
                    <?php
                    echo "<td>";echo $row['bid'];echo "</td>";
                    echo "<td>";echo $row['approve'];echo "</td>";
                    echo "<td>";echo $row['issue'];echo "</td>";
                    echo "<td>";echo $row['return'];echo "</td>";
                  

                    echo "</tr>";
                }
            echo "</table>";  
            ?>
            <p align="center"><button  type="submit" name="delete" class="btn btn-success" onclick="location.reload()"><i class="fa fa-trash-o" ></i>&nbsp;Delete</button></p>
            <?php
            }
        
     
        ?>
        </div>
        <?php
        if(isset($_POST['delete']))
        {
            if(isset($_POST['check']))
            {
                foreach ($_POST['check'] as $delete_id) {
                
                   mysqli_query($db,"DELETE from issue_book where bid='$delete_id' and username='$_SESSION[login_user]' ORDER BY bid ASC LIMIT 1 ;");
                }
            }
        }
    }else
    {
        echo "<h4 style='color:red'>sorry!🤦‍♂️ you need to login first. please try searching again.</h4>";

    }
        ?>
    </body>
</html>