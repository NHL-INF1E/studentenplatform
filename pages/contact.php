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
    <div class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-3">       
                <h2><b>Contact</b></h2>
                <form action="/contact.php"><!-- -->
                    <p>
                        <div class="text-center">
                            <label class="float-left" for="name">Naam:</label><br>
                            <input type="text" class="form-text" id="name" placeholder="Naam" name="name">
                        </div>
                        
                        <div class="text-center">
                            <label class="float-left" for="email">E-mail:</label><br>
                            <input  type="text" class="form-text" id="email" placeholder="E-mail" name="email">
                        </div>

                        <div class="text-center">
                            <label class="float-left" for="onderwerp">Onderwerp</label><br>
                            <input type="text" class="form-text" id="onderwerp" placeholder="Onderwerp" name="onderwerp">
                        </div>

                        <div class="text-center">
                            <label class="float-left" for="bericht">Bericht</label><br>
                            <textarea class="form-text" id="bericht" name="bericht" placeholder="Type hier je bericht" rows="5"></textarea>
                        </div>
                        <button type="submit" class="verzenden">Verzenden</button>
                    </p>
                </form>
            </div>
            <div class="col-md-5">
            </div>
        </div>
    </div> 
</body>
</html>