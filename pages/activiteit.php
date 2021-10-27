<?php
session_start();
?>
<?php
// a requirement from a different page
require_once('../utilities/dataStoreUtil.php');
?>

<!DOCTYPE HTML>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activiteit</title>
    <link href="../css/styles.css" rel=stylesheet>
    <link href="../css/headerfooter.css" rel=stylesheet>
    <link href="../css/activiteiten2.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
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
            <div class="col-md-5">
                <div id="buttoncontainerheader">
                    <a href=../index.php class="headerbutton active">Activiteiten</a>
                    <?php
                    if (isset($_SESSION['name'])) {
                        echo '<a href="../utilities/logout.php" class="headerbutton">Uitloggen</a>';
                    } else {
                        echo '<a href="login.php" class="headerbutton">Inloggen</a>';
                    }

                    if (isset($_SESSION['name']) && $_SESSION['role'] == 'admin') {
                        echo '<a href="adminPanel.php" class="headerbutton">Admin paneel</a>';
                    }
                    ?>
                    <a href=contact.php class="headerbutton">Contact</a>
                </div>
            <!-- Taal wissel knop hier -->
            <div id="google_translate_element" style="display: none"></div>
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
                <script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
                    type="text/javascript"></script>
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
                <a href="javascript:;" id="English" onclick="translateLanguage(this.id);"><span></span>
                <img src="../pictures/flags/UK_flag.jpg" id="langflag" alt="English"></a>
            </div>
        </div>
    </div>
    <!-- header end -->

    <!-- content -->
    <div class="container">
        <?php
        // if $_GET request 'cat' is set
        if (isset($_GET['cat'])) {

            //Activate function if GET isset true (get data for selected activity)
            $getActivity = getActivity($_GET['cat'], '../datastores/activities2.json');

            //Like button function
            if (isset($_POST['like'])) {
                $selectedActivity = $_SESSION['submittedActivity'];

                //Loop door alle activiteiten heen van $getActivity (de kozen categorie, sport/art/film etc.)
                foreach ($getActivity['activity'] as $activity) {
                    //Als de geloopte activiteitnaam gelijk is aan het geselecteerde activiteit dan pak die array
                    if ($activity['catName'] == $selectedActivity) {
                        //Tel activiteit deelnemers op met +1
                        $variableCount = $activity['activityCount'] + 1;
                        //Zet de geupdate value in een array 'activityCount'
                        $updatedValueCountArr = array('activityCount' => $variableCount);
                    }
                }

                //Replace oude activityCount met de nieuwe activityCount en zet dit in $getActivity neer
                $countReplace = array_replace($getActivity['activity'][$selectedActivity], $updatedValueCountArr);
                $getActivity['activity'][$selectedActivity] = $countReplace;

                //Hier wordt de oude volledige json lijst opgehaald en vervangen door de nieuwe value's
                $oldJson = getActivities('../datastores/activities2.json');
                $oldJson[$_GET['cat']] = $getActivity;

                //Hier wordt de array omgezet in een JSON object, in json `pretty` formaat
                $newJson = json_encode($oldJson, JSON_PRETTY_PRINT);

                //Hier wordt het nieuwe JSON object in het bestand gezet
                file_put_contents('../datastores/activities2.json', $newJson);
            }
        ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="left-content">
                        <?php
                        //Check if activity was selected or just the category, based on that echo data
                        if (isset($_POST['activity'])) {
                            $_SESSION['submittedActivity'] = $_POST['activity'];
                            foreach ($getActivity['activity'] as $key => $item) {
                                if ($_POST['activity'] == $item['catName']) {
                                    echo '
                                    <div class="col-md-12 text-end article-img">
                                        <img class="img-fluid" alt=' . $item['activityName'] . ' src=' . $item['activityImage'] . '>
                                    </div>
                                    ';
                                }
                            }
                        } else {
                            echo '
                            <div class="col-md-12 text-end article-img">
                                <img class="img-fluid" alt=' . $getActivity['title'] . ' src=' . $getActivity['image'] . '>
                            </div>
                            ';
                        }
                        ?>

                        <div class="col-md-12 article-title">
                            <?php
                            //Check if activity was selected or just the category, based on that echo data
                            if (isset($_POST['activity'])) {
                                foreach ($getActivity['activity'] as $key => $item) {
                                    if ($_POST['activity'] == $item['catName']) {
                                        echo '
                                        <h2 class="text-center"> 
                                            <b class="text-capitalize"> ' . $item["activityName"] . '</b>
                                        </h2>
                                        ';

                                        echo '
                                        <div class="col-md-12 article-text">
                                            <p>' . $item["activityDesc"] . '</p>
                                        </div>
                                        ';
                                    }
                                }
                            } else {
                                echo '
                                <h2 class="text-center"> 
                                    <b class="text-capitalize"> ' . $getActivity["title"] . '</b>
                                </h2>
                                ';

                                echo '
                                <div class="col-md-12 article-text">
                                    <p>' . $getActivity["description"] . '</p>
                                </div>
                                ';
                            }
                            ?>
                        </div>

                    </div>
                </div>

                <div class="col-md-8">
                    <div class="right-content">
                        <div class="col-md-12 article-title">
                            <h2 class="text-start"><b>Activiteiten</b></h2>
                        </div>

                        <div class="row">

                            <div class="col-sm-4">

                                <ul class="activity-drop article-text">
                                    <form method="POST">
                                        <?php
                                        //loop through the array of the json file
                                        foreach ($getActivity['activity'] as $key => $item) {
                                        ?>
                                            <li>
                                                <?php
                                                $clicked = false;
                                                if (isset($_POST['activity'])) {
                                                    $clicked = true;
                                                    $test = $_POST['activity'];

                                                    if ($test === $item['catName']) {
                                                        echo '
                                                        <button type="submit" class="activity-button text-capitalize fw-bold activeActivity" name="activity" value=' . $item['catName'] . '>' . $item['activityName'] . '</button> <i class="bi bi-chevron-down"></i>
                                                        ';
                                                    } else {
                                                        echo '
                                                        <button type="submit" class="activity-button text-capitalize fw-bold" name="activity" value=' . $item['catName'] . '>' . $item['activityName'] . '</button> <i class="bi bi-chevron-right"></i>
                                                        ';
                                                    }
                                                } else if (!$clicked) {
                                                    echo '
                                                    <button type="submit" class="activity-button text-capitalize fw-bold" name="activity" value=' . $item['catName'] . '>' . $item['activityName'] . '</button> <i class="bi bi-chevron-right"></i>
                                                    ';
                                                }
                                                ?>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </form>
                                </ul>
                            </div>

                            <div class="col-sm-8 text-center">
                                <p>
                                    <?php
                                    /*
                                    $_POST[activity] is checked if it has been clicked
                                    if it has been clicked value in html will be echoed
                                    */
                                    if (isset($_POST["activity"])) {
                                        foreach ($getActivity['activity'] as $key => $item) {
                                            if ($_POST['activity'] == $item['catName']) {
                                                //Als de sessie niet leeg is(oftwel er is iemand ingelogd)
                                                if (!empty($_SESSION['name'])) {

                                                    echo '
                                                    <div class="col-sm-12 text-center log-check3 fw-bold">
                                                        <p>Are you interested in this activity?</p>
                                                    </div>
                                                    ';

                                                    echo '
                                                    <div class="col-sm-12 text-center">
                                                        <form method="POST" action="">
                                                            <button type="submit" name="like" class="border-0" value=' . is_int($item["activityCount"] + 1) . '><img class="img-fluid log-check4" src="../pictures/stock/icons8-thumbs-up-64.png" alt="meedoen"></button>
                                                        </form>
                                                    </div>
                                                    ';

                                                    echo '
                                                    <div class="col-sm-12 text-center log-check3 fw-bold">
                                                        <p> ' . $item["activityCount"] . ' said yes</p>
                                                    </div>
                                                    ';
                                                } else {
                                                    echo '
                                                    <div class="col-sm-12 text-center log-check1 fw-bold">
                                                        Login to sign up for an activity
                                                    </div>
                                                    ';

                                                    echo '
                                                    <div class="col-sm-12 text-center">
                                                        <form method="POST">
                                                            <input disabled type="image" name="" value=' . $item["activityCount"] . ' class="img-fluid log-check2" src="../pictures/stock/icons8-thumbs-up-64.png" />
                                                        </form>
                                                    </div>
                                                    ';

                                                    echo '
                                                    <div class="col-sm-12 text-center log-check3 fw-bold">
                                                        <p> ' . $item["activityCount"] . ' said yes</p>
                                                    </div>
                                                    ';
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php
        }
?>
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