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
                $columns = array("titolo"=>$_POST['titolo'], "autore"=>$_POST['autore'], "annopub"=>$_POST['anno'], "descrizione"=>$_POST['parolachiave'], "dipartimento"=>$_POST['dipartimento'], "lingua"=>$_POST['lingua']);
                if(isset($_POST['incorso']))
                    $columns['annopub'] = -1;

                $clauses = array();
                $non_null_params = array();
                $param_index=1;
                foreach ($columns as $name=>$value) {
                    if ($value !== null && $value !== '') {
                        if($name === 'annopub' || $name === 'lingua' || $name === 'dipartimento'){
                            $clauses[] = "$name=\${$param_index}";
                            $param_index++;
                            $non_null_params[] = $value;
                        }
                        else{
                            $clauses[] = "$name LIKE \${$param_index}";
                            $param_index++;
                            $non_null_params[] = "%$value%";
                        }
                    }
                }
                $where_clause = "WHERE " . implode(" AND ", $clauses);

                echo $where_clause;
                echo "<br>";
                foreach($non_null_params as $name=>$value){
                    echo $name . "= " . $value;
                }

                $data = pg_query_params("SELECT titolo, autore, annopub, dipartimento, lingua from pubblicazioni $where_clause", $non_null_params);

                if($data){
                    echo "<h3>SONO DENTRO L'IF(DATA)</h3>";
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
                                <td>" . $line['annopub'] . "</td>
                                <td>" . $line['dipartimento'] . "</td>
                                <td>" . $line['lingua'] . "</td>";
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