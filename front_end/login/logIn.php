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
                        $q2="select * from utente where email=$1";
                        $result2=pg_query_params($dbconn,$q2,array($email));
                        $nome=pg_fetch_result($result2,0,0);
                        $usertype=pg_fetch_result($result2,0,5);
                        $user = '{"username":"' . $nome . '", "usertype":' . $usertype . '}';
                        setcookie("user",$user,time()+999999,'/',NULL,0);
                        header("location: ../index.html");
                        }
                    
                    else{
                        echo "<form id='myForm' action='index.html' method='get'>
                                <input type='hidden' name='loginError' value='1'>
                              </form>
                              <script type='text/javascript'>
                                document.getElementById('myForm').submit();
                              </script>";
                    }
                }
                ?>
                </body>

</html>
            


