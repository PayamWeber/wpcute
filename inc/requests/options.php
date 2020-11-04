<?php
/*
 * load wordpress files
 */
require_once '../../../../wp-load.php';

/*
 * verify nonce for security
 */
if( ! wp_verify_nonce( $_GET['nonce'], 'nvm-options-request-nonce' ) )
    die();

/*
 * check is user logged in
 */

//$user_role = pmw_get_user_role(get_current_user_id());

if( ! is_admin() && ! is_super_admin() )
    die();

if( $_POST )
{
    foreach ( $_POST as $key => $item )
    {
        if ( strpos( $key, NVM_SETTINGS_NAME ) === false )
            update_option($key, $item);
    }
}

die( 'asdfasdf' );