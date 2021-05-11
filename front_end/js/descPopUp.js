$(document).ready(function() {
    $("td").mouseover(function(e){
        $(e.currentTarget).css("cursor", "pointer");
    });
    $(".popup").click(function(e) {
        $("body > *:not(#unblurred)").css("filter", "blur(5px)");
        $(e.currentTarget).find("div").dialog({
            close: function( event, ui ) {
                $("body > *:not(#unblurred)").css("filter", "");
            }
          }).attr('id', 'unblurred');;
    });
});