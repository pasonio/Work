<?php
/*Plugin name: Pop-up menu*/
function popplgn_page() {
    add_menu_page( 
        'Pop-up',
        'Pop-up settings',
        'manage_options',
        'popplgn_page',
        'popplgn_settings_content'
        );
}
add_action( 'admin_menu', 'popplgn_page' );

function popplgn_database() {
    $defaults = array(
        'popplgn_title' => 'Default Title',
        'popplgn_body' => 'Default body text',
        'popplgn_display_time' => '10',
        'popplgn_delay' => '10',
        'popplgn_close_btn' => '1',
        'popplgn_esc_btn' => '1',
        'popplgn_overlay' => '0'
    );
    update_option( 'popplgn_options', $defaults );
}
register_activation_hook( __FILE__, 'popplgn_database' );

function popplgn_db_delete() {
    delete_option( 'popplgn_options' );
}
register_deactivation_hook( __FILE__, 'popplgn_db_delete' );

function popplgn_fields_register() {

    add_settings_section(
        'popplgn_settings_section',
        'Display Options',
        'popplgn_display',
        'popplgn_options'
    );

    add_settings_field(
        'popplgn_title',
        'Display title',
        'popplgn_title_field',
        'popplgn_options',
        'popplgn_settings_section'
    );

    add_settings_field(
        'popplgn_body',
        'Display body',
        'popplgn_body_field',
        'popplgn_options',
        'popplgn_settings_section'
    );

    add_settings_field(
        'popplgn_display_time',
        'Display time',
        'popplgn_display_time',
        'popplgn_options',
        'popplgn_settings_section'
    );
    add_settings_field(
        'popplgn_delay',
        'Time of delay',
        'popplgn_delay_field',
        'popplgn_options',
        'popplgn_settings_section'
    );

    add_settings_field(
        'popplgn_close_btn',
        'Display close button',
        'popplgn_close_btn_field',
        'popplgn_options',
        'popplgn_settings_section'
    );

    add_settings_field(
        'popplgn_esc_btn',
        'Close menu with "ESC"',
        'popplgn_esc_btn_field',
        'popplgn_options',
        'popplgn_settings_section'
    );

    add_settings_field(
        'popplgn_overlay',
        'Close menu with overlay',
        'popplgn_overlay_field',
        'popplgn_options',
        'popplgn_settings_section'
    );

    register_setting( 'popplgn_options', 'popplgn_options', 'popplgn_field_sanitize' );
}
add_action( 'admin_init', 'popplgn_fields_register' );

function popplgn_field_sanitize( $input ) {
//    Creating array for storing the validated options
    $output = array();

    $output['popplgn_title'] = strip_tags( stripslashes( $input['popplgn_title'] ) );
    $output['popplgn_body'] = strip_tags( stripslashes( $input['popplgn_body'] ) );
    $output['popplgn_display_time'] = strip_tags( stripslashes( $input['popplgn_display_time'] ) );
    $output['popplgn_delay'] = strip_tags( stripslashes( $input['popplgn_delay'] ) );
    $output['popplgn_close_btn'] = isset( $input['popplgn_close_btn'] ) ? 1 : 0;
    $output['popplgn_esc_btn'] = isset( $input['popplgn_esc_btn'] ) ? 1 : 0;
    $output['popplgn_overlay'] = isset( $input['popplgn_overlay'] ) ? 1 : 0;

    return $output;
}
function popplgn_display() {
    $text = '<div class="wrap">';
        $text .= '<h2>Pop-up plugin</h2>';
        $text .= '<p>Main settings of the plugin</p>';
    $text .='</div>';

    echo $text;
}
function popplgn_settings_content() {
    settings_errors(); ?>

    <form method="POST" action="options.php">
        <?php settings_fields( 'popplgn_options' );
        do_settings_sections( 'popplgn_options' );
        submit_button();?>
    </form>
<?php }

function popplgn_title_field() {
    $options = get_option( 'popplgn_options' );
    $value = $options['popplgn_title'];
    echo '<input name="popplgn_options[popplgn_title]" id="popplgn_title" type="text" value="' . $value . '"/>';
}
function popplgn_body_field() {
    $options = get_option( 'popplgn_options' );
    $value = $options['popplgn_body'];
    echo '<textarea name="popplgn_options[popplgn_body]" id="popplgn_body">' . sanitize_text_field( $value ) . '</textarea>';
}
function popplgn_display_time() {
    $options = get_option( 'popplgn_options' );
    $value = $options['popplgn_display_time'];
    echo '<input name="popplgn_options[popplgn_display_time]" id="popplgn_display_time" type="text" value="' . $value . '"/>';
}
function popplgn_delay_field() {
    $options = get_option( 'popplgn_options' );
    $value = $options['popplgn_delay'];
    echo '<input name="popplgn_options[popplgn_delay]" id="popplgn_delay" type="text" value="' . $value . '"/>';
}
function popplgn_close_btn_field() {
    $options = get_option( 'popplgn_options' );
    $value = $options['popplgn_close_btn'];
    echo '<input name="popplgn_options[popplgn_close_btn]" id="popplgn_close_btn" type="checkbox" value="' . $value . '"' . checked( 1, $value, false ) . '/>';
}
function popplgn_esc_btn_field() {
    $options = get_option( 'popplgn_options' );
    $value = $options['popplgn_esc_btn'];
    echo '<input name="popplgn_options[popplgn_esc_btn]" id="popplgn_esc_btn" type="checkbox" value="' . $value . '"' . checked( 1, $value, false ) . '/>';
}
function popplgn_overlay_field() {
    $options = get_option( 'popplgn_options' );
    $value = $options['popplgn_overlay'];
    echo '<input name="popplgn_options[popplgn_overlay]" id="popplgn_overlay" type="checkbox" value="' . $value . '"' . checked( 1, $value, false ) . '/>';
}
function popplgn_register_plugin_scripts() {
    $options = get_option( 'popplgn_options' );

    wp_enqueue_style( 'popplgn_style', plugins_url( 'custom-pop-up/css/style.css' ) );
    //    Passing data to javascript files
    $passing_array = array(
        'popplgn_title' => $options['popplgn_title'],
        'popplgn_body' => $options['popplgn_body'],
        'popplgn_delay' => $options['popplgn_delay'],
        'popplgn_display_time' => $options['popplgn_display_time'],
        'popplgn_close_btn' => $options['popplgn_close_btn'],
        'popplgn_esc_btn' => $options['popplgn_esc_btn'],
        'popplgn_overlay' => $options['popplgn_overlay']
    );
    wp_enqueue_script( 'popplgn-js-pass', plugins_url( 'custom-pop-up/js/functions.js' ), array( 'jquery', 'backbone', 'underscore') );
    wp_localize_script( 'popplgn-js-pass', 'popplgn_passed_data', $passing_array );
}
add_action( 'wp_enqueue_scripts', 'popplgn_register_plugin_scripts' );
function render_template(){
    include('menu.php');
}
add_action('wp_footer','render_template');