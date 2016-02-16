<?php
/*Plugin name: Twitts tracking plugin*/
global $jal_db_version;
$jal_db_version = '1.0';
function twttr_trck_plgn_page() {
    add_menu_page(
        'Twitter tracking plugin',
        'PLugin\'s options',
        'manage_options',
        'twttr_trck_plgn_page',
        'twttr_trck_plgn_content'
        );
}
add_action( 'admin_menu', 'twttr_trck_plgn_page');

function twttr_trck_plgn_db() {
    global $wpdb;
    global $jal_db_version;
    $jal_db_version = '1.0';
    $defaults = array(
        'twttr_trck_plgn_subject' => 'Popular',
        'twttr_trck_plgn_latitude' => '40.7127837',
        'twttr_trck_plgn_longtitude' => '-74.00594130000002',
        'twttr_trck_plgn_radius' => '100'
    );
    update_option( 'twttr_trck_plgn_options', $defaults );

//    Creating custom table for tweets
    $table_name = $wpdb->prefix . "twttr_trck_plgn";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
    id INT (10) NOT NULL AUTO_INCREMENT,
    posted DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    author VARCHAR(100) NOT NULL,
    description VARCHAR(100) NOT NULL,
    tweet VARCHAR(150) NOT NULL,
    source VARCHAR(150) DEFAULT '' NOT NULL,
    PRIMARY KEY id (id)
    ) $charset_collate";
    require_once ( ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta( $sql );
    add_option( 'jal_db_version', $jal_db_version );
}
register_activation_hook( __FILE__, 'twttr_trck_plgn_db' );

function twttr_trck_plgn_remove_db() {
    global $wpdb;
    $table_name = $wpdb->prefix . "twttr_trck_plgn";

    $query = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query( $query );

    delete_option( 'twttr_trck_plgn_options');
}
register_deactivation_hook( __FILE__, 'twttr_trck_plgn_remove_db' );

function twttr_trck_plgn_register() {

    add_settings_section(
        'twttr_trck_plgn_settings',
        'Twitter tracking options',
        'twttr_trck_plgn_display',
        'twttr_trck_plgn_options'
    );
    add_settings_field(
        'twttr_trck_plgn_subject',
        'Subject',
        'twttr_trck_plgn_subject_field',
        'twttr_trck_plgn_options',
        'twttr_trck_plgn_settings'
    );
    add_settings_field(
        'twttr_trck_plgn_latitude',
        'Latitude',
        'twttr_trck_plgn_latitude_field',
        'twttr_trck_plgn_options',
        'twttr_trck_plgn_settings'
    );
    add_settings_field(
        'twttr_trck_plgn_longtitude',
        'Longtitude',
        'twttr_trck_plgn_longtitude_field',
        'twttr_trck_plgn_options',
        'twttr_trck_plgn_settings'
    );
    add_settings_field(
        'twttr_trck_plgn_radius',
        'Radius',
        'twttr_trck_plgn_radius_field',
        'twttr_trck_plgn_options',
        'twttr_trck_plgn_settings'
    );
    add_settings_field(
        'twttr_trck_maps',
        'Google Map',
        'twttr_trck_plgn_maps_field',
        'twttr_trck_plgn_options',
        'twttr_trck_plgn_settings'
    );

    register_setting( 'twttr_trck_plgn_options', 'twttr_trck_plgn_options', 'twttr_trck_plgn_sanitize' );
}

function twttr_trck_plgn_sanitize($input) {
    $output = array ();

    $output['twttr_trck_plgn_subject'] = strip_tags( stripslashes( $input['twttr_trck_plgn_subject'] ) );
    $output['twttr_trck_plgn_latitude'] = $input['twttr_trck_plgn_latitude'];
    $output['twttr_trck_plgn_longtitude'] = $input['twttr_trck_plgn_longtitude'];
    $output['twttr_trck_plgn_radius'] = $input['twttr_trck_plgn_radius'];

    return $output;
}
add_action( 'admin_init', 'twttr_trck_plgn_register' );

function twttr_trck_plgn_display() {
    $text = '<div class="wrapper">';
        $text .= '<p>Plugin options</p>';
    $text .= '</div>';

    echo $text;
}
function twttr_trck_plgn_content() {
    settings_errors(); ?>

    <form method="POST" action="options.php">
        <?php settings_fields( 'twttr_trck_plgn_options');
        do_settings_sections( 'twttr_trck_plgn_options');
        submit_button();?>
    </form>
<?php }

function twttr_trck_plgn_subject_field() {
    $options = get_option( 'twttr_trck_plgn_options');
    $value = $options['twttr_trck_plgn_subject'];
    echo '<input name="twttr_trck_plgn_options[twttr_trck_plgn_subject]" id="twttr_trck_plgn_subject" type="text" value="' . $value . '"/>';
}

