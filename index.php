<?php
session_start();
require_once('utilities/dataStoreUtil.php');
// Haalt de data uit data.json
$file = 'datastores/activities2.json';
$activities = getCategories($file);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studentenplatform</title>
    <link href=css/styles.css rel=stylesheet>
    <link href=css/headerfooter.css rel=stylesheet>
    <link rel="stylesheet" href="css/activiteiten.css">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css"></head>

<body>
    <!-- header base -->
    <div id="headerbase" class="container-fluid mb-5">
        <div class="row">
            <!-- Header logo -->
            <div class="col-md-3 align-self-center">
                <img src="pictures/NHL_Stenden_Eropuit_Logo.png" alt="NHL Stenden Eropuit" id="logoheader">
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
            <div class="col-md-5" >
                <div id="buttoncontainerheader">
                <a href=index.php class="headerbutton active">Activiteiten</a>
                <?php
                if (isset($_SESSION['name'])) {
                    echo '<a href="utilities/logout.php" class="headerbutton">Uitloggen</a>';
                } else {
                    echo '<a href="pages/login.php" class="headerbutton">Inloggen</a>';
                }
                
                if (isset($_SESSION['name']) && $_SESSION['role'] == 'admin') {
                    echo '<a href="pages/adminPanel.php" class="headerbutton">Admin paneel</a>';
                }
                ?>
                <a href=pages/contact.php class="headerbutton">Contact</a>
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
                <?php
                //if (isset($[''])) {
                //    echo '<a href="javascript:;" id="English" onclick="translateLanguage(this.id);"><span></span>
                //    <img src="pictures/flags/UK_flag.jpg" id="langflag" alt="English"></a>';
                //} else {
                //    echo '<a href="javascript:void(0)"><span></span>
                //    <img src="pictures/flags/NL_flag.jpg" id="langflag" alt="Nederlands"></a>';   
                //}
                ?>
            </div>
        </div>
    </div>
    <!-- Header end -->

    <!-- content -->
    <div class="container">
        <div class="row text-center">
            <?php
            foreach ($activities as $key => $item) {
            ?>
                <div class="col-md-4">
                    <div class="kaartje row <?php echo $item->color ?>">
                        <div class="content p-0">
                            <div class="col-md-12 rowOne">
                                <img class="img-fluid" src="<?php echo $item->homeImage; ?>" alt="<?php echo $item->title; ?>">
                            </div>
                            <div class="col-md-12 rowTwo">
                                <b>
                                    <h3 class="text-start"><?php echo $item->title; ?></h3>
                                </b>
                            </div>
                            <div class="col-md-12 rowThree">
                                <p class="text-start"><?php echo $item->description; ?></p>
                            </div>
                            <div class="col-md-12 text-end p-4 rowFour">
                                <a href="<?php echo $item->link; ?>"><button class="button inschrijfKnop">Inschrijven</button></a>
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