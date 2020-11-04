<?php
// pmw file size converter
function pmw_filesize_convert( $bytes )
{
	$bytes   = floatval( $bytes );
	$arBytes = [
		0 => [
			"UNIT" => "TB",
			"VALUE" => pow( 1024, 4 ),
		],
		1 => [
			"UNIT" => "GB",
			"VALUE" => pow( 1024, 3 ),
		],
		2 => [
			"UNIT" => "MB",
			"VALUE" => pow( 1024, 2 ),
		],
		3 => [
			"UNIT" => "KB",
			"VALUE" => 1024,
		],
		4 => [
			"UNIT" => "B",
			"VALUE" => 1,
		],
	];
	foreach ( $arBytes as $arItem )
	{
		if ( $bytes >= $arItem[ "VALUE" ] )
		{
			$result = $bytes / $arItem[ "VALUE" ];
			$result = str_replace( ".", ",", strval( round( $result, 2 ) ) ) . " " . $arItem[ "UNIT" ];
			break;
		}
	}

	return $result;
}

// pmw title tag generator
function pmw_wp_title()
{
	if ( is_front_page() )
	{
		return wp_title( '', 'left', FALSE );
	} else
	{
		if ( is_page( "blog" ) && $_GET[ "search" ] && isset( $_GET[ "search" ] ) )
		{
			return $_GET[ "search" ];
		} else
		{
			return wp_title( '', 'left', FALSE );
		}
	}
}

// pmw main menu
function pmw_print_nav_menu( $theme_location, $menu_type = 'main', $return_html = false )
{
	$nav = new NavHelper();

	return $nav->PrintMenu( $theme_location, $menu_type, $return_html );
}

function pmw_print_divided_nav_menu( $theme_location, $position = 'left', $menu_type = 'second_footer', $return_html = false )
{
	$nav = new NavHelper();

	return $nav->PrintDividedMenu( $theme_location, $position, $menu_type, $return_html );
}

/**
 * this function make a nav menu for theme
 *
 * @param string         $theme_location
 * @param string|integer $id
 * @param integer        $current_depth
 * @param bool           $is_super
 *
 * @return void
 */
function pmw_main_nav_menu_old( $theme_location = NULL, $id = NULL, $current_depth = 1, $is_super = FALSE )
{
	if ( ( $theme_location ) && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $theme_location ] ) )
	{
		$menu       = get_term( $locations[ $theme_location ], 'nav_menu' );
		$menu_items = wp_get_nav_menu_items( $menu->term_id );
		// get half size
		$half_size = intval( count( array_keys( $menu_items ) ) / 2 );
		if ( $menu_items )
		{
			$_GET[ 'nav-menu-counter' ]   = isset( $_GET[ 'nav-menu-counter' ] ) ? intval( $_GET[ 'nav-menu-counter' ] ) : 1;
			$_GET[ 'super-menu-counter' ] = isset( $_GET[ 'super-menu-counter' ] ) ? intval( $_GET[ 'super-menu-counter' ] ) : 1;
			$next_depth                   = $current_depth + 1;
			if ( $is_super === FALSE )
			{
				if ( $id && $current_depth == 2 )
				{
					echo "<div class=\"navbar-dropdown navbar-dropdown-single\"><div class=\"navbar-box\"><div class=\"box-2\"><div class=\"box clearfix\"><ul>";
				}
				foreach ( $menu_items as $key => $item )
				{
					$link     = $item->url;
					$title    = $item->title;
					$isset_id = NULL;
					if ( $id )
					{
						$isset_id = $item->menu_item_parent == $id;
					} else
					{
						$isset_id = ! $item->menu_item_parent;
					}
					if ( $isset_id )
					{
						$active_class = '';
						/**
						 * setup active class
						 */
						$last_url_char = mb_substr( $link, -1, 1, 'UTF-8' );
						$fixed_link    = ( $last_url_char === '/' ) ? $link : $link . '/';
						if ( get_the_permalink( get_the_ID() ) == $fixed_link || ( $fixed_link == home_url( '/' ) && is_front_page() ) )
						{
							$active_class = 'current-menu-item';
						}
						$has_child = isset( $menu_items[ $key + 1 ] ) ? $item->ID == $menu_items[ $key + 1 ]->menu_item_parent : false;
						$is_zero   = $item->menu_item_parent == 0;
						$is_super  = intval( $item->super ) === 1;
						echo '<li class="' . ( ( $has_child && $current_depth == 2 ) ? 'label' : '' ) . '" id="menu-item-' . $item->ID . '">';
						if ( ! $has_child )
						{
							echo '<a class="" href="' . $fixed_link . '">' . $title . '</a>';
						}
						if ( $has_child && $current_depth == 2 )
						{
							echo $title;
						} else if ( $has_child && $current_depth != 2 )
						{
							echo '<a href="' . $link . '" class="">' . $title . ( $is_zero ? '<span class="open-dropdown"><i class="fa fa-angle-down"></i></span>' : '' ) . '</a>';
						}
						if ( $has_child )
						{
							pmw_main_nav_menu( $theme_location, $item->ID, $next_depth, $is_super );
						}
						echo '</li>';
					}
					$_GET[ 'nav-menu-counter' ]++;
				}
				if ( $id && $current_depth == 2 )
				{
					echo "</ul></div></div></div></div>";
				}
			} else
			{
				if ( $id && $current_depth == 2 )
				{
					echo "<div class=\"navbar-dropdown\"><div class=\"navbar-box\"><div class=\"box-2\"><div class=\"box clearfix\"><div class=\"row\">";
					$_GET[ 'last-row-number' ] = isset( $_GET[ 'last-row-number' ] ) ? $_GET[ 'last-row-number' ] : $_GET[ 'super-menu-counter' ];
				}
				foreach ( $menu_items as $key => $item )
				{
					if ( $_GET[ 'super-menu-counter' ] == $_GET[ 'last-row-number' ] && $current_depth == 2 )
					{
						echo "<div class=\"clearfix\">";
					}
					$link     = $item->url;
					$title    = $item->title;
					$isset_id = NULL;
					if ( $id )
					{
						$isset_id = $item->menu_item_parent == $id;
					} else
					{
						$isset_id = ! $item->menu_item_parent;
					}
					if ( $isset_id )
					{
						$active_class = '';
						/**
						 * setup active class
						 */
						$last_url_char = mb_substr( $link, -1, 1, 'UTF-8' );
						$fixed_link    = ( $last_url_char === '/' ) ? $link : $link . '/';
						if ( get_the_permalink( get_the_ID() ) == $fixed_link || ( $fixed_link == home_url( '/' ) && is_front_page() ) )
						{
							$active_class = 'current-menu-item';
						}
						$has_child = isset( $menu_items[ $key + 1 ] ) ? $item->ID == $menu_items[ $key + 1 ]->menu_item_parent : false;
						$is_zero   = $item->menu_item_parent == 0;
						if ( $current_depth == 2 )
						{
							echo "<div class=\"col-md-3\"><ul>";
							$_GET[ 'last-element-id' ] = isset( $_GET[ 'last-element-id' ] ) ? $_GET[ 'last-element-id' ] : pmw_find_last_member_of_second_depth_nav_menu( $theme_location, $key );
						}
						echo '<li class="' . ( ( $has_child && $current_depth == 2 ) ? 'label' : '' ) . '" id="menu-item-' . $item->ID . '">';
						if ( ! $has_child )
						{
							echo '<a class="" href="' . $fixed_link . '">' . $title . '</a>';
						}
						if ( $has_child && $current_depth == 2 )
						{
							echo $title;
						} else if ( $has_child && $current_depth != 2 )
						{
							echo '<a href="' . $link . '" class="">' . $title . ( $is_zero ? '<span class="open-dropdown"><i class="fa fa-angle-down"></i></span>' : '' ) . '</a>';
						}
						if ( $has_child )
						{
							pmw_main_nav_menu( $theme_location, $item->ID, $next_depth );
						}
						echo '</li>';
						if ( $current_depth == 2 )
						{
							echo "</ul></div>";
						}
						$is_last_child = isset( $_GET[ 'last-element-id' ] ) ? $_GET[ 'last-element-id' ] == $key : false;
						if ( ( $_GET[ 'super-menu-counter' ] == $_GET[ 'last-row-number' ] || $is_last_child ) && $current_depth == 2 )
						{
							echo "</div>";
							$_GET[ 'last-row-number' ] += 4;
						}
					}
					$_GET[ 'nav-menu-counter' ]++;
					if ( $current_depth == 2 )
					{
						$_GET[ 'super-menu-counter' ]++;
					}
				}
				if ( $id && $current_depth == 2 )
				{
					echo "</div></div></div></div></div>";
				}
			}
		}
	}
}

