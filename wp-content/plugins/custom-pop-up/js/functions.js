jQuery(document).ready(function($) {
    var popup = Backbone.Model.extend({
            defaults: {
                title: "Default Title",
                body: "Default body",
                display_time: "10",
                delay: "10",
                close_button: "1",
                esc_button: "1",
                overlay: "0",
                counter: 0,
                timer: popplgn_passed_data.popplgn_display_time
            },
            validate: function (attrs) {
                if (attrs.get('delay') <= 0) {
                    alert('The number must be positive.');
                }
            },
            //increasing counter by 1
            increase: function () {
                this.set('counter', this.get('counter') + 1);
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
             this.listenTo(this.model, 'change:counter', this.change);
             this.listenTo(this.model, 'change:counter', this.countdown);
             // binding model to keep calling it the old way. Without it the this.model will
             // call the window model
             setInterval(_.bind(function () {
                 this.model.increase();
             }, this), 1000);
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
            "click #overlay" : 'closeOverlay',
            "change:counter" : 'change'
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
            console.log(model.get('counter'));
            // setting statement for open
            if ( value == new_options.get('delay') ) {
                this.render();
            }
            //    setting statement for closing
            else if ( value >= new_options.get('display_time') ) {
                this.remove();
            }
        }
         //countdown: function( model, value, options ) {
         //   if ( value < new_options('timer') ) {
         //
         //   }
         //}
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
    $(this.el).append(menu_view.$el.html());
});