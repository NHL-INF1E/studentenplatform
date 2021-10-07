<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="../css/contact.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
</head>
<body>
    <?php
        $nameErr = $emailErr = $subjectErr = $messageErr = ""; //Hier kirjgen de error variabelen een definitie.
        $name = $email = $subject = $message = ""; //Hier krijgen de normale variabelen een definitie.
        $gelukt = ""; //Hier krijgt de gelukt variabele een definitie.

        if ($_SERVER["REQUEST_METHOD"] == "POST")  //Je kijkt hier of er een post methode wordt gebruikt.
        {
            if (empty($_POST["name"]))  //Hier wordt gekeken of de naam ingevuld is.
            {
                $nameErr = "<p class='error'>Naam is verplicht</p>"; //Als de naam leeg is komt dit er te staan.
            }

            if (empty($_POST["email"])) //Hier wordt gekeken of de E-mail ingevuld is.
            {
                $emailErr = "<p class='error'>E-mail is verplicht</p>";//Als de email niet is ingevuld komt dit er te staan
            }

            if (empty($_POST["subject"])) //Hier wordt gekeken of het onderwerp ingevuld is.
            { 
                $subjectErr = "<p class='error'>Onderwerp is verplicht</p>"; //Als het onderwerp niet is ingevuld komt dit er te staan.
            }

            if (empty($_POST["message"])) //Hier wordt gekeken of het bericht ingevuld is.
            {
                $messageErr = "<p class='error'>Bericht is verplicht</p>"; //Als het bericht niet is ingevuld komt dit er te staan.
            }

            if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["subject"]) && !empty($_POST["message"])) //Hier wordt gekeken of alle vakjes ingevuld zijn.
            {
                $gelukt = "<p id='gelukt'>Je bericht is verzonden</p>"; //Als alle vakjes ingevuld zijn komt dit er te staan.
            }
        }
    ?>
    <div class="container"> <!-- -->
        <div class="row"> <!-- -->
            <div class="col-md-4"> <!-- -->
            </div>
            <div class="col-md-3"> <!-- --> 
                <h2><b>Contact</b></h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"><!-- -->
                    <p>
                        <div class="text-center"> <!-- -->
                            <label class="float-left" for="name">Naam:</label><?php echo $nameErr; ?><br> <!-- -->
                            <input type="text" class="form-text" id="name" placeholder="Naam" name="name"> <!-- -->                         
                        </div>
                        
                        <div class="text-center">
                            <label class="float-left" for="email">E-mail:</label><?php echo $emailErr; ?><br> <!-- -->
                            <input  type="text" class="form-text" id="email" placeholder="E-mail" name="email"> <!-- -->                          
                        </div>

                        <div class="text-center">
                            <label class="float-left" for="subject">Onderwerp:</label><?php echo $subjectErr; ?><br> <!-- -->
                            <input type="text" class="form-text" id="subject" placeholder="Onderwerp" name="subject"> <!-- -->                         
                        </div>

                        <div class="text-center">
                            <label class="float-left" for="message">Bericht:</label><?php echo $messageErr; ?><br> <!-- -->
                            <textarea class="form-text" id="message" name="message" placeholder="Type hier je bericht" rows="5"></textarea> <!-- -->        	            
                        </div>
                        <input type="submit" class="verzenden" value="Verzenden"> <!-- -->
                        <?php echo $gelukt; ?> <!-- -->
                    </p>
                </form>
            </div>
            <div class="col-md-5"> <!-- -->
            </div>
        </div>
    </div> 
</body>
</html>