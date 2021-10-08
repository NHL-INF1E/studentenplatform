<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="../css/login.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    </head>

    <body>

        <?php

            $emailErr = "";
            $email = "";
            $pass = "";
            $passErr = "";

            if (isset($_POST["login"])) {
                if(empty($_POST["email"])) {
                    $emailErr = "E-mailadres is verplicht";
                } else {
                    $email = htmlspecialchars($_POST["email"]);
                }

                function validateEmail($email) {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Het e-mailadres is niet correct ingevoerd.";
                    } else {
                        $email = htmlspecialchars($_POST["email"]);
                    }
                    validateEmail('peter.piper@iana.org');
                    validateEmail('first.last@example.123');
                }

               if(empty($_POST["pass"])) {
                 $passErr = "Wachtwoord is verplicht";
                } else {
                  $pass = htmlspecialchars($_POST["pass"]);
                }
            }
        ?>

        <div id="container"> <!-- Divje waar het inlogformulier in staat -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <p id="title">Login</p>

                <p id="emailaddress">E-mailadres</p> 
                <input type="text" id="email" name="email">
                <span class="error">* <?php echo $emailErr;?></span>

                <p id="password">Wachtwoord</p>
                <input type="text" id="pass" name="pass">
                <span class="error">* <?php echo $passErr;?></span>

                <p><input type="submit" id="login" name ="login" value="Inloggen"></p>
            </form>
        </div>

    </body>
</html>