function pmw_find_last_member_of_second_depth_nav_menu( $theme_location, $number )
{
	if ( ( $theme_location ) && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $theme_location ] ) )
	{
		$array      = [];
		$menu       = get_term( $locations[ $theme_location ], 'nav_menu' );
		$menu_items = wp_get_nav_menu_items( $menu->term_id );
		if ( $menu_items )
		{
			foreach ( $menu_items as $key => $item )
			{
				if ( $item->menu_item_parent == $menu_items[ $number ]->menu_item_parent )
				{
					$array[] = $key;
				}
			}
			$last = end( $array );
			foreach ( $menu_items as $key => $item )
			{
				if ( $item->menu_item_parent == $last )
				{
					$last = $key;
				}
			}
		}
	}
	return $last;
}

//pmw set and get post views
function getPostViews( $postID )
{
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, TRUE );
	if ( $count == '' || $count == 0 )
	{
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );

		return "بدون بازدید";
	}

	return $count . ' بازدید';
}

// function to count views.
function setPostViews( $postID )
{
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, TRUE );
	if ( $count == '' )
	{
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else
	{
		$count++;
		update_post_meta( $postID, $count_key, $count );
	}
}

/**
 * this function create pagination for shop and blog page
 *
 * @param  string $numpages  [number of pages]
 * @param  string $pagerange [range of page]
 * @param  string $paged     [current page number]
 *
 * @return void/html            [echo html pagination code]
 */
function pmw_pagination( $numpages = '', $pagerange = '', $paged = '' )
{
	if ( empty( $pagerange ) )
	{
		$pagerange = 2;
	}
	global $paged;
	if ( empty( $paged ) )
	{
		$paged = 1;
	}
	if ( $numpages == '' )
	{
		global $wp_query;
		$numpages = $wp_query->max_num_pages;
		if ( ! $numpages )
		{
			$numpages = 1;
		}
	}
	$format = 'page/%#%';
	if ( $_GET[ 'search' ] )
	{
		$format = '&paged=%#%';
	}
	if ( is_category() || is_tag() )
	{
		$format = '?paged=%#%';
	}
	$pagination_args = [
		'base' => get_pagenum_link( 1 ) . '%_%',
		'format' => $format,
		'total' => $numpages,
		'current' => $paged,
		'show_all' => FALSE,
		'end_size' => 1,
		'mid_size' => $pagerange,
		'prev_next' => TRUE,
		'prev_text' => __( '&laquo;' ),
		'next_text' => __( '&raquo;' ),
		'type' => 'plain',
		'add_args' => FALSE,
		'add_fragment' => '',
	];
	$paginate_links  = paginate_links( $pagination_args );
	if ( $paginate_links )
	{
		echo $paginate_links;
	}
}

/**
 * this function create pagination for shop and blog page
 *
 * @param  string $numpages  [number of pages]
 * @param  string $pagerange [range of page]
 * @param  string $paged     [current page number]
 *
 * @return void/html            [echo html pagination code]
 */
function pmw_special_pagination( $numpages = '', $format = 'page_number', $url, $pagerange = '', $paged = '' )
{
	if ( empty( $pagerange ) )
	{
		$pagerange = 2;
	}
	$paged = isset( $_GET[ 'page_number' ] ) ? $_GET[ 'page_number' ] : 1;
	if ( empty( $paged ) )
	{
		$paged = 1;
	}
	if ( $numpages == '' )
	{
		global $wp_query;
		$numpages = $wp_query->max_num_pages;
		if ( ! $numpages )
		{
			$numpages = 1;
		}
	}
	//$format = '?page_number=%#%';
	$_GET   = array_filter( $_GET, function ( $var ) {
		$var = is_array( $var ) ? 'variable' : strval( $var );
		if ( $var && strpos( $_SERVER[ 'REQUEST_URI' ], $var ) === FALSE )
		{
			return FALSE;
		}

		return TRUE;
	} );
	$format = array_merge( $_GET, [
		$format => '%#%',
	] );
	$format = str_replace( '%25%23%25', '%#%', '?' . http_build_query( $format ) );
//    echo '<pre dir="ltr">'; var_dump( $format ); echo '</pre>';
//    die();
//    if ( $_GET['search'] )
//    {
//        $format = '&page_number=%#%';
//        $url .= '?search=' . $_GET['search'];
//    }
//    if ( is_category() || is_tag() || is_archive() ) $format = '?page_number=%#%';
	$pagination_args = [
		'base' => $url . '%_%',
		'format' => $format,
		'total' => $numpages,
		'current' => $paged,
		'show_all' => FALSE,
		'end_size' => 1,
		'mid_size' => $pagerange,
		'prev_next' => TRUE,
		'prev_text' => __( '&laquo;' ),
		'next_text' => __( '&raquo;' ),
		'type' => 'list',
		'add_args' => FALSE,
		'add_fragment' => '',
	];
	$paginate_links  = pmw_paginate_links( $pagination_args );
	if ( $paginate_links )
	{
		echo $paginate_links;
	}
}

/**
 * this function create pagination for shop and blog page
 *
 * @param  string $numpages  [number of pages]
 * @param  string $pagerange [range of page]
 * @param  string $paged     [current page number]
 *
 * @return void/html            [echo html pagination code]
 */
