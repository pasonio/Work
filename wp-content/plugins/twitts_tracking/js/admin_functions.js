jQuery(document).ready(function($) {
    //Creating slider for admin page
    $( function() {
        $("#slider").slider({
            change:function () {
                polygon.setRadius( Number($("#twttr_trck_plgn_radius").val()));
            },
            range: true,
            min: 50,
            max: 20000,
            values: [ twttr_trck_passed_data.twttr_trck_plgn_radius, 20000 ],
            slide: function( event, ui ) {
                //taking data from user input to display in slider
                $("#twttr_trck_plgn_radius").val(ui.values[0]);
            }
        });
        $("#twttr_trck_plgn_radius").val( $( "#slider" ).slider("values", 0));
    });
    $("#twttr_trck_plgn_radius").change(function(){
        polygon.setRadius( Number($("#twttr_trck_plgn_radius").val()));
    });
    //Edit button options
    $("#twttr_trck_plgn_edit_btn").click(function() {
        $("td").parent("tr").on('click', "#twttr_trck_plgn_edit_btn", function (){
            var tw_id = $("#twttr_trck_plgn_tw_id").text();
            var tw_subj = $(".subject").text();
            var tw_auth = $(".author").text();
            var tw_tweet = $(".tweet").text();
            var tw_screen_name = $(".screen_name").text();
            $(".tweet_id #twttr_trck_plgn_tw_id", this).html('<input type="text" id="twttr_trck_plgn_edit_id" value="'+tw_id+'" />');
            $(".subject").html('<input type="text" id="twttr_trck_plgn_edit_subject" value="'+tw_subj+'" />');
            $(".author").html('<input type="text" id="twttr_trck_plgn_edit_author" value="'+tw_auth+'" />');
            $(".tweet").html('<textarea id="twttr_trck_plgn_edit_tweet">'+tw_tweet+'</textarea>');
            $(".screen_name").html('<input type="text" id="twttr_trck_plgn_edit_screen_name" value="'+tw_screen_name+'" />');
        });
        $(this).html('<a id="twttr_trck_plgn_save_btn">Save</a>');
    });
        //Saving data by clicking on save button
        $("#twttr_trck_plgn_save_btn").click(function() {
            $(".tweet_id").val("#twttr_trck_plgn_edit_id");
            $("#twttr_trck_plgn_edit_id").hide();
            $("#twttr_trck_plgn_edit_subject").hide();
            $("#twttr_trck_plgn_edit_author").hide();
            $("#twttr_trck_plgn_edit_tweet").hide();
            $("#twttr_trck_plgn_edit_screen_name").hide();
        });
        var id = $('#twttr_trck_plgn_edit_id').val();
        var subj = $('#twttr_trck_plgn_edit_subject').val();
        var auth = $('#twttr_trck_plgn_edit_author').val();
        var tweet = $('#twttr_trck_plgn_edit_tweet').val();
        var screen_name = $('#twttr_trck_plgn_edit_screen_name').val();
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: 'load_input_data',
                tweet_id: id,
                subject: subj,
                author: auth,
                tweet: tweet,
                screen_name: screen_name
            },
            success: function(res) {
                console.log(res);
            }
        })
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
    //function for setting new coordinates and sending them to the DOM form
    function change_marker_position(latLng) {
        marker1.setPosition(latLng);
    }
//  creating polygon for the marker
    polygon = new google.maps.Circle({
        map: map,
        editable: true,
        fillColor: '#FF0000',
        fillOpacity: 0.5,
        radius: JSON.parse(twttr_trck_passed_data.twttr_trck_plgn_radius)
    });
    //event for changing radius
    polygon.addListener( 'radius_changed', function(){
        var radius_marker = polygon.getRadius();
        jQuery("#twttr_trck_plgn_radius").val(radius_marker);
    });
    //bind polygon with marker coordinates
    polygon.bindTo('center', marker1, 'position');
}