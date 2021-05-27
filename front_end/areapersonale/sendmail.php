<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    <?php
        $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());
        $q1 = "select email from utente where nome = $1";
        $campo=$_POST['titolo'];
        $email = pg_query_params($dbconn, $q1, array($campo));
        $_email= pg_fetch_result($email, 0, 0);
        header("location: mailto:" . $_email . "?subject=" . $_POST['oggetto'] . "&body=" . $_POST['message']);
        echo    "<form id='myForm' action='index.html' method='get'>
                    <input type='hidden' name='loginError' value='1'>
                </form>
                <script type='text/javascript'>
                    document.getElementById('myForm').submit();
                </script>"; 
    ?>
    </body>
</html>