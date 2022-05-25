<?php

    session_start();

    include "../components/navbar.php";

    include "../../db/index.php";

    $username = $_SESSION['username'];
    $personname = $_POST['person'];
    $eventtype = $_POST['eventtype'];
    $eventdate = $_POST['eventdate'];

    if ($personname && $eventtype && $eventdate) {
    
        $database = new Database();

        // Getting event type ID

        $eventcode = 0;

        if ($eventtype == "birthday") {
            $eventcode = 1;
        }
        if ($eventtype == "wedding") {
            $eventcode = 2;
        }
        if ($eventtype == "anniversery") {
            $eventcode = 3;
        }
        if ($eventtype == "engagement") {
            $eventcode = 4;
        }
        if ($eventtype == "baby") {
            $eventcode = 5;
        }
        if ($eventtype == "private") {
            $eventcode = 6;
        }
        if ($eventtype == "other") {
            $eventcode = 7;
        }

        // Check if person is in the database under this user

        $checkuser = $database->selectQuery("SELECT * FROM Users WHERE Username = '$username';");

        $userid = $checkuser[0]['UserID'];

        $checkpeople = $database->selectQuery("SELECT PersonName FROM Persons WHERE UserID = '$userid';");

        $samename = 0;

        foreach($checkpeople as $person) {
            if ($person['PersonName'] == $personname) {
                $samename++;
            }
        }

        if ($samename == 1) {

            // Getting person ID

            $getpersonid = $database->selectQuery("SELECT PersonID FROM Persons WHERE UserID = '$userid' AND PersonName = '$personname';");

            $personid = $getpersonid[0]['PersonID'];

            // Check if the same combination already exists

            $listeventsunderthisperson = $database->selectQuery("SELECT * FROM Events WHERE PersonID = '$personid' AND EventTypeID = '$eventcode';");

            $sameevents = 0;

            foreach($listeventsunderthisperson as $dateofevent) {
                if ($dateofevent['EventDate'] == $eventdate) {
                    $sameevents++;
                }
            }

            if ($sameevents == 0) {

                $addevent = $database->insertQuery("INSERT INTO Events (EventTypeID, EventDate, PersonID) VALUES ('$eventcode', '$eventdate', '$personid');");

                // Getting persons firstname for the message

                $dividednames = explode(" ", $personname);
                $firstname = $dividednames[0];

                echo "<div class='approved-message'>"; 
                    echo $username . ", you added " . $firstname . "'s ". $eventtype . " on your calendar!"; 
                echo "</div>"; 


                echo "<br>";
                echo "<a href='../../add.php'>Add something else</a>";

                echo "<p><a href='../../calendar.php'>Check Calendar!</a></p>";

            }

            else {
                echo "<div class='error-message'>";
                    echo "You already have the same event on your calendar!";
                    echo "<br>";
                    echo "<a class='link-message' href='../../add.php'>Go Back</a>";
                echo "</div>";
            }
            
        }

        else {
            echo "<div class='error-message'>";
                echo "This person does not exist on your list!";
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