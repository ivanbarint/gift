<?php

session_start();

$active_user = $_SESSION['username'];

$username = $_SESSION['username'];

include "db/index.php";

$database = new Database();

// Find user that is logged in

$checkuserid = $database->selectQuery("SELECT UserID FROM Users WHERE Username = '$username';");

$userid = $checkuserid[0]['UserID'];

// Find all the people from the user logged in

$peoplelist = $database->selectQuery("SELECT PersonID FROM Persons WHERE UserID = '$userid';");

$peoplearray = [];
$eventarray = [];

foreach($peoplelist as $person) {
    $personid = $person['PersonID'];
    $eventlist = $database->selectQuery("SELECT EventDate FROM Events WHERE PersonID = '$personid';");
    foreach($eventlist as $event) {
        $eventarray[] = $event['EventDate'];
    }
}

// Setting timezone

date_default_timezone_set('Europe/Zagreb');

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');  // the first day of the month
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Today (Format:2018-08-8)
$today = date('Y-m-j');

// Title (Format:August, 2018)
$title = date('F, Y', $timestamp);

// Create prev & next month link
$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);

// 1:Mon 2:Tue 3: Wed ... 7:Sun
$str = date('N', $timestamp);

// Array for calendar
$weeks = [];
$week = '';

// Add empty cell(s)
$week .= str_repeat('<td></td>', $str - 1);

for ($day = 1; $day <= $day_count; $day++, $str++) {

        if ($day < 10) {
            $date = $ym . '-0' . $day;
        }
        else {
            $date = $ym . '-' . $day;
        }
    
        if ($date == $today) {
            $week .= '<td class="today">' . $day . ' Today </td>';
        } 
        else if (in_array($date, $eventarray)) {
            
            $_SESSION['date'] = $date;
            $date = $_SESSION['date'];

            $person = $database->selectQuery("SELECT PersonName FROM Persons WHERE PersonID IN (SELECT PersonID FROM Events WHERE EventDate = '$date');");
            $eventtype = $database->selectQuery("SELECT EventTypeName FROM EventTypes WHERE EventTypeID IN (SELECT EventTypeID FROM Events WHERE EventDate = '$date');");

            $personname = $person[0]['PersonName'];

            $eventname = $eventtype[0]['EventTypeName'];

            $_SESSION['personname'] = $personname;
            $_SESSION['eventtype'] = $eventname;

            
            $week .= '<td>' . $day . ' <form method="POST" class="calendar-item" action="api/endpoints/pickgift.php">' . $personname . "'s " . $eventname . '<input class="form-button" type="submit" value="Gift"></form></td>'; 

        }
        else {
            $week .= '<td>' . $day . '</td>';
        }

    // Sunday OR last day of the month
    if ($str % 7 == 0 || $day == $day_count) {

        // last day of the month
        if ($day == $day_count && $str % 7 != 0) {
            // Add empty cell(s)
            $week .= str_repeat('<td></td>', 7 - $str % 7);
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        $week = '';
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="assets/style/style.css" rel="stylesheet">

</head>
<body>

    <?php

        include "api/components/navbar.php";

    ?>

    <div class='container calendar'>

        <ul class='list-inline'>
            <li class='list-inline-item'><a href='?ym=<?= $prev; ?>' .class='btn btn-link'>&lt; prev</a></li>
            <li class='list-inline-item'><p class="title-month"><?= $title;?></p></li>
            <li class='list-inline-item'><a href='?ym=<?= $next; ?>' .class='btn btn-link'>next &gt;</a></li>
        </ul>
        <p>
            <a href="calendar.php">Actual Month</a>
        </p>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>MON</th>
                    <th>TUE</th>
                    <th>WED</th>
                    <th>THU</th>
                    <th>FRI</th>
                    <th>SAT</th>
                    <th>SUN</th>
                </tr>
            </thead>
            <tbody>
            
            <?php

                foreach($weeks as $week) {
                    echo $week;
                }
            
            ?>

            </tbody>

        </table>

    </div>

    <div>

        <a href='add.php'>Add people or events</a>

    </div>

</body>
</html>