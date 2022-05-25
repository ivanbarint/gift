<<<<<<< HEAD
<?php

    $email = $_POST["email"];
    $cemail = $_POST["cemail"];

    if ($email && $cemail) {

        if ($email == $cemail) {

            echo "<a href='../../resetpass.html'>Go to reset page!</a>";

            $to = $email;
            $subject = "Reset your password";
            $txt = "http://igiftu.be/resetpass.html";

            mail($to,$subject,$txt);
               
        }

        else {
            echo "Your mails are not the same";
            echo "<br>";
            echo "<a href='../../mailforreset.html'>Go back!</a>";
        }

    }

    else if ($email == "") {
        echo "Email field is empty!";
        echo "<br>";
        echo "<a href='../../mailforreset.html'>Go back!</a>";
    }

    else if ($cemail == "") {
        echo "Confirm email field is empty!";
        echo "<br>";
        echo "<a href='../../mailforreset.html'>Go back!</a>";
    }
=======
<?php

    $email = $_POST["email"];
    $cemail = $_POST["cemail"];

    if ($email && $cemail) {

        if ($email == $cemail) {

            echo "<a href='../../resetpass.html'>Go to reset page!</a>";

            $to = $email;
            $subject = "Reset your password";
            $txt = "http://igiftu.be/resetpass.html";

            mail($to,$subject,$txt);
               
        }

        else {
            echo "Your mails are not the same";
            echo "<br>";
            echo "<a href='../../mailforreset.html'>Go back!</a>";
        }

    }

    else if ($email == "") {
        echo "<div class='error-message'>";
        echo "Email field is empty!";
        echo "</div>";
        echo "<br>";
        echo "<a href='../../mailforreset.html'>Go back!</a>";
    }

    else if ($cemail == "") {
        echo "<div class='error-message'>";
        echo "Confirm email field is empty!";
        echo "</div>";
        echo "<br>";
        echo "<a href='../../mailforreset.html'>Go back!</a>";
    }
>>>>>>> 29d205325eb3b454a0d5724fe3b74c44152bcc5c
