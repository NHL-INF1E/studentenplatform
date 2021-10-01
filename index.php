<?php
    // Haalt de data uit data.json
    $activities = getJsonContent();

    function getJsonContent() {
        $json = file_get_contents('datastores/categorie.json');
        $content = json_decode($json);
        return $content;
    }
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
            <div class="col-md-4 kaartje">
                <div class="row">
                    <div class="col-md-12">
                        <img class="img-fluid" src="<?php echo $item->image; ?>" alt="">
                    </div>
                    <div class="col-md-12">
                        <p class="text-start"><?php echo $item->title; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p class="text-start"><?php echo $item->beschrijving; ?></p>
                    </div>
                    <div class="col-md-12 text-end">
                        <button class="button"><a href="<?php echo $item->link; ?>">Inschrijven</a></button>
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