<?php
session_start();
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Beheerder's Paneel</title>
        <link href="../css/admin.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        include "../utilities/dataStoreUtil.php";
        $_SESSION["activityID"] = 1;
        $error = "";
        if(isset($_POST["submit"])){
            if(empty($_POST["title"]) || empty($_POST["image"]) || empty($_POST["description"]) || empty($_POST["color"]) || empty($_POST["link"])){
                $error = "all fields must be filled out";
            }else{
                $result = array(
                    "title" => $_POST['title'],
                    "beschrijving" => $_POST['description'],
                    "image" => $_POST["image"],
                    "link" => $_POST["link"],
                    "kleur" => $_POST["color"]
                );
                $ID = $_SESSION["activityID"];
                if($ID < 0){
                    addActivity($result, "../datastores/id.txt", "../datastores/activities.json");
                }else{
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
            if($_SESSION["activityID"] >= 0){
                $ID = $_SESSION["activityID"];
                $currentActivity = getActivity($ID, "../datastores/activities.json");
                $result = $currentActivity[$ID];
                $title = $result["title"];
                $description = $result["beschrijving"];
                $image = $result["image"];
                $link = $result["link"];
                $color = $result["kleur"];
            }
        ?>
        <section id="activityWrapper">
            <form method="post" action="">
                <input type="text" name="title" id="title" placeholder="title" value="<?=$title?>">
                <input type="text" name="image" id="image" placeholder="image.jpg" value="<?=$image?>">
                <textarea rows="4" cols="50" name="description" id="description" placeholder="description..."><?=$description?></textarea>
                <input type="text" name="color" id="color" placeholder="color"  value="<?=$color?>">
                <input type="text" name="link" id="link" placeholder="index.php" value="<?=$link?>">
                <input type="submit" value="Opslaan" id="submit" name="submit">
            </form>
            <?=$error?>
        </section>
    </body>
</html>
