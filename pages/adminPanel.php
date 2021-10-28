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
    $_SESSION["categoryID"] = "sport";
    $_SESSION["activityID"] = "soccer";
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

    if (isset($_SESSION["activityID"]) && strlen($_SESSION["activityID"]) > 0) {
        getActivity($_SESSION["categoryID"], $_SESSION["activityID"], "../datastores/activities2.json");
//        $ID = $_SESSION["activityID"];
//        $currentActivity = getActivity($ID, "../datastores/activities.json");
//        $result = $currentActivity;
//        $title = $result["title"];
//        $description = $result["beschrijving"];
//        $image = $result["image"];
//        $link = $result["link"];
//        $color = $result["kleur"];
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
								<input type="text" name="color" class="inputBox" id="color" placeholder="kleur" value="<?= $color ?>">
								<input type="text" name="link" class="inputBox" id="link" placeholder="index.php" value="<?= $link ?>">
							</div>
							
							<div>
								<input class="knop" type="submit" value="Opslaan" class="inputBox" id="submit" name="submit">
								<input class="knop" type="submit" value="deletus" class="inputBox" id="deletus" name="deletus">
							</div>
						</form>
						<?= $error ?>
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