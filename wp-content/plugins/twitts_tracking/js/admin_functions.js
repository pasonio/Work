jQuery(document).ready(function($) {
    //Creating slider for admin page
    $( function() {
        $("#slider").slider({
            range: true,
            min: 50,
            max: 20000,
            values: [ twttr_trck_passed_data.twttr_trck_plgn_radius, 20000 ],
            slide: function( event, ui ) {
                //taking data from user input to display in slider
                $( "#twttr_trck_plgn_radius").val( ui.values[0]);
            }
        });
        $("#twttr_trck_plgn_radius").val( $( "#slider" ).slider("values", 0));
    });



});
