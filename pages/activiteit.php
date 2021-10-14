<?php
session_start();
?>
<?php
    // a requirement from a different page
    require_once('../utilities/dataStoreUtil.php');
    // get the json data from json file
    $activities = getActivities('../datastores/activities2.json');
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activiteit</title>
    <link href="../css/styles.css" rel=stylesheet>
    <link href="../css/headerfooter.css" rel=stylesheet>
    <link href="../css/activiteiten2.css" rel="stylesheet">
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
            <!-- Login gebruikersnaam placeholder -->
            <div class="col-md-5 align-self-center">
                <?php
                if (isset($_SESSION['name'])) {
                    echo '<p id="usernameheader">Welkom, <span class="blue text-capitalize">' . $_SESSION['name'] . '</span></p>';
                }
                ?>
            </div>
            <!-- Knoppen naar andere pagina's -->
            <div class="col-md-4" id="buttoncontainerheader">
                <a href=../index.php class="headerbutton active">Activiteiten</a>
                <a href=login.php class="headerbutton">Inloggen</a>
                <a href=contact.php class="headerbutton">Contact</a>
                <!-- Taal wissel knop hier -->
                <a href="enlish page ofz lol">
                    <img src="../pictures/flags/UK_flag.jpg" id="langflag">
                </a>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="container">
    <?php
        if (isset($_GET['cat'])) {
            $getActivity = getActivity($_GET['cat'], '../datastores/activities2.json');
        }
    ?>
        <div class="row">
            <div class="col-md-4">
                <div class="left-content">
                    <?php
                        foreach ($activities as $key => $item) {
                    ?>
                    <div class="col-md-12 text-end article-img">
                        <img class="img-fluid" alt="sports" src="<?php echo $item['image']; ?>">
                    </div>
                    <div class="col-md-12 article-title">
                        <h2 class="text-center"><b><?php echo $item['title']; ?></b></h2>
                    </div>
                    <div class="col-md-12 article-text">
                        <?php echo $item['description']; ?>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="right-content">
                    <div class="col-md-12 article-title">
                        <h2 class="text-start"><b>Activities</b></h2>
                    </div>
                    <div class="row">
                        <?php 
                            foreach ($activities as $key => $item) { 
                                foreach ($item['activity'] as $innerKey => $value) {
                        ?>
                        <div class="col-sm-4">
                            <ul class="activity-drop article-text">
                                <form method="POST">
                                    <li><input type="submit" class="activity-button" name="activity"
                                            value="<?php echo $value['activityName'] ?>">&gt;</li>
                                </form>
                            </ul>
                        </div>
                        <?php
                                } 
                            } 
                        ?>
                        <div class="col-sm-8 text-center">
                            <p>
                                <?php 
                                    /*
                                    $_POST[activity] is checked if it has been clicked
                                    if it has been clicked value in html will be echoed
                                    */
                                    if (isset($_POST["activity"])) {
                                        foreach ($activities as $key => $item) { 
                                            foreach ($item['activity'] as $innerKey => $value) {
                                ?>
                            <div class="col-sm-12 text-center log-check1">Login to sign up for an activity</div>
                            <div class="col-sm-12 text-center">
                                <img alt="like" class="img-fluid log-check2"
                                    src="../pictures/stock/icons8-thumbs-up-64.png">
                            </div>
                            <div class="col-sm-12 text-center log-check3"><?php echo $value['activityCount']; ?></div>
                            <?php
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