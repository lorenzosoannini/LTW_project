function reqListener () {
    console.log(this.responseText);
  }
  var oReq = new XMLHttpRequest();
  oReq.onload = function() {
    var testo=this.responseText;
    //alert(testo);
    var testo2=testo.replace(/\"/g,'§');
    var testo3=testo2.split("§"); //array
    //alert(testo3);
    document.getElementById("_nome").innerHTML=testo3[1];
    document.getElementById("_cognome").innerHTML=testo3[3];
    document.getElementById("_email").innerHTML=testo3[5];
    document.getElementById("_matricola").innerHTML=testo3[7];
  };
  oReq.open("get", "../js/areaPersonale.php", true);                       
  oReq.send();
