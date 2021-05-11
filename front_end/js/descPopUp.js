$(document).ready(function() {
    $("td").mouseover(function(e){
        $(e.currentTarget).css("cursor", "pointer");
    });
    $(".popup").click(function(e) {
        $(e.currentTarget).find("div").dialog({
            close: function( event, ui ) {
                //remove blur
            }
          });
    });
});