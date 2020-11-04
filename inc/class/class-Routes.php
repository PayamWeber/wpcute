<?php

namespace PMW\Inc\Vendor;

class Routes
{
	/**
	 * all routes put here
	 *
	 * @var array
	 */
	public static $routes = [];

	/**
	 * this is the default post id for routing
	 *
	 * @var int
	 */
	public static $route_post_id = 0;

	/**
	 * this property shows us routes are finalized or not
	 *
	 * @var bool
	 */
	private static $finalized = false;

	/**
	 * @param       $route
	 * @param       $controller
	 * @param array $args
	 *
	 * @return bool
	 */
	public static function make( $route, $controller, $args = [] )
	{
		if ( ! $controller )
			return false;

		$default_args = [
			'request_method' => 'GET',
			'exclude_tags' => [],
			'regex' => [],
		];
		$args         = array_merge( $default_args, $args );

		$route        = self::trim_slashes( $route );
		$regex        = $route;
		$parameters   = [
			'page_id' => self::get_route_post_id(),
			'request_method' => $args[ 'request_method' ],
		];
		$route_prefix = '';
		$route        = $route_prefix . $route;

		$route_regex_parts = self::extract_parameters( $route );

		$regex_parameters = [];
		$regex            = self::trim_slashes( $regex );
		$key_prefix       = '_';

		if ( $parameters )
		{
			if ( $route_regex_parts )
			{
				foreach ( $route_regex_parts as $part )
				{
					$parameters[ $part ] = isset( $args[ 'regex' ][ $part ] ) ? '(' . $args[ 'regex' ][ $part ] . ')' : '(.*)';
				}
			}
			foreach ( $parameters as $key => $parameter )
			{
				if ( in_array( $key, $args[ 'exclude_tags' ] ) )
					continue;
				if ( preg_match( '/\(.*\)/', $parameter ) )
				{
					$regex_parameters[ $key_prefix . $key ] = $parameter;
					$regex                                  = str_replace( '{' . $key . '}', $parameter, $regex );
				}
			}
		}

		$http_query_parameters      = $parameters;
		$http_query_parameters_text = '';
		$counter                    = 1;
		foreach ( $http_query_parameters as $key => $value )
		{
			$value                      = isset( $regex_parameters[ $key_prefix . $key ] ) ? '$matches[' . $counter . ']' : $value;
			$key                        = isset( $regex_parameters[ $key_prefix . $key ] ) ? $key_prefix . $key : $key;
			$http_query_parameters_text .= $key . '=' . $value . '&';
			if ( isset( $regex_parameters[ $key ] ) )
				$counter++;
		}
		$http_query_parameters_text = mb_substr( $http_query_parameters_text, 0, strlen( $http_query_parameters_text ) - 1 );
		self::$routes[]             = [
			'controller' => $controller,
			'regex' => '^' . $regex . '$',
			'request_method' => $args[ 'request_method' ],
			'regex_parameters' => $regex_parameters,
			'http_query' => $http_query_parameters_text,
		];
		return true;
	}

	/**
	 * this is a GET request route
	 *
	 * @param       $route
	 * @param       $controller
	 * @param array $args
	 *
	 * @return bool
	 */
	public static function get( $route, $controller, $args = [] )
	{
		return self::make( $route, $controller, array_merge( [
			'request_method' => 'GET',
		], $args ) );
	}

	/**
	 * this is a POST request route
	 *
	 * @param       $route
	 * @param       $controller
	 * @param array $args
	 *
	 * @return bool
	 */
	public static function post( $route, $controller, $args = [] )
	{
		return self::make( $route, $controller, array_merge( [
			'request_method' => 'POST',
		], $args ) );
	}

	/**
	 * finalize routes
	 *
	 * @return bool
	 */
	public static function finalize()
	{
		if ( ! self::$finalized )
		{
			$self            = new self;
			self::$finalized = true;

			// enter routes added in routes.php file
			include_once NVM_DIR_PATH . '/inc/base/routes.php';

			//add wordpress rewrite rules
			add_action( 'init', [
				$self,
				'add_rewrite_rules',
			] );

			// check for 404 pages
			add_action( 'template_redirect', [
				$self,
				'check_404_page',
			] );

			// show the controller entered in routes
			add_filter( 'page_template', [
				$self,
				'controller',
			], 999 );
		}
		return true;
	}

	/**
	 * this method checks the errors we have and shows the 404 page
	 */
	public function check_404_page()
	{
		global $wp_query;
		if ( $wp_query->is_page && $wp_query->query_vars[ 'page_id' ] == self::get_route_post_id() )
		{
			if ( self::$routes )
			{
				foreach ( self::$routes as $route )
				{
					if ( self::is_route_active( $route ) && $route[ 'request_method' ] != $_SERVER[ 'REQUEST_METHOD' ] )
					{
						$wp_query->is_page = false;
						$wp_query->set_404();
					}
				}
			}
		}
	}

