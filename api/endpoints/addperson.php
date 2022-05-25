<?php

    session_start();

    include "../components/navbar.php";

    include "../../db/index.php";

    $username = $_SESSION['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    if ($firstname && $firstname && $lastname && $age && $gender) {

        $database = new Database();

        $fullname = $firstname . " " . $lastname;

        // Finding users ID

        $checkuser = $database->selectQuery("SELECT * FROM Users WHERE Username = '$username';");

        $userid = $checkuser[0]['UserID'];

        // Checking if the person already exists with the same user

        $checkpeople = $database->selectQuery("SELECT PersonName FROM Persons WHERE UserID = '$userid';");

        $samename = 0;

        foreach($checkpeople as $person) {
            if ($person['PersonName'] == $fullname) {
                $samename++;
            }
        }

        if ($samename == 0) {
            
            // Getting the gender code

            $gendercode = 0;

            if ($gender == "Male") {
                $gendercode = 1;
            }
            else if ($gender == "Female") {
                $gendercode = 2;
            }
            else if ($gender == "Other") {
                $gendercode = 3;
            }

            $addperson = $database->insertQuery("INSERT INTO Persons(UserID, PersonName, GenderId, Age) VALUES ('$userid', '$fullname', '$gendercode', '$age');");
        
            echo "<div class='approved-message'>"; 
                echo "You added " . $firstname . " to your people list!";
            echo "</div>"; 


            echo "<br>";
            echo "<a href='../../add.php'>Add something else</a>";
            echo "<br>";
            echo "<a href='../../add.php'>Add Event</a>";

        }
        
        else if ($samename > 0) {
            echo "<div class='error-message'>";
                echo "This person is already on your list!";
                echo "<br>";
                echo "<a class='link-message' href='../../add.php'>Go Back</a>";
            echo "</div>";
        }

    }

    else {
        echo "<div class='error-message'>";
            echo "You are missing some information!";
            echo "<br>";
            echo "<a class='link-message' href='../../add.php'>Go Back</a>";
        echo "</div>";
    }

?>