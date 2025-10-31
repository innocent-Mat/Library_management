<?php
include "connection.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Library System</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        .badge {
            background-color: red;
        }
        .profile_img {
            border-radius: 50%;
        }
       
    </style>
</head>
<body>
<?php
if (isset($_SESSION['login_user'])) {
    // Get unread messages
    $r = mysqli_query($db, "SELECT COUNT(`status`) AS total FROM `message` WHERE status='no' AND email='$_SESSION[login_user]' AND sender='admin'");
    $c = mysqli_fetch_assoc($r);
    //---------------timer------------
    $b=mysqli_query($db,"SELECT * FROM issue_book where username='$_SESSION[login_user]' and approve='yes' ORDER BY `return` ASC limit 0,1;");
    $var1= mysqli_num_rows($b);

    $bid =mysqli_fetch_assoc($b);

    // Get user's profile picture
    $userQuery = mysqli_query($db, "SELECT pic FROM student WHERE email='$_SESSION[login_user]'");
    $userData = mysqli_fetch_assoc($userQuery);

    // Check if user has an image, else use default image
    $profileImage = (!empty($userData['pic'])) ? "images/" . $userData['pic'] : "images/default.png";
    ?>
    <header>
        <div class="logo"></div>
        <nav class="navigation">
            <div class="center-links">
                <a href="index.php"><i class="fa fa-home"></i>&nbsp;HOME</a>
                <a href="books.php"><i class="fa fa-book"></i>&nbsp;BOOKS</a>
                <a href="feedback.php"><i class="fa fa-mail-forward"></i>&nbsp;FEEDBACK</a>
                
            </div>
            <ul class="center-links">
                <a href="profile.php"><i class="fa fa-user-circle-o"></i>&nbsp;PROFILE</a>
                <a href="fine.php"><i class="fa fa-user"></i>&nbsp;FINES</a>
            </ul>

            <ul>
                <a><p style="color:#ff1503; font-size:20px;" id="demo"></p></a>
            </ul>
            &nbsp;&nbsp;
            <ul>
                <a href="message.php">
                    <span class="glyphicon glyphicon-envelope" style="color:white;"></span>
                </a>
            </ul>
            <span class="badge bg-green"><?php echo $c['total']; ?></span>
            &nbsp;&nbsp;
            <ul>
                <a href="profile.php">
                    <div style="color: white">
                        <img class="img-circle profile_img" width="30px" height="30px" src="<?php echo $profileImage; ?>" onerror="this.onerror=null; this.src='images/default.png';">
                        <?php echo " " . $_SESSION['login_user']; ?>
                    </div>
                </a>
            </ul>
            &nbsp;&nbsp;
            <ul>
                <a href="logout.php">
                    <span class="glyphicon glyphicon-log-out" style="color:white;"> LOGOUT</span>
                </a>
            </ul>
        </nav>
    </header>
    <?php
    if($var1==1)
    {
    ?>

    <script>
        // Timer countdown script
        var countDownDate = new Date("<?php echo isset($res['tm']) ? $res['tm'] : ''; ?>").getTime();
        var x = setInterval(function () {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
<?php } }?>
</body>
</html>
