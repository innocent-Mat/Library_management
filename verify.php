<?php
include "navbar.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>verify email address</title>
        <style>
            .box1
            {
                width: 500px;
                height: 350px;
                margin: 0px auto;
                background-color:black;
                color:white;
                padding-top:20px;
            }
        </style>
    </head>
    <body style="background-color:#00695c">
        <div class="box1">
            <h2>Enter the OTP:-</h2>
            <form method="post">
                <input style="width: 300px ; height:50px ; " type="text" name="otp" class="form-control" required="" placeholder="Enter the OTP here..."><br>
                    <button class="btn btn-default" type="submit" name="submit_v" style="font-weight:700;">verify</button>
            </form>

        </div>
        <?php
        $ver1=0;
            if(isset($_POST['submit_v']))
            {
                $ver2=mysqli_query($db,"SELECT * FROM `verify`;");
                while ($row=mysqli_fetch_assoc($ver2)) 
                {
                    if ($_POST['otp']==$row['otp'])
                    {
                        mysqli_query($db,"UPDATE student SET status='1' where username='$row[username]';");
                        $ver1=$ver1+1;
                    }
                }
                if($ver1==1)
                {
                    header("location:log_out.php");                    
                }
                else
                {
                    ?>
                    <script type="text/javascript">
                        alert("wrong OTP given. Try again.");
                    </script>
                    <?php 
                }
            }
        ?>
    </body>
</html>