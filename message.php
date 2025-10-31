   <?php
      include "connection.php";
      include "navbar.php";
   ?>
   <!DOCTYPE html>
   <html>
       <head>
           <title>Chat</title>
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <style type="text/css">
               .wrapper {
                   height: 600px;
                   width: 500px;
                   background-color: black;
                   color: white;
                   margin: 100px auto;
                   padding: 10px;
                   border-radius:20px;
               }
               .form-control {
                   height: 47px;
                   width: 73%;
               }
               .msg {
                   height: 450px;
                   overflow-y: scroll;
                   background-color:rgb(64, 65, 59);
                   border-radius:15px;
               }
               .btn-info {
                   background-color: green;
                   color:white;
               }
               .btn-info:hover {
                   background-color: black;
                   color:green;
               }
               .chat {
                   display: flex;
                   flex-flow: row wrap;
                   margin-bottom: 10px;
               }
               .user .chatbox {
                   height: 40px;
                   width: 350px;
                   padding: 13px 10px;
                   background-color:rgb(28, 203, 180);
                   color: white;
                   border-radius: 10px;
                   order: -1;
               }
               .admin .chatbox {
                   height: 40px;
                   width: 350px;
                   padding: 13px 10px;
                   background-color: gray;
                   color: white;
                   border-radius: 10px;
               }
           </style>
       </head>
       <body>
           <?php
               // Check if the form is submitted
               if (isset($_POST['submit'])) {
                   $message = mysqli_real_escape_string($db, $_POST['message']);
                   $login_user = $_SESSION['login_user'];

                   // Insert the message into the database
                   mysqli_query($db, "INSERT INTO `message` (email, message, status, sender) VALUES ('$login_user', '$message', 'no', 'student')") or die(mysqli_error($db));
               }

               // Fetch messages from the database
               $login_user = $_SESSION['login_user'];
               $res = mysqli_query($db, "SELECT * FROM message WHERE email='$login_user' ORDER BY id ASC") or die(mysqli_error($db));
               
               // Update the status of admin's messages to 'read'
               mysqli_query($db, "UPDATE `message` SET `status`='yes' WHERE sender='admin' AND email='$login_user'") or die(mysqli_error($db));
           ?>

           <div class="wrapper">
               <div style="height:70px; width:100%; background-color: green; text-align:center; color:white;">
                   <h3 style="margin-top:5px; padding-top:10px">Admin</h3>
               </div>
               <div class="msg"><br>
                   <?php
                       // Display messages from the result set
                       while ($row = mysqli_fetch_assoc($res)) {
                           if ($row['sender'] == 'student') {
                   ?>
                   <!-------------student chat---------------->
                       <div class="chat user">
                           <div style="float:left; padding-top: 5px;">&nbsp
                               <?php
                                   echo "<img class='img-circle profile_img' width='40px' height='40px' src='images/". $_SESSION['pic']. "'>";
                               ?>&nbsp
                           </div>
                           <div style="float:left;" class="chatbox">
                               <?php echo $row['message']; ?>
                           </div>
                       </div><br>
                   <?php
                           } else {
                   ?>
                   <!---------admin chat----------------->
                       <div class="chat admin">
                           <div style="float:left; padding-top: 5px;">&nbsp
                               <img src="p.jpg" style="width:40px; height:40px; border-radius:10px;"> &nbsp
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

               <div style="height:100px; padding-top:10px;">
                   <form action="" method="post">
                       <input type="text" name="message" class="form-control" required="" placeholder="Write message..." style="float:left;">&nbsp&nbsp&nbsp
                       <button class="btn btn-info btn-lg" type="submit" name="submit">
                           <span class="glyphicon glyphicon-send"></span>&nbsp Send
                       </button>
                   </form>
               </div>
           </div>
       </body>
   </html>
   