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
        'popplgn_delay' => '10',
        'popplgn_close_btn' => '1',
        'popplgn_esc_btn' => '1',
        'popplgn_overlay' => '0'
    );
    update_option( 'popplgn_options', $defaults );
}
register_activation_hook( __FILE__, 'popplgn_database' );
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
//    MAKE A STATEMENT FOR EVERY ROW IN THE SETTINGS WITH VALIDATION FOR EACH ROW
//   Loop through each of the incoming options
    $output['popplgn_title'] = strip_tags( stripslashes( $input['popplgn_title'] ) );
    $output['popplgn_body'] = strip_tags( stripslashes( $input['popplgn_body'] ) );
    $output['popplgn_delay'] = strip_tags( stripslashes( $input['popplgn_delay'] ) );
    $output['popplgn_close_btn'] = isset( $input['popplgn_close_btn'] ) ? 1 : 0;
    $output['popplgn_esc_btn'] = isset( $input['popplgn_esc_btn'] ) ? 1 : 0;
    $output['popplgn_overlay'] = isset( $input['popplgn_overlay'] ) ? 1 : 0; 

//     foreach ($input as $key => $value) {
// //        Check to see if the current option has a value. If so, process it.
//         if (isset($input[$key])) {
// //            Strip all HTML and PHP tags and properly handle quoted strings
//             $output[$key] = strip_tags(stripslashes($input[$key]));
//         }
//         else if( ! isset( $input['popplgn_esc_btn'] ) ||
//              ! isset( $input['popplgn_close_btn'] ) ||
//             ! isset($input['popplgn_overlay'] ) )
//         {
//             $input['popplgn_esc_btn'] = "0";
//             $input['popplgn_close_btn'] = "0";
//             $input['popplgn_overlay'] = "0";
//         }
//     }
//    Return the array processing any additional functions filtered by this action
    return apply_filters('popplgn_field_sanitize', $output, $input);
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
    wp_register_script( 'popplgn-script', plugin_url( 'js/functions.js') );
    wp_enqueue_script( 'popplgn-script' );
    wp_register_style( 'popplgn-style', plugin_url( 'css/style.css') );
    wp_enqueue_style( 'popplgn_style' );
}
add_action( 'wp_enqueue_scripts', 'popplgn_register_plugin_scripts' );