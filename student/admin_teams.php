<?php
include "connection.php";  // Ensure the database connection is included

// Check database connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all admins from the database
$query = "SELECT * FROM `admin`";  // No LIMIT to fetch all admins
$result = mysqli_query($db, $query);

// Check for query errors
if (!$result) {
    die("Query failed: " . mysqli_error($db));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>
        body {
            position: relative;
            background: #222;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #fff;
            text-align: center;
            text-transform: uppercase;
            font-size: 60px;
            font-weight: 900;
            margin-bottom: 35px;
            padding-top: 35px;
            letter-spacing: 2px;
        }

        .wrapper_v {
            max-width: 1250px;
            margin: 5% auto;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .box {
            width: 320px;
            height: 330px;
            margin: 15px;
            background: #111;
            border-radius: 25px;
            color: #fff;
            padding: 30px 20px;
            text-align: center;
            position: relative;
            list-style: none;
        }

        .img_area {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 7px solid darkorange;
            margin: auto;
        }

        .img_area img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .box:before {
            content: '';
            background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
            position: absolute;
            top: -2px;
            left: -2px;
            background-size: 400%;
            z-index: -1;
            filter: blur(5px);
            width: calc(100% + 4px);
            height: calc(100% + 4px);
            animation: animate 20s linear infinite;
            opacity: 0;
            transition: opacity .3s ease;
        }

        .box:hover:before {
            opacity: 1;
        }

        .box:after {
            z-index: -1;
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: #111;
            left: 0;
            top: 0;
            border-radius: 25px;
        }

        .box h2 {
            text-transform: uppercase;
            margin-top: 15px;
        }

        .box p {
            line-height: 1.5;
            color: #9d9d9d;
        }

        @keyframes animate {
            0% { background-position: 0 0; }
            50% { background-position: 400% 0; }
            100% { background-position: 0 0; }
        }
    </style>
</head>
<body>
    <h1>Our Team</h1>
    <div class="wrapper_v">
        <?php
        // Loop through all fetched admins and display their details
        while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['username'];
            $email = $row['email'];
            $status = $row['status'];
            $pic = $row['pic'];  // Admin's picture
            ?>
            <div class="box">
                <div class="img_area">
                    <img src="images/<?php echo $pic; ?>" alt="Admin Image">
                </div>
                <h2><?php echo $username; ?></h2>
                <p>Email: <?php echo $email; ?></p>
                <p>Status: <?php echo $status == 1 ? 'Active' : 'Inactive'; ?></p>
            </div>
            <?php
        }
        ?>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        // Optional JavaScript functionality
        document.querySelectorAll('.box').forEach((box) => {
            box.addEventListener('click', function() {
                alert('You clicked on: ' + this.querySelector('h2').innerText);
            });
        });
    </script>
</body>
</html>
