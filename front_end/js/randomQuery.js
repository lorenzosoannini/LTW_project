function loadNewQuery(){
    if(document.getElementById("casual_page").getAttribute("odd") == 'true'){
        document.getElementById("casual_page").setAttribute("odd", 'false');

        document.getElementById("descrizione").innerHTML="";
        function reqListener () {
        console.log(this.responseText);
        }
        var oReq = new XMLHttpRequest();
        oReq.onload = function() {
            var testo=this.responseText;
            var testo2=testo.replace(/\"/g,'§');
            var testo3=testo2.split("§"); //array
            document.getElementById("titolo").innerHTML=testo3[1];
            document.getElementById("autore").innerHTML=testo3[3];
            document.getElementById("descrizione").innerHTML=testo3[7];
            //document.getElementById("titolo_").innerHTML=testo3[1];
        };
        oReq.open("get", "js/random_page.php", true);                       
        oReq.send();
    }
    else{
        document.getElementById("casual_page").setAttribute("odd", 'true');
    }
}
var oReq = new XMLHttpRequest();

var f = function() {
    var testo=this.responseText;
    var testo2=testo.replace(/\"/g,'§');
    var testo3=testo2.split("§"); //array
    document.getElementById("titolo").innerHTML=testo3[1];
    document.getElementById("autore").innerHTML=testo3[3];
    document.getElementById("descrizione").innerHTML=testo3[7];
};
oReq.onload =f;
//pulsante.onclick=f;

oReq.open("get", "js/random_page.php", true);                       
oReq.send();