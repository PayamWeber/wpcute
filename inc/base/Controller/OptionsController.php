<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;

class OptionsController extends Controller
{
	public $data = [];

	public function save()
	{
		$all = Input::all();

		if( ! is_admin() && ! is_super_admin() )
			die();

		if( ! isset( $all['nonce'] ) || ! wp_verify_nonce( $all['nonce'], 'nvm-options-request-nonce' ) )
			die();

		if( $all )
		{
			foreach ( $all as $key => $item )
			{
				if ( strpos( $key, NVM_SETTINGS_NAME ) === false )
					update_option($key, $item);
			}
		}

		return [
			'success' => true
		];
	}

	public function find_url()
	{
		if( ! is_admin() && ! is_super_admin() )
			die();

		echo "<ul class='pmw_url_input_list'>";
		pmw_get_posts(array(
			'query_args' => array(
				'post_type' => array( 'post', 'page', 'service', 'package', 'special_card', 'discount' ),
				'posts_per_page' => 25,
				's' => $_POST['search']
			),
			'callback' => function(){
				?>
				<li post-id="<?php the_ID(); ?>" post-url="<?php the_permalink(); ?>"><?php the_title(); ?></li>
				<?php
			}
		));
		echo '</ul>';
		die();
	}
}