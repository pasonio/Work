<?php
/* Plugin name: Pop Up plugin
*/
function plugin_page() {
    add_menu_page( 'Pop-up', 'Pop-up settings', 'manage_options', 'popplgn_page', 'popplgn_callback_func', '', 50 );
}
add_action( 'admin_menu', 'plugin_page' );
function popplgn_api_init() {
//    Add the section to settings media field so we can add our fields to it
    add_settings_section(/*should be triggered 1 time*/
        'popplgn_setting_section',
        'Pop up menu',
        'popplgn_callback_func',
        'popplgn_page'
    );
    add_settings_field(/* Should create for all rows*/
        'popplgn_title',
        'Title',
        'popplgn_body_field',
        'popplgn_page',
        'popplgn_setting_section'
    );
    register_setting( 'popplgn_page', 'popplgn_title' );
}
add_action('admin_init', 'popplgn_api_init' );
/*----------------Call do_settings_section for data output----------------------*/
function popplgn_settings() {
    /*Install the option defaults*/
    if( isset( $_POST['submit'] ) ) {
        /*Creating default array of values*/
        $defaults = array(
            'title' => '',
            'body' => '',
            'delay' => '',
            'close_btn' => '0',
            'esc_btn' => '0',
            'overlay_btn' => '0'
        );
    }
}
/*Function for displaying description in the admin page*/
function popplgn_callback_func() {
    echo '<p>The main settings for pop-up menu plugin.</p>';
}
/*Function for displaying title setting field*/
function popplgn_title_field() {
    echo '<input name="popplgn-title[asdasd]" type="text" value="' . get_option( "popplgn_title" ) . '"/>';
}
/*Function for displaying body text setting field*/
function popplgn_body_field() {
    echo '<textarea name="popplgn-body"></textarea>';
}
/*Function for displaying time of delay field*/
function popplgn_delay_field() {
    echo '<input name="popplgn-delay" type="text"/>';
}
/*Function for displaying close button setting field*/
function popplgn_close_btn_field() {
    echo '<input name="popplgn-close-btn" type="checkbox" value="0"/>';
}
/*Function for displaying  "Close by press Esc" option setting field*/
function popplgn_esc_btn_field() {
    echo '<input name="popplgn-esc-btn" type="checkbox" value="0"/>';
}
/*Function for displaying "Close by clicking Overlay" option setting field*/
function popplgn_overlay_field() {
    echo '<input name="popplgn-overlay" type="checkbox" value="0"/>';
}