
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
  window.location.reload();
}
