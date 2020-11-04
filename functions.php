<?php
/*
 * functions
 */

define( 'NVM_DIR_URL', get_template_directory_uri() );
define( 'NVM_DIR_PATH', get_template_directory() );
define( 'NVM_CAPTCHA_SITE_KEY', '' );
define( 'NVM_CAPTCHA_SECRET_KEY', '' );
define( 'NVM_SETTINGS_NAME', 'nvm_setting' );
define( 'NVM_ACTIVE_THEME_OPTIONS', true );

// get template parts
include 'vendor/autoload.php';
//get_template_part( "inc/nvm", "functions" );
//get_template_part( "inc/nvm", "classes" );
get_template_part( "inc/nvm", "middleware" );
get_template_part( "inc/nvm", "filters" );
get_template_part( "inc/nvm", "actions" );
get_template_part( "inc/nvm", "post-types" );
get_template_part( "inc/nvm", "shortcodes" );
get_template_part( "inc/nvm", "meta-box" );
get_template_part( "inc/nvm", "options" );
get_template_part( "inc/nvm", "widgets" );
get_template_part( "inc/nvm", "users" );
get_template_part( "inc/nvm", "acf" );

/**
 * include ajax actions
 */
pmw_include_files( NVM_DIR_PATH . '/inc/ajax-actions' );