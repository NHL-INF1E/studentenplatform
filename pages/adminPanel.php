<?php
session_start();
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
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'nl',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                    autoDisplay: false
                },
                'google_translate_element');
        }
    </script>
    <script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
        function translateLanguage(lang) {

            var $frame = $('.goog-te-menu-frame:first');
            if (!$frame.size()) {
                alert("Error: Could not find Google translate frame.");
                return false;
            }
            $frame.contents().find('.goog-te-menu2-item span.text:contains(' + lang + ')').get(0).click();
            return false;
        }
    </script>
</head>

<body>
    <!-- header base -->
    <div id="headerbase" class="container-fluid mb-5">
        <div class="row">
            <!-- Header logo -->
            <div class="col-md-3 align-self-center">
                <img src="../pictures/NHL_Stenden_Eropuit_Logo.png" alt="NHL Stenden Eropuit" id="logoheader">
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
                        echo '<a href="adminPanel.php" class="headerbutton active">Admin paneel</a>';
                    }
                    ?>
                    <a href=contact.php class="headerbutton">Contact</a>

                    <!-- Taal wissel knop hier -->
                    <div id="google_translate_element" style="display: none">
                    </div>
                    <a href="javascript:;" id="English" onclick="translateLanguage(this.id);">
                        <span></span>
                        <img src="../pictures/flags/UK_flag.jpg" id="langflag" alt="English">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- header end -->

    <?php
    include "../utilities/dataStoreUtil.php";
    $_SESSION["activityID"] = -1;
    $error = "";

    if (isset($_POST["deletus"])) {
        removeActivity($_SESSION["activityID"], "../datastores/activities.json");
    }

    if (isset($_POST["submit"])) {
        if (empty($_POST["title"]) || empty($_POST["image"]) || empty($_POST["description"]) || empty($_POST["color"]) || empty($_POST["link"])) {
            $error = "all fields must be filled out";
        } else {
            $result = array(
                "title" => $_POST['title'],
                "beschrijving" => $_POST['description'],
                "image" => $_POST["image"],
                "link" => $_POST["link"],
                "kleur" => $_POST["color"]
            );
            $ID = $_SESSION["activityID"];
            if ($ID < 0) {
                addActivity($result, "../datastores/id.txt", "../datastores/activities.json");
            } else {
                editActivity($ID, $result, "../datastores/activities.json");
                $_SESSION["activityID"] = -1;
            }
        }
    }
    //the values are empty when adding an activity
    $title = "";
    $description = "";
    $image = "";
    $link = "";
    $color = "";

    //todo make it so that when activityID has a value, the corresponding Activity gets loaded into the form.
    if ($_SESSION["activityID"] >= 0) {
        $ID = $_SESSION["activityID"];
        $currentActivity = getActivity($ID, "../datastores/activities.json");
        $result = $currentActivity;
        $title = $result["title"];
        $description = $result["beschrijving"];
        $image = $result["image"];
        $link = $result["link"];
        $color = $result["kleur"];
    }
    ?>
    <section id="activityWrapper">
        <form method="post" action="">
            <input type="text" name="title" id="title" placeholder="title" value="<?= $title ?>">
            <input type="text" name="image" id="image" placeholder="image.jpg" value="<?= $image ?>">
            <textarea rows="4" cols="50" name="description" id="description" placeholder="description..."><?= $description ?></textarea>
            <input type="text" name="color" id="color" placeholder="color" value="<?= $color ?>">
            <input type="text" name="link" id="link" placeholder="index.php" value="<?= $link ?>">
            <input type="submit" value="Opslaan" id="submit" name="submit">
            <input type="submit" value="deletus" id="deletus" name="deletus">
        </form>
        <?= $error ?>
    </section>

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