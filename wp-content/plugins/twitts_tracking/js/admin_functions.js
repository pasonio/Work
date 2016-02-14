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
//    Display google maps in admin page
var map;
var marker1;
var polygon;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: JSON.parse(twttr_trck_passed_data.twttr_trck_plgn_latitude),
            lng: JSON.parse(twttr_trck_passed_data.twttr_trck_plgn_longtitude)
        },
        zoom: 9
    });
    //adding marker to the map
    marker1 = new google.maps.Marker({
        map: map,
        draggable: true,
        position: {
            lat: JSON.parse(twttr_trck_passed_data.twttr_trck_plgn_latitude),
            lng: JSON.parse(twttr_trck_passed_data.twttr_trck_plgn_longtitude)
        }
    });
    //event for changing position of the marker
    map.addListener( 'click', function(e) {
        change_marker_position(e.latLng);
        var marker_latitude = marker1.getPosition();
        var marker_longtitude = marker1.getPosition();
        jQuery("#twttr_trck_plgn_latitude").val(marker_latitude.lat());
        jQuery("#twttr_trck_plgn_longtitude").val(marker_longtitude.lng());
    });
    ////function for setting new coordinates and sending them to the DOM form
    function change_marker_position(latLng) {
        marker1.setPosition(latLng);

    }
//  creating polygon for the marker
    polygon = new google.maps.Circle({
        map: map,
        editable: false,
        fillColor: '#FF0000',
        fillOpacity: 0.5,
        radius: JSON.parse(twttr_trck_passed_data.twttr_trck_plgn_radius),
    });
    //bind polygon with marker coordinates
    polygon.bindTo('center', marker1, 'position');
}
