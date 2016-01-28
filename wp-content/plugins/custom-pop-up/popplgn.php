<?php
/* Plugin name: Pop Up plugin
*/
add_action( 'admin_menu', 'popplgn_menu' );
function popplgn_menu() {
    add_menu_page( 'Pop Up Options', 'Pop Up Settings', 'manage_options', 'popplgn.php', 'popplgn_page' );
}
function popplgn_settings() {
    global $new_options, $defaults;
    /*Creating default array of values*/
    $defaults = array(
        'title' => 'Hello World!',
        'body' => 'This is the first message in pop-up menu.',
        'delay' => '10',
        'close_btn' => '0',
        'esc_btn' => '0',
        'overlay_btn' => '0'
    );
    /*Install the option defaults*/
    add_option( 'popplgn_options', $defaults );
    update_option( 'popplgn_options', $defaults );

    /*Get options from the database*/
    $new_options = get_option( 'popplgn_options' );
}
function popplgn_page() {
    global $new_options, $defaults;
    if( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You are not prepare!') );
    }
    /*Assigning values from input to array*/
    if ( isset( $_POST['popplgn-submit'] ) ) {
        $new_options['title'] = $_POST['popplgn-title'];
        $new_options['body'] = $_POST['popplgn-body'];
        $new_options['delay'] = $_POST['popplgn-time'];
        $new_options['close_btn'] = isset( $_POST['popplgn-close'] ) ? 1 : 0;
        $new_options['esc_btn'] = isset( $_POST['popplgn-btn-close'] ) ? 1 : 0;
        $new_options['overlay_btn'] = isset( $_POST['popplgn-overlay'] ) ? 1 : 0;

        update_option( 'popplgn_options', $new_options );
        get_option( $new_options, 'popplgn_options' );
    }
    ?>
    <div id='wpwrap'>
        <div class='wpcontent'>
            <h2>Pop up Settings Menu</h2>
            <p>This page contains main settings for pop up menu</p>
            <form name="popplgn-settings" method="POST">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">Title text</th>
                            <td>
                                <label for="popplgn-title"></label>
                                <input name="popplgn-title" type="text" value="<?php echo $new_options['title']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Body text</th>
                            <td>
                                <label for="popplgn-body"></label>
                                <textarea name="popplgn-body"><?php echo $new_options['body']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Time of delay</th>
                            <td>
                                <label for="popplgn-time"></label>
                                <input type="text" name="popplgn-time" value="<?php echo $new_options['delay']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Display "Close" button</th>
                            <td>
                                <label for="popplgn-close"></label>
                                <input name="popplgn-close" type="checkbox" value="0" <?php if ( $new_options['close_btn'] == 1 ) echo "checked='checked'"; ?>/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Close pop-up with "Esc" button</th>
                            <td>
                                <label for="popplgn-btn-close"></label>
                                <input name="popplgn-btn-close" type="checkbox" value="0" <?php if ( $new_options['esc_btn'] == 1 ) echo "checked='checked'"; ?>/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Close pop-up by clicking on Overlay</th>
                            <td>
                                <label for="popplgn-overlay"></label>
                                <input name="popplgn-overlay" type="checkbox" value="0" <?php if ( $new_options['overlay_btn'] == 1 ) echo "checked='checked'"; ?>/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><input type="submit" name="popplgn-submit" value="Submit changes"/></th>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
<?php }