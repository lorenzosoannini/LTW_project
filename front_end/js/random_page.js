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
  };
  oReq.open("get", "js/random_page.php", true);                       
  oReq.send();
