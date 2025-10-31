<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .container {
            height: 750px;
            width: 100%;
            color: white;
            margin: auto;
        }
        .left_box {
            height: 600px;
            width: 40%;
            float: left;
            margin-top: -20px;
            margin: 140px auto;
        }
        .left_box2 {
            height: 600px;
            width: 300px;
            background-color:#2D6A4F;
            border-radius: 20px;
            float: right;
            margin-right: 30px;
        }
        .left_box input {
            width: 150px;
            height: 50px;
            background-color:black;
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
        }
        .btn-default:hover {
                background-color:white;
                color:green;
                text-align:center;
                width: 90px;
                
            }
        .btn-default {
                background-color:green;
                color:white;
                text-align:center;
                width: 90px;
                
            }
        .list {
            height: 500px;
            width: 300px;
            background-color:beige;
            float: right;
            color: white;
            padding: 10px;
            overflow-y: scroll;
        }
        .show_user
        {
            background-color: black;
            color:white;
            border-radius:20px;
        }
        .right_box {
            height: 600px;
            width: 60%;
            background-color:#2D6A4F;
            margin-top: -20px;
            margin: 140px 478px;
            padding: 10px;
            border-radius:20px
        }
        .right_box2 {
            height: 600px;
            width: 660px;
            margin-top: -10px;
            padding: 20px;
            border-radius: 20px;
            background-color:beige ;
            float: left;
            color: white;
        }
        .form-control {
            height: 45px;
            width: 73%;
        }
        .msg {
            height: 450px;
            overflow-y: scroll;
            background-color:black;
            opacity:.7;

        }
        .btn{
            background-color:green;
            color:white;

        }
        .btn-info {
            background-color: green;
            margin-left:450px;
            margin-top:-60px;
        }
        .btn-info:hover {
            background-color: black;
        }
        .chat {
            display: flex;
            flex-flow: row wrap;
        }
        .user .chatbox {
            height: 40px;
            width: 500px;
            padding: 13px 10px;
            background-color: green;
            color: white;
            border-radius: 10px;
        }
        .admin .chatbox {
            height: 40px;
            width: 500px;
            padding: 13px 10px;
            background-color: gray;
            color: white;
            border-radius: 10px;
            order: -1;
        }
        tr:hover {
            background-color: green;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $sql1 = mysqli_query($db, "SELECT student.pic, student.status, message.email FROM student INNER JOIN message ON student.email = message.email GROUP BY email ORDER BY status;");
        ?>

        <!------- Left Box ----------------------->
        <div class="left_box">
            <div class="left_box2">
                <div>
                    <form action="" method="post">
                        <input type="text" name="email" id="uname" placeholder="Select an email">
                        <button name="submit" type="submit" class="btn btn-default">SHOW</button>
                    </form>
                </div>
                <div class="list">
                    <?php
                    echo "<table id='table' class='table' >";
                    while ($res1 = mysqli_fetch_assoc($sql1)) {
                        echo "<tr class='show_user'>";
                        echo "<td width=65>";
                        echo "<img style='background-color:white' class='img-circle profile_img' height=60px width=60px src='p.jpg'>";
                        echo "</td>";
                        echo "<td style='padding-top:30px'>";
                        echo $res1['email'];
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                </div>
            </div>
        </div>

        <!------- Right Box ----------------------->
        <div class="right_box">
            <div class="right_box2">
                <?php
                if (isset($_POST['submit']) && !empty($_POST['email'])) {
                    $_SESSION['email'] = $_POST['email'];
                }

                if (!empty($_SESSION['email'])) {
                    $res = mysqli_query($db, "SELECT * FROM message WHERE email = '$_SESSION[email]' ORDER BY id ASC;");
                ?>
                    <div style="height:70px; width:100%; text-align:center; color:white;background-color:#2D6A4F;border-radius:10px">
                        <h3 style="margin-top:-5px; padding-top:10px"><?php echo $_SESSION['email']; ?></h3>
                    </div>
                    <div class="msg"><br>
                        <?php
                        while ($row = mysqli_fetch_assoc($res)) {
                            if ($row['sender'] == 'student') {
                        ?>
                                <div class="chat user">
                                    <div style="float:left; padding-top: 5px;">&nbsp
                                        <img class='img-circle profile_img' width='40px' height='40px' src='p.jpg'>
                                    </div>
                                    <div style="float:left;" class="chatbox">
                                        <?php echo $row['message']; ?>
                                    </div>
                                </div><br>
                            <?php
                            } else {
                            ?>
                                <div class="chat admin">
                                    <div style="float:left; padding-top: 5px;">&nbsp
                                        <?php
                                        echo "<img class='img-circle profile-img' height=40 width=40 src='images/".$_SESSION['pic']."'>";
                                        ?>
                                    </div>
                                    <div style="float:left;" class="chatbox">
                                        <?php echo $row['message']; ?>
                                    </div>
                                </div><br>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div style="height:50px; padding-top:10px;">
                        <form action="" method="post">
                            <input type="text" name="message" class="form-control" required="" placeholder="Write message...">&nbsp&nbsp
                            <button class="btn btn-info btn-lg" type="submit" name="submit1"><span class="glyphicon glyphicon-send"></span>&nbsp Send</button>
                        </form>
                    </div>
                <?php
                    if (isset($_POST['submit1']) && !empty($_POST['message'])) {
                        $message = mysqli_real_escape_string($db, $_POST['message']);
                        mysqli_query($db, "INSERT INTO message (email, message, status, sender) VALUES ('$_SESSION[email]', '$message', 'no', 'admin')");
                        echo "<meta http-equiv='refresh' content='0'>"; // Refresh the page to show the new message
                    }
                } else {
                    echo "<h3 style='text-align:center; color:gray;'>Select a user to start a conversation</h3>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- JavaScript for Row Selection -->
    <script>
        var table = document.getElementById('table');
        for (var i = 0; i < table.rows.length; i++) {
            table.rows[i].onclick = function () {
                document.getElementById("uname").value = this.cells[1].innerHTML.trim();
            }
        }
    </script>
</body>
</html>