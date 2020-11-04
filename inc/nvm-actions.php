<?php
// after setup theme
add_action( "after_setup_theme", "pmw_ast" );
function pmw_ast()
{
	//register nav menus
	register_nav_menus( [
		"main-menu" => __( 'Main Menu' ),
		"footer-menu" => __( 'Footer Menu' ),
	] );

	// add theme supports
	add_theme_support( "woocommerce" );

	//register post thumbnails
	add_theme_support( "post-thumbnails" );

	//register image size for post thumbnails
	add_image_size( "pmw-medium", 600, 999, FALSE );
	add_image_size( "pmw-large", 900, 999, FALSE );

	load_theme_textdomain( 'artist', NVM_DIR_PATH . '/lang' );
}

// add scripts
add_action( "wp_enqueue_scripts", function () {
//	wp_enqueue_script('wp-mediaelement');
//    wp_enqueue_script( "nvm_load_jquery_script", NVM_DIR_URL . "/js/load_jquery.js", [ 'jquery' ], "1.2.3", FALSE );
//    wp_localize_script( "nvm_load_jquery_script", "nvm_data", [
//        "ajax_url" => admin_url( '/admin-ajax.php' ),
//        "search_nonce" => wp_create_nonce( 'srchajax' ),
//    ] );
} );

add_action( "admin_enqueue_scripts", function () {
	wp_enqueue_style( "pmw_admin_font", NVM_DIR_URL . "/assets/fonts/IRANSans/css/fontiran.css" );
	wp_enqueue_style( "pmw_admin_fontawesome", NVM_DIR_URL . "/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css" );
	wp_enqueue_style( "pmw_admin_style", NVM_DIR_URL . "/assets/admin/css/admin_style.css" );
	wp_enqueue_style( "pmw_custom_style", NVM_DIR_URL . "/assets/admin/css/my_custom.css" );
	wp_enqueue_media();
	wp_enqueue_script( "pmw_admin_script", NVM_DIR_URL . "/assets/admin/js/admin_scripts.js", [ "jquery" ], "1.3", TRUE );
	wp_localize_script( "pmw_admin_script", "pmw_data", [
		"ajax_url" => pmwAjaxUrl(),
		"api_url" => site_url('api/'),
	] );
} );

/**
 * Add new rewrite rule
 */
add_action( 'init', function () {
	add_rewrite_rule(
		'blog/([^/]*)$',
		'index.php?name=$matches[1]',
		'top'
	);
	add_rewrite_tag( '%blog%', '([^/]*)' );

	/**
	 * change rewrite rule for cat an tag pages
	 */
	add_rewrite_rule(
		'blog/category/([^/]*)$',
		'index.php?category_name=$matches[1]',
		'top'
	);
	add_rewrite_rule(
		'blog/tag/([^/]*)$',
		'index.php?tag=$matches[1]',
		'top'
	);
}, 999 );

/**
 * Modify post link
 * This will print /blog/post-name instead of /post-name
 */
add_filter( 'post_link', function ( $url, $post, $leavename ) {
	if ( $post->post_type == 'post' )
	{
		$url = home_url( user_trailingslashit( "blog/$post->post_name" ) );
	}

	return $url;
}, 10, 3 );

/**
 * Redirect all posts to new url
 * If you get error 'Too many redirects' or 'Redirect loop', then delete everything below
 */
//function redirect_old_urls() {
//    if ( is_singular('post') ) {
//        global $post;
//        if ( strpos( $_SERVER['REQUEST_URI'], '/blog/') == false) {
//            wp_redirect( home_url( user_trailingslashit( "blog/$post->post_name" ) ), 301 );
//            exit();
//        }
//    }
//}
//add_filter( 'template_redirect', 'redirect_old_urls' );

/*
 * woocommerce user logged in in checkout
 */
//add_action( 'woocommerce_checkout_process', 'pmw_wc_chekcout' );
function pmw_wc_chekcout()
{
	if ( ! is_user_logged_in() )
	{
		throw new Exception( 'اگر حساب کاربری دارید وارد شوید و یا <a href="' . drq_get_register_url() . '" class="wc-backward">ثبت نام</a> کنید. ' );
	}
}

add_action( 'wp_footer', function () {
	wp_deregister_script( 'wp-embed' );
} );

// remove elementor scripts and styles
add_action( 'wp_print_scripts', function () {
	if ( ! pmw_is_elementor() )
	{
		wp_dequeue_script( 'elementor-frontend-modules' );
		wp_deregister_script( 'elementor-frontend-modules' );
	}
}, 10 );
add_action( 'wp_print_styles', function () {
	if ( ! pmw_is_elementor() )
	{
		wp_dequeue_style( 'elementor-frontend' );
		wp_deregister_style( 'elementor-frontend' );
	}
}, 10 );


add_action( 'init', function () {
	if ( ! session_id() ) {
		session_start();
	}
}, 1 );






















