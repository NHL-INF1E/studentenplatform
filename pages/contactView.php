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
            <div class="col-md-5 align-self-center">
                <?php
                if (isset($_SESSION['name'])) {
                    echo '<p id="usernameheader">Welkom, <span class="blue text-capitalize">' . $_SESSION['name'] . '</span></p>';
                }
                ?>
            </div>
            <!-- Knoppen naar andere pagina's -->
            <div class="col-md-4" id="buttoncontainerheader">
                <a href="../index.php" class="headerbutton">Activiteiten</a>
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
                <a href="contact.php" class="headerbutton">Contact</a>
                <!-- Taal wissel knop hier -->
                <a href="contactview_EN.php">
                    <img src="../pictures/flags/UK_flag.jpg" id="langflag">
                </a>
            </div>
        </div>
    </div>

    <div class="contentContainer">
        <?php
        include '../utilities/dataStoreUtil.php';
        $contacts = getContacts("../datastores/contacts.json");
        foreach ($contacts as $contact) {
            echo "<div class='contactContainer'>";
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