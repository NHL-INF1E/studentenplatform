<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="../css/styles.css" rel=stylesheet>
    <link href="../css/headerfooter.css" rel=stylesheet>
    <link href="../css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <!-- header base -->
    <div id="headerbase" class="container-fluid mb-5">
        <div class="row">
            <!-- Header logo -->
            <div class="col-md-3 align-self-center">
                <img src="../pictures/NHL_Stenden_Eropuit_Logo.png" alt="NHL Stenden Eropuit" id="logoheader">
            </div>
            <!-- Login Gebruikersnaam -->
            <div class="col-md-5 align-self-center">
                <?php
                if (isset($_SESSION['name'])) {
                    echo '<p id="usernameheader">Welcome, <span class="blue text-capitalize">' . $_SESSION['name'] . '</span></p>';
                }
                ?>
            </div>
            <!-- Knoppen naar andere pagina's -->
            <div class="col-md-4" id="buttoncontainerheader">
                <a href=../index_EN.php class="headerbutton">Activities</a>
                <a href=login_EN.php class="headerbutton active">Sign in</a>
                <a href=contact_EN.php class="headerbutton">Contact</a>
                <!-- Taal wissel knop hier -->
                <a href="login.php">
                    <img src="../pictures/flags/NL_flag.jpg" id="langflag">
                </a>
            </div>
        </div>
    </div>

    <?php
        //Defines variables and sets them to empty values.
        $email = "";
        $pass = "";
        $emailErr = "";
        $passErr = "";

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
                $emailErr = "Enter a email address here.";
            } else {
                $email = test_input($_POST["email"]);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "The Email address is incorrect.";
                }
            }
        }

        if(empty($_POST["pass"])) {
            $passErr = "Enter a password here.";
        } else {
            $pass = test_input($_POST["pass"]);    
            //Optionally there could be extra strict password validation here.
        }
        if(isset($_POST["login"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !empty($_POST["pass"])) {
            
            //Dit zorgt ervoor dat er een string wordt gemaakt van het JSON bestand
            $allUsers = file_get_contents("../datastores/users.json");

            //Json_decode zet het json formaat(string vanuit file_get_contents) om in een array.
            $json = json_decode($allUsers);

            //Hier loopt hij door de array heen, checkt of de ingevulde waardes gelijk zijn aan een van de gebruikers in de datastore
            foreach ($json->people as $user) {
                if ($user->email == htmlspecialchars($_POST["email"]) && password_verify(htmlspecialchars($_POST["pass"]), $user->password) ) {
                    //Hier zetten we nu de waardes in de sessie, hievoor moeten we eerst session_start() aanroepen
                    //echo $user->name . '<br>';
                    //echo $user->email . '<br>';
                    //echo $user->password . '<br>';
                    //echo $user->role . '<br>';

                    //Hier zetten we de waardes van de gebruiker in de sessie
                    $_SESSION['name'] = $user->name;
                    $_SESSION['email'] = $user->email;
                    $_SESSION['role'] = $user->role;

                    echo '<h1 id="redirect">You are being logged in...</h1>';
                    echo '<script src="script.js"></script>';
                }
            }
        }
        ?>

    <!-- The HTML form where site visitors enter their e-mail and password-->
    <div id="container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <p id="title">Login</p>
            <p><span class="error">* Required field</span></p>

            <p class="paragraph">Email address</p>
            <input type="text" class="inputBox" name="email">
            <span class="error">* <?php echo $emailErr;?></span>

            <p class="paragraph">Password</p>
            <input type="password" class="inputBox" name="pass">
            <span class="error">* <?php echo $passErr;?></span>

            <p><input type="submit" id="login" name="login" value="Sign in"></p>
        </form>
    </div>

    <!-- Footer basis -->
    <div id="footerbase" class="container-fluid mt-5">
        <!-- Text in footer -->
        <div class="col-md-3">
            <p id="footertext">© NHL Stenden 2021</p>
        </div>
        <!-- de rest van de collumns -->
        <div class="col-md-9">
        </div>
    </div>
</body>

</html>