function pmw_paginate_links( $args = '' )
{
	global $wp_query, $wp_rewrite;
	// Setting up default values based on the current URL.
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$url_parts    = explode( '?', $pagenum_link );
	// Get max pages and current page out of the current query, if available.
	$total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
	$current = ( isset( $_GET[ 'page_number' ] ) && $_GET[ 'page_number' ] ) ? intval( $_GET[ 'page_number' ] ) : 1;
	// Append the format placeholder to the base URL.
	$pagenum_link = trailingslashit( $url_parts[ 0 ] ) . '%_%';
	// URL base depends on permalink settings.
	$format   = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format   .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';
	$defaults = [
		'base' => $pagenum_link,
		// http://example.com/all_posts.php%_% : %_% is replaced by format (below)
		'format' => $format,
		// ?page=%#% : %#% is replaced by the page number
		'total' => $total,
		'current' => $current,
		'show_all' => FALSE,
		'prev_next' => TRUE,
		'prev_text' => __( '&laquo; Previous' ),
		'next_text' => __( 'Next &raquo;' ),
		'end_size' => 1,
		'mid_size' => 2,
		'type' => 'plain',
		'add_args' => [],
		// array of query args to add
		'add_fragment' => '',
		'before_page_number' => '',
		'after_page_number' => '',
	];
	$args     = wp_parse_args( $args, $defaults );
	if ( ! is_array( $args[ 'add_args' ] ) )
	{
		$args[ 'add_args' ] = [];
	}
	// Merge additional query vars found in the original URL into 'add_args' array.
	if ( isset( $url_parts[ 1 ] ) )
	{
		// Find the format argument.
		$format       = explode( '?', str_replace( '%_%', $args[ 'format' ], $args[ 'base' ] ) );
		$format_query = isset( $format[ 1 ] ) ? $format[ 1 ] : '';
		wp_parse_str( $format_query, $format_args );
		// Find the query args of the requested URL.
		wp_parse_str( $url_parts[ 1 ], $url_query_args );
		// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
		foreach ( $format_args as $format_arg => $format_arg_value )
		{
			unset( $url_query_args[ $format_arg ] );
		}
		$args[ 'add_args' ] = array_merge( $args[ 'add_args' ], urlencode_deep( $url_query_args ) );
	}
	// Who knows what else people pass in $args
	$total = (int) $args[ 'total' ];
	if ( $total < 2 )
	{
		return;
	}
	$current  = (int) $args[ 'current' ];
	$end_size = (int) $args[ 'end_size' ]; // Out of bounds?  Make it the default.
	if ( $end_size < 1 )
	{
		$end_size = 1;
	}
	$mid_size = (int) $args[ 'mid_size' ];
	if ( $mid_size < 0 )
	{
		$mid_size = 2;
	}
	$add_args   = $args[ 'add_args' ];
	$r          = '';
	$page_links = [];
	$dots       = FALSE;
	if ( $args[ 'prev_next' ] && $current && 1 < $current ) :
		$link = str_replace( '%_%', 1 == $current ? '' : $args[ 'format' ], $args[ 'base' ] );
		$link = str_replace( '%#%', $current - 1, $link );
		if ( $add_args )
		{
			$link = add_query_arg( $add_args, $link );
		}
		$link .= $args[ 'add_fragment' ];
		/**
		 * Filters the paginated links for the given archive pages.
		 *
		 * @since 3.0.0
		 *
		 * @param string $link The paginated link URL.
		 */
		$page_links[] = '<li><a href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '"><span class="sr-only">قبلی</span><i class="fa  fa-angle-left"></i></a></li>';
	else:
		$page_links[] = '<li class="disabled"><a href="#"><span class="sr-only">قبلی</span><i class="fa  fa-angle-left"></i></a></li>';
	endif;
	for ( $n = 1; $n <= $total; $n++ ) :
		$link = str_replace( '%_%', $args[ 'format' ], $args[ 'base' ] );
		$link = str_replace( '%#%', $n, $link );
		if ( $add_args )
		{
			$link = add_query_arg( $add_args, $link );
		}
		$link .= $args[ 'add_fragment' ];

		if ( $n == $current ) :
			$page_links[] = "<li class='current'><a href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>" . $args[ 'before_page_number' ] . number_format_i18n( $n ) . $args[ 'after_page_number' ] . "</a></li>";
			$dots         = TRUE;
		else :
			if ( $args[ 'show_all' ] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
				/** This filter is documented in wp-includes/general-template.php */
				$page_links[] = "<li><a href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>" . $args[ 'before_page_number' ] . number_format_i18n( $n ) . $args[ 'after_page_number' ] . "</a></li>";
				$dots         = TRUE;
			elseif ( $dots && ! $args[ 'show_all' ] ) :
				$page_links[] = '<li><a>' . __( '&hellip;' ) . '</a></li>';
				$dots         = FALSE;
			endif;
		endif;
	endfor;
	if ( $args[ 'prev_next' ] && $current && $current < $total ) :
		$link = str_replace( '%_%', $args[ 'format' ], $args[ 'base' ] );
		$link = str_replace( '%#%', $current + 1, $link );
		if ( $add_args )
		{
			$link = add_query_arg( $add_args, $link );
		}
		$link .= $args[ 'add_fragment' ];
		/** This filter is documented in wp-includes/general-template.php */
		$page_links[] = '<li><a href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '"><span class="sr-only">بعدی</span><i class="fa  fa-angle-right"></i></a></li>';
	else:
		$page_links[] = '<li class="disabled"><a href="#"><span class="sr-only">بعدی</span><i class="fa  fa-angle-right"></i></a></li>';
	endif;
	switch ( $args[ 'type' ] )
	{
		case 'array' :
			return $page_links;
		case 'list' :
			$r .= join( "\n\t", $page_links );
			break;
		default :
			$r = join( "\n", $page_links );
			break;
	}

	return $r;
}

/*
 * before main content
 */
function beforeIndexMainContainer()
{
	?>
	<div class="uma-fullwidth-colored uma-unique-grid rsb-vertical-space down-arrow-active remove-after" style="background: url(img/mapbg.png); background-repeat: repeat-x;">
	<?php
}

/*
 * after main content
 */
function afterIndexMainContainer()
{
	?>
	</div>
	<?php
}

/* secure echo for payam weber */
function pmwEcho( $value, $default = '' )
{
	echo $value ? stripslashes( $value ) : $default;
}

/* get pmw ajax url */
function pmwAjaxUrl()
{
	return get_template_directory_uri() . '/requests/pmw_ajax.php';
}

/**
 * { pmw load ajax function }
 *
 * @param  callable $action [description]
 *
 * @return [type]           [description]
 */
function pmw_load_ajax( $action )
{
	if ( function_exists( $action ) )
	{
		$action();
	}
}

/**
 * pmw footer content for pages
 *
 * @return html code for footer content
 */
function pmw_footer_content()
{
	?>
	<div class="footerBottom alignH posR">
		<div class="footerBottomLogo alignHV">
			<div class="footerBottomVline alignV"></div>
			<div class="footerBottomVline  alignV"></div>
		</div>
		<div class="footerContainer posR">
			<div class="socials2 alignV">
				<a href="<?php echo esc_attr( get_nvm_settings( 'instagram_link', 'javascript:void(0);' ) ); ?>"
				   class="inista2"></a>
				<a href="<?php echo esc_attr( get_nvm_settings( 'telegram_link', 'javascript:void(0);' ) ); ?>"
				   class="tele2"></a>
				<a href="<?php echo esc_attr( get_nvm_settings( 'facebook_link', 'javascript:void(0);' ) ); ?>"
				   class="face2"></a>
			</div>
			<p class="copyR alignV">
				design by selakpardaz
			</p>
		</div>
	</div>
	<?php
}

/**
 * ((((  deprecated  ))))
 * this function makes a pmw list items box and echo that
 *
 * @param  [array] $fields        an array of input names and values
 * @param  [array] $items         an array of items
 * @param  [string] $singular_name items singular name
 *
 * @return [html]                html code
 */
function pmw_make_list_items( $fields, $items, $singular_name = 'آیتم', $first_member_name, $theme = 'dark' )
{
	pmw_make_list_item( [
		'fields' => $fields,
		'items' => $items,
		'singular_name' => $singular_name,
		'first_member_name' => $first_member_name,
		'theme' => $theme,
	] );
}

/**
 * this function makes a pmw list items box
 *
 * @param  array $args [an array of arguments]
 *
 * @return void/html       [print pmw list item]
 */
function pmw_make_list_item( array $args )
{
	/**
	 * setup default arguments
	 */
	$defaults = [
		'fields' => '',
		'items' => '',
		'singular_name' => 'آیتم',
		'theme' => 'light',
		'single_input' => FALSE,
		'tab_select' => FALSE,
		'tab_items' => '',
		'tab_name' => '',
		'first_member_name' => '',
		// deprecated. don't need this any more
	];
	$args     = array_merge( $defaults, $args );
	if ( ! $args[ 'fields' ] || ! is_array( $args[ 'fields' ] ) )
	{
		return FALSE;
	}
	// additional custom classes for developer
	$additional_classes = '';
	$additional_classes .= ( $args[ 'single_input' ] === TRUE ) ? 'pmw_list_item_single_input' : '';
	?>
	<div class="pmw_list_items_container">
		<div class="pmw_list_items <?php echo esc_attr( $args[ 'theme' ] ); ?> pm_sortable">
			<?php
			if ( $args[ 'items' ] && $args[ 'items' ][ pmw_get_first_array_member( $args[ 'fields' ], TRUE ) ] )
			{
				foreach ( $args[ 'items' ][ pmw_get_first_array_member( $args[ 'fields' ], TRUE ) ] as $item_key => $item_title )
				{
					?>
					<div class="pmw_list_item_box <?php echo $additional_classes; ?>">
						<div class="pmw_list_item_options">
							<a class="dashicons dashicons-plus-alt add_pmw_item" title="اضافه کن"></a>
							<a class="dashicons dashicons-dismiss remove_pmw_item" title="حذف کن"></a>
						</div>
						<h4 class="pmw_list_item_title closed">
							<?php
							if ( $args[ 'tab_select' ] === TRUE && $args[ 'tab_items' ] )
							{
								echo '<a class="dashicons dashicons-arrow-down-alt2"></a>';
								echo '<span>' . $args[ 'tab_items' ][ $args[ 'items' ][ 'tab_name' ][ $item_key ] ] . '</span>';
							} else
							{
								if ( $args[ 'single_input' ] === TRUE )
								{
									$first_array_member = pmw_get_first_array_member( $args[ 'fields' ] );
									echo '<input class="' . $first_array_member[ 'classes' ] . '" type="text" name="' . $first_array_member[ 'name' ] . '" value="' . $item_title . '">';
								} else
								{
									echo '<a class="dashicons dashicons-arrow-down-alt2"></a>';
									echo '<span>' . ( ( mb_strlen( $item_title, 'UTF-8' ) > 50 ) ? mb_substr( $item_title, 0, 50, 'UTF-8' ) . ' . . .' : $item_title ) . '</span>';
								}
							}
							?>
						</h4>
						<?php
						if ( $args[ 'single_input' ] !== TRUE ):
							?>
							<div class="pmw_list_item_content">
								<?php
								// tab select
								if ( $args[ 'tab_select' ] === TRUE && $args[ 'tab_items' ] )
								{
									echo '<select class="tab_select_list_item" name="' . $args[ 'tab_name' ] . '">';
									foreach ( $args[ 'tab_items' ] as $key => $value )
									{
										$selected = ( $args[ 'items' ][ 'tab_name' ][ $item_key ] == $key ) ? 'selected="selected"' : '';
										echo "<option {$selected} value=\"{$key}\">{$value}</option>";
									}
									echo '</select>';
								}
								foreach ( $args[ 'fields' ] as $key => $value )
								{
									$type                   = isset( $value[ 'type' ] ) ? $value[ 'type' ] : '';
									$classes                = isset( $value[ 'classes' ] ) ? $value[ 'classes' ] : '';
									$value[ 'tab' ]         = isset( $value[ 'tab' ] ) ? $value[ 'tab' ] : '';
									$value[ 'title' ]       = isset( $value[ 'title' ] ) ? $value[ 'title' ] : '';
									$value[ 'placeholder' ] = isset( $value[ 'placeholder' ] ) ? $value[ 'placeholder' ] : '';
									$value[ 'name' ]        = isset( $value[ 'name' ] ) ? $value[ 'name' ] : '';
									// add tab class
									if ( $args[ 'tab_select' ] === TRUE && $args[ 'tab_items' ] )
									{
										$classes = $classes . ' ' . $value[ 'tab' ];
									}
									echo "<label class='{$value['tab']}'>" . $value[ 'title' ] . '</label>';
									// if its input text show this
									if ( $type == 'input-text' )
									{
										echo '<input placeholder="' . $value[ 'placeholder' ] . '" class="' . $classes . '" type="text" name="' . $value[ 'name' ] . '" value="' . esc_attr( $args[ 'items' ][ $key ][ $item_key ] ) . '">';
									}
									// if its input url show this
									if ( $type == 'input-url' )
									{
										pmw_url_input( $value[ 'name' ], str_replace( ']', '', str_replace( '[', '', $value[ 'name' ] ) ), esc_attr( $args[ 'items' ][ $key ][ $item_key ] ), $classes );
									}
									// if its textarea show this
									if ( $type == 'textarea' )
									{
										echo '<textarea placeholder="' . $value[ 'placeholder' ] . '" class="' . $classes . '" name="' . $value[ 'name' ] . '">' . esc_textarea( $args[ 'items' ][ $key ][ $item_key ] ) . '</textarea>';
									}
									// if its image upload show this
									if ( $type == 'image' )
									{
										$upload_id = preg_replace( '/[\[\]]/', '', $value[ 'name' ] ) . $item_key;
										echo '<div class="pmw-file-upload ' . $classes . '" id="' . $upload_id . '" upload-id="' . $upload_id . '" upload-type="image">
                                                <img src="' . esc_attr( wp_get_attachment_image_url( $args[ 'items' ][ $key ][ $item_key ], 'medium' ) ) . '" class="pmw-image-preview">
                                                <button class="orange ui button pmw-upload-button">آپلود تصویر</button>
                                                <input type="hidden" name="' . $value[ 'name' ] . '" value="' . esc_attr( $args[ 'items' ][ $key ][ $item_key ] ) . '" class="file-value">
                                            </div>';
									}
								}
								?>
							</div>
						<?php
						endif;
						?>
					</div>
					<?php
				}
			}
			?>
		</div>
		<div class="pmw_list_item_box  <?php echo $additional_classes; ?>">
			<div class="pmw_list_item_options">
				<a class="dashicons dashicons-plus-alt add_pmw_item" title="اضافه کن"></a>
				<a class="dashicons dashicons-dismiss remove_pmw_item" title="حذف کن"></a>
			</div>
			<h4 class="pmw_list_item_title closed">
				<?php
				if ( $args[ 'single_input' ] === TRUE )
				{
					$first_array_member = pmw_get_first_array_member( $args[ 'fields' ] );
					echo '<input class="' . $first_array_member[ 'classes' ] . '" type="text" hidden-name="' . $first_array_member[ 'name' ] . '" placeholder="یک ' . $args[ 'singular_name' ] . ' جدید">';
				} else
				{
					echo '<a class="dashicons dashicons-arrow-down-alt2"></a>';
					echo '<span>یک ' . $args[ 'singular_name' ] . ' جدید</span>';
				}
				?>
			</h4>
			<?php
			if ( $args[ 'single_input' ] !== TRUE ):
				?>
				<div class="pmw_list_item_content">
					<?php
					// tab select
					if ( $args[ 'tab_select' ] === TRUE && $args[ 'tab_items' ] )
					{
						echo '<select class="tab_select_list_item">';
						foreach ( $args[ 'tab_items' ] as $key => $value )
						{
							echo "<option value=\"{$key}\">{$value}</option>";
						}
						echo '</select>';
					}
					foreach ( $args[ 'fields' ] as $key => $value )
					{
						$type                   = isset( $value[ 'type' ] ) ? $value[ 'type' ] : '';
						$classes                = isset( $value[ 'classes' ] ) ? $value[ 'classes' ] : '';
						$value[ 'tab' ]         = isset( $value[ 'tab' ] ) ? $value[ 'tab' ] : '';
						$value[ 'title' ]       = isset( $value[ 'title' ] ) ? $value[ 'title' ] : '';
						$value[ 'placeholder' ] = isset( $value[ 'placeholder' ] ) ? $value[ 'placeholder' ] : '';
						$value[ 'name' ]        = isset( $value[ 'name' ] ) ? $value[ 'name' ] : '';
						// add tab class
						if ( $args[ 'tab_select' ] === TRUE && $args[ 'tab_items' ] )
						{
							$classes = $classes . ' ' . $value[ 'tab' ];
						}
						echo "<label class='{$value['tab']}'>" . $value[ 'title' ] . '</label>';
						// if its input text show this
						if ( $type == 'input-text' )
						{
							echo '<input placeholder="' . $value[ 'placeholder' ] . '" class="' . $classes . '" type="text" hidden-name="' . $value[ 'name' ] . '" value="">';
						}
						// if its input url show this
						if ( $type == 'input-url' )
						{
							pmw_url_input( $value[ 'name' ], str_replace( ']', '', str_replace( '[', '', $value[ 'name' ] ) ), '', $classes );
						}
						// if its textarea show this
						if ( $type == 'textarea' )
						{
							echo '<textarea placeholder="' . $value[ 'placeholder' ] . '" class="' . $classes . '" hidden-name="' . $value[ 'name' ] . '"></textarea>';
						}
						// if its image upload show this
						if ( $type == 'image' )
						{
							$upload_id = preg_replace( '/[\[\]]/', '', $value[ 'name' ] );
							echo '<div class="pmw-file-upload ' . $classes . '" id="' . $upload_id . '" upload-id="' . $upload_id . '" upload-type="image">
                                    <img src="" class="pmw-image-preview">
                                    <button class="orange ui button pmw-upload-button">آپلود تصویر</button>
                                    <input type="hidden" hidden-name="' . $value[ 'name' ] . '" value="" class="file-value">
                                </div>';
						}
					}
					?>
				</div>
			<?php
			endif;
			?>
		</div>
		<input class="button hide-if-no-js add_new_list_item <?php echo esc_attr( $args[ 'theme' ] ); ?>" type="button"
			   value="افزودن <?php echo $args[ 'singular_name' ]; ?>">
		<div class="clear_fix"></div>
	</div>
	<?php
}

/**
 * this function give you first member of an array
 *
 * @param   array   $array target array
 * @param   boolean $name  return array key(name)
 *
 * @return  mixed               value of first member
 */
function pmw_get_first_array_member( array $array, $name = FALSE )
{
	if ( $array )
	{
		$first_member = [];
		foreach ( $array as $key => $value )
		{
			return ( $name === TRUE ) ? $key : $value;
		}
	}

	return FALSE;
}

/**
 * get jsoned post meta as array
 *
 * @param  [string] $meta_key [ post meta key( name ) ]
 * @param  [string/integer] $post_id  [ post id ]
 *
 * @return array           [ return an array of json post meta ]
 */
function pmw_get_json_pmeta( $meta_key, $post_id )
{
	return json_decode( get_post_meta( $post_id, $meta_key, TRUE ), TRUE );
}

/**
 * this function tel us is this a custom page template or not
 *
 * @param  string $template name of pmw custom page template
 *
 * @return boolean           return true or false
 */
function pmw_is_page_tpl( $template )
{
	$template = sanitize_text_field( $template );

	return ( get_post_meta( get_the_ID(), 'sp_page_template', TRUE ) == $template ) ? TRUE : FALSE;
}

/**
 * this function return custom body class for every page
 *
 * @return string [return a string with classes or single class for body]
 */
function pmw_get_body_class()
{
	$classes   = [];
	$classes[] = 'page';
	$classes[] = 'page-' . ConfigHelper::get( 'page' );
	return implode( ' ', $classes );
}

/**
 * this function returns header title for custom pages and posts
 *
 * @return string [return a string of page title]
 */
function pmw_header_title( $type = '' )
{
	// if is search page
	if ( $_GET[ 'search' ] )
	{
		return $_GET[ 'search' ];
	}
	// if is page or post or custom post type
	if ( is_page() || is_singular() || is_single() )
	{
		return get_the_title( get_the_ID() );
	}
	// if is archive
	if ( $type == 'shop' )
	{
		return 'فروشگاه';
	}
	// if is archive
	if ( is_archive() )
	{
		return get_the_archive_title();
	}
	// if is category
	if ( is_category() )
	{
		return single_cat_title( 'دسته بندی ', FALSE );
	}
	// if is category
	if ( is_tag() )
	{
		return single_tag_title( 'برچسب ', FALSE );
	}
}

/**
 * this function return usr role
 *
 * @param $user
 *
 * @return array|bool|false|WP_User
 */
function pmw_get_user_role( $user )
{
	$uid = $user ? $user : get_current_user_id();
	if ( ! is_numeric( $uid ) )
	{
		return FALSE;
	}
	$user_role = get_userdata( $uid );
	$user_role = $user_role->roles;
	foreach ( $user_role as $role )
	{
		$user_role = $role;
		break;
	}

	return $user_role;
}

/**
 * get nav menu name
 *
 * @param  string $menu_location [menu location name]
 *
 * @return string                [return menu name or if not exist return empty string]
 */
function pmw_get_menu_name( $menu_location = NULL )
{
	if ( ! $menu_location )
	{
		return FALSE;
	}
	$menu_locations = get_nav_menu_locations();
	$menu_object    = ( isset( $menu_locations[ $menu_location ] ) ? wp_get_nav_menu_object( $menu_locations[ $menu_location ] ) : NULL );

	return ( isset( $menu_object->name ) ? $menu_object->name : '' );
}

/**
 * clean wordpress json decode
 *
 * @param  string  $json_array     [json code]
 * @param  boolean $is_post_custom [ is this a post custom array ]
 *
 * @return array            [a clean array]
 */
function pmw_clean_wpjson( array $json_array, $is_post_custom = FALSE )
{
	$clean_array = [];
	if ( is_array( $json_array ) )
	{
		if ( $is_post_custom === TRUE )
		{
			if ( $json_array )
			{
				foreach ( $json_array as $key => $value )
				{
					$value = $value[ 0 ];
					if ( is_array( $value ) )
					{
						$clean_array[ $key ] = pmw_clean_wpjson( $value );
						continue;
					}
					$clean_array[ $key ] = $value;
				}
			}
		} else
		{
			if ( $json_array[ 0 ] )
			{
				foreach ( $json_array[ 0 ] as $key => $value ) $clean_array[ $key ] = $value;
			}
		}
	}

	return $clean_array;
}

/**
 * print posts with this function
 *
 * @param  array $args [arguments]
 *
 * @return void/html       [print html code or return empty]
 */
function pmw_get_posts( array $args )
{
	// setup default args
	$defaults = [
		'query_args' => [
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 10,
		],
		'callback' => '',
		'offset' => 0,
		'force_count' => FALSE,
	];
	// merge arguments
	$args = pmw_array_merge( $defaults, $args );
	// query object
	$query = new WP_Query( ( $args[ 'query_args' ] ) ? $args[ 'query_args' ] : $defaults[ 'query_args' ] );
	// check force count
	if ( $args[ 'force_count' ] === TRUE && count( $query->posts ) < $args[ 'query_args' ][ 'posts_per_page' ] )
	{
		echo "<h5>دسته بندی باید حداقل {$args['query_args']['posts_per_page']} مطلب داشته باشد.</h5>";

		return FALSE;
	}
	if ( $query->have_posts() && $args[ 'callback' ] )
	{
		$count = 1;
		while ( $query->have_posts() )
		{
			$query->the_post();
			// continue if isset offset
			if ( $args[ 'offset' ] && $count <= $args[ 'offset' ] )
			{
				$count++;
				continue;
			}
			// load callback function
			$callback = $args[ 'callback' ];
			$callback( $count );
			// add count
			$count++;
		}
		wp_reset_query();
	}

	return $query;
}

/**
 * print terms with this function
 *
 * @param  array $args [arguments]
 *
 * @return void/html       [print html code or return empty]
 */
function pmw_get_terms( array $args )
{
	// setup default args
	$defaults = [
		'query_args' => [
			'taxonomy' => 'post_tag',
			'hide_empty' => FALSE,
		],
		'callback' => '',
		'offset' => 0,
	];
	// merge arguments
	$args = pmw_array_merge( $defaults, $args );
	// query object
	$terms = get_terms( ( $args[ 'query_args' ] ) ? $args[ 'query_args' ] : $defaults[ 'query_args' ] );
	if ( $terms )
	{
		$count = 1;
		foreach ( $terms as $key => $term )
		{
			// continue if isset offset
			if ( $args[ 'offset' ] && $count <= $args[ 'offset' ] )
			{
				$count++;
				continue;
			}
			$cb_args = [
				'count' => $count,
				'term' => $term,
			];
			// load callback function
			$callback = $args[ 'callback' ];
			$callback( $cb_args );
			// add count
			$count++;
		}
	}
}

/**
 * custom pmw array merge
 *
 * @param  array $array1 [first array]
 * @param  array $array2 [second array]
 *
 * @return array/boolean         [return array or false]
 */
function pmw_array_merge( array $array1, array $array2 )
{
	foreach ( $array1 as $key => $value )
	{
		$array1[ $key ] = isset( $array1[ $key ] ) ? $array1[ $key ] : '';
		$array2[ $key ] = isset( $array2[ $key ] ) ? $array2[ $key ] : '';

		if ( $array2[ $key ] && is_array( $array2[ $key ] ) && is_array( $array1[ $key ] ) )
		{
			$array1[ $key ] = pmw_array_merge( $array1[ $key ], $array2[ $key ] );
		} else
		{
			if ( ( $array2[ $key ] && ! is_array( $array2[ $key ] ) ) || ( $array2[ $key ] && is_array( $array2[ $key ] ) ) && ! is_array( $array1[ $key ] ) )
			{
				$array1[ $key ] = $array2[ $key ];
				unset( $array2[ $key ] );
			}
		}
	}

	return $array1 + $array2;
}

/**
 * check custom syntax error and print error
 *
 * @param  callable $check_function external function for check syntex
 * @param  mixed    $var            variable to check
 * @param  string   $error_text     custom error text
 *
 * @return void                                 print error
 */
function pmw_syntax_check( $check_function, $var, $error_text = '' )
{
	if ( ! function_exists( $check_function ) || ! $var )
	{
		return FALSE;
	}
	// current line number
	$func_called = debug_backtrace();
	// before and after error text
	$before_error = "<h4 style=\"font-weight: normal;\"> <strong>PMW Error:</strong> ";
	$after_error  = " in file [ <strong>{$func_called[0]['file']}</strong> ] ( On line <strong>{$func_called[0]['line']}</strong> ) </h4>";
	if ( ! $check_function( $var ) )
	{
		if ( $error_text && is_string( $error_text ) )
		{
			die( $before_error . $error_text . $after_error );
		}
		if ( $check_function == 'is_string' )
		{
			trigger_error( "variable '{$var}' must be string", E_USER_ERROR );
		}
		if ( $check_function == 'is_numeric' )
		{
			trigger_error( "variable '{$var}' must be numeric", E_USER_ERROR );
		}
	}
}

/**
 * this function check value is negative integer or not
 *
 * @param  integer $value a numeric value
 *
 * @return boolean                  if is negative return true if not return false
 */
function pmw_is_negative( $value )
{
	if ( ! is_numeric( $value ) )
	{
		return FALSE;
	}
	$value = intval( $value );
	if ( ( $value + abs( $value ) ) == 0 )
	{
		return TRUE;
	}

	return FALSE;
}

/**
 * include multiple php files
 *
 * @param  string  $dir          directory of where you want find files
 * @param  string  $prefix       files prefix
 * @param  boolean $hierarchical do you want to sub folder files ?
 *
 * @return void/error                   returns void or php error if files not exist
 */
function pmw_include_files( $dir, $prefix = '', $hierarchical = FALSE )
{
	$files = scandir( $dir );
	// remove dot member from array
	unset( $files[ array_search( '.', $files, TRUE ) ] );
	unset( $files[ array_search( '..', $files, TRUE ) ] );
	// prevent empty ordered elements
	if ( count( $files ) < 1 )
	{
		return;
	}
	foreach ( $files as $file )
	{
		if ( $hierarchical === TRUE && is_dir( $dir . '/' . $file ) )
		{
			listFolderFiles( $dir . '/' . $file );
		} else if ( substr( $file, -4, 4 ) == '.php' )
		{
			$file_path = $dir . '/' . ( ( $prefix ) ? $prefix . substr( $file, strlen( $prefix ), strlen( $file ) ) : $file );
			if ( file_exists( $file_path ) )
				include( $file_path );
		}
	}
}

/**
 * check is this value even
 *
 * @param  string /integer   $value  number for check
 *
 * @return boolean/error            reuturn boolean or error if has error
 */
function pmw_is_even( $value )
{
	pmw_syntax_check( 'is_numeric', $value );
	$value = intval( $value );
	if ( $value % 2 == 0 )
	{
		return TRUE;
	}

	return FALSE;
}


/**
 * this function create a smart url input for wordpress
 * @param        $name //input name
 * @param        $nonce_action
 * @param        $value
 * @param string $class //classes
 * @param bool   $print_html
 *
 * @return string
 */
function pmw_url_input( $name, $nonce_action, $value, $class = '', $print_html = true )
{
	$nonce = wp_create_nonce( $nonce_action );
	$url   = pmw_get_url( $value );
	$html  = <<<html
    <div class="pmw_url_input $class">
        <i class="pmw_nonce" action="$nonce_action"
           nonce="$nonce"></i>
        <div class="inputs">
            <input value="$url" class="visible"
                   placeholder="جستجو کنید یا آدرس را وارد کنید . . ." type="text"
                   onblur="remove_pmw_url_input_list();">
            <input value="$value" class="hidden" type="hidden"
                   name="$name">
        </div>
        <div class="selectable hidden-before"></div>
        <style></style>
    </div>
html;

	if ( $print_html )
		echo $html;
	else
		return $html;
}

/**
 * get url of post id or simple url
 *
 * @param  string $value value of url
 *
 * @return string                        return url if exist and if not return empty
 */
function pmw_get_url( $value )
{
	return ( is_numeric( $value ) ) ? get_the_permalink( $value ) : esc_url( $value );
}

/**
 * is this page contact us ?
 *
 * @return      boolean     return true and false
 */
function pmw_is_page_template( $template )
{
	return ( get_post_meta( get_the_ID(), 'sp_page_template', TRUE ) == $template ) ? TRUE : FALSE;
}

/**
 * include slider and pages big image
 *
 * @return  void    include that file
 */
function pmw_include_slider()
{
	get_template_part( 'part', 'slider' );
}

/**
 * call head tag and this content
 *
 * @param  callable $more contents to add end of tag
 *
 * @return void/html            print head tag
 */
function pmw_head( callable $more = NULL )
{
	if ( $more && ! is_callable( $more ) )
	{
		return FALSE;
	}
	?>
	<?php
}

/**
 * this function loads the custom options for theme by PayamWeber
 *
 * @param       array $options an array of options
 *
 * @return      void/html               do the job
 */
function pmw_load_options( array $options )
{
	// load options menu
	if ( isset( $options[ 'menu' ] ) )
	{
		echo "
        <aside>
        <ul>
        ";
		foreach ( $options[ 'menu' ] as $key => $value )
		{
			$_menu_id             = isset( $value[ 'id' ] ) ? $value[ 'id' ] : '';
			$_menu_class          = isset( $value[ 'class' ] ) ? $value[ 'class' ] : '';
			$_menu_icon           = ( isset( $value[ 'icon' ] ) && $value[ 'icon' ] ) ? $value[ 'icon' ] : 'dashicons-admin-settings';
			$_menu_title          = isset( $value[ 'title' ] ) ? $value[ 'title' ] : '';
			$_menu_children       = isset( $value[ 'children' ] ) ? $value[ 'children' ] : '';
			$_menu_before_content = isset( $value[ 'before_content' ] ) ? $value[ 'before_content' ] : '';
			$_menu_after_content  = isset( $value[ 'after_content' ] ) ? $value[ 'after_content' ] : '';
			echo "
            <li id=\"{$_menu_id}\" class=\"{$_menu_class}\">
                " . pmw_load_callable( $_menu_before_content ) . "
                <div>
                    <span class=\"dashicons {$_menu_icon}\"></span>
                    <span class=\"title\">{$_menu_title}</span>
            ";
			echo "
                </div>
            ";
			if ( is_array( $value[ 'children' ] ) && $value[ 'children' ] )
			{
				echo "<ul>";
				foreach ( $value[ 'children' ] as $child )
				{
					$_child_id    = $child[ 'id' ];
					$_child_title = $child[ 'title' ];
					echo "
                    <li id=\"{$_child_id}\">{$_child_title}</li>
                    ";
				}
				echo "</ul>";
			}
			echo "
                " . pmw_load_callable( $_menu_after_content ) . "
            </li>
            ";
		}
		echo "
        </ul>
        </aside>
        ";
	}
	// load options content
	if ( isset( $options[ 'content' ] ) )
	{
		$_section_before_content = isset( $options[ 'content' ][ 'before_content' ] ) ? $options[ 'content' ][ 'before_content' ] : '';
		$_section_after_content  = isset( $options[ 'content' ][ 'after_content' ] ) ? $options[ 'content' ][ 'after_content' ] : '';
		echo "
        <section>
        ";
		pmw_load_callable( $_section_before_content );
		if ( isset( $options[ 'content' ] ) )
		{
			foreach ( $options[ 'content' ] as $_key => $_value )
			{
				$_content_id             = isset( $_value[ 'id' ] ) ? $_value[ 'id' ] : '';
				$_content_class          = isset( $_value[ 'class' ] ) ? $_value[ 'class' ] : '';
				$_content_before_content = isset( $_value[ 'before_content' ] ) ? $_value[ 'before_content' ] : '';
				$_content_after_content  = isset( $_value[ 'after_content' ] ) ? $_value[ 'after_content' ] : '';
				$_content_title          = isset( $_value[ 'title' ] ) ? $_value[ 'title' ] : '';
				echo "
                <div id=\"block-{$_content_id}\" class=\"singleBlock {$_content_class}\">
                    " . pmw_load_callable( $_content_before_content ) . "
                    <h3 class=\"part_title\">{$_content_title}</h3>
                ";
				// settings loop
				if ( isset( $_value[ 'settings' ] ) )
				{
					pmw_load_options_settings( $_value[ 'settings' ] );
				}
				// settings loop
				pmw_load_callable( $_content_after_content );
				echo "
                </div>
                ";
			}
		}
		pmw_load_callable( $_section_after_content );
		echo "
        </section>
        ";
	}
}

/**
 * load a function if is callable
 *
 * @param   callable $func a callable variable
 *
 * @return  void                    do the job
 */
function pmw_load_callable( $func, array $args = NULL )
{
	if ( is_callable( $func ) )
	{
		( $args ) ? $func( $args ) : $func();
	}
}

/**
 * this function created for ( pmw_load_options function )
 * this function make settings given from developer as array
 *
 * @param  array $settings settings in this array
 *
 * @return void/html                print settings
 */
function pmw_load_options_settings( array $settings )
{
	if ( $settings )
	{
		foreach ( $settings as $__key => $setting )
		{
			$_id                = isset( $setting[ 'id' ] ) ? $setting[ 'id' ] : '';
			$_class             = isset( $setting[ 'class' ] ) ? $setting[ 'class' ] : '';
			$_title             = isset( $setting[ 'title' ] ) ? $setting[ 'title' ] : '';
			$_desc              = isset( $setting[ 'description' ] ) ? $setting[ 'description' ] : '';
			$_type              = ( isset( $setting[ 'type' ] ) && $setting[ 'type' ] ) ? $setting[ 'type' ] : 'input';
			$_value             = isset( $setting[ 'value' ] ) ? $setting[ 'value' ] : '';
			$_input_class       = isset( $setting[ 'input_args' ][ 'class' ] ) ? $setting[ 'input_args' ][ 'class' ] : '';
			$_input_type        = isset( $setting[ 'input_args' ][ 'type' ] ) ? $setting[ 'input_args' ][ 'type' ] : 'text';
			$_input_name        = isset( $setting[ 'input_args' ][ 'name' ] ) ? $setting[ 'input_args' ][ 'name' ] : '';
			$_input_placeholder = isset( $setting[ 'input_args' ][ 'placeholder' ] ) ? $setting[ 'input_args' ][ 'placeholder' ] : '';
			$_list_item_args    = isset( $setting[ 'list_item_args' ] ) ? $setting[ 'list_item_args' ] : '';
			$_before_content    = isset( $setting[ 'before_content' ] ) ? $setting[ 'before_content' ] : '';
			$_after_content     = isset( $setting[ 'after_content' ] ) ? $setting[ 'after_content' ] : '';
			echo "
            <div id='{$_id}' class=\"singleSetting {$_class}\">
                " . pmw_load_callable( $_before_content ) . "
                <h4 class=\"settingTitle\">{$_title}</h4>
            ";
			// setting content
			if ( $_type == 'input' )
			{
				$_value = esc_attr( $_value );
				echo "
                <input class=\"{$_input_class}\" type=\"{$_input_type}\" name=\"{$_input_name}\" placeholder=\"{$_input_placeholder}\" value=\"{$_value}\"/>
                ";
			}
			if ( $_type == 'input-url' )
			{
				pmw_url_input( $_input_name, str_replace( ']', '', str_replace( '[', '', $_input_name ) ), esc_attr( $_value ), $_input_class );
			}
			if ( $_type == 'list_item' )
			{
				pmw_make_list_item( $_list_item_args );
			}
			if ( $_type == 'textarea' )
			{
				$_value = esc_textarea( $_value );
				echo "
                <textarea class=\"{$_input_class}\" name=\"{$_input_name}\" placeholder=\"{$_input_placeholder}\">{$_value}</textarea>
                ";
			}
			if ( $_type == 'image' )
			{
				$_upload_id = uniqid( 'upload-' . $_id );
				$_image     = esc_attr( wp_get_attachment_image_url( $_value, 'medium' ) );
				$_esc_value = esc_attr( $_value );
				echo "
                <div class=\"pmw-file-upload\" id=\"$_upload_id\" upload-id=\"$_upload_id\" upload-type=\"image\">
                    <img src=\"$_image\" class=\"pmw-image-preview\">
                    <button class=\"orange ui button pmw-upload-button\">آپلود تصویر</button>
                    <input type=\"hidden\" name=\"$_input_name\" value=\"$_esc_value\" class=\"file-value\">
                </div>
                ";
			}
			// setting content
			echo "
                <small>{$_desc}</small>
                " . pmw_load_callable( $_after_content ) . "
            </div>
            ";
		}
	}
}

// part functions
function pmw_get_head( array $args = NULL )
{
	pmw_set_GET( $args );
	include NVM_DIR_PATH . '/head.php';
}

function pmw_get_foot( array $args = NULL )
{
	pmw_set_GET( $args );
	include NVM_DIR_PATH . '/foot.php';
}

function pmw_get_part( $name )
{
	include NVM_DIR_PATH . '/inc/parts/part-' . $name . '.php';
}

/**
 * set _GET variable members for use them in some where
 *
 * @param  array $args _GET members in this array
 *
 * @return void             do the job
 */
function pmw_set_GET( array $args = NULL )
{
	if ( $args )
	{
		foreach ( $args as $key => $value )
		{
			$_GET[ $key ] = $value;
		}
	}
}

/**
 * print array members with custom callback function
 *
 * @param array    $array    an array to looping
 * @param callable $callback a function to call in every loop
 *
 * @return void/html                print html code or return empty
 */
function pmw_smart_loop( $array, callable $callback, $is_multiple = FALSE )
{
	if ( ! $array )
		return false;
	$_array = ( $is_multiple === TRUE ) ? reset( $array ) : $array;
	if ( $_array )
	{
		foreach ( $_array as $key => $value )
		{
			$_args = [
				'count' => $key + 1,
				'key' => $key,
				'value' => $value,
				'items' => $array,
			];
			// load callback function
			$callback( $_args );
		}
	}
}

/**
 * print array members with custom callback function ( divided version )
 *
 * @param array    $array    an array to looping
 * @param callable $callback a function to call in every loop
 *
 * @return void/html                print html code or return empty
 */
function pmw_smart_divided_loop( $array, callable $callback, $is_multiple = FALSE, $divide = 2, $current = 1 )
{
	$_half_size = ( is_float( count( $args[ 'items' ] ) / 2 ) ) ? ( count( $args[ 'items' ] ) / 2 + 1 ) : count( $args[ 'items' ] ) / 2;
	if ( $args[ 'count' ] > $_half_size )
	{
		return FALSE;
	}
	$_array = ( $is_multiple === TRUE ) ? reset( $array ) : $array;
	if ( $_array )
	{
		foreach ( $_array as $key => $value )
		{
			$_args = [
				'count' => $key + 1,
				'key' => $key,
				'value' => $value,
				'items' => $array,
			];
			// load callback function
			$callback( $_args );
		}
	}
}

/**
 * Update post meta field based on post ID. ( edited by payamweber )
 *
 * Use the $prev_value parameter to differentiate between meta fields with the
 * same key and post ID.
 *
 * If the meta field for the post does not exist, it will be added.
 *
 * @since 1.5.0
 *
 * @param int    $post_id    Post ID.
 * @param string $meta_key   Metadata key.
 * @param mixed  $meta_value Metadata value. Must be serializable if non-scalar.
 * @param mixed  $prev_value Optional. Previous value to check before removing.
 *                           Default empty.
 *
 * @return int|bool Meta ID if the key didn't exist, true on successful update,
 *                  false on failure.
 */
function pmw_update_post_meta( $object_id, $meta_key, $meta_value, $prev_value = '', $meta_type = 'post' )
{
	global $wpdb;
	if ( ! $meta_type || ! $meta_key || ! is_numeric( $object_id ) )
	{
		return FALSE;
	}
	$object_id = absint( $object_id );
	if ( ! $object_id )
	{
		return FALSE;
	}
	$table = _get_meta_table( $meta_type );
	if ( ! $table )
	{
		return FALSE;
	}
	$column    = sanitize_key( $meta_type . '_id' );
	$id_column = 'user' == $meta_type ? 'umeta_id' : 'meta_id';
	// expected_slashed ($meta_key)
	$raw_meta_key = $meta_key;
	$meta_key     = wp_unslash( $meta_key );
	$passed_value = $meta_value;
	$meta_value   = $meta_value;
	$meta_value   = sanitize_meta( $meta_key, $meta_value, $meta_type );
	/**
	 * Filters whether to update metadata of a specific type.
	 *
	 * The dynamic portion of the hook, `$meta_type`, refers to the meta
	 * object type (comment, post, or user). Returning a non-null value
	 * will effectively short-circuit the function.
	 *
	 * @since 3.1.0
	 *
	 * @param null|bool $check      Whether to allow updating metadata for the given type.
	 * @param int       $object_id  Object ID.
	 * @param string    $meta_key   Meta key.
	 * @param mixed     $meta_value Meta value. Must be serializable if non-scalar.
	 * @param mixed     $prev_value Optional. If specified, only update existing
	 *                              metadata entries with the specified value.
	 *                              Otherwise, update all entries.
	 */
	$check = apply_filters( "update_{$meta_type}_metadata", NULL, $object_id, $meta_key, $meta_value, $prev_value );
	if ( NULL !== $check )
	{
		return (bool) $check;
	}
	// Compare existing value to new value if no prev value given and the key exists only once.
	if ( empty( $prev_value ) )
	{
		$old_value = get_metadata( $meta_type, $object_id, $meta_key );
		if ( count( $old_value ) == 1 )
		{
			if ( $old_value[ 0 ] === $meta_value )
			{
				return FALSE;
			}
		}
	}
	$meta_ids = $wpdb->get_col( $wpdb->prepare( "SELECT $id_column FROM $table WHERE meta_key = %s AND $column = %d", $meta_key, $object_id ) );
	if ( empty( $meta_ids ) )
	{
		return add_metadata( $meta_type, $object_id, $raw_meta_key, $passed_value );
	}
	$_meta_value = $meta_value;
	$meta_value  = maybe_serialize( $meta_value );
	$data        = compact( 'meta_value' );
	$where       = [
		$column => $object_id,
		'meta_key' => $meta_key,
	];
	if ( ! empty( $prev_value ) )
	{
		$prev_value            = maybe_serialize( $prev_value );
		$where[ 'meta_value' ] = $prev_value;
	}
	foreach ( $meta_ids as $meta_id )
	{
		/**
		 * Fires immediately before updating metadata of a specific type.
		 *
		 * The dynamic portion of the hook, `$meta_type`, refers to the meta
		 * object type (comment, post, or user).
		 *
		 * @since 2.9.0
		 *
		 * @param int    $meta_id    ID of the metadata entry to update.
		 * @param int    $object_id  Object ID.
		 * @param string $meta_key   Meta key.
		 * @param mixed  $meta_value Meta value.
		 */
		do_action( "update_{$meta_type}_meta", $meta_id, $object_id, $meta_key, $_meta_value );
		if ( 'post' == $meta_type )
		{
			/**
			 * Fires immediately before updating a post's metadata.
			 *
			 * @since 2.9.0
			 *
			 * @param int    $meta_id    ID of metadata entry to update.
			 * @param int    $object_id  Object ID.
			 * @param string $meta_key   Meta key.
			 * @param mixed  $meta_value Meta value.
			 */
			do_action( 'update_postmeta', $meta_id, $object_id, $meta_key, $meta_value );
		}
	}
	$result = $wpdb->update( $table, $data, $where );
	if ( ! $result )
	{
		return FALSE;
	}
	wp_cache_delete( $object_id, $meta_type . '_meta' );
	foreach ( $meta_ids as $meta_id )
	{
		/**
		 * Fires immediately after updating metadata of a specific type.
		 *
		 * The dynamic portion of the hook, `$meta_type`, refers to the meta
		 * object type (comment, post, or user).
		 *
		 * @since 2.9.0
		 *
		 * @param int    $meta_id    ID of updated metadata entry.
		 * @param int    $object_id  Object ID.
		 * @param string $meta_key   Meta key.
		 * @param mixed  $meta_value Meta value.
		 */
		do_action( "updated_{$meta_type}_meta", $meta_id, $object_id, $meta_key, $_meta_value );
		if ( 'post' == $meta_type )
		{
			/**
			 * Fires immediately after updating a post's metadata.
			 *
			 * @since 2.9.0
			 *
			 * @param int    $meta_id    ID of updated metadata entry.
			 * @param int    $object_id  Object ID.
			 * @param string $meta_key   Meta key.
			 * @param mixed  $meta_value Meta value.
			 */
			do_action( 'updated_postmeta', $meta_id, $object_id, $meta_key, $meta_value );
		}
	}

	return TRUE;
}

/**
 * this function create a image upload button for wordpress
 *
 * @param   string $id         upload id must be different
 * @param   string $name       input name for save data
 * @param   mixed  $value      file id in wordpress database
 * @param bool     $print_html do you want to print that html my self ?
 *
 * @return  void                  do the job
 */
function pmw_create_image_upload( $id, $name, $value = '', $print_html = true )
{
	$image_src = wp_get_attachment_image_url( $value, "medium" );
	if ( ! $id )
		$id = md5( uniqid( rand( 1, 999 ) ) );
	$upload_text = __( 'Upload Image', 'artist' );
	$html        = <<<HTML
    <div class="pmw-file-upload" id="$id" upload-id="$id" upload-type="image">
        <img src="$image_src" class="pmw-image-preview">
        <button class="orange ui button pmw-upload-button">$upload_text</button>
        <input type="hidden" name="$name" value="$value" class="file-value">
    </div>
HTML;
	if ( $print_html )
		echo $html;
	else
		return $html;
}

/**
 * this function make a list of categories in blog and return them
 *
 * @param integer $parent parent id for showing children
 *
 * @return  string      return html code of categories
 */
function pmw_get_categories_list( $parent = 0 )
{
	$categories = get_categories( [
		'hide_empty' => FALSE,
	] );
	$_html      = '';

	if ( $categories )
	{
		foreach ( $categories as $category )
		{
			if ( $category->parent == $parent )
			{
				$_html .= "<li class=\"cat-item cat-item-$category->term_id\"><a href=\"" . get_term_link( $category->term_id ) . "\">" . $category->name . "</a>";

				global $wpdb;
				$_found = $wpdb->get_var( "SELECT term_id FROM {$wpdb->term_taxonomy} WHERE parent = '{$category->term_id}' LIMIT 1;" );

				if ( $_found )
				{
					$_html .= "<ul class='sub-cats'>";
					$_html .= pmw_get_categories_list( (int) $category->term_id );
					$_html .= "</ul>";
				}

				$_html .= "</li>";
			}
		}
	}

	return $_html;
}

function pmw_is_blog()
{
	if ( is_page( 'blog' ) || is_single() || is_category() || is_tag() )
	{
		return TRUE;
	}

	return FALSE;
}

function pmw_get_current_url()
{
	$http = isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] ? 'https://' : 'http://';
	return $http . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ];
}

