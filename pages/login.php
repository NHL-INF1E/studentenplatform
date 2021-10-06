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
    
        <div id="container"> <!-- Divje waar het inlogformulier in staat -->
            <form method="post" action="../index.php">
                <p id="title">Login</p>

                <p id="emailaddress">E-mailadres</p> 
                <input type="text" id="email" name="email">

                <p id="password">Wachtwoord</p>
                <input type="text" id="pass" name="pass">

                <p><input type="submit" id="login" name ="login" value="Inloggen"></p>
            </form>
        </div>

        <?php

        ?>

    </body>
</html>