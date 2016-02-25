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
    //Edit button settings

    $(".edit a").click(function() {
        var parent = $(this).closest('tr');

        var tw_id = $(parent).find("#twttr_trck_plgn_tw_id").text();
        var tw_subj = $(parent).find(".subject").text();
        var tw_auth = $(parent).find(".author").text();
        var tw_post = $(parent).find(".posted").text();
        var tw_tweet = $(parent).find(".tweet").text();
        var tw_screen_name = $(parent).find(".screen_name").text();

        $(parent).find(".subject").html('<input type="text" id="twttr_trck_plgn_edit_subject" value="'+tw_subj+'" />');
        $(parent).find(".author").html('<input type="text" id="twttr_trck_plgn_edit_author" value="'+tw_auth+'" />');
        $(parent).find(".posted").html('<input type="text" id="twttr_trck_plgn_edit_posted" value="'+tw_post+'"/>');
        $(parent).find(".tweet").html('<textarea id="twttr_trck_plgn_edit_tweet">'+tw_tweet+'</textarea>');
        $(parent).find(".screen_name").html('<input type="text" id="twttr_trck_plgn_edit_screen_name" value="'+tw_screen_name+'" />');
        //Hide edit btn
        $(parent).find(".edit #twttr_trck_plgn_edit_btn").hide();
        //Show save btn
        $(parent).find(".edit").prepend('<a id="twttr_trck_plgn_save_btn">Save</a>');

        //Saving data by clicking on save button
        $("#twttr_trck_plgn_save_btn").on( 'click', function(){
            var ready_parent = $(this).closest('tr');
            var ready_subj = $(ready_parent).find('#twttr_trck_plgn_edit_subject').val();
            var ready_auth = $(ready_parent).find('#twttr_trck_plgn_edit_author').val();
            var ready_post = $(ready_parent).find('#twttr_trck_plgn_edit_posted').val();
            var ready_tweet = $(ready_parent).find('#twttr_trck_plgn_edit_tweet').val();
            var ready_screen_name = $(ready_parent).find('#twttr_trck_plgn_edit_screen_name').val();

            $(ready_parent).find('.subject').html(ready_subj);
            $(ready_parent).find('.author').html(ready_auth);
            $(ready_parent).find('.posted').html(ready_post);
            $(ready_parent).find('.tweet').html(ready_tweet);
            $(ready_parent).find('.screen_name').html(ready_screen_name);
            //Show edit btn
            $(ready_parent).find(".edit #twttr_trck_plgn_edit_btn").show();
            //Remove save btn
            $(ready_parent).find('.edit #twttr_trck_plgn_save_btn').remove();
            //Making ajax query for updating edited rows in frontend
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'load_input_data',
                    tweet_id: tw_id,
                    subject: ready_subj,
                    author: ready_auth,
                    posted: ready_post,
                    tweet: ready_tweet,
                    screen_name: ready_screen_name
                },
                success: function(res) {
                    console.log(res);
                }
            })
        });
    });
    $(".delete a").click(function() {
        var parent = $(this).closest('tr');
        var tw_id = $(parent).find("#twttr_trck_plgn_tw_id").text();
        //Making ajax query for deleting selected row in database
        $.ajax({
            type:"POST",
            url: ajaxurl,
            data: {
                action: 'delete_table_row',
                tweet_id: tw_id
            },
            success: function(res) {
                console.log(res);
            }
        });
        //Removing row from the table
        $(parent).remove();
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