<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Contact Viewing</title>
    <link href="../css/styles.css" rel=stylesheet>
    <link href="../css/headerfooter.css" rel=stylesheet>
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- header base -->
    <div id="headerbase" class="container-fluid mb-5">
        <div class="row">
            <!-- Header logo -->
            <div class="col-md-3 align-self-center">
                <img src="../pictures/NHL_Stenden_Eropuit_Logo.png" alt="NHL Stenden Eropuit" id="logoheader">
            </div>
            <!-- Login Gebruikersnaam -->
            <div class="col-md-5 align-self-center">
                <?php
                if (isset($_SESSION['name'])) {
                    echo '<p id="usernameheader">Welcome, <span class="blue text-capitalize">' . $_SESSION['name'] . '</span></p>';
                }
                ?>
            </div>
            <!-- Knoppen naar andere pagina's -->
            <div class="col-md-4" id="buttoncontainerheader">
                <a href=../index_EN.php class="headerbutton">Activities</a>
                <a href=login_EN.php class="headerbutton ">Sign in</a>
                <a href=contact_EN.php class="headerbutton active">Contact</a>
                <!-- Taal wissel knop hier -->
                <a href="contactView.php">
                    <img src="../pictures/flags/NL_flag.jpg" id="langflag">
                </a>
            </div>
        </div>
    </div>

    <div class="contentContainer">
        <?php
            include '../utilities/dataStoreUtil.php';
            $contacts = getContacts("../datastores/contacts.json");
            foreach($contacts as $contact){
                echo"<div class='contactContainer'>";
                echo $contact["name"];
                echo $contact["email"];
                echo $contact["subject"];
                echo $contact["message"];
                echo '</div>';
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