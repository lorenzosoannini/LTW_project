
  var user = getCookie("user");
  if (user != "") {
      var userobj = JSON.parse(user);
      var username = userobj.username;
      document.getElementById("_nome").innerHTML=userobj.username;
      document.getElementById("_cognome").innerHTML=userobj.surname;
      document.getElementById("_email").innerHTML=userobj.email;
      document.getElementById("_matricola").innerHTML=userobj.id;
  }


  function getCookie(cname) {
      var name = cname + "=";
      var decodedCookie = decodeURIComponent(document.cookie);
      var ca = decodedCookie.split(';');
      for (var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
              c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
          }
      }
      return "";
  }


function deleteCookie(){
  document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "user_email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  window.location.reload();
}






// function reqListener () {
//     console.log(this.responseText);
//   }
//   var oReq = new XMLHttpRequest();
//   oReq.onload = function() {
//     var testo=this.responseText;
//     //alert(testo);
//     var testo2=testo.replace(/\"/g,'§');
//     var testo3=testo2.split("§"); //array
//     //alert(testo3);
//     document.getElementById("_nome").innerHTML=testo3[1];
//     document.getElementById("_cognome").innerHTML=testo3[3];
//     document.getElementById("_email").innerHTML=testo3[5];
//     document.getElementById("_matricola").innerHTML=testo3[7];
//   };
// oReq.open("get", "../js/areaPersonale.php", true);                       
// oReq.send();
