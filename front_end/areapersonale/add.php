<?php
    $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());
    if(!(isset($_POST['addButton']))){ header("Location: ../index.html"); }
    else{
        $id_res = pg_query($dbconn, "SELECT max(id) FROM pubblicazioni");
        $id = null;
        if(!$id_res){
            echo "<div class='container'><h1>Qualcosa è andato storto</h1></div>";
        }
        else{
            $line = pg_fetch_array($id_res, null, PGSQL_ASSOC);
            $id = intval($line['max']) + 1;
        }

        $titolo = $_POST['titolo'];
        $autore = $_POST['autore'];
        $anno = $_POST['anno'];
        $descrizione = $_POST['descrizione'];
        $dipartimento = $_POST['dipartimento'];
        $lingua = $_POST['lingua'];

        $q = "INSERT INTO pubblicazioni VALUES( $1, $2, $3, $4, $5, $6, $7 )";
        $result = pg_query_params($dbconn, $q, array($id, $titolo, $autore, $anno, $descrizione, $dipartimento, $lingua));

        if(pg_affected_rows($result) == 0){
            echo "<div class='container'><h1>Qualcosa è andato storto</h1></div>";
        }
        else{
            echo "<form id='myForm' action='index.html' method='get'>
                    <input type='hidden' name='insertSuccess' value='1'>
                  </form>
                  <script type='text/javascript'>
                    document.getElementById('myForm').submit();
                  </script>";
        }

    }
    
?>