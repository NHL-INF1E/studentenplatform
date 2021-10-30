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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    
    <!-- Translation button script -->
    <!-- Code provided by google -->
    <script type="text/javascript">
        function googleTranslateElementInit2() {
            new google.translate.TranslateElement({
                pageLanguage: 'nl',
                autoDisplay: false
            }, 'google_translate_element2');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>

    <!-- Translation button handler -->
    <script type="text/javascript">
        eval(function (p, a, c, k, e, r) {
            e = function (c) {
                return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
            };
            if (!''.replace(/^/, String)) {
                while (c--) r[e(c)] = k[c] || e(c);
                k = [function (e) {
                    return r[e]
                }];
                e = function () {
                    return '\\w+'
                };
                c = 1
            }
            while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
            return p
        }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}', 43, 43, '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'), 0, {}))
    </script>
</head>

<body>
    <!-- header base -->
    <div id="headerbase" class="container-fluid mb-5">
        <div class="row">
            <!-- Header logo -->
            <div class="col-md-3 align-self-center">
                <a href=../index.php>
                    <img src="../pictures/NHL_Stenden_Eropuit_Logo.png" alt="NHL Stenden Eropuit" id="logoheader">
                </a>
            </div>
            <!-- Login gebruikersnaam placeholder -->
            <div class="col-md-4 align-self-center">
                <?php
                if (isset($_SESSION['name'])) {
                    echo '<p id="usernameheader">Welkom, <span class="blue text-capitalize">' . $_SESSION['name'] . '</span></p>';
                }
                ?>
            </div>
            <!-- Knoppen naar andere pagina's -->
            <div class="col-md-5 headerKnoppenContainer">
                <div id="buttoncontainerheader">
                    <a href=../index.php class="headerbutton">Activiteiten</a>
                    <?php
                    if (isset($_SESSION['name'])) {
                        echo '<a href="../utilities/logout.php" class="headerbutton">Uitloggen</a>';
                    } else {
                        echo '<a href="login.php" class="headerbutton active">Inloggen</a>';
                    }

                    if (isset($_SESSION['name']) && $_SESSION['role'] == 'admin') {
                        echo '<a href="adminPanel.php" class="headerbutton">Activiteit Toevoegen</a>';
                    }
                    ?>
                    <a href=contact.php class="headerbutton">Contact</a>

                    <!-- Taal wissel knop hier -->
                    <!-- Language Switch button -->
                    <div id="google_translate_element2" style="display:none">
                    </div>

                    <a href="#" onclick="doGTranslate('nl|en');return false;" title="English">
                        <img src="../pictures/flags/UK_flag.jpg" id="langflag" alt="English"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- header end -->

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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["pass"])) {
            $passErr = "Vul een wachtwoord in.";
        } else {
            $pass = test_input($_POST["pass"]);
        }
    }

    if (isset($_POST["login"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !empty($_POST["pass"])) {

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
                exit;
            } else {
                $passErr = "Verkeerde inloggegevens";
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
                    <input type="text" class="inputBox" name="email" placeholder="E-mailadres" autofocus="autofocus">
                    <p><span class="error"><?php echo $emailErr; ?></span></p>

                    <p class="paragraph">Wachtwoord <span class="text-danger">*</span></p>
                    <input type="password" class="inputBox" name="pass" placeholder="Wachtwoord">
                    <p><span class="error"><?php echo $passErr; ?></span></p>

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