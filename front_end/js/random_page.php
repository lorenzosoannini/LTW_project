<?php
        $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());
        $q_max="select id from pubblicazioni where id >= all (select id from pubblicazioni)";
        $max_id_result=pg_query($dbconn,$q_max);
        $max_id=pg_fetch_result($max_id_result,0,0);
        $random_number=rand(0,$max_id);
        //echo "<h1> $random_number </h1>";

        $q_title="select titolo from pubblicazioni where id=$1 ";
        $title=pg_query_params($dbconn,$q_title,array($random_number));
        $title_=pg_fetch_result($title,0,0);
        //echo "<h1> $title_ </h1>";

        $q_autore="select autore from pubblicazioni where id=$1 ";
        $autore=pg_query_params($dbconn,$q_autore,array($random_number));
        $autore_=pg_fetch_result($autore,0,0);
        //echo "<h1> $autore_ </h1>";

        $q_annopub="select annopub from pubblicazioni where id=$1 ";
        $annopub=pg_query_params($dbconn,$q_annopub,array($random_number));
        $annopub_=pg_fetch_result($annopub,0,0);
        //echo "<h1> $annopub_ </h1>";

        $q_descrizione="select descrizione from pubblicazioni where id=$1 ";
        $descrizione=pg_query_params($dbconn,$q_descrizione,array($random_number));
        $descrizione_=pg_fetch_result($descrizione,0,0);
        //echo "<h1> $descrizione_ </h1>";

        $q_dipartimento="select dipartimento from pubblicazioni where id=$1 ";
        $dipartimento=pg_query_params($dbconn,$q_dipartimento,array($random_number));
        $dipartimento_=pg_fetch_result($dipartimento,0,0);
        //echo "<h1> $dipartimento_ </h1>";

    
        
        echo json_encode($title_);
        echo json_encode($autore_);
        echo json_encode($annopub_);
        echo json_encode($descrizione_);
        echo json_encode($dipartimento_);
        

        ?>