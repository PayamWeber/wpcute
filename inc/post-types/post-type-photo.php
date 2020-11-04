<?php

add_action( 'init', function () {
	$PMW_PostType = new PMW_PostType( 'photo' );

	// register post type
	$PMW_PostType->register( [
		'labels' => [
			'name' => __( 'Photo', 'artist' ),
			'singular_name' => __( 'Photo', 'artist' ),
			'add_new_item' => __( 'Add new Photo', 'artist' ),
			'add_new' => __( 'Add Photo', 'artist' ),
			'not_found' => __( 'No Photo found', 'artist' ),
			'view_item' => __( 'View Photo', 'artist' ),
			'edit_item' => __( 'Edit Photo', 'artist' ),
		],
		'public' => true,
		'menu_icon' => 'dashicons-format-gallery',
		'query_var' => 'photo',
		'publicly_queryable' => true,
		'has_archive' => false,
		'supports' => [
			'thumbnail',
			'title',
		],
		'menu_position' => 28
	] );

	// edit admin columns for campaigns list
	$PMW_PostType->columns( function ( $columns ) {
		$new_columns = [
			'cb' => '<input id="cb-select-all-1" type="checkbox">',
			'image' => __( 'Image' ),
			'title' => __( 'Title' ),
			'album' => __( 'Album', 'artist' ),
		];
		//die();
		return $new_columns;
	}, function ( $column, $post_id ) {
		$cats      = wp_get_post_terms( $post_id, 'photo_album' );
		$cat       = $cats ? $cats[ 0 ] : '';
		$thumbnail = get_the_post_thumbnail( $post_id, 'thumbnail', [ 'style' => 'max-width:100px;height:auto;' ] );

		if ( ! $thumbnail ) {
			$image     = $cat ? get_term_meta( $cat->term_id, 'image', true ) : '';
			$image     = $image ? wp_get_attachment_image( $image, 'thumbnail', false, [ 'style' => 'max-width:100px;height:auto;' ] ) : '';
			$thumbnail = $image;
		}

		switch ( $column ) {
			case 'image':
				echo $thumbnail;
				break;
			case 'album':
				if ( $cat ) {
					$url = get_edit_term_link( $cat->term_id, 'photo_album' );
					echo "<a href='$url'>$cat->name</a>";
				}
				break;
		}
	} );

	/**
	 * register taxonomy for this post type
	 */
	$PMW_PostType->taxonomy( 'photo_album', [
		'label' => __( 'Album', 'artist' ),
		'labels' => [
			'menu_name' => __( 'Albums', 'artist' ),
			'name' => __( 'Albums', 'artist' ),
			'singular_name' => __( 'Album', 'artist' ),
			'search_items' => __( 'Search in Albums', 'artist' ),
			'popular_items' => __( 'Popular Albums', 'artist' ),
			'all_items' => __( 'All Albums', 'artist' ),
			'parent_item' => __( 'Parent Album', 'artist' ),
			'edit_item' => __( 'Edit Album', 'artist' ),
			'view_item' => __( 'View Album', 'artist' ),
			'update_item' => __( 'Update Album', 'artist' ),
			'add_new_item' => __( 'Add Album', 'artist' ),
			'new_item_name' => __( 'New Album name', 'artist' ),
			'items_list_navigation' => __( 'Albums', 'artist' ),
		],
		'hierarchical' => true,
		'show_in_nav_menus' => true,
		'public' => true,
		'query_var' => true,
		'rewrite' => [ 'slug' => 'photo_album', 'with_front' => false ],
	] );
} );

// enable campaigns
add_action( 'save_post', function ( $post_id ) {
	//    $status = get_post_meta( $post_id, '_campaign_status', true );

	//    if ( ! $status )
	//        update_post_meta( $post_id, '_campaign_status', Campaign::STATUS_ENABLED );
} );