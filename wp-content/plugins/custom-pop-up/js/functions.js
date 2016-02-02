( function( $ ) {
    //alert(popplgn_passed_data.popplgn_title);
    var popup = Backbone.Model.extend({
        defaults: {
            title: "Default Title",
            body: "Default body",
            delay: "10",
            close_button: "1",
            esc_button: "1",
            overlay: "0"
        },
        initialize: function() {

        }
    });
    var new_options = new popup({
        title: popplgn_passed_data.popplgn_title,
        body: popplgn_passed_data.popplgn_body,
        delay: popplgn_passed_data.popplgn_delay,
        close_button: popplgn_passed_data.popplgn_close_btn,
        esc_button: popplgn_passed_data.popplgn_esc_btn,
        overlay: popplgn_passed_data.popplgn_overlay
    });
    // Fetching admin data to variables
    var menu_title = new_options.get( "title" );
    var menu_body = new_options.get( "body" );
    var time_delay = new_options.get( "delay" );
    var close_btn = new_options.get( "close_button" );
    var esc_btn = new_options.get( "esc_button" );
    var close_overlay = new_options.get( "overlay" );

} )( jQuery );
