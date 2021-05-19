<html>
    <head>
    <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width initial-scale=1.0"/>
        <title>Ricerca | CURS - Centro Unico di Ricerca Sapienza</title>
        <link rel="icon" href="/front_end/assets/img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
        <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/mytopnav_style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="../js/topnav.js"></script>
        <link rel="stylesheet" href="../css/mystyle.css">
        <script type="text/javascript" src="../js/vue.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="../css/jquery-ui.css">
        <script type="text/javascript" src="../js/descPopUp.js"></script>
        <script type="text/javascript" src="../js/check_cookies.js"></script>
    </head>
    <body onload="setActiveTab()">
        <div id="header" name="Ricerca">
            <topheader></topheader>
        </div>
        <script type="text/javascript" src="../js/topheader.js"></script>

        <br>
        <br>

        <?php
            error_reporting(E_ALL ^ E_WARNING);
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
                $data = pg_query_params("SELECT titolo, autore, annopub, dipartimento, lingua, descrizione from pubblicazioni $where_clause", $non_null_params);

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
                        if($count % 2 == 0)
                            echo "  <tr class='table-default popup'>";
                        else
                            echo "  <tr class='table-danger popup'>";
                        echo "  <th scope='row'>$count</th>
                                <td style='display: none;'>
                                    <div class='popupText' title='Descrizione'>
                                        <p>" . $line['descrizione'] . "</p>
                                    </div>
                                </td>
                                <td>" . $line['titolo'] . "</td>
                                <td>" . $line['autore'] . "</td>";
                        if($line['annopub'] == -1)
                            echo "<td>" . "In corso" . "</td>";
                        else
                            echo "<td>" . $line['annopub'] . "</td>";

                        switch($line['dipartimento']){
                            case 'diap':
                                echo "<td>" . "Architettura e progetto" . "</td>";
                                break;
                            case 'dba':
                                echo "<td>" . "Biologia ambientale" . "</td>";
                                break;
                            case 'bbcd':
                                echo "<td>" . "Biologia e biotecnologie Charles Darwin" . "</td>";
                                break;
                            case 'chem':
                                echo "<td>" . "Chimica" . "</td>";
                                break;
                            case 'ctf':
                                echo "<td>" . "Chimica e tecnologie del farmaco" . "</td>";
                                break;
                            case 'chvaldoni':
                                echo "<td>" . "Chirurgia Pietro Valdoni" . "</td>";
                                break;
                            case 'dcgs':
                                echo "<td>" . "Chirurgia generale e specialistica Paride Stefanini" . "</td>";
                                break;
                            case 'coris':
                                echo "<td>" . "Comunicazione e ricerca sociale" . "</td>";
                                break;
                            case 'deap':
                                echo "<td>" . "Diritto ed economia delle attività produttive" . "</td>";
                                break;
                            case 'ecodir':
                                echo "<td>" . "Economia e diritto" . "</td>";
                                break;
                            case 'filosofia':
                                echo "<td>" . "Filosofia" . "</td>";
                                break;
                            case 'fisica':
                                echo "<td>" . "Fisica" . "</td>";
                                break;
                            case 'dff':
                                echo "<td>" . "Fisiologia e farmacologia Vittorio Erspamer" . "</td>";
                                break;
                            case 'di':
                                echo "<td>" . "Informatica" . "</td>";
                                break;
                            case 'diaee':
                                echo "<td>" . "Ingegneria astronautica, elettrica ed energetica" . "</td>";
                                break;
                            case 'dicma':
                                echo "<td>" . "Ingegneria chimica materiali ambiente" . "</td>";
                                break;
                            case 'dicea':
                                echo "<td>" . "Ingegneria civile, edile e ambientale" . "</td>";
                                break;
                            case 'diet':
                                echo "<td>" . "Ingegneria dell'informazione, elettronica e telecomunicazioni" . "</td>";
                                break;
                            case 'diag':
                                echo "<td>" . "Ingegneria informatica, automatica e gestionale Antonio Ruberti" . "</td>";
                                break;
                            case 'dima':
                                echo "<td>" . "Ingegneria meccanica e aerospaziale" . "</td>";
                                break;
                            case 'disg':
                                echo "<td>" . "Ingegneria strutturale e geotecnica" . "</td>";
                                break;
                            case 'diso':
                                echo "<td>" . "Istituto italiano di studi orientali - Iso" . "</td>";
                                break;
                            case 'lcm':
                                echo "<td>" . "Lettere e culture moderne" . "</td>";
                                break;
                            case 'management':
                                echo "<td>" . "Management" . "</td>";
                                break;
                            case 'mat':
                                echo "<td>" . "Matematica Guido Castelnuovo" . "</td>";
                                break;
                            case 'misu':
                                echo "<td>" . "Materno infantile e scienze urologiche" . "</td>";
                                break;
                            case 'dmcm':
                                echo "<td>" . "Medicina clinica e molecolare" . "</td>";
                                break;
                            case 'dmm':
                                echo "<td>" . "Medicina molecolare" . "</td>";
                                break;
                            case 'dms':
                                echo "<td>" . "Medicina sperimentale" . "</td>";
                                break;
                            case 'dmtp':
                                echo "<td>" . "Medicina traslazionale e di precisione" . "</td>";
                                break;
                            case 'memotef':
                                echo "<td>" . "Metodi e modelli per l'economia, il territorio e la finanza" . "</td>";
                                break;
                            case 'neuroscienze':
                                echo "<td>" . "Neuroscienze" . "</td>";
                                break;
                            case 'nesmos':
                                echo "<td>" . "Neuroscienze, salute mentale e organi di senso - Nesmos" . "</td>";
                                break;
                            case 'organidisenso':
                                echo "<td>" . "Organi di senso" . "</td>";
                                break;
                            case 'pdta':
                                echo "<td>" . "Pianificazione, design, tecnologia dell'architettura" . "</td>";
                                break;
                            case 'dippsi':
                                echo "<td>" . "Psicologia" . "</td>";
                                break;
                            case 'dip38':
                                echo "<td>" . "Psicologia dei processi di sviluppo e socializzazione" . "</td>";
                                break;
                            case 'dip42':
                                echo "<td>" . "Psicologia dinamica, clinica e salute" . "</td>";
                                break;
                            case 'dspmi':
                                echo "<td>" . "Sanità pubblica e malattie infettive" . "</td>";
                                break;
                            case 'saimlal':
                                echo "<td>" . "Scienze anatomiche, istologiche, medico-legali e dell'apparato locomotore" . "</td>";
                                break;
                            case 'dsb':
                                echo "<td>" . "Scienze biochimiche Alessandro Rossi Fanelli" . "</td>";
                                break;
                            case 'dscienzechir':
                                echo "<td>" . "Scienze chirurgiche" . "</td>";
                                break;
                            case 'sciac':
                                echo "<td>" . "Scienze cliniche internistiche, anestesiologiche e cardiovascolari" . "</td>";
                                break;
                            case 'antichita':
                                echo "<td>" . "Scienze dell'antichità" . "</td>";
                                break;
                            case 'dst':
                                echo "<td>" . "Scienze della Terra" . "</td>";
                                break;
                            case 'sbai':
                                echo "<td>" . "Scienze di base e applicate per l'ingegneria" . "</td>";
                                break;
                            case 'dsbmc':
                                echo "<td>" . "Scienze e biotecnologie medico-chirurgiche (Latina)" . "</td>";
                                break;
                            case 'scienzegiuridiche':
                                echo "<td>" . "Scienze giuridiche" . "</td>";
                                break;
                            case 'smcmt':
                                echo "<td>" . "Scienze medico-chirurgiche e medicina traslazionale" . "</td>";
                                break;
                            case 'odontoiatriamaxfacc':
                                echo "<td>" . "Scienze odontostomatologiche e maxillo facciali" . "</td>";
                                break;
                            case 'disp':
                                echo "<td>" . "Scienze politiche" . "</td>";
                                break;
                            case 'droap':
                                echo "<td>" . "Scienze radiologiche, oncologiche e anatomo-patologiche" . "</td>";
                                break;
                            case 'disse':
                                echo "<td>" . "Scienze sociali ed economiche" . "</td>";
                                break;
                            case 'dss':
                                echo "<td>" . "Scienze statistiche" . "</td>";
                                break;
                            case 'dsdra':
                                echo "<td>" . "Storia, disegno e restauro dell'architettura" . "</td>";
                                break;
                            case 'saras':
                                echo "<td>" . "Storia, antropologia, religioni, arte, spettacolo" . "</td>";
                                break;
                            case 'seai':
                                echo "<td>" . "Studi europei, americani e interculturali" . "</td>";
                                break;
                            case 'dsge':
                                echo "<td>" . "Studi giuridici ed economici" . "</td>";
                                break;
                            default:
                                echo "<td>" . $line['dipartimento'] . "</td>";
                        }
                            

                        if($line['lingua'] == 'it')
                            echo "<td>" . "Italiano" . "</td>";
                        else if($line['lingua'] == "en")
                            echo "<td>" . "Inglese" . "</td>";
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