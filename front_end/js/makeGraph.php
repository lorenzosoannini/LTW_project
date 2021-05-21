<?php
        $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());

        // $q1="select nome from utente where email=$1 ";
        // $nome=pg_query_params($dbconn,$q1,array($_email2));
        // $nome_=pg_fetch_result($nome,0,0);

        // $q2="select cognome from utente where email=$1 ";
        // $cognome=pg_query_params($dbconn,$q2,array($_email2));
        // $cognome_=pg_fetch_result($cognome,0,0);

        // $q3="select matricola from utente where email=$1 ";
        // $matricola=pg_query_params($dbconn,$q3,array($_email2));
        // $matricola_=pg_fetch_result($matricola,0,0);

        // echo json_encode($nome_,JSON_UNESCAPED_UNICODE);
        // echo json_encode($cognome_,JSON_UNESCAPED_UNICODE);
        // echo json_encode($_email2,JSON_UNESCAPED_UNICODE);
        // echo json_encode($matricola_,JSON_UNESCAPED_UNICODE);
        

        ?>