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
    <link href="../css/activiteiten2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
    <div class="container">
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
                                                <li><input type="submit" class="activity-button" name="activity" value="<?php echo $value['activityName'] ?>">&gt;</li>
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
                                            <img alt="like" class="img-fluid log-check2" src="../pictures/stock/icons8-thumbs-up-64.png">
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
</body>
</html>
