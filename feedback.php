<?php   
    include "connection.php";
    include "navbar.php";

?>
<DOCTYPE html>
<html>
    <head>
        <title>feedback</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            .container{
                
                height: 600px;
                border: 2px solid rgba(225, 255, 255);
                background:  black;
                border-radius: 20px;
                align-items: center;
                justify-content: center;
                backdrop-filter: blur(20px);
                opacity: .9.2;
                color: white;
                margin: 130px auto;
            }
            
            .form-control
            {
               height: 70px;
               width: 60%;

            }
            .scroll{
                width: 100%;
                height: 300px;
                overflow: auto;
                color: black;
                background-color:beige;
                border-radius: 20px
            }
            .btn-default {
                background-color:green;
                color:white;
                text-align:center; 
                font-size:17px;
                text-align:center; 
                width: 100px;
                height: 35px;   
            }
            .btn-default:hover {
                background-color:white;
                color:green;
            }
        </style>
        
    </head>
    <body>
        <div class="container">
        <div class="wrapper">
                <h4>if you have any suggestions or questions please commment below.</h4>
                <form style="" action="" method="post">
                    <input class="form-control" type="text" name="comment" placeholder="write something..."><br><br>
                    <input class="btn btn-default" type="submit" name="submit" value="comment" style="width: 100px; height: 35px">
                </form>
            <br><br>
            <div class="scroll">
                <?php
                    if(isset($_POST['submit']))
                    {
                        if(isset($_SESSION['user_login']))
                        {
                            
                    $sql="INSERT INTO `comments` VALUES(' ', '$_SESSION[login_user]', '$_POST[comment]');";
                    if(mysqli_query($db,$sql)) 
                    {
                        $q="SELECT * FROM `comments` ORDER BY `id` DESC";

                        $res=mysqli_query($db,$q);

                        echo "<table class='table table-bordered'>";
                        while ($row=mysqli_fetch_assoc($res))
                        {
                            echo "<tr>";
                                echo "<td>"; echo $row['email']; echo "</td>";
                                echo "<td>"; echo $row['comment']; echo "</td>";
                            echo "</tr>";

                        }
                    }
                        }
                        else 
                        {
                            ?>
                            <script >
                                alert("login first");
                                </script>
                            <?php
                             $q="SELECT * FROM `comments` ORDER BY `id` DESC";

                             $res=mysqli_query($db,$q);
     
                             echo "<table class='table table-bordered'>";
                             while ($row=mysqli_fetch_assoc($res))
                             {
                                 echo "<tr>";
                                     echo "<td>"; echo $row['email']; echo "</td>";
                                     echo "<td>"; echo $row['comment']; echo "</td>";
                                 echo "</tr>";
     
                             }
                        }
                    }
                    else
                    {
                        $q="SELECT * FROM `comments` ORDER BY `id` DESC";

                        $res=mysqli_query($db,$q);

                        echo "<table class='table table-bordered'>";
                        while ($row=mysqli_fetch_assoc($res))
                        {
                            echo "<tr>";
                                echo "<td>"; echo $row['email']; echo "</td>";
                                echo "<td>"; echo $row['comment']; echo "</td>";
                            echo "</tr>";

                        }
                    }
                ?>
            </dvi>
        </div>
                </div>
    </body>
</html>