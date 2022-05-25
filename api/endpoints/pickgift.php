<?php

    session_start();

    include "../components/navbar.php";

    $date = $_SESSION['date'];

    include "../../db/index.php";

    $database = new Database();

    $checkeventid = $database->selectQuery("SELECT EventID FROM Events WHERE EventDate = '$date';");

    $eventid = $checkeventid[0]['EventID'];

    $checkperson = $database->selectQuery("SELECT PersonID FROM Events WHERE EventID = '$eventid';");
    $personid = $checkperson[0]['PersonID'];
    $checkpersonname = $database->selectQuery("SELECT PersonName FROM Persons WHERE PersonID = '$personid';");
    $personname = $checkpersonname[0]['PersonName'];
    echo "<br>";

    echo "You are picking a gift for " . $personname . ".";

    echo "<form method='POST' action='giftlist.php'>";

    echo "<div class='form-part'>";
        echo "<label class='form-label' for='interest'>Interest</label>";
        echo "<br>";
        echo "<input class='form-input' type='text' name='interest' id='interest'>";
    echo "</div>";

    echo "<div class='form-part'>";
        echo "<input class='form-button' type='submit' value='Pick'>";
    echo "</div>";

    echo "<br>";

    echo "</form>";
?>