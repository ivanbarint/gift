<?php

    session_start();

    include "../../db/index.php";

    $username = $_POST['username'];
    $password = $_POST['psw'];
    $password = hash('sha3-512' , $password);
    
    if ($username && $password) {
        
        $_SESSION['username'] = $username;
        $activeuser = $_SESSION['username'];

        $database = new Database();

        $checkuser = $database->selectQuery("SELECT Pswrd FROM Users WHERE Username = '$username';");

        if ($checkuser[0]['Pswrd'] == $password) {

            include "../components/navbar.php";

            echo "<div class='approved-message'>";
                echo "<a class='link-message' href='../../calendar.php'>Go to Calendar</a>";
            echo "</div>";   

        }

        else {
            echo "<div class='error-message'>";
            echo "You credentials are not matching!";
            echo "<br>";
            echo "<a class='link-message' href='../../index.html'>Go Back</a>";
        echo "</div>";
        }

    }

    else {
        echo "<div class='error-message'>";
            echo "You have to fill up both fields!";
            echo "<br>";
            echo "<a class='link-message' href='../../index.html'>Go Back</a>";
        echo "</div>";
    }




