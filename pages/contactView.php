<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Contacten Weergeven</title>
    <link href="../css/styles.css" rel=stylesheet>
    <link href="../css/headerfooter.css" rel=stylesheet>
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
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
            <div class="col-md-5" >
                <div id="buttoncontainerheader">
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

    <div class="contentContainer">
        <?php
        //hier word er een benodigde bestand meegenomen 
        include '../utilities/dataStoreUtil.php';
        //hier word een functie uit json opgehaald
        $contacts = getContacts("../datastores/contacts.json");
        //hier word er door het bestand heen geloopt
        foreach ($contacts as $contact) {
        ?>
            <div class="container contactContainer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row outerContent">
                            <div class="col-sm-4 innerContent">
                                <?php echo 'Naam: '. $contact["name"]; ?>
                            </div>
                            <div class="col-sm-4 innerContent">
                                <?php echo 'E-mail: '. $contact["email"]; ?>
                            </div>
                            <div class="col-sm-4 innerContent">
                                <?php echo 'Onderwerp: '. $contact["subject"]; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 innerContent">
                                <?php echo 'Bericht: '. $contact["message"]; ?>
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