function checkEditForm(){
    if(document.getElementById("titolo").value == ""){
        document.getElementById("alert").innerHTML = "<div class='alert alert-danger d-flex align-items-center' role='alert'><svg class='bi flex-shrink-0 me-2' width='24' height='24'><use xlink:href='#exclamation-triangle-fill'/></svg><div>Selezionare prima una pubblicazione</div></div>";
        return false;
    }

    if(document.getElementById("desc").value == "" &&
       document.getElementById("dipartimento").value == "" &&
       document.getElementById("anno").value == ""){
        document.getElementById("alert").innerHTML = "<div class='alert alert-danger d-flex align-items-center' role='alert'><svg class='bi flex-shrink-0 me-2' width='24' height='24'><use xlink:href='#exclamation-triangle-fill'/></svg><div>Completa almeno un campo per effettuare la ricerca</div></div>";
        return false;
    }
    var anno = document.getElementById("anno").value;
    if(anno != "" && isNaN(anno)){
        document.getElementById("alert").innerHTML = "<div class='alert alert-danger d-flex align-items-center' role='alert'><svg class='bi flex-shrink-0 me-2' width='24' height='24'><use xlink:href='#exclamation-triangle-fill'/></svg><div>Inserire un anno valido</div></div>";
        return false;
    }
}

function checkNewForm(){
    if(document.getElementById("titoloAdd").value == "" ||
       document.getElementById("autoreAdd").value == "" ||
       document.getElementById("linguaAdd").value == "" ||
       document.getElementById("dipartimentoAdd").value == "" ||
       document.getElementById("descrizioneAdd").value == ""){
        document.getElementById("alert").innerHTML = "<div class='alert alert-danger d-flex align-items-center' role='alert'><svg class='bi flex-shrink-0 me-2' width='24' height='24'><use xlink:href='#exclamation-triangle-fill'/></svg><div>Completa tutti i campi</div></div>";
        return false;
    }

    if(document.getElementById("annoAdd").value == "" && document.getElementById("incorsoAdd").checked == false){
        document.getElementById("alert").innerHTML = "<div class='alert alert-danger d-flex align-items-center' role='alert'><svg class='bi flex-shrink-0 me-2' width='24' height='24'><use xlink:href='#exclamation-triangle-fill'/></svg><div>Inserisci l'anno di pubblicazione oppure seleziona la casella 'In corso'</div></div>";
        return false;
    }

    var anno = document.getElementById("annoAdd").value;
    if(anno != "" && isNaN(anno)){
        document.getElementById("alert").innerHTML = "<div class='alert alert-danger d-flex align-items-center' role='alert'><svg class='bi flex-shrink-0 me-2' width='24' height='24'><use xlink:href='#exclamation-triangle-fill'/></svg><div>Inserire un anno valido</div></div>";
        return false;
    }
}