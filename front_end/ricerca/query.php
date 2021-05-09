<html>
    <head>
    <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width initial-scale=1.0"/>
        <title>Ricerca | CURS - Centro Unico di Ricerca Sapienza</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../css/mytopnav_style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="../js/topnav.js"></script>
        <link rel="stylesheet" href="../css/mystyle.css">
        <script type="text/javascript" src="../js/vue.min.js"></script>
    </head>
    <body onload="setActiveTab()">
        <div id="header" name="Ricerca">
            <topheader></topheader>
        </div>
        <script type="text/javascript" src="../js/topheader.js"></script>

        <br>
        <br>

        <?php
            $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());
            if(!(isset($_POST['ricercaButton']))){ header("Location: index.html"); }
            else{
                if(isset($_POST['titolo']))
                    $titolo = $_POST['titolo'];
                else
                    $titolo = '';
                if(isset($_POST['autore']))
                    $autore = $_POST['autore'];
                else
                    $autore = '';
                if(isset($_POST['anno']))
                    $anno = intval($_POST['anno']);
                else
                    $anno = 'is not null';
                if(isset($_POST['lingua']))
                    $lingua = $_POST['lingua'];
                else
                    $lingua = 'is not null';
                if(isset($_POST['dipartimento']))
                    $dipartimento = $_POST['dipartimento'];
                else
                    $dipartimento = 'is not null';
                if(isset($_POST['parolachiave']))
                    $parolachiave = $_POST['parolachiave'];
                else
                    $parolachiave = '';

                $q = "select titolo, autore, annopub, dipartimento, lingua from pubblicazioni where titolo like $1 and autore like $2 and annopub = $3 and lingua = $4 and dipartimento = $5 and descrizione like $6";
                if($anno == 'is not null')
                    str_replace('annopub =', 'annopub ', $q);
                if($lingua == 'is not null')
                    str_replace('lingua =', 'lingua ', $q);
                if($dipartimento == 'is not null')
                    str_replace('dipartimento =', 'dipartimento ', $q);
                
                $params = array("%$titolo%", "%$autore%", $anno, $lingua, $dipartimento, "%$parolachiave%");
                $data = pg_query_params($dbconn, $q, $params);
                if($data){
                    echo "<div class='container'>
                            <table class='table'>
                            <thead>
                                <tr>
                                    <th scope='col'>#</th>
                                    <th scope='col'>Titolo</th>
                                    <th scope='col'>Autore</th>
                                    <th scope='col'>Anno</th>
                                    <th scope='col'>Dipartimento</th>
                                    <th scope='col'>Lingua</th>
                                </tr>
                            </thead>
                            <tbody>";
                    $count = 0;
                    while($line = pg_fetch_array($data, null, PGSQL_ASSOC)){
                        $count += 1;
                        echo "  <tr>
                                <th scope='row'>$count</th>
                                <td>" . $line['titolo'] . "</td>
                                <td>" . $line['autore'] . "</td>
                                <td>" . $colvalue['annopub'] . "</td>
                                <td>" . $colvalue['dipartimento'] . "</td>
                                <td>" . $colvalue['lingua'] . "</td>";
                    }
                    
                    echo "  </tbody>
                            </table>
                          </div>";
                }
                else{
                    echo "<div class='container'><h1>Qualcosa è andato storto</h1></div>";
                }
            }
            pg_free_result($data);
            pg_close($dbconn);
        ?>
    </body>
</html>