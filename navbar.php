<?php
    include "connection.php";
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>title bars</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
        <style>
            .badge
            {
                background-color:red;
            }
            .glyphicon-user:hover
            {
                color: green;
            }
            .glyphicon-log-out:hover
            {
                color: green;
            }
            .glyphicon-log-in:hover
            {
                color: green;
            }
        </style>
    </head>
    <body>
      
      <header>
      <div class="logo"></div>
            <nav class="navigation">
                
                <div class="center-links">
                <a href="index.php"><i class="fa fa-home"></i>&nbsp;HOME</a>
                <a href="books.php"><i class="fa fa-book"></i>&nbsp;BOOKS</a>
                <a href="feedback.php"><i class="fa fa-mail-forward"></i>&nbsp;FEEDBACK</a>
                </div>
                <div class="right-links">
                                <ul><a href="log_out.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></ul>
                                <ul><a href="log_out.php"><span class="glyphicon glyphicon-user"> SIGN UP</span></a></ul>
                            </div>
                
                <?php
                if(isset($_SESSION['login_user']))
                            {?>
                            <?php
                    $r=mysqli_query($db,"SELECT COUNT(`status`) as total FROM `message` where status='no' and email='$_SESSION[login_user]' and sender='admin'");
                    $c=mysqli_fetch_assoc($r);
                    //---------------------timer-------------//
                    $b=mysqli_query($db,"SELECT * FROM issue_book where username='$_SESSION[login_user]' and approve='yes' ORDER BY `return` ASC limit 0,1 ;");

                    $bid=mysqli_fetch_assoc($b);
                    $t=mysqli_query($db, "SELECT * FROM `timer` where name='$_SESSION[login_user]' and bid='$bid[bid]' ;");
                    
                    $res=mysqli_fetch_assoc($t);
                    ?>
<!-------------------------timer------------------------------------------------------------------>

                <script>
                // Set the date we're counting down to
                var countDownDate = new Date("<?php echo $res['tm']; ?>").getTime();

                // Update the count down every 1 second
                var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();
                    
                // Find the distance between now and the count down date
                var distance = countDownDate - now;
                    
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    
                // Output the result in an element with id="demo"
                document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";
                    
                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
                }, 1000);
                </script>
<!------------------------timer-------------------------------------------------------------------->
                    <ul class="center-links">
                        <a href="profile.php">PROFILE</a>
                        <a href="fine.php">FINES</a>

                    </ul>
                    <ul><a><p style="color:#ff1503; font-size:20px;" id="demo"></p></a></ul>&nbsp&nbsp
                    <ul><a href="message.php"><span class="glyphicon glyphicon-envelope"></span></a></ul><span class="badge bg-green"><?php echo $c['total'];?></span>&nbsp&nbsp
                    <ul><a href="profile.php" > <div style="color: white">
                                    <?php
                                    echo "<img class='img-circle profile_img' width='30px' height='30px' src='images/".$_SESSION['pic']."'>";
                                    echo " ".$_SESSION['login_user'];
                                    ?>
                                    </div>
                        </a></ul>&nbsp;&nbsp;
                    <ul><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></ul>

                    <?php
                }
                
            ?>
            </nav>  
            <?php
           if(isset($_SESSION['login_user']))
           {
            $day=0;

            $exp='<p style="color: Yellow; background-color: red">EXPIRED</p>';
            $res=mysqli_query($db,"SELECT issue_book.return from issue_book where username='$_SESSION[login_user]' and approve='$exp' ;"); 

            while($row=mysqli_fetch_assoc($res))
            {
                $d=strtotime($row['return']);
                $c=strtotime(date("y-m-d"));
                $diff= $c-$d;
            
                if($diff>=0)
               { $day=$day+floor($diff/(60*60*24)); //all days
               }
            }
            $_SESSION['fine']=$day*.10;
        }
            ?>
      </header>
      
    </body>

</html>