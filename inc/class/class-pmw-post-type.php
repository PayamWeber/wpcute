<?php
/* dont access if use directly */
if( ! defined( 'ABSPATH' ) )
	exit;

/**
* pmw custom post type class
*/
class PMW_PostType
{

	// post type arguments
	public $post_type_args = array(
		'labels' => array(
			'name' => 'پست ها',
	        'singular_name' => 'پست',
	        'add_new_item' => 'افزودن پست جدید',
	        'add_new' => 'افزودن پست',
	        'not_found' => 'هیچ پستی پیدا نشد'
		)
	);


	// post type name
	public $post_type_name;


	// taxonomy arguments
	public $taxonomy_args;


	// taxonomy name
	public $taxonomy_name;


	// maname edit columns callback function
	public $manage_edit_columns;


	// maname edit posts columns callback function
	public $manage_edit_posts_columns;


	
	public function __construct( $post_type_name )
	{
		$this->post_type_name = $post_type_name;
	}

	/**
	 * register post type by pmw function
	 * @param  string 			$post_type_name 	string as custom post type name
	 * @return void/WP_Error                 		return void if success or WP error
	 */
	public function register( array $post_type_args )
	{
		$this->post_type_args = $post_type_args ? pmw_array_merge( $this->post_type_args, $post_type_args ) : $this->post_type_args;

		if ( $this->post_type_name )
            register_post_type( $this->post_type_name, $this->post_type_args );
	}

	/**
	 * register taxonomy for current post type
	 * @param  string 			$taxonomy_name 		taxonomy name
	 * @param  array 			$taxonomy_args 		taxonomy arguments
	 * @return void/boolean                			return void if success and return false if some thing wrong
	 */
	public function taxonomy( $taxonomy_name, array $taxonomy_args )
	{
		if ( ! $this->post_type_name || ! is_string( $this->post_type_name ) )
			return false;

		$this->taxonomy_args = $taxonomy_args;

		$this->taxonomy_name = $taxonomy_name;

		// init action for do this
        $this->register_taxonomy_init();
	}

	/**
	 * register taxonomy init action for wordpress
	 * @return void 	register that taxonomy
	 */
	public function register_taxonomy_init()
	{
		register_taxonomy(
	        $this->taxonomy_name,
	        $this->post_type_name,
	        $this->taxonomy_args
	    );
	}


	/**
	 * post type columns edit
	 * @param  callable 	$manage_edit_columns 	a function to edit columns
	 * @return void                      			do the job
	 */
	public function columns( $manage_edit_columns, $manage_edit_posts_columns )
	{
		$this->manage_edit_columns = $manage_edit_columns;
		
		$this->manage_edit_posts_columns = $manage_edit_posts_columns;

		// load manage edit columns filter if isset 
		if ( is_callable( $manage_edit_columns ) )
		{
			add_filter( "manage_edit-{$this->post_type_name}_columns", array( $this, 'manage_edit_columns' ) );
		}

		// load manage edit columns filter if isset 
		if ( is_callable( $manage_edit_posts_columns ) )
		{
			add_filter( "manage_{$this->post_type_name}_posts_custom_column", array( $this, 'manage_edit_posts_columns' ), 10, 2 );
		}
	}


	/**
	 * manage post type edit columns hook
	 * @param  array 	$columns 	columns array
	 * @return array          		return columns as array
	 */
	public function manage_edit_columns( $columns )
	{
		// run function
		$manage_edit_columns = $this->manage_edit_columns;

		// default return
		return $manage_edit_columns( $columns );
	}


	/**
	 * manage post type edit columns hook
	 * @param  array 	$columns 	columns array
	 * @return array          		return columns as array
	 */
	public function manage_edit_posts_columns( $column, $post_id )
	{
		// run function
		$manage_edit_posts_columns = $this->manage_edit_posts_columns;

		// default return
		return $manage_edit_posts_columns( $column, $post_id );
	}
}