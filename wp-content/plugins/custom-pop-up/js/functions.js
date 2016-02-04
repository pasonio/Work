jQuery(document).ready(function($) {
    var popup = Backbone.Model.extend({
        defaults: {
            title: "Default Title",
            body: "Default body",
            display_time: "10",
            delay: "10",
            close_button: "1",
            esc_button: "1",
            overlay: "0"
        },
        validate: function( attrs ) {
            if ( attrs.delay <= 0 ) {
                alert( 'The number must be positive.' );
            }
        }
    });
     var menuView = Backbone.View.extend( {
         model: null,
         className: "popplgn_render",
         template: _.template( $('#popplgn_menu_template').html() ),
         initialize: function(model) {
            this.model = model;
            this.render();
         },
        render: function() {
             this.$el.html( this.template( this.model.toJSON() ) );
        }
    });
    var new_options = new popup({
        title: popplgn_passed_data.popplgn_title,
        body: popplgn_passed_data.popplgn_body,
        display_time: popplgn_passed_data.popplgn_display_time,
        delay: popplgn_passed_data.popplgn_delay,
        close_button: popplgn_passed_data.popplgn_close_btn,
        esc_button: popplgn_passed_data.popplgn_esc_btn,
        overlay: popplgn_passed_data.popplgn_overlay
    });
    var menu_view = new menuView(new_options);
    _.delay( menu_view.template, new_options['delay'] );
    $('.header').append(menu_view.$el.html());
});