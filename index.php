<?php
session_start();
require_once('utilities/dataStoreUtil.php');
// Haalt de data uit data.json
$file = 'datastores/activities2.json';
$activities = getCategories($file);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studentenplatform</title>
    <link href=css/styles.css rel=stylesheet>
    <link href=css/headerfooter.css rel=stylesheet>
    <link rel="stylesheet" href="css/activiteiten.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

    <!-- Translation button script -->
    <!-- Code provided by google -->
    <script type="text/javascript">
        function googleTranslateElementInit2() {
            new google.translate.TranslateElement({
                pageLanguage: 'nl',
                autoDisplay: false
            }, 'google_translate_element2');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>

    <!-- Translation button handler -->
    <script type="text/javascript">
        eval(function(p, a, c, k, e, r) {
            e = function(c) {
                return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
            };
            if (!''.replace(/^/, String)) {
                while (c--) r[e(c)] = k[c] || e(c);
                k = [function(e) {
                    return r[e]
                }];
                e = function() {
                    return '\\w+'
                };
                c = 1
            }
            while (c--)
                if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
            return p
        }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}', 43, 43, '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'), 0, {}))
    </script>
</head>

<body>
    <!-- header base -->
    <div id="headerbase" class="container-fluid mb-5">
        <div class="row">
            <!-- Header logo -->
            <div class="col-md-3 align-self-center">
                <img src="pictures/NHL_Stenden_Eropuit_Logo.png" alt="NHL Stenden Eropuit" id="logoheader">
            </div>
            <!-- Login gebruikersnaam placeholder -->
            <div class="col-md-4 align-self-center">
                <?php
                if (isset($_SESSION['name'])) {
                    echo '<p id="usernameheader">Welkom, <span class="blue text-capitalize">' . $_SESSION['name'] . '</span></p>';
                }
                ?>
            </div>
            <!-- Knoppen naar andere pagina's -->
            <div class="col-md-5 headerKnoppenContainer">
                <div id="buttoncontainerheader">
                    <a href=index.php class="headerbutton active">Activiteiten</a>
                    <?php
                    if (isset($_SESSION['name'])) {
                        echo '<a href="utilities/logout.php" class="headerbutton">Uitloggen</a>';
                    } else {
                        echo '<a href="pages/login.php" class="headerbutton">Inloggen</a>';
                    }

                    if (isset($_SESSION['name']) && $_SESSION['role'] == 'admin') {
                        echo '<a href="pages/adminPanel.php" class="headerbutton">Activiteit Toevoegen</a>';
                    }
                    ?>
                    <a href=pages/contact.php class="headerbutton">Contact</a>

                    <!-- Language Switch button -->
                    <div id="google_translate_element2" style="display:none">
                    </div>

                    <a href="#" onclick="doGTranslate('nl|en');return false;" title="English">
                        <img src="pictures/flags/UK_flag.jpg" id="langflag" alt="English" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Header end -->

    <!-- content -->
    <div class="container">
        <div class="row text-center">
            <?php
            foreach ($activities as $key => $item) {
            ?>
                <div class="col-md-4">
                    <div class="kaartje row <?php echo $item->color ?>">
                        <div class="content p-0">
                            <div class="col-md-12 rowOne">
                                <img class="img-fluid" src="<?php echo $item->homeImage; ?>" alt="<?php echo $item->title; ?>">
                            </div>
                            <div class="col-md-12 rowTwo">
                                <b>
                                    <h3 class="text-start"><?php echo $item->title; ?></h3>
                                </b>
                            </div>
                            <div class="col-md-12 rowThree">
                                <p class="text-start"><?php echo $item->description; ?></p>
                            </div>
                            <div class="col-md-12 text-end p-4 rowFour">
                                <a href="<?php echo $item->link; ?>"><button class="button inschrijfKnop">Inschrijven</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
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