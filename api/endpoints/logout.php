<?php

    session_start();

    session_destroy();

    echo "<div class='logout-message'>";
        echo "You are succesfully logged out!";
        echo "<br>";
        echo "<a class='link-message' href='../../index.html'>Go Back</a>";
    echo "</div>";
