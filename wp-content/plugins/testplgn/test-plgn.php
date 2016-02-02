<?php
/*
Plugin name: Test plugin
*/
global $jal_db_version;
$jal_db_version = '1.0';
function table_add() {
    global $wpdb;
    global $jal_db_version;
    $table_name = $wpdb->prefix . "testplgn";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    name tinytext NOT NULL,
    text text NOT NULL,
    url varchar(55) DEFAULT '' NOT NULL,
    UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    add_option( 'jal_db_version', $jal_db_version );
}
register_activation_hook( __FILE__, 'table_add');
function custom_title($title) {
    return "<div class='filtered' style='color: red'>$title</div>";
}
add_filter( 'the_title', 'custom_title');
function register_pluginstyle() {
    wp_register_style( 'test-style', plugins_url( 'testplgn/css/style.css') );
    wp_enqueue_style( 'test-style' );
    wp_register_script( 'test-script', plugins_url( 'testplgn/js/functions.js') );
    wp_enqueue_script( 'test-script' );
}
add_action( 'wp_enqueue_scripts', 'register_pluginstyle' );
function register_admin_pluginstyles() {
    wp_register_style( 'admin-test-style', plugins_url( 'testplgn/css/admin.css') );
    wp_enqueue_style( 'admin-test-style' );
    wp_register_script( 'admin-test-script', plugins_url( 'testplgn/js/admin-functions.js') );
    wp_enqueue_script( 'admin-test-script');
}
add_action( 'admin_enqueue_scripts', 'register_admin_pluginstyles' );
function delete_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "testplgn";

    $query = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query( $query );
}
register_deactivation_hook( __FILE__, 'delete_table' );