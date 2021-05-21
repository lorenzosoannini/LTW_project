document.addEventListener('DOMContentLoaded', function() {
    var user = getCookie("user");
    if (user != "") {
        var userobj = JSON.parse(user);
        var username = userobj.username;
        document.getElementById("loginButton").style="display: none";
        document.getElementById("signupButton").style="display: none";
        document.getElementById("d_down").style="display: block";
        document.getElementById("alreadyLogged").innerHTML="Bentornato <b>"+username+"</b>";
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
});

function deleteCookie(){
    document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "user_email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    window.location.reload();
}