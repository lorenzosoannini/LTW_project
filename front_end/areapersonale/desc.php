<?php
    $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $titolo = $_POST['titolo'];
    $q = "select descrizione from pubblicazioni where autore like $1 and titolo = $2";
    $desc = pg_query_params($dbconn, $q, array("$nome $cognome", $titolo));
    if(!$desc){
        echo "<div class='container'><h1>Qualcosa è andato storto</h1></div>";
    }
    else{
        $line = pg_fetch_array($desc, null, PGSQL_ASSOC);
        echo $line['descrizione'];
    }
?>