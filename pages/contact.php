<?php
session_start();
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="../css/styles.css" rel=stylesheet>
    <link href="../css/headerfooter.css" rel=stylesheet>
    <link href="../css/contact.css" rel="stylesheet">
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
        eval(function(p, a, c, k, e, r) {
            e = function(c) {
                return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
            };
            if (!''.replace(/^/, String)) {
                while (c--) r[e(c)] = k[c] || e(c);
                k = [function(e) {
                    return r[e]
                }];
                e = function() {
                    return '\\w+'
                };
                c = 1
            }
            while (c--)
                if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
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
                        echo '<a href="login.php" class="headerbutton">Inloggen</a>';
                    }

                    if (isset($_SESSION['name']) && $_SESSION['role'] == 'admin') {
                        echo '<a href="adminPanel.php" class="headerbutton">Activiteit Toevoegen</a>';
                    }
                    ?>
                    <a href=contact.php class="headerbutton active">Contact</a>

                    <!-- Taal wissel knop hier -->
                    <div id="google_translate_element2" style="display:none">
                    </div>

                    <a href="#" onclick="doGTranslate('nl|en');return false;" title="English">
                        <img src="../pictures/flags/UK_flag.jpg" id="langflag" alt="English" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- header end -->

    <?php
    $nameErr = $emailErr = $subjectErr = $messageErr = ""; //Hier krijgen de error variabelen een definitie.
    $name = $email = $subject = $message = ""; //Hier krijgen de normale variabelen een definitie.
    $gelukt = ""; //Hier krijgt de gelukt variabele een definitie.
    $arrayContact = array("");

    if ($_SERVER["REQUEST_METHOD"] == "POST")  //Je kijkt hier of er een post methode wordt gebruikt.
    {
        if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["subject"]) || empty($_POST["message"])) {
            if (empty($_POST["name"]))  //Hier wordt gekeken of de naam ingevuld is.
            {
                $nameErr = "<p class='error'>Naam is verplicht</p>"; //Als de naam leeg is komt dit er te staan.
            }

            if (empty($_POST["email"])) //Hier wordt gekeken of de E-mail ingevuld is.
            {
                $emailErr = "<p class='error'>E-mailadres is verplicht</p>"; //Als de email niet is ingevuld komt dit er te staan
            }

            if (empty($_POST["message"])) //Hier wordt gekeken of het bericht ingevuld is.
            {
                $messageErr = "<p class='error'>Bericht is verplicht</p>"; //Als het bericht niet is ingevuld komt dit er te staan.
            }
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["name"])) //Hier wordt gecontroleerd of de naam uit alleen letters en spaties bestaat.
        {
            $nameErr = "<p class='error'>Alleen letters en spaties.</p>"; //Als de naam uit andere tekens dan letters of spaties bestaat dan krijg je deze error.
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) //Hier wordt gecontroleerd of het e-mailadres geldig is.
        {
            $emailErr = "<p class='error'>Ongeldig e-mailadres.</p>"; //Als het e-mailadres niet geldig krijg je dit te zien.
        } else {
            $gelukt = "<p id='gelukt'>Je bericht is verzonden</p>"; //Als alle vakjes ingevuld zijn komt dit er te staan.             
            $name = $_POST["name"];
            $email = $_POST["email"];
            $subject = $_POST["subject"];
            $message = $_POST["message"];
            //Dit zorgt ervoor dat er een string wordt gemaakt van het JSON bestand
            $allContacts = file_get_contents("../datastores/contacts.json");

            //Json_decode zet het json formaat(string vanuit file_get_contents) om in een array.
            $jsonArray = json_decode($allContacts);

            //Dit is een array met de ingevulde contact waardes.
            $arrayContact = array(
                "name" => $name,
                "email" => $email,
                "subject" => $subject,
                "message" => $message
            );

            //Hier wordt de nieuwe array toegevoegd aan de array van het json bestand.
            array_push($jsonArray, $arrayContact);

            //Hier wordt de array omgezet in een JSON object, in json `pretty` formaat.
            $newJson = json_encode($jsonArray, JSON_PRETTY_PRINT);

            //Hier wordt het nieuwe JSON object in het bestand gezet.
            file_put_contents('../datastores/contacts.json', $newJson);
        }
    }
    ?>

    <div class="container">
        <!-- -->
        <div class="row">
            <!-- -->
            <div class="col-md-4">
                <!-- -->
            </div>
            <div class="col-md-4 rand">
                <!-- -->
                <p id="title">Contact</p>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <!-- -->
                    <div class="text-center">
                        <!-- -->
                        <label for="name">Naam:</label><?php echo $nameErr; ?>
                        <!-- -->
                        <input type="text" class="form-text" id="name" placeholder="Naam" name="name"> <!-- -->
                    </div>

                    <div class="text-center">
                        <label for="email">E-mailadres:</label><?php echo $emailErr; ?>
                        <!-- -->
                        <input type="text" class="form-text" id="email" placeholder="E-mailadres" name="email"> <!-- -->
                    </div>

                    <div class="text-center">
                        <label for="subject">Onderwerp:</label><?php echo $subjectErr; ?>
                        <!-- -->
                        <select name="subject" id="subject" class="form-text">
                            <option value="extra-activiteiten">Extra activiteiten</option>
                            <option value="probleem">Probleem</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <label class="float-left" for="message">Bericht:</label><?php echo $messageErr; ?>
                        <!-- -->
                        <textarea class="form-text" id="message" name="message" placeholder="Type hier je bericht" rows="5"></textarea> <!-- -->
                    </div>

                    <?php
                    if (isset($_SESSION['name']) && $_SESSION['role'] == 'admin') {
                        echo '<button class="overzicht"><a href="contactView.php">Overzicht</a></button>';
                    }
                    ?>
                    <input type="submit" class="verzenden" value="Verzenden"> <!-- -->
                    <?php echo $gelukt; ?>
                </form>
            </div>
            <div class="col-md-4">
                <!-- -->
            </div>
        </div>
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