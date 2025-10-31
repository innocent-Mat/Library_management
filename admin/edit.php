<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html>
    <head><title>Edit profile</title>
        <style>
            .wrapper
            {
                padding: 16px;
                margin: 120px auto;
            }
            .form-control
            {
                width: 250px;
                height: 30px;
            }
            label
            {
                color:white;
            }
            .btn-default {
                background-color:green;
                color:white;
                text-align:center;
                width: 90px;
                
            }
            .btn-default:hover {
                background-color:white;
                color:green;
            }
        </style>
</head>
    <body style="background: black">
        <div class="wrapper">
            <h2 class="text-align: center; color:white">Edit information</h2>
            <?php
                $sql ="SELECT * FROM `admin` WHERE email='$_SESSION[login_user]'";
                $result = mysqli_query($db,$sql) or die (mysql_error()); 
                
                while($row = mysqli_fetch_assoc($result))
                {
                    $username=$row['username'];
                    $email=$row['email'];
                    $password=$row['password'];

                }
            ?>
            <div class="profile_info" style="text-align: center">
                <span style="color:white;">welcome</span>
                <h4 style="color:white;"><?php echo $_SESSION['login_user'];?></h4>
            </div><br>
            <form method="post" action="" enctype="multipart/form-data">
                <input class="form-control" type="file" name="file" value="">
                <label><h4><b>Username:</b></h4></label>
                <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
                <label><h4><b>Email:</b></h4></label>
                <input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
                <label><h4><b>Password: </b></h4></label>
                <input class="form-control"  type="text" name="password" value="<?php echo $password; ?>"><br>
                <div style="padding-left:100px;"><button class="btn btn-default" type="submit" name="submit">Save</button>
                </div>

            </form>
        </div>
        <?php
            if(isset($_POST['submit']))
            {
                move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);

                $username=$_POST['username'];
                $email=$_POST['email'];
                $password=$_POST['password'];
                $pic=$_FILES['file']['name'];

                $sql1= "UPDATE `admin` SET pic='$pic',username='$username', email='$email', `password`='$password' WHERE email='".$_SESSION['login_user']."';";

                if(mysqli_query($db,$sql1))
                {
                    ?>
                    <script type="text/javascript">
                        alert("saved successfully");
                        window.location="profile.php";
                    </script>
                    <?php
                }
            }
        ?>
    </body>
</html>