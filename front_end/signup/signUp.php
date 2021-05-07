<html>
    <body>
        <?php
                $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());
                if(!(isset($_POST['signUpButton']))){ header("Location: ../index.html"); }   /*controllo se è stato premuto signupbutton (header reindirizza)*/
                else{
                    $email= $_POST['inputEmail'];
                    $q1="select * from utente where email= $1";
                    $result=pg_query_params($dbconn,$q1,array($email));
                    if($line=pg_fetch_array($result,null,PGSQL_ASSOC)){
                        echo "<h1> Sei già registrato al nostro sito<h1>
                        <a href=../login/index.html> Clicca qui per accedere </a>";
                    }
                    else{
                        $name=$_POST['inputName'];
                        $surname=$_POST['inputSurname'];
                        $matricola=$_POST['inputMatricola'];
                        $password=$_POST['inputSignUpPassword'];
                        $q2="insert into utente values ($1,$2,$3,$4,$5)";
                        $data=pg_query_params($dbconn,$q2, array($name,$surname,$matricola,$email,$password));
                        if($data){                                                                              /*in $data è stato inserito un valore di ritorno booleano*/
                            echo "<h1>Registrazione completata, </h1> <a href=../index.html> clicca qui </a> <h1> per tornare al nostro sito</h1>";
                        }
                        else{
                            echo "<h1>Qualcosa è andato storto </h1>";
                        }
                    }
                }
                ?>
                </body>

</html>
            


