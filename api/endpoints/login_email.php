<?php

    session_start();

    include "../../db/index.php";
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $password = hash('sha3-512' , $password);
     
    if ($email && $password) {

        $_SESSION['username'] = $username;
        $activeuser = $_SESSION['username'];
        
        $database = new Database();
        
        $sql = "SELECT Pswrd FROM Users WHERE Email = '$email';";
        $checkuser = $database->selectQuery($sql);

        if ($checkuser[0]['Pswrd'] == $password) {

            $sql = "SELECT Username FROM Users WHERE Email = '$email';";
            $_SESSION['username'] = $database->selectQuery($sql);
            $activeuser = $_SESSION['username'];
            include "../components/navbar.php";

            echo "<div class='approved-message'>";
                echo "<a class='link-message' href='../../calendar.php'>Go to Calendar</a>";
            echo "</div>";   

        }

        else {
            echo "<div class='error-message'>";
            echo "You credentials are not matching!";
            echo "<br>";
            echo "<a class='link-message' href='../../login_email.html'>Go Back</a>";
        echo "</div>";
        }

    }

    else {
        echo "<div class='error-message'>";
            echo "You have to fill up both fields!";
            echo "<br>";
            echo "<a class='link-message' href='../../login_email.html'>Go Back</a>";
        echo "</div>";
    }
?>
