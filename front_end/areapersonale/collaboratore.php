<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Offcanvas template for Bootstrap</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/offcanvas/">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/offcanvas.css" rel="stylesheet">
    <script src="../js/areaPersonale.js"></script>
  </head>

  <body class="bg-light">
    <div class="container text-center">
      <h3>Benvenuto nella tua area personale</h3>
      <br>
      <button class="btn ms-3 me-3" style="background-color: #8400ff; color: white" type="button" data-bs-toggle="collapse" data-bs-target="#edit" aria-expanded="false" aria-controls="casual_page">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        Invia una richiesta di finanziamento
      </button>
    </div>
    <br>
    <div id="edit" class="collapse" data-bs-parent="#group">
      <div class="row justify-content-center text-center">
        <div class="col-8">
          <form action="sendmail.php" class="needs-validation" novalidate method="POST" name="myForm" style="visibility: visible;">
            <div class="row">
              <div class="mb-3">
              <?php
                $dbconn=pg_connect("host=localhost port=5432 dbname=centro_ricerca_unico user=postgres password=password") or die("errore di connessione".pg_last_error());
                $q1 = "select nome from utente where usertype=1";
                $titoli = pg_query($dbconn, $q1);
                if(!$titoli)
                  echo "<div class='container'><h1>Qualcosa è andato storto</h1></div>";
                else{
                  echo "<select class='form-select' id='titolo' name='titolo'>
                        <option value='' selected>Seleziona il ricercatore a cui inviarla</option>";
                  while($line = pg_fetch_array($titoli, null, PGSQL_ASSOC)){
                    echo "<option value=\"". $line['nome'] ."\">" . $line['nome'] . "</option>";
                  }
                  echo "</select>";
                }
              ?>
                <label for="ogetto">Oggetto dell'email</label>
                <input type="text" class="form-control" name="oggetto" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="Testo">Descrivi la richiesta <span class="text-muted"></span></label>
              <textarea class="form-control" name="message" required style="height: 300px;"></textarea>
            </div>
            <div class="text-center">
              <button class="button" type="submit" name="inviaButton"> <span> Invia </span> </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <main role="main" class="container">
      <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">I miei dati</h6>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
            <strong class="d-block text-gray-dark">Nome</strong>
            <a id="_nome" style="font-style: italic;">err</a>
          </p>
        </div>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
            <strong class="d-block text-gray-dark">Cognome</strong>
            <a id="_cognome" style="font-style: italic;">err</a>
          </p>
        </div>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <strong class="d-block text-gray-dark"  >Email</strong>
            <a id="_email" style="font-style: italic;">err</a>
          </p>
        </div>
        <div class="media text-muted pt-3">
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
              <strong class="d-block text-gray-dark"  >Codice identificativo</strong>
              <a id="_matricola" style="font-style: italic;">err</a>
            </p>
          </div>
      </div>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script src="offcanvas.js"></script>
  </body>
</html>
