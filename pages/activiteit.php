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
                    <div class="col-md-12 text-end article-img">
                        <img class="img-fluid" alt="sports" src="../pictures/stock/hardloopTracks.jpeg">
                    </div>
                    <div class="col-md-12 article-title">
                        <h2 class="text-center"><b>Sports</b></h2>
                    </div>
                    <div class="col-md-12 article-text">
                        <p>
                            If you're the athletic type who enjoys playing sports in teams, this might just be the category for you.
                        </p>     
                        <p>
                            You will be making contacts with both Dutch and international students as you play sports such as football,
                            tennis or rowing.
                        </p>
                        <p>
                            If you're more the strategic type, there are also sports such as e-sports and archery available.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="right-content">
                    <div class="col-md-12 article-title">
                        <h2 class="text-start"><b>Activities</b></h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <ul class="activity-drop article-text">
                                <form method="POST">
                                    <li><input type="submit" class="activity-button" name="activity" value="soccer">&gt;</li>
                                    <li><input type="submit" class="activity-button" name="activity" value="tennis">&gt;</li>
                                    <li><input type="submit" class="activity-button" name="activity" value="rowing">&gt;</li>
                                    <li><input type="submit" class="activity-button" name="activity" value="archery">&gt;</li>
                                    <li><input type="submit" class="activity-button" name="activity" value="e-sports">&gt;</li>
                                </form>
                            </ul>
                        </div>
                        <div class="col-sm-8 text-center">
                            <p>
                                <?php 
                                    /*
                                    $_POST[activity] is checked if it has been clicked
                                    if it has been clicked value in html will be echoed
                                    */
                                    if (isset($_POST["activity"])) {
                                ?>
                                <div class="col-sm-12 text-center log-check1">Login to sign up for an activity</div>
                                <div class="col-sm-12 text-center">
                                    <img alt="like" class="img-fluid log-check2" src="../pictures/stock/icons8-thumbs-up-64.png">
                                </div>
                                <div class="col-sm-12 text-center log-check3">24 said yes</div>
                                <?php
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
