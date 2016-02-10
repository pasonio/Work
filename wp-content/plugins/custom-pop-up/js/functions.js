jQuery(document).ready(function($) {
    var popup = Backbone.Model.extend({
        timer:'0',
            defaults: {
                title: "Default Title",
                body: "Default body",
                display_time: "10",
                delay: "0",
                close_button: "1",
                esc_button: "1",
                overlay: "0",
                counter: 0,
                timer: JSON.parse(popplgn_passed_data.popplgn_display_time) + JSON.parse(popplgn_passed_data.popplgn_delay)
            },
            validate: function (attrs, options) {
                if (attrs.delay < 0 || attrs.display_time < 0) {
                    return 'The number must be positive.';
                }
            },
            decrease: function() {
              this.set('timer', this.get('timer') - 1);
            }
    });
     var menuView = Backbone.View.extend( {
         el: ".header",
         model: null,
         className: "popplgn_render",
         template: _.template( $('#popplgn_menu_template').html() ),
         initialize: function(model) {
             this.model = model;
             this.listenTo(this.model, 'change:timer', this.change );
             setInterval(_.bind(function() {
                 this.model.decrease();
             }, this), 1000);
             $(document).keydown(_.bind(function () {
                 if (event.keyCode == 27) {
                     if (this.model.get('esc_button') == 1) {
                        this.remove();
                     }
                 }
             }, this))
         },
         render: function() {
             this.$el.html( this.template( this.model.toJSON() ) );
             return this;
         },
         events: {
            "click #popplgn_close" : 'closeIcon',
            "click #overlay" : 'closeOverlay'
        },
        closeIcon: function() {
            this.remove();
        },
        closeOverlay: function() {
           if ( new_options.get('overlay') == 1 ){
                this.remove();
           } 
         },
        change: function( model, value, options ) {
            //rendering counter in browsers log
            //console.log(model.get('timer'));
            // setting statement for open
            this.model.get('timer');
            if (value <= new_options.get('display_time') && value > 0 ) {
                this.render();
            }
            //setting statement for closing
            else if ( value == 0 ) {
                this.remove();
            }
        }
     });
    var new_options = new popup({
        title: popplgn_passed_data.popplgn_title,
        body: popplgn_passed_data.popplgn_body,
        close_button: popplgn_passed_data.popplgn_close_btn,
        esc_button: popplgn_passed_data.popplgn_esc_btn,
        overlay: popplgn_passed_data.popplgn_overlay
    }, {validate: true} );

    new_options.on('invalid', function(model, error) {
        alert(model.get('title') + " : " + error);
        console.log(error);
    });
    new_options.set({
        display_time: popplgn_passed_data.popplgn_display_time,
        delay: popplgn_passed_data.popplgn_delay
    }, {validate: true});

    //if ( !new_options.isValid()) {
    //    alert( new_options.get('title') + " : " + new_options.validationError);
    //}
    var menu_view = new menuView(new_options);
    $(this.el).append(menu_view.$el.html());
});