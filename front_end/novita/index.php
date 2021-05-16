<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width initial-scale=1.0"/>
        <title>Novità | CURS - Centro Unico di Ricerca Sapienza</title>
        <link rel="icon" href="/front_end/assets/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../css/mytopnav_style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="../js/topnav.js"></script>
        <link rel="stylesheet" href="../css/mystyle.css">
        <link rel="stylesheet" href="../css/timeline.css">
        <script type="text/javascript" src="../js/vue.min.js"></script>
    </head>
    <body onload="setActiveTab()">
        <div id="header" name="Novità">
            <topheader></topheader>
        </div>
        <script type="text/javascript" src="../js/topheader.js"></script>

        <br>
        <div class="container text-center">
            <h2>Scopri le ultime pubblicazioni Sapienza</h2>
            <section class="timeline">
                <ul>
                    <?php
                        $dbconn = pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());
                        $q = "select * from pubblicazioni order by annopub desc limit 6";
                        $data = pg_query($dbconn, $q);
                        if($data){
                            while($line = pg_fetch_array($data, null, PGSQL_ASSOC)){
                                echo "<li>
                                        <div>
                                            <time>". $line['annopub'] . "</time><p class='boxtitle'>" . $line['titolo'] . "</p><p>" . $line['descrizione'] . "</p>
                                        </div>
                                      </li>";
                            }
                        }
                        else{
                            echo "<div class='container'><h1>Qualcosa è andato storto</h1></div>";
                        }

                    ?>
                </ul>
            </section>

            <script type="text/javascript">
                (function () {
                    "use strict";

                    // define variables
                    var items = document.querySelectorAll(".timeline li");

                    // check if an element is in viewport
                    function isElementInViewport(el) {
                        var rect = el.getBoundingClientRect();
                        return (
                        rect.top >= 0 &&
                        rect.left >= 0 &&
                        rect.bottom <=
                            (window.innerHeight || document.documentElement.clientHeight) &&
                        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                        );
                    }

                    function callbackFunc() {
                        for (var i = 0; i < items.length; i++) {
                        if (isElementInViewport(items[i])) {
                            items[i].classList.add("in-view");
                        }
                        }
                    }

                    // listen for events
                    window.addEventListener("load", callbackFunc);
                    window.addEventListener("resize", callbackFunc);
                    window.addEventListener("scroll", callbackFunc);
                    })();

            </script>

        </div>

        <br>
        <br>
        <nav class="container">
            <a href="https://www.uniroma1.it/it/pagina-strutturale/contatti">Contatti</a> |
            <a href="https://www.uniroma1.it/it/pagina/settore-urp-rapporti-con-il-pubblico">URP</a> |
            <a href="https://www.uniroma1.it/it/pagina/settore-ufficio-stampa-e-comunicazione">Media</a> |
        </nav>
        <div class="bottombar">
            <div class="container">
                <p>
                    © Sapienza Università di Roma - Piazzale Aldo Moro 5, 00185 Roma - (+39) 06 49911 - CF 80209930587 PI 02133771002
                </p>
                <a href="#" class="btn-floating btn-large fixed-action-btn smooth-scroll float-end">
                    <i class="fa fa-arrow-up"></i>
                </a>
            </div>
        </div>
    </body>
</html>