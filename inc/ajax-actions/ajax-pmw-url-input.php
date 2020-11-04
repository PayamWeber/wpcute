<?php
/* dont access if use directly */
if( ! defined( 'ABSPATH' ) )
	exit;


/**
 * pmw ajax function for front end section settings
 * @return [type] [description]
 */
function pmw_ajax_url_input()
{

	/**
	 * do security works
	 * @var PMW_Security
	 */
	$security = new PMW_Security( array(
		'post' => $_POST['nonce'],
		'action' => $_POST['nonce_action']
	) );

    // check admin security
    if ( ! $security->admin_security() )
        die( 'یک مشکل امنیتی به وجود آمد !' );

    echo "<ul class='pmw_url_input_list'>";
    pmw_get_posts(array(
        'query_args' => array(
            'post_type' => array( 'post', 'page', 'service' ),
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