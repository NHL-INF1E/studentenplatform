<?php
session_start();
?>
<!DOCTYPE html>

<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="../css/styles.css" rel=stylesheet>
    <link href="../css/headerfooter.css" rel=stylesheet>
    <link href="../css/login.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css"></head>

<body>
    <!-- header base -->
    <div id="headerbase" class="container-fluid mb-5">
        <div class="row">
            <!-- Header logo -->
            <div class="col-md-3 align-self-center">
                <a href="../index.php">
                    <img src="../pictures/NHL_Stenden_Eropuit_Logo.png" alt="NHL Stenden Eropuit" id="logoheader">
                </a>    
            </div>
            <!-- Login username placeholder -->
            <div class="col-md-5 align-self-center">
                <?php
                if (isset($_SESSION['name'])) {
                    echo '<p id="usernameheader">Welkom, <span class="blue text-capitalize">' . $_SESSION['name'] . '</span></p>';
                }
                ?>
            </div>
            <!-- Buttons to other pages -->
            <div class="col-md-4" id="buttoncontainerheader">
                <a href=../index.php class="headerbutton">Activiteiten</a>
                <?php
                if (isset($_SESSION['name'])) {
                    echo '<a href="../utilities/logout.php" class="headerbutton">Uitloggen</a>';
                } else {
                    echo '<a href="login.php" class="headerbutton active">Inloggen</a>';
                }
                
                if (isset($_SESSION['name']) && $_SESSION['role'] == 'admin') {
                    echo '<a href="adminPanel.php" class="headerbutton">Admin paneel</a>';
                }
                ?>
                <a href="contact.php" class="headerbutton">Contact</a>
                <!-- Language switch button here -->
                <a href="login_EN.php">
                    <img src="../pictures/flags/UK_flag.jpg" id="langflag">
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
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Checks if everything is filled in (correctly).
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
            $emailErr = "Vul een e-mailadres in.";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Het e-mailadres klopt niet.";
            }
        }
    }

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["pass"])) {
                $passErr = "Vul een wachtwoord in.";
            } else {
                $pass = test_input($_POST["pass"]);    
            }
        }

        if(isset($_POST["login"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !empty($_POST["pass"])) {
            
            //Makes a string of the JSON file.
            $allUsers = file_get_contents("../datastores/users.json");

        //Makes a string of the JSON file.
        $allUsers = file_get_contents("../datastores/users.json");

        //Json_decode transfers the json format(string from file_get_contents) to an array.
        $json = json_decode($allUsers);

        //Runs through the array, checks if the defined values are equal to one of the users in the database.
        foreach ($json->people as $user) {
            if ($user->email == htmlspecialchars($_POST["email"]) && password_verify(htmlspecialchars($_POST["pass"]), $user->password)) {
                //Here we put values in the session, for this we first have to use session_start().
                //echo $user->name . '<br>';
                //echo $user->email . '<br>';
                //echo $user->password . '<br>';
                //echo $user->role . '<br>';

                //Here we put the values of the user in the session.
                $_SESSION['name'] = $user->name;
                $_SESSION['email'] = $user->email;
                $_SESSION['role'] = $user->role;

                //This piece of javascript adds a delay after logging in so that it's not too abrupt.
                echo '<h1 id="redirect">U wordt ingelogd...</h1>';
                echo '<script src="script.js"></script>';
            }
        }
    }
    ?>

    <!-- The HTML form where site visitors enter their e-mail and password-->
    <div id="container">
        <div class="row">
            <div class="col-md-4">
                <!-- -->
            </div>
            <div class="col-md-4 rand">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <p id="title">Login</p>
                    <p><span class="error">* verplicht veld</span></p>

                    <p class="paragraph">E-mailadres <span class="text-danger">*</span></p>
                    <input type="text" class="inputBox" name="email" placeholder="E-mailadres">
                    <p><span class="error"><?php echo $emailErr;?></span></p>

                    <p class="paragraph">Wachtwoord <span class="text-danger">*</span></p>
                    <input type="password" class="inputBox" name="pass" placeholder="Wachtwoord">
                    <p><span class="error"><?php echo $passErr;?></span></p>

                    <p><input type="submit" id="login" name="login" value="Inloggen"></p>
                </form>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>

    <!-- Footer basis -->
    <div id="footerbase" class="container-fluid mt-5">
        <!-- Text in footer -->
        <div class="col-md-3">
            <p id="footertext">© NHL Stenden 2021</p>
        </div>
        <!-- The rest of the columns -->
        <div class="col-md-9">
        </div>
    </div>
</body>

</html>