function pmw_is_elementor()
{
	if (
		( strpos( $_SERVER[ 'REQUEST_URI' ], 'elementor-preview' ) !== false ) ||
		( strpos( $_SERVER[ 'REQUEST_URI' ], 'admin-ajax' ) !== false ) ||
		( strpos( $_SERVER[ 'REQUEST_URI' ], 'elementor' ) !== false )
	)
	{
		return true;
	} else
	{
		return false;
	}
}

function include_view( $path, $with = [] )
{
	if ( isset( $GLOBALS[ 'view_args' ] ) && $GLOBALS[ 'view_args' ] && is_array( $GLOBALS[ 'view_args' ] ) )
		extract( $GLOBALS[ 'view_args' ] );
	if ( $with && is_array( $with ) )
		extract( $with );

	if ( file_exists( $_this_file_path = \PMW\Inc\Vendor\View::ABSPATH . str_replace( '.', '/', $path ) . '.view.php' ) )
		include( $_this_file_path );
}

function add_query_to_url( $url, array $args )
{
	parse_str( $_SERVER[ 'QUERY_STRING' ], $query_args );

	if ( $query_args )
	{
		$query_args = array_merge( $query_args, $args );
	} else
	{
		$query_args = $args;
	}

	if ( $query_args )
	{
		return $url . '?' . http_build_query( $query_args );
	}

	return $url;
}

