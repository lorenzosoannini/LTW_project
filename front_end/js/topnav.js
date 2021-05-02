/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function doHamburger() {
    var x = document.getElementById("myTopnav");
    if (x.className === "container topnav") {
      x.className += " responsive";
    } else {
      x.className = "container topnav";
    }
  }