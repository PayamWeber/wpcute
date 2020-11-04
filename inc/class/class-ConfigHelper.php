<?php

class ConfigHelper
{
	const PAGE_ABOUT           = 'about';
	const PAGE_AGENTS          = 'agents';
	const PAGE_BLOG            = 'blog';
	const PAGE_BLOG_DETAILS    = 'blog-details';
	const PAGE_CUSTOMERS       = 'customers';
	const PAGE_SUPPORT         = 'support';
	const PAGE_FAQ             = 'faq';
	const PAGE_FESTIVALS       = 'festivals';
	const PAGE_PRODUCT_DETAILS = 'productdetails';
	const PAGE_PRODUCT_LIST    = 'productlist';
	const PAGE_RETAILERS       = 'retailers';

	public static $config = [
		'isDev' => true, // whether in 'development' or 'production' mode
		'isLocal' => true, // local or on server
		'isHttps' => false, // useful when on server
		'baseUrl' => '', // base url of project (for assets)
		'themeUrl' => NVM_DIR_URL, // base url of project (for assets)
		'root' => __DIR__, // directory path to root of project (for php blocks if needed)
		'lang' => 'fa',
		'dir' => 'ltr', // oneof(['rtl', 'ltr'])
		'css' => '/public/css/main.css', // only used in production
		'js' => '/public/js/script.js',
		'sprite' => '/public/images/sprite.svg',
		'hash' => 'sdfsdf', // hash for cache busting (preventing the browser to cache assets)
		'pages' => [
			self::PAGE_ABOUT => 'templates/tpl-about.php',
			self::PAGE_AGENTS => 'templates/tpl-agents.php',
			self::PAGE_BLOG => 'templates/tpl-blog.php',
			self::PAGE_BLOG_DETAILS => 'blog-details',
			self::PAGE_CUSTOMERS => 'templates/tpl-customers.php',
			self::PAGE_SUPPORT => 'templates/tpl-support.php',
			self::PAGE_FAQ => 'templates/tpl-faq.php',
			self::PAGE_FESTIVALS => 'templates/tpl-festivals.php',
			self::PAGE_PRODUCT_DETAILS => 'productdetails',
			self::PAGE_PRODUCT_LIST => 'templates/tpl-product-list.php',
			self::PAGE_RETAILERS => 'templates/tpl-retailers.php',
		], // all pages that we have in this project
		'page' => '',
		'url' => [],
		'instaAccessToken' => '', // instagram account user accesstoken
	];

	private function __construct() { }

	/**
	 * @param $name
	 * @param $value
	 */
	public static function set( $name, $value )
	{
		if ( $name )
		{
			self::$config->$name = $value;
		}
	}

	/**
	 * @param        $name
	 * @param string $default
	 *
	 * @return string
	 */
	public static function get( $name, $default = '' )
	{
		if ( $name )
		{
			if ( strpos( $name, '.' ) !== false )
			{
				$name      = explode( '.', $name );
				$main_name = $name[ 0 ];
				unset( $name[ 0 ] );
				$value = ( isset( self::$config->$main_name ) && self::$config->$main_name ) ? self::$config->$main_name : $default;

				foreach ( $name as $n )
				{
					$value = ( isset( $value[ $n ] ) && $value[ $n ] ) ? $value[ $n ] : $default;
				}
				return $value;
			}
			return ( isset( self::$config->$name ) && self::$config->$name ) ? self::$config->$name : $default;
		}
	}

	/**
	 * init function
	 * this function make config variable to an object variable
	 * also this function set the initial values to config variable
	 */
	public static function initialize()
	{
		self::$config          = (object) self::$config;
		self::$config->baseUrl = site_url();
		self::$config->css     = self::$config->themeUrl . self::$config->css;
		self::$config->js      = self::$config->themeUrl . self::$config->js;
		self::$config->sprite  = self::$config->themeUrl . self::$config->sprite;
		self::$config->media   = self::$config->themeUrl . '/public/media/';
		self::$config->images  = self::$config->themeUrl . '/public/images/';
		switch ( ConfigHelper::$config->lang )
		{
			case 'fa':
				self::$config->dir = 'rtl';
				break;
		}
		add_action( 'template_redirect', [ new self, 'generate_page_names' ] );
	}

	public function generate_page_names()
	{
		foreach ( self::$config->pages as $page => $path )
		{
			$page_object                = get_field( '_page_' . $page, 'option' );
			self::$config->url[ $page ] = get_the_permalink( $page_object );
		}

		foreach ( self::$config->pages as $page => $path )
		{
			if ( is_front_page() )
			{
				self::$config->page = 'home';
				break;
			} else if ( $page == self::PAGE_BLOG_DETAILS && is_singular( 'post' ) )
			{
				self::$config->page = $page;
				break;
			} else if ( $page == self::PAGE_PRODUCT_DETAILS && is_singular( 'product' ) )
			{
				self::$config->page = $page;
				break;
			} else if ( $page == self::PAGE_PRODUCT_LIST && ( ( function_exists('is_shop') && is_shop() ) || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) )
			{
				self::$config->page = $page;
				break;
			} else if ( $page == self::PAGE_BLOG && ( is_category() || is_tag() ) )
			{
				self::$config->page = $page;
				break;
			} else if ( is_page_template( $path ) )
			{
				self::$config->page = $page;
				break;
			}
		}
	}
}