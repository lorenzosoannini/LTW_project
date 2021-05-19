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

// Controlla il tipo di utente: ricercatore o collaboratore

document.addEventListener('DOMContentLoaded', function() {
    var user = getCookie("user");
    if (user != "") {
        var userobj = JSON.parse(user);
        var usertype = userobj.usertype;
    }
});