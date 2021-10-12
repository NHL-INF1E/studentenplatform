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
        //Defines variables and sets them to empty values.
            $email = $pass = $emailErr = $passErr = "";

        //Checks if there's dodgy input.
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

        //Checks if everything is filled in (correctly).
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                if(empty($_POST["email"])) {
                    $emailErr = "Vul een e-mailadres in.";
                } else {
                    $email = test_input($_POST["email"]);
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Het e-mailadres klopt niet.";
                    }
                }
            }

            if(empty($_POST["pass"])) {
                $passErr = "Vul een wachtwoord in.";
            } else {
                $pass = test_input($_POST["pass"]);    
                //Optionally there could be extra strict password validation here.
            }
        ?>

        <!-- The HTML form where site visitors enter their e-mail and password-->
        <div id="container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <p id="title">Login</p>
                <p><span class="error">* verplicht veld</span></p>

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