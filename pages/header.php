<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Header</title>
    <link href=../css/headerfooter.css rel=stylesheet>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <!-- header base -->
    <div style="background-color:#005AAA;" class="container-fluid">
        <div class="row">
          <!-- Header logo -->
          <div class="col-md-3">
            <img src="../pictures/NHL_Stenden_Eropuit_Logo.png" alt="NHL Stenden Eropuit" id="logoheader">
          </div>
          <!-- Login gebruikersnaam template -->
          <div class="col-md-5">
            <p id="usernameheader">Hallo Stefan</p>
          </div>
          <!-- Knoppen naar andere pagina's -->
          <div class="col-md-4" id="buttoncontainerheader">
            <a href=activiteiten.php id="headerbutton">Activiteiten</a>
            <a href=login.php id="headerbutton">Inloggen</a>
            <a href=contact.php id="headerbutton">Contact</a>
            <!-- Taal wissel knop hier -->
          </div>
        </div>
    </div>
  </body>
</html>
