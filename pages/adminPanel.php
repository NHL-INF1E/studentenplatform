<?php
session_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Beheerder's Paneel</title>
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
                <a href="../index.php">
                    <img src="../pictures/NHL_Stenden_Eropuit_Logo.png" alt="NHL Stenden Eropuit" id="logoheader">
                </a> 
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
                <a href="enlish page ofz lol">
                    <img src="../pictures/flags/UK_flag.jpg" id="langflag">
                </a>
            </div>
        </div>
    </div>

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
								<input type="submit" value="Opslaan" class="inputBox" id="submit" name="submit">
								<input type="submit" value="deletus" class="inputBox" id="deletus" name="deletus">
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