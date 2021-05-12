function disableAnno(){
    if(document.getElementById("incorso").checked == true){
        var anno = document.getElementById("anno");
        anno.disabled = true;
        anno.value = '';
        
    }
    else{
        document.getElementById("anno").disabled = false;
    }
}

function checkRicercaForm(){
    if(document.getElementById("titolo").value == "" &&
        document.getElementById("autore").value == "" &&
        document.getElementById("anno").value == "" &&
        document.getElementById("incorso").checked == false &&
        document.getElementById("lingua").value == "" &&
        document.getElementById("dipartimento").value == "" &&
        document.getElementById("parolachiave").value == ""){
        document.getElementById("alert").innerHTML = "<div class='alert alert-danger d-flex align-items-center' role='alert'><svg class='bi flex-shrink-0 me-2' width='24' height='24'><use xlink:href='#exclamation-triangle-fill'/></svg><div>Completa almeno un campo per effettuare la ricerca</div></div>";
        return false;
    }
    var anno = document.getElementById("anno").value;
    if(anno != "" && isNaN(anno)){
        document.getElementById("alert").innerHTML = "<div class='alert alert-danger d-flex align-items-center' role='alert'><svg class='bi flex-shrink-0 me-2' width='24' height='24'><use xlink:href='#exclamation-triangle-fill'/></svg><div>Inserire un anno valido</div></div>";
        return false;
    }
}