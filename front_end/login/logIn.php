<html>
    <body>
        <?php
                $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());
                if(!(isset($_POST['logInButton']))){ header("Location: ../index.html"); }   /*controllo se è stato premuto signupbutton (header reindirizza)*/
                else{
                    $email= $_POST['inputEmail'];
                    $password=md5($_POST['inputLogInPassword']);
                    $q1="select * from utente where email= $1 and password= $2";
                    $result=pg_query_params($dbconn,$q1,array($email,$password));
                    if($line=pg_fetch_array($result,null,PGSQL_ASSOC)){
                        $q2="select nome from utente where email=$1";
                        $result2=pg_query_params($dbconn,$q2,array($email));
                        $nome=pg_fetch_result($result2,0,0);
                        setcookie("username",$nome,time()+999999);
                        header("location: ../index.html");
                        }
                    
                    else{
                        echo "<h1>Email o password sbagliati<h1>
                        <a href=../signup/index.html> Clicca qui per registrarti </a>";
                    }
                }
                ?>
                </body>

</html>
            


