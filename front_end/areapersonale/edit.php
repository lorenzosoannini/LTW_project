<?php
    $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());
    if(!(isset($_POST['editButton']))){ header("Location: ../index.html"); }
    else{
        $titolo = $_POST['titolo'];
        $columns = array("annopub"=>$_POST['anno'], "descrizione"=>$_POST['descrizione'], "dipartimento"=>$_POST['dipartimento']);
        $clauses = array();
        $non_null_params = array();
        $param_index=1;
        foreach ($columns as $name=>$value) {
            if ($value !== null && $value !== '') {               
                $clauses[] = "$name=\${$param_index}";
                $param_index++;
                $non_null_params[] = $value;
            }
        }
        $set_clause = "SET " . implode(", ", $clauses);
        $titolo = pg_escape_literal($titolo);
        $result = pg_query_params("UPDATE pubblicazioni $set_clause WHERE titolo = $titolo", $non_null_params);

        if(pg_affected_rows($result) == 0){
            echo "<div class='container'><h1>Qualcosa è andato storto</h1></div>";
        }
        else{
            echo "<form id='myForm' action='index.html' method='get'>
                    <input type='hidden' name='updateSuccess' value='1'>
                  </form>
                  <script type='text/javascript'>
                    document.getElementById('myForm').submit();
                  </script>";
        }

    }
    
?>