	/**
	 * add rewrite rules for wordpress rewrite system
	 */
	public function add_rewrite_rules()
	{
		if ( self::$routes )
		{
			foreach ( self::$routes as $route )
			{
				add_rewrite_rule( '^' . $route[ 'regex' ] . '$', 'index.php?' . $route[ 'http_query' ], 'top' );
				if ( $route[ 'regex_parameters' ] )
				{
					foreach ( $route[ 'regex_parameters' ] as $key => $parameter )
					{
						add_rewrite_tag( "%$key%", $parameter );
					}
				}
			}
			flush_rewrite_rules();
		}
	}

	/**
	 * @param $content
	 *
	 * @return false|string
	 */
	public function controller( $content )
	{
		if ( self::$routes && is_page( self::get_route_post_id() ) )
		{
			foreach ( self::$routes as $route )
			{
				$is_correct = false;

				if ( self::is_route_active( $route, true ) )
				{
					$is_correct = true;
				}

				if ( $is_correct )
				{
					$arguments      = [];
					$arguments_text = '';
					$counter        = 0;
					foreach ( $route[ 'regex_parameters' ] as $k => $r )
					{
						$k              = get_query_var( $k );
						$arguments_text .= ( $counter ? ',' : '' ) . " '$k'";
						$arguments[]    = $k;
						$counter++;
					}
					ob_start();
					if ( is_callable( $route[ 'controller' ] ) )
					{
						$output = call_user_func_array( $route[ 'controller' ], $arguments );
					} else
					{
						$output = Controller::grab( $route[ 'controller' ], $arguments );
					}
					echo is_array( $output ) ? json_encode( $output, JSON_UNESCAPED_UNICODE ) : $output;
					$controller = ob_get_clean();

					if ( is_array( $output ) )
					{
						header( 'Content-Type: application/json' );
					}

					if ( mb_substr( $controller, strlen( $controller ) - 4, 4 ) == '.php' )
						$content = $controller;
					else
						die( $controller );
				}
			}
		}
		return $content;
	}

	/**
	 * this method checks the provided route is now active or not
	 *
	 * @param      $route
	 * @param bool $check_request_method
	 *
	 * @return bool
	 */
	private static function is_route_active( $route, $check_request_method = false )
	{
		$current_path     = str_replace( site_url(), '', pmw_get_current_url() );
		$current_path     = explode( '?', $current_path )[ 0 ];
		$current_path     = self::trim_slashes( $current_path );
		$route[ 'regex' ] = str_replace( '/', '\/', $route[ 'regex' ] );

		if ( preg_match( '/' . $route[ 'regex' ] . '/', $current_path ) )
		{
			if ( $check_request_method && $route[ 'request_method' ] == $_SERVER[ 'REQUEST_METHOD' ] )
				return true;
			else if ( ! $check_request_method )
				return true;
		}
		return false;
	}

	/**
	 * this method will generate default post id for routes
	 *
	 * @return int
	 */
	public static function get_route_post_id()
	{
		if ( ! self::$route_post_id )
		{
			$posts = get_posts( [
				'post_type' => [ 'page' ],
				'post_status' => [ 'publish' ],
				'posts_per_page' => 2,
				'post__not_in' => [ get_option( 'page_on_front' ) ],
			] );

			if ( count( $posts ) > 1 )
			{
				foreach ( $posts as $key => $post )
				{
					if ( $post->post_title == 'Routing' )
					{
						wp_delete_post( $post->ID, true );
						unset( $posts[ $key ] );
						break;
					}
				}
			}
			$post_id = $posts ? reset( $posts )->ID : '';

			if ( ! $post_id )
			{
				$post_id = wp_insert_post( [
					'post_title' => 'Routing',
					'post_type' => 'page',
					'post_status' => 'publish',
				] );
			}
			self::$route_post_id = $post_id ? $post_id : 1;
		}

		return self::$route_post_id;
	}

	/**
	 * @param $text
	 *
	 * @return array|bool
	 */
	public static function extract_parameters( $text )
	{
		if ( ! $text )
			return false;

		preg_match_all( '/(\{[\w]+\})/', $text, $matches, PREG_PATTERN_ORDER );
		$matches = array_map( 'array_unique', $matches );

		if ( ! $matches )
			return false;

		$parameters = [];
		foreach ( $matches[ 0 ] as $match )
		{
			$name         = preg_replace( '/^\{(.*)\}$/', '$1', $match );
			$parameters[] = $name;
		}

		return $parameters;
	}

	/**
	 * this method removes the slashes from beginning and ending of text
	 *
	 * @param $text
	 *
	 * @return string
	 */
	public static function trim_slashes( $text )
	{
		$first = mb_substr( $text, 0, 1 );
		$last  = mb_substr( $text, strlen( $text ) - 1, 1 );

		if ( $first == '/' )
			$text = mb_substr( $text, 1, strlen( $text ) );
		if ( $last == '/' )
			$text = mb_substr( $text, 0, strlen( $text ) - 1 );

		return $text;
	}
}