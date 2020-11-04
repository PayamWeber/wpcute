<?php
// admin page register and settings
add_action( 'admin_menu', 'pmw_admin_menu' );
function pmw_admin_menu()
{
    if ( NVM_ACTIVE_THEME_OPTIONS )
        add_menu_page( __( 'Theme Options' ), __( 'Theme Options' ), 'manage_options', 'nvm_options_page', 'nvm_options_content', "", 59 );

    if ( function_exists( 'acf_add_options_page' ) )
    {
//        acf_add_options_page(array(
//            'page_title' 	=> __( 'Special Options', 'artist' ),
//            'menu_title'	=> __( 'Special Options', 'artist' ),
//            'menu_slug' 	=> 'theme-general-settings',
//            'capability'	=> 'manage_options',
//            'redirect'		=> false
//        ));
    }
}

add_action( 'admin_init', function () {
    register_setting( 'nvm_options_settings_group', 'nvm_setting' );
} );

function nvm_options_content()
{
    get_template_part( 'inc/nvm', 'options_content' );
}

//admin page register styles
add_action( 'admin_enqueue_scripts', function ( $hook ) {
    // Load only on ?page=mypluginname
    if ( $hook != 'toplevel_page_nvm_options_page' )
    {
        return;
    }
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'nvm_options_style', get_template_directory_uri() . '/assets/admin/css/options.css' );
    wp_enqueue_script( 'nvm_options_script', get_template_directory_uri() . '/assets/admin/js/options.js', [
        'jquery',
        'wp-color-picker',
    ] );
} );

/**
 * @param        $key
 * @param string $default
 * @param string $escape_func
 *
 * @return string
 */
function get_nvm_setting( $key, $default = "", $escape_func = '' )
{
    global ${NVM_SETTINGS_NAME};
    $getOption  = ${NVM_SETTINGS_NAME} ?? get_option( NVM_SETTINGS_NAME );
    $getOption2 = ( ! isset( $getOption[ strval( $key ) ] ) || ! $getOption[ strval( $key ) ] ) ? strval( $default ) : $getOption[ strval( $key ) ];

    if ( is_callable( $escape_func ) )
    {
        return $escape_func( $getOption2 );
    }

    return $getOption2;
}

add_action( 'init', function () {
    $GLOBALS[ NVM_SETTINGS_NAME ] = get_option( NVM_SETTINGS_NAME );
} );
