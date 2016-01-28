<?php
/* Plugin name: Pop Up plugin
*/
add_action( 'admin_menu', 'popplgn_menu' );
function popplgn_menu() {
    add_menu_page( 'Pop Up Options', 'Pop Up Settings', 'manage_options', 'popplgn.php', 'popplgn_page' );
}
function popplgn_settings() {
    /*Creating default array of values*/
    $defaults = array(
        'title' => 'Hello World!',
        'body' => 'This is the first message in pop-up menu.',
        'delay' => '10',
        'close_btn' => '0',
        'esc_btn' => '0',
        'overlay_btn' => '0'
    );
    add_option( $defaults, '255' );
    /*Assigning values from input to array*/
    $new_options = array(
        'title' == $_POST['popplgn-title'],
        'body' == $_POST['popplgn-body'],
        'delay' == $_POST['popplgn-time'],
        'close_btn' == $_POST['popplgn-close']?1:0,
        'esc_btn' == $_POST['popplgn-btn-close']?1:0,
        'overlay_btn' == $_POST['popplgn-overlay']?1:0
    );
    get_option( $_POST['popplgn-submit'] );
    update_option( $defaults, $new_options );
}
function popplgn_page() {
    if( !current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You are not prepare!') );
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
                                <input name="popplgn-title" type="text"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Body text</th>
                            <td>
                                <label for="popplgn-body"></label>
                                <textarea name="popplgn-body"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Time of delay</th>
                            <td>
                                <label for="popplgn-time"></label>
                                <input type="text" name="popplgn-time"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Display "Close" button</th>
                            <td>
                                <label for="popplgn-close"></label>
                                <input name="popplgn-close" type="checkbox" <?php if ( 'close_btn' == 1 ) "checked=checked"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Close pop-up with "Esc" button</th>
                            <td>
                                <label for="popplgn-btn-close"></label>
                                <input name="popplgn-btn-close" type="checkbox" <?php if ( 'esc_btn' == 1 ) "checked=checked"; ?>/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Close pop-up by clicking on Overlay</th>
                            <td>
                                <label for="popplgn-overlay"></label>
                                <input name="popplgn-overlay" type="checkbox" <?php if ( 'overlay_btn' == 1 ) "checked=checked"; ?>/>
                            </td>
                        </tr>
                        <tr>
                            <input type="submit" name="popplgn-submit" value="Submit changes"/>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
<?php }