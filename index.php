<?php
    session_start();
    require_once('utilities/dataStoreUtil.php');
    // Haalt de data uit data.json
    $file = 'datastores/activities.json';
$activities = getActivities($file);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studentenplatform</title>
    <link href=css/styles.css rel=stylesheet>
    <link href=css/headerfooter.css rel=stylesheet>
    <link rel="stylesheet" href="css/activiteiten.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <!-- header base -->
    <div id="headerbase" class="container-fluid mb-5">
        <div class="row">
            <!-- Header logo -->
            <div class="col-md-3 align-self-center">
                <img src="pictures/NHL_Stenden_Eropuit_Logo.png" alt="NHL Stenden Eropuit" id="logoheader">
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
                <a href=index.php class="headerbutton active">Activiteiten</a>
                <a href=pages/login.php class="headerbutton">Inloggen</a>
                <a href=pages/contact.php class="headerbutton">Contact</a>
                <!-- Taal wissel knop hier -->
                <a href="enlish page ofz lol">
                    <img src="pictures/flags/UK_flag.jpg" id="langflag">
                </a>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="container">
        <div class="row text-center">
            <?php
            foreach ($activities as $key => $item) {
            ?>
            <div class="col-md-4">
                <div class="kaartje row <?php echo $item->kleur?>">
                    <div class="content p-0">
                        <div class="col-md-12 rowOne">
                            <img class="img-fluid" src="<?php echo $item->image; ?>" alt="<?php echo $item->title; ?>">
                        </div>
                        <div class="col-md-12 rowTwo">
                            <b>
                                <h3 class="text-start"><?php echo $item->title; ?></h3>
                            </b>
                        </div>
                        <div class="col-md-12 rowThree">
                            <p class="text-start"><?php echo $item->beschrijving; ?></p>
                        </div>
                        <div class="col-md-12 text-end p-4 rowFour">
                            <a href="<?php echo $item->link; ?>"><button
                                    class="button inschrijfKnop">Inschrijven</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
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