function get_aparat_videos()
{
	$aparat = new AparatHelper();

	return $aparat->getData();
}

/**
 * this function has default status code 200 for mobile responses
 *
 * @param       $success
 * @param array $errors_or_data
 * @param int   $code
 * @param bool  $real_status
 *
 * @return false|string
 */
function api_response( $success, $errors_or_data = [], $code = 0, $real_status = false )
{
	$code = $code ? $code : ( $success ? 200 : 422 );

	http_response_code( $real_status ? $code : 200 );
	header( 'Content-type: application/json; charset=utf-8' );

	$array = [
			'status' => boolval( $success ),
			$success ? 'data' : 'error' => $errors_or_data,
		] + ( ! $success ? [
			'error_code' => $code,
		] : [] );

	return json_encode( $array, JSON_UNESCAPED_UNICODE );
}

/**
 * @param      $datetime
 * @param bool $full
 *
 * @return string
 * @throws Exception
 */
function time_elapsed_string( $datetime, $full = false )
{
	$now  = new DateTime;
	$ago  = new DateTime( \StringHelper::number_to_en( $datetime ), wp_timezone() );
	$diff = $now->diff( $ago );

	$diff->w = floor( $diff->d / 7 );
	$diff->d -= $diff->w * 7;

	$string = [
		'y' => 'سال',
		'm' => 'ماه',
		'w' => 'هفته',
		'd' => 'روز',
		'h' => 'ساعت',
		'i' => 'دقیقه',
		's' => 'ثانیه',
	];
	foreach ( $string as $k => &$v ) {
		if ( $diff->$k ) {
			$v = $diff->$k . ' ' . $v . ( $diff->$k > 1 ? '' : '' );
		} else {
			unset( $string[ $k ] );
		}
	}

	if ( ! $full ) $string = array_slice( $string, 0, 1 );
	return $string ? implode( ', ', $string ) . ' پیش' : 'همین الان';
}

if ( ! function_exists( 'dd' ) ){
	function dd(){
		echo "<pre>";
		if ( func_get_args() ){
			foreach ( func_get_args() as $arg ){
				ob_start();
				var_dump( $arg );
				$obget = ob_get_clean();
				echo htmlspecialchars( $obget );
			}
		}
		echo "</pre>";
		die();
	}
}

/**
 * @return string
 */
function pmw_get_main_template()
{
	return get_nvm_setting( 'main_template' ) ? : 'tp1';
}