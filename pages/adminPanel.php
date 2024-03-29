<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
}
?>
<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Beheerder's Paneel</title>
    <link href="../css/styles.css" rel=stylesheet>
    <link href="../css/headerfooter.css" rel=stylesheet>
    <link href="../css/admin.css" rel="stylesheet" type="text/css">

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
                        echo '<a href="adminPanel.php" class="headerbutton active">Activiteit Toevoegen</a>';
                    }
                    ?>
                    <a href=contact.php class="headerbutton">Contact</a>

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
    //functies voor het werken met activities.json, de datastore
    include "../utilities/dataStoreUtil.php";

    //deze error wordt gevuld wanneer er iets mis gaat en onderaan de pagina geprint
    $error = "";
    $greatSucces = "";

    //delete button afhandeling
    if (isset($_POST["deletus"])) {
        //verwijdert een activity met de gegeven category en activity ID
        removeActivity($_SESSION["categoryID"], $_SESSION["activityID"], "../datastores/activities2.json");
    }

    //opslaan button afhandeling
    if (isset($_POST["submit"])) {

        //checkt of er geen velden leeg gelaten zijn
        if (empty($_POST["title"]) || empty($_POST["image"]) || empty($_POST["description"]) || ($_POST["category"] == "noCategory")) {
            $error = "all fields must be filled out";
        } else {
            //maakt een array van de values van de form velden
            $title = $_POST["title"];
            $id = str_replace(" ", "", $title);
            $image = $_POST["image"];
            $description = $_POST["description"];
            $category = $_POST["category"];

            $content = array($id => array(
                "catName" => $id,
                "activityName" => ucfirst($title),
                "activityCount" => 0,
                "activityImage" => $image,
                "activityDesc" => $description
            ));

            //als activityID niet empty is dan zijn we een activity aan het bewerken in plaats van een nieuwe aan het maken
            if (empty($_SESSION["activityID"])) {
                //checkt of er niet al een activity onder dezelfde naam bestaat
                if (!(is_null(getActivity($category, $title, "../datastores/activities2.json")))) {
                    $error = "Er is al een Activiteit onder die naam";
                } else {
                    addActivity($content, $category, "../datastores/activities2.json");
                    $greatSucces = 'Activiteit ' . $title . " aangemaakt";
                }
            } else {
                editActivity($_SESSION["activityID"], $content, $_SESSION["categoryID"], $category, "../datastores/activities2.json");
            }
        }
    }

    $_SESSION["activityID"] = "";
    $_SESSION["categoryID"] = "";
    if (isset($_POST["edit"])) {
        $_SESSION["activityID"] = $_POST["activityID"];
        $_SESSION["categoryID"] = $_POST["categoryID"];
    }


    //the value van de form input velden, deze zijn leeg wanneer je een nieuwe activity aanmaakt
    $title = "";
    $description = "";
    $image = "";
    $category = "";

    //wanneer er een activity bewerkt wordt, worde de oude waarden in de form input velden ingevuld
    if (!(empty($_SESSION["activityID"]))) {
        $currentActivity = getActivity($_SESSION["categoryID"], $_SESSION["activityID"], "../datastores/activities2.json");
        if (isset($currentActivity["activityName"])) {
            $title = $currentActivity["activityName"];
        }
        if (isset($currentActivity["activityImage"])) {
            $image = $currentActivity["activityImage"];
        }
        if (isset($currentActivity["activityDesc"])) {
            $description = $currentActivity["activityDesc"];
        }
        $category = $_SESSION["categoryID"];
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="formContent">
                    <section id="activityWrapper">
                        <form class="form" method="post" action="">
                            <div>
                                <h2>Beheerder's paneel</h2>
                            </div>
                            <div>
                                <input type="text" name="title" class="inputBox" id="title" placeholder="titel" value="<?= $title ?>">
                                <input type="text" name="image" class="inputBox" id="image" placeholder="foto.jpg" value="<?= $image ?>">
                            </div>

                            <div>
                                <textarea name="description" class="inputBox" id="description" placeholder="beschrijving..."><?= $description ?></textarea>
                            </div>

                            <div>
                                <select name="category" id="category">
                                    <?php
                                    //placeholder optie voor categorie wanneer er geen activity bewerkt wordt
                                    if (empty($_SESSION["activityID"])) {
                                        echo "<option value='noCategory'>Selecteer een Categorie</option>";
                                    }
                                    ?>
                                    <option value="sport" <?php if ($category == "sport") {
                                                                echo " selected";
                                                            } ?>>Sport</option>
                                    <option value="beeldendekunst" <?php if ($category == "beeldendekunst") {
                                                                        echo " selected";
                                                                    } ?>>Beeldende Kunst</option>
                                    <option value="muziekendans" <?php if ($category == "muziekendans") {
                                                                        echo " selected";
                                                                    } ?>>Muziek en Dans</option>
                                    <option value="film" <?php if ($category == "film") {
                                                                echo " selected";
                                                            } ?>>Film</option>
                                </select>
                            </div>

                            <div>
                                <input class="knop" type="submit" value="Opslaan" class="inputBox" id="submit" name="submit">
                                <?php
                                //delete button niet nodig bij het aanmaken van een activiteit
                                if (!empty($_SESSION["activityID"])) {
                                    echo '<input class="knop" type="submit" value="Verwijderen" class="inputBox" id="deletus" name="deletus">';
                                }
                                ?>
                            </div>
                        </form>
                        <?= $error ?>
                        <?= $greatSucces ?>

                    </section>
                </div>

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