function twttr_trck_plgn_latitude_field() {
    $options = get_option( 'twttr_trck_plgn_options' );
    $value = $options['twttr_trck_plgn_latitude'];
    echo '<input name="twttr_trck_plgn_options[twttr_trck_plgn_latitude]" id="twttr_trck_plgn_latitude" type="text" value="' . $value . '"/>';
}

function twttr_trck_plgn_longtitude_field() {
    $options = get_option( 'twttr_trck_plgn_options' );
    $value = $options['twttr_trck_plgn_longtitude'];
    echo '<input name="twttr_trck_plgn_options[twttr_trck_plgn_longtitude]" id="twttr_trck_plgn_longtitude" type="text" value="' . $value . '"/>';
}

function twttr_trck_plgn_radius_field() {
    $options = get_option('twttr_trck_plgn_options');
    $value = $options['twttr_trck_plgn_radius'];
        echo '<input name="twttr_trck_plgn_options[twttr_trck_plgn_radius]" id="twttr_trck_plgn_radius" type="text" value="' . $value .  '"/>';
        echo '<div id="slider"></div>';
}
function twttr_trck_plgn_maps_field() {
    $options = get_option( 'twttr_trck_plgn_options' );
    $value = $options['twttr_trck_plgn_latitude'];
    echo '<div id="map"></div>';
}

function twttr_trck_plgn_admin_scripts() {
    $options = get_option('twttr_trck_plgn_options');
    wp_enqueue_script( 'twttr_trck_pass', plugins_url( 'twitts_tracking/js/admin_functions.js' ), array( 'jquery', 'jquery-ui-core', 'jquery-ui-slider' ) );
    wp_enqueue_style( 'twttr_trck_plgn_admin_style', plugins_url( 'twitts_tracking/css/admin_style.css' ) );
    wp_enqueue_style( 'twttr_trck_plgn_slider_style', plugins_url( 'twitts_tracking/css/slider.css'));
    //    Loading Google maps API with libraries
    wp_enqueue_script( 'twttr_trck_plgn_google_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAAqT1sWRYIGOXE8i3WELWgaDDTwdSl4Bo&callback=initMap&libraries=drawing', array(), false, true);
    //    passing data to js file to save the user input data
    $passing_array = array(
        'twttr_trck_plgn_latitude' => $options['twttr_trck_plgn_latitude'],
        'twttr_trck_plgn_longtitude' => $options['twttr_trck_plgn_longtitude'],
        'twttr_trck_plgn_radius' => $options['twttr_trck_plgn_radius']
    );
    wp_localize_script( 'twttr_trck_pass', 'twttr_trck_passed_data', $passing_array);
}
add_action( 'admin_enqueue_scripts', 'twttr_trck_plgn_admin_scripts' );

function twttr_trck_plgn_scripts_register() {
    wp_enqueue_style( 'twttr_trck_plgn_style', plugins_url( 'twitts_tracking/css/style.css' ) );
    wp_enqueue_script( 'twttr_trck_plgn_script', plugins_url( 'twitts_tracking/js/functions.js'));
}
add_action( 'wp_enqueue_scripts', 'twttr_trck_plgn_scripts_register');

function twttr_trck_plgn_tweets() {
    global $wpdb;
    $table_name = $wpdb->prefix . "twttr_trck_plgn";
    require_once('twitteroauth.php');

    $options = get_option('twttr_trck_plgn_options');
    $subj = $options['twttr_trck_plgn_subject'];
    $lat = $options['twttr_trck_plgn_latitude'];
    $lng = $options['twttr_trck_plgn_longtitude'];
    $rad = $options['twttr_trck_plgn_radius'];

    define('CONSUMER_KEY', 'w9NBL5BpcQCeLTt299ngol6Nk');
    define('CONSUMER_SECRET', 'OQwW3icYAMuanMTSEyV1vmLCv33iAfLYbsS1NLiK9AC52Kgwm1');
    define('ACCESS_TOKEN', '4913029835-vDpQPOPwQRsV85uvzklZ0cMhaGTDcak6C7Gukqn');
    define('ACCESS_SECRET', 'e7S62uFNLdnVDBxvbed7DZhAeYZPj1OKIRVilHlmTwgVu');


    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_SECRET);
    $content = $connection->get('account/verify_credentials');

    $search_query = $connection->get("search/tweets", ['count' => 20, 'q' => "$subj", 'geocode' => $lat . ',' . $lng . ',' . $rad . 'km', 'result_type' => 'mixed']);

    foreach ( $search_query->statuses as  $value=>$key ) {

            $id = $key->user->id;
            $name = $key->user->name;
            $date = $key->created_at;
            $text = $key->text;
            $source = $key->user->url;
    }
    $query = "INSERT INTO $table_name ( id, author, posted, tweet, source ) VALUES( $id, $name, $date, $text, $source)";
    $wpdb->query($query);
}
add_action( 'admin_init', 'twttr_trck_plgn_tweets' );