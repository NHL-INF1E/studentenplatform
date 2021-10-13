<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="../css/contact.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>

<body>
    <?php           
            $nameErr = $emailErr = $subjectErr = $messageErr = ""; //Hier krijgen de error variabelen een definitie.
            $name = $email = $subject = $message = ""; //Hier krijgen de normale variabelen een definitie.
            $gelukt = ""; //Hier krijgt de gelukt variabele een definitie.
            $arrayContact = array("");

            if ($_SERVER["REQUEST_METHOD"] == "POST")  //Je kijkt hier of er een post methode wordt gebruikt.
            {
                if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["subject"]) || empty($_POST["message"]))
                {
                    if (empty($_POST["name"]))  //Hier wordt gekeken of de naam ingevuld is.
                    {
                        $nameErr = "<p class='error'>Naam is verplicht</p>"; //Als de naam leeg is komt dit er te staan.
                    }

                    if (empty($_POST["email"])) //Hier wordt gekeken of de E-mail ingevuld is.
                    {
                        $emailErr = "<p class='error'>E-mail is verplicht</p>";//Als de email niet is ingevuld komt dit er te staan
                    }

                    if (empty($_POST["message"])) //Hier wordt gekeken of het bericht ingevuld is.
                    {
                        $messageErr = "<p class='error'>Bericht is verplicht</p>"; //Als het bericht niet is ingevuld komt dit er te staan.
                    }
                }  
                elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) //Hier wordt gecontroleerd of de naam uit alleen letters en spaties bestaat.
                {
                    $nameErr = "<p class='error'>Alleen letters en spaties.</p>";//Als de naam uit andere tekens dan letters of spaties bestaat dan krijg je deze error.
                } 
                elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))//Hier wordt gecontroleerd of het e-mailadres geldig is.
                {
                    $emailErr = "<p class='error'>Ongeldig e-mailadres.</p>";//Als het e-mailadres niet geldig krijg je dit te zien.
                }
                else
                {
                    $gelukt = "<p id='gelukt'>Je bericht is verzonden</p>"; //Als alle vakjes ingevuld zijn komt dit er te staan.             
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $subject = $_POST["subject"];
                    $message = $_POST["message"];
                    //Dit zorgt ervoor dat er een string wordt gemaakt van het JSON bestand
                    $allContacts = file_get_contents("../datastores/contacts.json");

                    //Json_decode zet het json formaat(string vanuit file_get_contents) om in een array.
                    $jsonArray = json_decode($allContacts);

                    //Dit is een array met de ingevulde contact waardes.
                    $arrayContact = array(
                        "name" => $name,
                        "email" => $email,
                        "subject" => $subject,
                        "message" => $message);

                    //Hier wordt de nieuwe array toegevoegd aan de array van het json bestand.
                    array_push($jsonArray, $arrayContact);

                    //Hier wordt de array omgezet in een JSON object, in json `pretty` formaat.
                    $newJson = json_encode($jsonArray, JSON_PRETTY_PRINT);

                    //Hier wordt het nieuwe JSON object in het bestand gezet.
                    file_put_contents('../datastores/contacts.json', $newJson);
                }  
            }

            
        ?>

    <div class="container">
        <!-- -->
        <div class="row">
            <!-- -->
            <div class="col-md-4">
                <!-- -->
            </div>
            <div class="col-md-3">
                <!-- -->
                <h2><b>Contact</b></h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <!-- -->
                    <p>
                    <div class="text-center">
                        <!-- -->
                        <label class="float-left" for="name">Naam:</label><?php echo $nameErr; ?><br> <!-- -->
                        <input type="text" class="form-text" id="name" placeholder="Naam" name="name"> <!-- -->
                    </div>

                    <div class="text-center">
                        <label class="float-left" for="email">E-mail:</label><?php echo $emailErr; ?><br> <!-- -->
                        <input type="text" class="form-text" id="email" placeholder="E-mail" name="email"> <!-- -->
                    </div>

                    <div class="text-center">
                        <label class="float-left" for="subject">Onderwerp:</label><?php echo $subjectErr; ?><br>
                        <!-- -->
                        <select name="subject" id="subject" class="form-text">
                            <option value="extra-activiteiten">Extra activiteiten</option>
                            <option value="probleem">Probleem</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <label class="float-left" for="message">Bericht:</label><?php echo $messageErr; ?><br> <!-- -->
                        <textarea class="form-text" id="message" name="message" placeholder="Type hier je bericht"
                            rows="5"></textarea> <!-- -->
                    </div>
                    <input type="submit" class="verzenden" value="Verzenden"> <!-- -->
                    <?php echo $gelukt; ?>
                    <!-- -->
                    <?php
                                foreach($arrayContact as $value)
                                {
                                    echo $value . "<br>";
                                }
                                ?>
                    </p>
                </form>
            </div>
            <div class="col-md-5">
                <!-- -->
            </div>
        </div>
    </div>
</body>

</html>