    <?php
    /*Plugin name: Twitts tracking plugin*/
    global $jal_db_version;
    $jal_db_version = '1.0';
    function twttr_trck_plgn_page() {
        $hook = add_menu_page(
            'Twitter tracking plugin',
            'PLugin\'s options',
            'manage_options',
            'twttr_trck_plgn_page',
            'twttr_trck_plgn_content'
            );
        add_action( 'load-' . $hook, 'twttr_trck_plgn_google_maps');
    }
    add_action( 'admin_menu', 'twttr_trck_plgn_page');

    function twttr_trck_plgn_db() {
        global $wpdb;
        global $jal_db_version;
        $table_name = $wpdb->prefix . "twttr_trck_plgn";
        $charset_collate = $wpdb->get_charset_collate();
        $defaults = array(
            'twttr_trck_plgn_subject' => 'Popular',
            'twttr_trck_plgn_latitude' => '40.7127837',
            'twttr_trck_plgn_longtitude' => '-74.00594130000002',
            'twttr_trck_plgn_radius' => '100'
        );
        update_option( 'twttr_trck_plgn_options', $defaults );

    //    Creating custom table for tweets
        $sql = "CREATE TABLE $table_name (
        id mediumint(10) NOT NULL AUTO_INCREMENT,
        tweet_id bigint(20) unsigned NOT NULL,
        posted VARCHAR (100) NOT NULL,
        subject VARCHAR (100) NOT NULL,
        author VARCHAR(100) DEFAULT NULL,
        screen_name VARCHAR (100) DEFAULT NULL,
        image_url VARCHAR (100) DEFAULT NULL,
        tweet VARCHAR (255) NOT NULL,
        source VARCHAR(200) DEFAULT NULL,
        UNIQUE KEY id (id)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
        require_once ( ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta( $sql );
        add_option( 'jal_db_version', $jal_db_version );

    //    creating db update event
        wp_schedule_event( current_time( 'timestamp' ), 'hourly', 'twttr_trck_plgn_update_event');
    }
    register_activation_hook( __FILE__, 'twttr_trck_plgn_db' );

    function twttr_trck_plgn_remove_db() {
        global $wpdb;
        $table_name = $wpdb->prefix . "twttr_trck_plgn";

        $query = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query( $query );

        delete_option( 'twttr_trck_plgn_options');

        wp_clear_scheduled_hook( 'twttr_trck_plgn_update_event' );
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
        //    passing data to js file to save the user input data
        $passing_array = array(
            'twttr_trck_plgn_latitude' => $options['twttr_trck_plgn_latitude'],
            'twttr_trck_plgn_longtitude' => $options['twttr_trck_plgn_longtitude'],
            'twttr_trck_plgn_radius' => $options['twttr_trck_plgn_radius']
        );
        wp_localize_script( 'twttr_trck_pass', 'twttr_trck_passed_data', $passing_array);
    }
    add_action( 'admin_enqueue_scripts', 'twttr_trck_plgn_admin_scripts' );

    function twttr_trck_plgn_google_maps() {
        //    Loading Google maps API with libraries
        wp_enqueue_script( 'twttr_trck_plgn_google_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAAqT1sWRYIGOXE8i3WELWgaDDTwdSl4Bo&callback=initMap&libraries=drawing', array(), false, true);
    }
    function twttr_trck_plgn_scripts_register() {
        wp_enqueue_style( 'twttr_trck_plgn_style', plugins_url( 'twitts_tracking/css/style.css' ) );
        wp_enqueue_script( 'twttr_trck_plgn_script', plugins_url( 'twitts_tracking/js/functions.js'));
    }
    add_action( 'wp_enqueue_scripts', 'twttr_trck_plgn_scripts_register');

    //function for listening geolocation changes on plugin's settings page
    function twttr_trck_plgn_tweets($old_options,$new_options) {
        global $wpdb;
        $table_name = $wpdb->prefix . "twttr_trck_plgn";
        require_once('twitteroauth.php');

        $options = get_option('twttr_trck_plgn_options');
        $options=$new_options;
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
                $date = $key->created_at;
                $theme = $subj;
                $name = $key->user->name;
                $screen_name = $key->user->screen_name;
                $profile_image = $key->user->profile_image_url;
                $text = $key->text;
                $source = $key->user->url;

                $text = addslashes( $text );
                $convert_time = strtotime( $date );
                $fixed_time = date( "d-m-Y H:i", $convert_time);
    //        remove $query from the loop and put all data in array and then put it(array) in query
                $query = 'INSERT INTO ' . $table_name . '( tweet_id, posted, subject, author, screen_name, image_url, tweet, source  ) VALUES( "' . $id . '", "' . $fixed_time . '", "' . $theme . '","' . $name . '", "' . $screen_name . '", "' . $profile_image . '", "' . $text . '", "' . $source . '" )';
                $wpdb->query($query);
        }
    }
    add_action( 'update_option_twttr_trck_plgn_options', 'twttr_trck_plgn_tweets',10,2);

    function twttr_trck_plgn_db_update() {
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
            $date = $key->created_at;
            $theme = $subj;
            $name = $key->user->name;
            $screen_name = $key->user->screen_name;
            $profile_image = $key->user->profile_image_url;
            $text = $key->text;
            $source = $key->user->url;

            $text = addslashes( $text );
            $convert_time = strtotime( $date );
            $fixed_time = date( "d-m-Y H:i", $convert_time);
    //        remove $query from the loop and put all data in array and then put it(array) in query
            $query = 'INSERT INTO ' . $table_name . '( tweet_id, posted, subject, author, screen_name, image_url, tweet, source  ) VALUES( "' . $id . '", "' . $fixed_time . '", "' . $theme . '","' . $name . '", "' . $screen_name . '", "' . $profile_image . '", "' . $text . '", "' . $source . '" )';
            $wpdb->query($query);
        }
    }
    add_action( 'twttr_trck_plgn_update_event', 'twttr_trck_plgn_db_update');

    function twttr_plgn_trck_shortcode() {
        global $wpdb;
        $table_name = $wpdb->prefix . "twttr_trck_plgn";
        ob_start(); ?>
        <div class='container'>
        <?php foreach( $wpdb->get_results("SELECT tweet_id, posted, subject, author, screen_name, image_url, tweet, source FROM $table_name ORDER BY id DESC LIMIT 20") as $key=>$row) {
            $id = $row->tweet_id;
            $date = $row->posted;
            $theme = $row->subject;
            $name = $row->author;
            $screen_name = $row->screen_name;
            $avatar = $row->image_url;
            $tweet = $row->tweet; ?>
            <div class='col-sm-6' id='twttr_trck_plgn_nickname'>
                <span class="name"><strong><?php echo $name; ?></strong><small id="twttr_trck_plgn_screen_name"><?php echo $screen_name; ?></small></span>
            </div>
            <div class="col-sm-6" id="twttr_trck_plgn_subject">
                <span class="subject"><?php echo $theme; ?></span>
            </div>
            <div class="col-sm-6" id="twttr_trck_plgn_date">
                <span class="date"><?php echo $date; ?></span>
            </div>
            <div class="col-sm-12" id="twttr_trck_plgn_body">
                <span class="tweet"><?php echo $tweet; ?></span>
            </div>
        <?php } ?>
        </div>
        <?php return ob_get_clean();
    }
    add_shortcode( 'twitter_shortcode', 'twttr_plgn_trck_shortcode');

    // Add list table in the admin page
    if ( ! class_exists( 'Wp_List_Table') ) {
        require_once ( ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
    }
    class Twitter_List_Table extends WP_List_Table{

        function get_columns() {

            $columns = array(
                'cb' => '<input type="checkbox"/>',
                'tweet_id' => 'Tweet id',
                'subject' => 'Subject',
                'author' => 'Author',
                'posted' => 'Created at',
                'tweet' => 'Tweet',
                'screen_name' => 'Screen name'
            );
            return $columns;
        }
//        ACTION "DELETE" SHOULD BE CALLED BEFORE get_items() function ACTION "EDIT" SHOULD ADD INPUT FIELDS BY CLICKING IN EDIT BTN
        function column_tweet_id($item) {
            $actions = array(
                'edit' => sprintf('<a id="twttr_trck_plgn_edit_btn">Edit</a>', $_REQUEST['page'], 'edit', $item->tweet_id),
                'delete' => sprintf('<a href="?page=%s&action=%s&row=%s">Delete</a>', $_REQUEST['page'], 'delete', $item->tweet_id ),
            );
            return sprintf('%1$s %2$s', "<span id='twttr_trck_plgn_tw_id'>".$item->tweet_id."</span>", $this->row_actions($actions) );
        }

        function get_items() {
            global $wpdb;
            $table_name = $wpdb->prefix . "twttr_trck_plgn";
            $query = "SELECT tweet_id, posted, subject, author, screen_name, tweet, source FROM $table_name ";

    //      Sorting order
            if (isset($_REQUEST['s']) && $_REQUEST['s']!=''){
                die('search');
            }
            $orderby = ! empty ($_GET['orderby']) ? $_GET['orderby'] : 'DESC';
            $order = ! empty ( $_GET['order']) ? $_GET['order'] : '';
            if ( !empty($orderby) && !empty($order) && $_GET['orderby'] == 'posted' ) {
                $query .= 'ORDER BY ' . $orderby . ' ' . $order;
            }
            else if ( !empty($orderby) && !empty($order) && $_GET['orderby'] == 'subject') {
                $query .= 'ORDER BY ' . $orderby . ' ' . $order;
            }

    //        Pagination
    //        Number of elements in your table

            $totalitems = $wpdb->query($query); // return total number of affected rows
    //        How many to display per page
            $perpage = $this->get_items_per_page( 'tweets_per_page', 10);
    //        Which page is this
            $paged = $this->get_pagenum();
    //        page number
            if(empty($paged) || !is_numeric($paged) || $paged < 0 ) {
                $paged = 1;
            }

    //        How many pages do we have in total

            $totalpages = ceil($totalitems/$perpage);
    //        adjust the query to take pagination into account
            if(!empty($paged) && !empty($perpage)) {
                $offset = ($paged-1)*$perpage;
                $query.=' LIMIT ' .(int)$offset.', '.(int)$perpage;
            }

    //        Register the pagination

            $this->set_pagination_args( array(
                'total_items' => $totalitems,
                'total_pages' => $totalpages,
                'per_page' => $perpage,
            ) );

            $this->items = $wpdb->get_results($query);//Fetch the items
        }

        function prepare_items() {
            $columns = $this->get_columns();
            $hidden = array();
            $sortable = $this->get_sortable_columns();
            $this->_column_headers = array( $columns, $hidden, $sortable);
            $this->get_items();
        }

        function column_cb($item) {
            return sprintf(
                '<input type="checkbox" name="bulk[]" value="%s"/>', $item->tweet_id
            );
        }

        function get_sortable_columns() {
            $sortable_columns = array(
                'posted' => array( 'posted', true),
                'subject' => array( 'subject', true)
            );
            return $sortable_columns;
        }

        function get_bulk_actions() {
            $actions = [
                'bulk_delete' => 'Delete'
            ];
                return $actions;
        }

        function column_default($item, $column_name) {
            switch ($column_name) {
                case 'tweet_id' : return $item->tweet_id; break;
                case 'subject' : return $item->subject; break;
                case 'author' : return $item->author; break;
                case 'posted' : return $item->posted; break;
                case 'tweet' : return $item->tweet; break;
                case 'screen_name' : return $item->screen_name; break;
            }
        }
    }

    function twttr_trck_plgn_list_table() {
        $hook = add_menu_page( 'List of tweets', 'Tweets', 'manage_options', 'tweet_list', 'twttr_trck_plgn_list_page');
        add_action( "load-$hook", 'add_options');
    }
    add_action( 'admin_menu', 'twttr_trck_plgn_list_table' );

//    Adding screen option at the top of the page
    function add_options() {
        $option = 'per_page';
        $args = array(
            'label' => 'Tweets',
            'default' => 10,
            'option' => 'tweets_per_page'
        );
        add_screen_option($option, $args);
    }

//    Return options from screen options
    function twttr_trck_plgn_set_option($status, $option, $value ) {
        return $value;
    }
    add_filter( 'set-screen-option', 'twttr_trck_plgn_set_option', 10, 3);

    function twttr_trck_plgn_list_page() {
        echo '<form method="post">';
        echo '<input type="hidden" name="page" value="tweet_list"/>';
        $twttr_trck_plgn_list_data = new Twitter_List_Table();
        echo '<div class="twttr_trck_plgn_table_wrap"><h2>Twitter list table</h2>';
        $twttr_trck_plgn_list_data->prepare_items();
        $twttr_trck_plgn_list_data->search_box( 'search','twttr_trck_plgn_search');
        $twttr_trck_plgn_list_data->display();
        echo '</div>';
        echo '</form>';
    }

    function input_data_process() {
        var_dump($_POST);
        die('Dead');
    }
add_action( 'wp_ajax_load_input_data', 'input_data_process');