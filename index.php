<?php
    require_once('utilities/dataStoreUtil.php');
    // Haalt de data uit data.json
    $activities = getActivities();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studentenplatform</title>
    <link rel="stylesheet" href="css/activiteiten.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row text-center">
            <?php
            foreach ($activities as $key => $item) {
            ?>
            <div class="col-md-4">
                <div class="kaartje row <?php echo $item->kleur?>">
                    <div class="content p-0">
                        <div class="col-md-12 p-0" style="height: 30vh;">
                            <img class="img-fluid" src="<?php echo $item->image; ?>" alt="">
                        </div>
                        <div class="col-md-12 p-4" style="height: 5vh;">
                            <b><h3 class="text-start"><?php echo $item->title; ?></h3></b>
                        </div>
                        <div class="col-md-12 p-4" style="height: 27vh;">
                            <p class="text-start"><?php echo $item->beschrijving; ?></p>
                        </div>
                        <div class="col-md-12 text-end p-4" style="height: 8vh;">
                            <button class="button inschrijfKnop"><a href="<?php echo $item->link; ?>">Inschrijven</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>