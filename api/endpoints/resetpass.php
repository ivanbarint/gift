<<<<<<< HEAD
<?php

    include "../db/index.php";

    $email = $_POST["email"];
    $newpassword = $_POST["newpsw"];
    $cpassword = $_POST["cpsw"];

    if ($email && $newpassword && $cpassword) {

        if ($newpassword == $cpassword) {
            
            $database = new Database();

            $updatepass = $database->insertQuery("UPDATE Users SET Pswrd = '$newpassword' WHERE Email = '$email';");

            echo "Password updated";
            echo "<br>";
            echo "<a href='../../index.html'>Go to login page!</a>";

        }

        else {
            echo "Your passwords are not matching";
            echo "<br>";
            echo "<a href='../../resetpass.html'>Go back!</a>";
        }
       
    }
    else if ($email == "") {
        echo "Email field is empty!";
        echo "<br>";
        echo "<a href='../../resetpass.html'>Go back!</a>";
    }

    else if ($newpassword == "") {
        echo "Password field is empty!";
        echo "<br>";
        echo "<a href='../../resetpass.html'>Go back!</a>";
    }

    else if ($cpassword == "") {
        echo "You have to confirm your password!";
        echo "<br>";
        echo "<a href='../../resetpass.html'>Go back!</a>";
    }
=======
<?php
    
    $sql = "SELECT * FROM Users;";
    session_start();
    include "../../db/index.php";

    $email = $_POST["email"];
    $password = $_POST["psw"];
    $cpassword = $_POST["cpsw"];
    $password = hash('sha3-512' , $password);
    $cpassword = hash('sha3-512' , $cpassword);
    $userinfo = array();

    if ($email && $password && $cpassword) {
        
        if ($password === $cpassword) {

            $database = new Database();

            // Check if email already exist in the database
            $emailexists = 0;

            $checkuser = $database->selectQuery("SELECT * FROM Users;");

            foreach($checkuser as $user) {
                if ($user['Email'] == $email) {
                    $emailexists++;
                    $userinfo = array(
                        'username' => $user['Username'],
                        'email' => $user['Email'],
                        'password' => $user['Pswrd']
                    );
                }
            }
            
            if ( $emailexists == 0) {
                // email doesn't exist
                echo "<div class='error-message'>";
                    echo "Please signup! <br> Email address isn't in use!";
                    echo "<br>";
                    echo "<a class='link-message' href='../../signup.html'>Go Back</a>";
                echo "</div>";
            }
            else if ($emailexists > 1){
                // email exists more than once
                echo "<div class='error-message'>";
                    echo "We are sorry something went wrong";
                    echo "<br>";
                    echo "<a class='link-message' href='../../signup.html'>Go Back</a>";
                echo "</div>";
            }
            else if ($emailexists == 1) {
                if ($userinfo['password'] === $password){
                    // password is same as previous password
                    echo "<div class='error-message'>";
                    echo "The password cannot be the same as the last one.";
                    echo "<br>";
                    echo "<a class='link-message' href='../../index.html'>Go Back</a>";
                    echo "</div>";
                }
                else{
                    // Change password
                    $username = $userinfo['username'];
                    $_SESSION['username'] = $username;
                    $sql = "CALL Reset_Password('$username', '$password');";
                    $database->insertQuery($sql);
                    
                    include "../components/navbar.php";
                    echo "<div class='password-updated'>";
                        echo "Password updated";
                        echo "<br>";
                        echo "<a href='../../index.html'>Go to login page!</a>";
                    echo "</div>";
                }

            } 

        }

        else {

            echo "<div class='error-message'>";
                echo "Passwords entered are not matching!";
                echo "<br>";
                echo "<a class='link-message' href='../../resetpass.html'>Go Back</a>";
            echo "</div>";

        }

    }

    else if ($email == "") {
        echo "<div class='error-message'>";
        echo "Email field is empty!";
        echo "<br>";
        echo "<a href='../../resetpass.html'>Go back!</a>";
        echo "</div>";
    }

    else if ($newpassword == "") {
        echo "<div class='error-message'>";
        echo "Password field is empty!";
        echo "<br>";
        echo "<a href='../../resetpass.html'>Go back!</a>";
        echo "</div>";
    }

    else if ($cpassword == "") {
        echo "<div class='error-message'>";
        echo "You have to confirm your password!";
        echo "<br>";
        echo "<a href='../../resetpass.html'>Go back!</a>";
        echo "</div>";
    } 
?>
>>>>>>> 29d205325eb3b454a0d5724fe3b74c44152bcc5c
