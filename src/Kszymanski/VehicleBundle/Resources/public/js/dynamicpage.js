$(function() {

    var newHash      = "",
        $mainContent = $("#content"),
        $el;
    
    $(window).bind('hashchange', function(){

        newHash = window.location.hash.substring(1);

        if (newHash) {
            $mainContent
                .fadeOut(200, function() {
                    $mainContent.hide();
                    $.ajax({
                        url: "/notes/" + newHash
                    })
                        .done(function( html ) {
                            $("#content").html(html);
                        });
                    $mainContent.fadeIn(200);
                });
        };
        
    });
    
    $(window).trigger('hashchange');

});