<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="assets/style/style.css">

</head>
<body>

    <?php

        session_start();

        $active_user = $_SESSION['username'];

<<<<<<< HEAD
        include "api/components/navbar.php";

=======
        if(isset($active_user)) {

            echo "<div class='welcome-message'>";
            echo "Hi, " . $active_user;
            echo "</div>";
            echo "<div class='logout-button'>";
            echo "<a href='api/endpoints/logout.php'>Logout</a>";
            echo "<div>";
            }         

            else {

            echo "<div class='error-message'>";
            echo "You are not logged in!";
            echo "<br>";
            echo "<a class='link-message' href='../../index.html'>Login</a>";
            echo "</div>";

            }
        include "db/index.php";
        $database = new Database();

        $sql = "SELECT * FROM eventtypes;";
        $events = $database->selectQuery($sql);
        
        $sql = "SELECT * FROM genders;";
        $genders = $database->selectQuery($sql);
>>>>>>> 29d205325eb3b454a0d5724fe3b74c44152bcc5c
    ?>

    <h1>Add Something to the Calendar</h1>

    <button class='form-button' id="add-person">Add Person</button>

    <div id="person-modal">

        <button class='form-button' id="close-person">x</button>

        <p>Add Person</p>

        <form method="POST" action="api/endpoints/addperson.php">

            <div class='form-part'>
<<<<<<< HEAD
                <label class='form-label' for="firstname">First Name</label>
                <input class='form-input' type="text" name="firstname" id="firstname">
            </div>

            <div class='form-part'>
                <label class='form-label' for="lastname">Last Name</label>
                <input class='form-input' type="text" name="lastname" id="lastname">
            </div>

            <div class='form-part'>
                <label class='form-label' for="age">Age</label>
                <input class='form-input' type="number" id="age" name="age">
            </div>

            <div class='form-part'>
                <label class='form-label' for="gender">Gender</label>
                <select class='form-input' name="gender" id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
=======
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" id="firstname" placeholder="ex: James">
            </div>

            <div class='form-part'>
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" id="lastname" placeholder="ex: Bond">
            </div>

            <div class='form-part'>
                <label for="age">Age</label>
                <input type="number" id="age" name="age" placeholder="ex: 18">
            </div>

            <div class='form-part'>
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <?php
                        foreach($genders as $gender){
                            echo "<option value=".$gender['GenderName'].">".$gender['GenderName']."</option>";
                        }
                    ?>
>>>>>>> 29d205325eb3b454a0d5724fe3b74c44152bcc5c
                </select>
            </div>

            <div class='form-part'>
                <input class='form-button' type="submit" value="Add Person">
            </div>

        </form>

    </div>

    <button class='form-button' id="add-event">Add Event</button>

    <div id="event-modal">

        <button class='form-button' id="close-event">x</button>

        <p>Add Event</p>

        <form method="POST" action="api/endpoints/addevent.php">

            <div class='form-part'>
<<<<<<< HEAD
                <label class='form-label' for="person">Person</label>
                <input class='form-input' type="text" name="person" id="person">
            </div>

            <div class='form-part'>
                <label class='form-label' for="eventtype">Event Type</label>
                <select class='form-input' name="eventtype" id="eventtype">
                    <option value="birthday">Birthday</option>
                    <option value="wedding">Wedding</option>
                    <option value="anniversery">Anniversery</option>
                    <option value="engagement">Engagement</option>
                    <option value="baby">Baby</option>
                    <option value="private">Private</option>
                    <option value="other">Other</option>
=======
                <label for="person">Fullname</label>
                <input type="text" name="person" id="person" placeholder="James Bond">
            </div>

            <div class='form-part'>
                <label for="eventtype">Event Type</label>
                <select name="eventtype" id="eventtype">
                <?php
                    foreach($events as $event) {
                        echo "<option value=".$event["EventTypeName"].">".$event["EventTypeName"]."</option>";
                    }
                ?>
>>>>>>> 29d205325eb3b454a0d5724fe3b74c44152bcc5c
                </select>
            </div>

            <div class='form-part'>
                <label class='form-label' for="eventdate">Date</label>
                <input class='form-input' type="date" name="eventdate" id="eventdate">
            </div>

            <div class='form-part'>
                <input class='form-button' type="submit" value="Add Event">
            </div>

        </form>

    </div>

    <p><a href="calendar.php">Check Calendar!</a></p>

    <script src="assets/script/script.js"></script>
    
</body>
</html>