<!DOCTYPE html>
<html>
    <head>
        <script src="../js/areaPersonale.js"></script>
        <script type="text/javascript">
            function loadDesc(nome, cognome){
                var titolo = $("#titolo option:selected").text();
                if(titolo == "Seleziona la pubblicazione da modificare")
                    $("#desc").html("");
                else
                    $("#desc").load("desc.php", { 'nome': nome, 'cognome': cognome, 'titolo': titolo });
                
            }

            function disableAnno(){
                if(document.getElementById("incorsoAdd").checked == true){
                    var anno = document.getElementById("annoAdd");
                    anno.disabled = true;
                    anno.value = '';
                    
                }
                else{
                    document.getElementById("annoAdd").disabled = false;
                }
            }

            $(document).ready(function() {
                var user = getCookie("user");
                if (user != "") {
                    var userobj = JSON.parse(user);
                    var username = userobj.username.trim();
                    var surname = userobj.surname.trim();

                    $("#autoreAdd").val(username+ " " + surname);
                }
            });
        </script>
        <script type="text/javascript" src="../js/checkPersonalAreaForms.js"></script>
    </head>
    <body>
        <div class="container text-center">
            <h3>Benvenuto nella tua area personale</h3>
            <h5>Qui puoi gestire le tue pubblicazioni o aggiungerne di nuove</h5>
            <br>
            
            <button class="btn ms-3 me-3" style="background-color: #FF8000; color: white" type="button" data-bs-toggle="collapse" data-bs-target="#edit" aria-expanded="false" aria-controls="casual_page">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                Modifica una pubblicazione
            </button>

            <button class="btn btn-success ms-3 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#add" aria-expanded="false" aria-controls="casual_page">
                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                Aggiungi una pubblicazione
            </button>
            
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>
            <br>   
            <div id="alert" class="mt-4" style="display: inline-block"></div>
            <script type="text/javascript">
                var url_string = window.location.href;
                var url = new URL(url_string);
                var err = url.searchParams.get("updateSuccess");
                if(err)
                    document.getElementById("alert").innerHTML = "<div class='alert alert-success d-flex align-items-center' role='alert'><svg class='bi flex-shrink-0 me-2' width='24' height='24'><use xlink:href='#check-circle-fill'/></svg><div>Modifica avvenuta con successo</div></div>";
                
                var err = url.searchParams.get("insertSuccess");
                if(err)
                    document.getElementById("alert").innerHTML = "<div class='alert alert-success d-flex align-items-center' role='alert'><svg class='bi flex-shrink-0 me-2' width='24' height='24'><use xlink:href='#check-circle-fill'/></svg><div>Inserimento avvenuto con successo</div></div>";
            
            </script>

            <div id="group">
            <div id="edit" class="collapse" data-bs-parent="#group">
                <div class="card card-body mt-4">
                    <form class="needs-validation" action="edit.php" novalidate method="POST" id="editForm" onsubmit="return checkEditForm()">
                        <div class="row">
                            <div class="col mb-3">
                                <?php
                                    $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());
                                    $user_array = json_decode($_COOKIE['user'], true);
                                    $nome = str_replace(' ', '', $user_array['username']);
                                    $cognome = str_replace(' ', '', $user_array['surname']);

                                    $q1 = "select titolo from pubblicazioni where autore like $1";
                                    $titoli = pg_query_params($dbconn, $q1, array("%$nome $cognome%"));
                                    if(!$titoli)
                                        echo "<div class='container'><h1>Qualcosa è andato storto</h1></div>";
                                    else{
                                        echo "<select class='form-select' id='titolo' name='titolo' onchange='loadDesc(".json_encode($nome).", ".json_encode($cognome).")'>
                                                <option value='' selected>Seleziona la pubblicazione da modificare</option>";
                                        while($line = pg_fetch_array($titoli, null, PGSQL_ASSOC)){
                                            echo "<option value=\"". $line['titolo'] ."\">" . $line['titolo'] . "</option>";
                                        }
                                        echo "</select>";
                                    }


                                ?>
                            </div>

                            <div class="col mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">Descrizione</span>
                                    <textarea class="form-control" aria-label="Descrizione" form="editForm" name="descrizione" id="desc"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="dipartimento" class="form-label">Dipartimento</label>
                                <select class="form-select form-control" id="dipartimento" name="dipartimento">
                                    <option selected></option>
                                    <option value="diap">Architettura e progetto</option>
                                    <option value="dba">Biologia ambientale</option>
                                    <option value="bbcd">Biologia e biotecnologie Charles Darwin</option>
                                    <option value="chem">Chimica</option>
                                    <option value="ctf">Chimica e tecnologie del farmaco</option>
                                    <option value="chvaldoni">Chirurgia Pietro Valdoni</option>
                                    <option value="dcgs">Chirurgia generale e specialistica Paride Stefanini</option>
                                    <option value="coris">Comunicazione e ricerca sociale</option>
                                    <option value="deap">Diritto ed economia delle attività produttive</option>
                                    <option value="ecodir">Economia e diritto</option>
                                    <option value="filosofia">Filosofia</option>
                                    <option value="fisica">Fisica</option>
                                    <option value="dff">Fisiologia e farmacologia Vittorio Erspamer</option>
                                    <option value="di">Informatica</option>
                                    <option value="diaee">Ingegneria astronautica, elettrica ed energetica</option>
                                    <option value="dicma">Ingegneria chimica materiali ambiente</option>
                                    <option value="dicea">Ingegneria civile, edile e ambientale</option>
                                    <option value="diet">Ingegneria dell'informazione, elettronica e telecomunicazioni</option>
                                    <option value="diag">Ingegneria informatica, automatica e gestionale Antonio Ruberti</option>
                                    <option value="dima">Ingegneria meccanica e aerospaziale</option>
                                    <option value="disg">Ingegneria strutturale e geotecnica</option>
                                    <option value="diso">Istituto italiano di studi orientali - Iso</option>
                                    <option value="lcm">Lettere e culture moderne</option>
                                    <option value="management">Management</option>
                                    <option value="mat">Matematica Guido Castelnuovo</option>
                                    <option value="misu">Materno infantile e scienze urologiche</option>
                                    <option value="dmcm">Medicina clinica e molecolare</option>
                                    <option value="dmm">Medicina molecolare</option>
                                    <option value="dms">Medicina sperimentale</option>
                                    <option value="dmtp">Medicina traslazionale e di precisione</option>
                                    <option value="memotef">Metodi e modelli per l'economia, il territorio e la finanza</option>
                                    <option value="neuroscienze">Neuroscienze umane</option>
                                    <option value="nesmos">Neuroscienze, salute mentale e organi di senso - Nesmos</option>
                                    <option value="organidisenso">Organi di senso</option>
                                    <option value="pdta">Pianificazione, design, tecnologia dell'architettura</option>
                                    <option value="dippsi">Psicologia</option>
                                    <option value="dip38">Psicologia dei processi di sviluppo e socializzazione</option>
                                    <option value="dip42">Psicologia dinamica, clinica e salute</option>
                                    <option value="dspmi">Sanità pubblica e malattie infettive</option>
                                    <option value="saimlal">Scienze anatomiche, istologiche, medico-legali e dell'apparato locomotore</option>
                                    <option value="dsb">Scienze biochimiche Alessandro Rossi Fanelli</option>
                                    <option value="dscienzechir">Scienze chirurgiche</option>
                                    <option value="sciac">Scienze cliniche internistiche, anestesiologiche e cardiovascolari</option>
                                    <option value="antichita">Scienze dell'antichità</option>
                                    <option value="dst">Scienze della Terra</option>
                                    <option value="sbai">Scienze di base e applicate per l'ingegneria</option>
                                    <option value="dsbmc">Scienze e biotecnologie medico-chirurgiche (Latina)</option>
                                    <option value="scienzegiuridiche">Scienze giuridiche</option>
                                    <option value="smcmt">Scienze medico-chirurgiche e medicina traslazionale</option>
                                    <option value="odontoiatriamaxfacc">Scienze odontostomatologiche e maxillo facciali</option>
                                    <option value="disp">Scienze politiche</option>
                                    <option value="droap">Scienze radiologiche, oncologiche e anatomo-patologiche</option>
                                    <option value="disse">Scienze sociali ed economiche</option>
                                    <option value="dss">Scienze statistiche</option>
                                    <option value="dsdra">Storia, disegno e restauro dell'architettura</option>
                                    <option value="saras">Storia, antropologia, religioni, arte, spettacolo</option>
                                    <option value="seai">Studi europei, americani e interculturali</option>
                                    <option value="dsge">Studi giuridici ed economici</option>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label for="annopub" class="form-label">Anno pubblicazione</label>
                                <input type="text" class="form-control" id="anno" name="anno">
                            </div>
                        </div>

                        <br>
                        <div class="text-center">
                            <button class="button" type="submit" name="editButton"> <span> Modifica </span> </button>
                        </div>

                    </form>
                </div>
            </div>

            <div id="add" class="collapse" data-bs-parent="#group">
                <div class="card card-body mt-4">
                <form class="needs-validation" action="add.php" novalidate method="POST" id="addForm" onsubmit="return checkNewForm()">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="titolo" class="form-label">Titolo</label>
                            <input type="text" class="form-control" id="titoloAdd" name="titolo">
                        </diV>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="autore" class="form-label">Autore(i)</label>
                            <input type="text" class="form-control" id="autoreAdd" name="autore">
                        </diV>
                        <div class="col mb-3">
                            <label for="anno" class="form-label">Anno</label>
                            <input type="text" class="form-control" id="annoAdd" name="anno">
                        </div>
                        <div class="col mb-3" style="display: inline-block; margin-top: 40px;">
                            <input class="form-check-input" type="checkbox" value="-1" id="incorsoAdd" name="anno" onclick="disableAnno();">
                            <label class="form-check-label" for="incorso">In corso</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <div class="input-group">
                                <span class="input-group-text">Descrizione</span>
                                <textarea class="form-control" aria-label="Descrizione" form="addForm" id="descrizioneAdd" name="descrizione"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="dipartimento" class="form-label">Dipartimento</label>
                            <select class="form-select form-control" id="dipartimentoAdd" name="dipartimento">
                                <option selected></option>
                                <option value="diap">Architettura e progetto</option>
                                <option value="dba">Biologia ambientale</option>
                                <option value="bbcd">Biologia e biotecnologie Charles Darwin</option>
                                <option value="chem">Chimica</option>
                                <option value="ctf">Chimica e tecnologie del farmaco</option>
                                <option value="chvaldoni">Chirurgia Pietro Valdoni</option>
                                <option value="dcgs">Chirurgia generale e specialistica Paride Stefanini</option>
                                <option value="coris">Comunicazione e ricerca sociale</option>
                                <option value="deap">Diritto ed economia delle attività produttive</option>
                                <option value="ecodir">Economia e diritto</option>
                                <option value="filosofia">Filosofia</option>
                                <option value="fisica">Fisica</option>
                                <option value="dff">Fisiologia e farmacologia Vittorio Erspamer</option>
                                <option value="di">Informatica</option>
                                <option value="diaee">Ingegneria astronautica, elettrica ed energetica</option>
                                <option value="dicma">Ingegneria chimica materiali ambiente</option>
                                <option value="dicea">Ingegneria civile, edile e ambientale</option>
                                <option value="diet">Ingegneria dell'informazione, elettronica e telecomunicazioni</option>
                                <option value="diag">Ingegneria informatica, automatica e gestionale Antonio Ruberti</option>
                                <option value="dima">Ingegneria meccanica e aerospaziale</option>
                                <option value="disg">Ingegneria strutturale e geotecnica</option>
                                <option value="diso">Istituto italiano di studi orientali - Iso</option>
                                <option value="lcm">Lettere e culture moderne</option>
                                <option value="management">Management</option>
                                <option value="mat">Matematica Guido Castelnuovo</option>
                                <option value="misu">Materno infantile e scienze urologiche</option>
                                <option value="dmcm">Medicina clinica e molecolare</option>
                                <option value="dmm">Medicina molecolare</option>
                                <option value="dms">Medicina sperimentale</option>
                                <option value="dmtp">Medicina traslazionale e di precisione</option>
                                <option value="memotef">Metodi e modelli per l'economia, il territorio e la finanza</option>
                                <option value="neuroscienze">Neuroscienze umane</option>
                                <option value="nesmos">Neuroscienze, salute mentale e organi di senso - Nesmos</option>
                                <option value="organidisenso">Organi di senso</option>
                                <option value="pdta">Pianificazione, design, tecnologia dell'architettura</option>
                                <option value="dippsi">Psicologia</option>
                                <option value="dip38">Psicologia dei processi di sviluppo e socializzazione</option>
                                <option value="dip42">Psicologia dinamica, clinica e salute</option>
                                <option value="dspmi">Sanità pubblica e malattie infettive</option>
                                <option value="saimlal">Scienze anatomiche, istologiche, medico-legali e dell'apparato locomotore</option>
                                <option value="dsb">Scienze biochimiche Alessandro Rossi Fanelli</option>
                                <option value="dscienzechir">Scienze chirurgiche</option>
                                <option value="sciac">Scienze cliniche internistiche, anestesiologiche e cardiovascolari</option>
                                <option value="antichita">Scienze dell'antichità</option>
                                <option value="dst">Scienze della Terra</option>
                                <option value="sbai">Scienze di base e applicate per l'ingegneria</option>
                                <option value="dsbmc">Scienze e biotecnologie medico-chirurgiche (Latina)</option>
                                <option value="scienzegiuridiche">Scienze giuridiche</option>
                                <option value="smcmt">Scienze medico-chirurgiche e medicina traslazionale</option>
                                <option value="odontoiatriamaxfacc">Scienze odontostomatologiche e maxillo facciali</option>
                                <option value="disp">Scienze politiche</option>
                                <option value="droap">Scienze radiologiche, oncologiche e anatomo-patologiche</option>
                                <option value="disse">Scienze sociali ed economiche</option>
                                <option value="dss">Scienze statistiche</option>
                                <option value="dsdra">Storia, disegno e restauro dell'architettura</option>
                                <option value="saras">Storia, antropologia, religioni, arte, spettacolo</option>
                                <option value="seai">Studi europei, americani e interculturali</option>
                                <option value="dsge">Studi giuridici ed economici</option>
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="lingua" class="form-label">Lingua</label>
                            <select class="form-select form-control" id="linguaAdd" name="lingua">
                                <option selected></option>
                                <option value="it">Italiano</option>
                                <option value="en">Inglese</option>
                            </select>
                        </div>
                    </div>

                    <br>
                    <div class="text-center">
                        <button class="button" type="submit" name="addButton"> <span> Aggiungi </span> </button>
                    </div>
                </form>
                </div>
            </div>
            </div>

        </div>
    
    <main role="main" class="container">
      <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">I miei dati</h6>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
            <strong class="d-block text-gray-dark">Nome</strong>
            <a id="_nome" style="font-style: italic;">Qui c'è il nome err</a>
          </p>
        </div>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
            <strong class="d-block text-gray-dark">Cognome</strong>
            <a id="_cognome" style="font-style: italic;">err</a>
          </p>
        </div>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <strong class="d-block text-gray-dark"  >Email</strong>
            <a id="_email" style="font-style: italic;">err</a>
          </p>
        </div>
        <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
              <strong class="d-block text-gray-dark"  >Codice identificativo</strong>
              <a id="_matricola" style="font-style: italic;">err</a>
            </p>
          </div>
      </div>
    </main>    
    
    
    </body>
</html>