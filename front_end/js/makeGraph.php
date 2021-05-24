<?php
        $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());

        $q1="   select dipartimento, count(*) as num 
                from pubblicazioni 
                group by dipartimento order by num limit 5";
        $ris=pg_query($dbconn,$q1);

        $quinta=pg_fetch_result($ris,0,0);
        $n_quinta=pg_fetch_result($ris,0,1);

        $quarta=pg_fetch_result($ris,1,0);
        $n_quarta=pg_fetch_result($ris,1,1);

        $terza=pg_fetch_result($ris,2,0);
        $n_terza=pg_fetch_result($ris,2,1);
        
        $seconda=pg_fetch_result($ris,3,0);
        $n_seconda=pg_fetch_result($ris,3,1);
        
        $prima=pg_fetch_result($ris,4,0);
        $n_prima=pg_fetch_result($ris,4,1);

        echo json_encode($quinta,JSON_UNESCAPED_UNICODE);
        echo json_encode($n_quinta,JSON_UNESCAPED_UNICODE);
        echo json_encode($quarta,JSON_UNESCAPED_UNICODE);
        echo json_encode($n_quarta,JSON_UNESCAPED_UNICODE);
        echo json_encode($terza,JSON_UNESCAPED_UNICODE);
        echo json_encode($n_terza,JSON_UNESCAPED_UNICODE);
        echo json_encode($seconda,JSON_UNESCAPED_UNICODE);
        echo json_encode($n_seconda,JSON_UNESCAPED_UNICODE);
        echo json_encode($prima,JSON_UNESCAPED_UNICODE);
        echo json_encode($n_prima,JSON_UNESCAPED_UNICODE);
        

        ?>