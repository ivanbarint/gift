<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" href="../../assets/style/style.css">

</head>
<body>

    <div class='navbar'>

        <?php

            session_start();

            $active_user = $_SESSION['username'];

            if(isset($active_user)) {

                echo "<div class='nav'>";
                echo "<div class='navbar-option welcome-message'>";
                    echo "Hi, " . $active_user;
                echo "</div>";

                echo "<img class='navbar-option' src='../../assets/images/logo.png' alt='logo'>";

                echo "<div class='navbar-option logout-button'>";
                    echo "<a href='../endpoints/logout.php'>Logout</a>";
                echo "<div>";
                echo "</div>";
            }         

            else {

                echo "<div class='error-message'>";
                echo "You are not logged in!";
                echo "<br>";
                echo "<a class='link-message' href='../../index.html'>Login</a>";
                echo "</div>";

            }

        ?>

    </div>
    
</body>
</html>