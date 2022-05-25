<?php

    session_start();

    $activeuser = $_SESSION['username'];

    include "../../db/index.php";

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["psw"];
    $cpassword = $_POST["cpsw"];
    
    $password = hash('sha3-512' , $password);
    $cpassword = hash('sha3-512' , $cpassword);

    if ($username && $email && $password && $cpassword) {

        if ($password === $cpassword) {

            $database = new Database();

            // Check if username or email already exist in the database

            $userexists = 0;
            $emailexists = 0;

            $checkuser = $database->selectQuery("SELECT * FROM Users;");

            foreach($checkuser as $user) {
                if ($user['Username'] == $username) {
                    $userexists++;
                }
            }

            foreach($checkuser as $user) {
                if ($user['Email'] == $email) {
                    $emailexists++;
                }
            }

            if ($userexists == 1 && $emailexists == 1) {
                echo "<div class='error-message'>";
                    echo "Username and email address both already in use!";
                    echo "<br>";
                    echo "<a class='link-message' href='../../signup.html'>Go Back</a>";
                echo "</div>";
            }

            else if ($userexists == 1 && $emailexists == 0) {
                echo "<div class='error-message'>";
                    echo "Username already in use!";
                    echo "<br>";
                    echo "<a class='link-message' href='../../signup.html'>Go Back</a>";
                echo "</div>";
            }

            else if ($userexists == 0 && $emailexists == 1) {
                echo "<div class='error-message'>";
                    echo "Email address already in use!";
                    echo "<br>";
                    echo "<a class='link-message' href='../../signup.html'>Go Back</a>";
                echo "</div>";
            }

            else if ($userexists == 0 && $emailexists == 0) {

                // Add new user

                $_SESSION['username'] = $username;
                $activeuser = $_SESSION['username'];

                $newuser = $database->insertQuery("INSERT INTO Users (Username, Email, Pswrd) VALUES ('$username', '$email', '$password');");
                
                include "../components/navbar.php";

                echo "<div class='approved-message'>";
                    echo "<a class='link-message' href='../../calendar.php'>Go to Calendar</a>";
                echo "</div>";

            } 

        }

        else {

            echo "<div class='error-message'>";
                echo "Passwords entered are not matching!";
                echo "<br>";
                echo "<a class='link-message' href='../../signup.html'>Go Back</a>";
            echo "</div>";

        }

    }

    else {

        echo "<div class='error-message'>";
            echo "You have to fill up all the fields!";
            echo "<br>";
            echo "<a class='link-message' href='../../signup.html'>Go Back</a>";
        echo "</div>";

    }



?>