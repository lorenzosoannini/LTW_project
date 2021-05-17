
document.addEventListener('DOMContentLoaded', function() {
    var username = getCookie("username");
    if (username != "") {
        document.getElementById("loginButton").style="display: none";
        document.getElementById("signupButton").style="display: none";
        document.getElementById("d_down").style="display: block";
        document.getElementById("dropdownMenuButton1").innerHTML="Bentornato <b>"+getCookie("username")+"</b>"
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

    function checkCookie(cname){
        var x=getCookie("username");
        if (username != "") {
            return false;
        }
        else{
            return true; 
        }
    }


});

function deleteCookie(){
    document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    window.location.reload(true);
}