function disableAnno(){
    if(document.getElementById("incorso").checked == true){
        document.getElementById("anno").disabled = true;
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
        alert("Completa almeno un campo per effettuare la ricerca");
        return false;
    }
    var anno = document.getElementById("anno").value;
    if(anno != "" && isNaN(anno)){
        alert("Inserire un anno valido");
        return false;
    }
}