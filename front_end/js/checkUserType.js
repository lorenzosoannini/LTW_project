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

// Se login NON effettuato rimanda alla homepage

document.addEventListener('DOMContentLoaded', function() {
    var user = getCookie("user");
    if (user == "") {
        window.location.href = '../';
    }
});

// Controlla il tipo di utente: ricercatore (1) o collaboratore (0) e carica l'area personale corrispondente

$(document).ready(function() {
    var user = getCookie("user");
    if (user != "") {
        var userobj = JSON.parse(user);
        var usertype = userobj.usertype;
        if(usertype == '0')         // utente è un collaboratore
            $("#mainbox").load("collaboratore.html");
        else                        //utente è un ricercatore
            $("#mainbox").load("ricercatore.html");
    }
});