<?php
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
        'title' => 'Default Title',
        'body' => 'Default body text',
        'delay' => '10',
        'close_btn' => '0',
        'esc_btn' => '0',
        'overlay_btn' => '0'
    );
    update_option( 'popplgn_options', $defaults );
}
add_action( 'plugins_loaded', 'popplgn_database' );
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

    register_setting( 'popplgn_options','popplgn_options', 'popplgn_field_sanitize' );
}
add_action( 'admin_init', 'popplgn_fields_register' );

function popplgn_field_sanitize( $option ) {
    $option = sanitize_text_field( $option );
    return $option;
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
    $value = $options['title'];
    echo '<input name="popplgn-options[title]" id="popplgn_title" type="text" value="' . $value . '"/>';
}
function popplgn_body_field() {
    $options = get_option( 'popplgn_options' );
    $value = $options['body'];
    echo '<textarea name="popplgn-options[body]" id="popplgn_body">' . $value . '</textarea>';
}
function popplgn_delay_field() {
    $options = get_option( 'popplgn_options' );
    $value = $options['delay'];
    echo '<input name="popplgn-options[delay]" id="popplgn_delay" type="text" value="' . $value . '"/>';
}
function popplgn_close_btn_field() {
    $options = get_option( 'popplgn_options' );
    $value = $options['close_btn'];
    echo '<input name="popplgn-options[close_btn]" id="popplgn_close_btn" type="checkbox" value="0"' . checked( 1, $value, false ) . '/>';
}
function popplgn_esc_btn_field() {
    $options = get_option( 'popplgn_options' );
    $value = $options['esc_btn'];
    echo '<input name="popplgn-options[esc_btn]" id="popplgn_esc_btn" type="checkbox" value="0"' . checked( 1, $value, false ) . '/>';
}
function popplgn_overlay_field() {
    $options = get_option( 'popplgn_options' );
    $value = $options['overlay_btn'];
    echo '<input name="popplgn-options[overlay_btn]" id="popplgn_overlay" type="checkbox" value="0"' . checked( 1, $value, false ) . '/>';
}