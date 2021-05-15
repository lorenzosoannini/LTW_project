/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function doHamburger() {
    var x = document.getElementById("myTopnav");
    if (x.className === "container topnav") {
      x.className += " responsive";
    } else {
      x.className = "container topnav";
    }
  }

function setActiveTab(){
  var x = document.getElementById("header").getAttribute("name");
  var c = document.getElementById("myTopnav").children;
  if(x == "login")
    document.getElementById("loginButton").classList.add("active");
  else if(x == "signup")
    document.getElementById("signupButton").classList.add("active");
  else{
    for (let i = 0; i < c.length; i++) {
      let item = c[i];
      if(item.text == x)
        item.classList.add("active");
    }
  }
}