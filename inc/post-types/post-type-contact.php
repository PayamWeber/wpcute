<?php

use PMW\Contact;
use PMW\PostMeta;

add_action( 'init', function () {
	$PMW_PostType = new PMW_PostType( 'contact' );

	// register post type
	$PMW_PostType->register( [
		'labels' => [
			'name' => __( 'Contact', 'artist' ),
			'singular_name' => __( 'Contact', 'artist' ),
			'add_new_item' => __( 'Add new Contact', 'artist' ),
			'add_new' => __( 'Add Contact', 'artist' ),
			'not_found' => __( 'No Contact found', 'artist' ),
			'view_item' => __( 'View Contact', 'artist' ),
			'edit_item' => __( 'Edit Contact', 'artist' ),
		],
		'public' => true,
		'menu_icon' => 'dashicons-phone',
		'query_var' => 'contact',
		'publicly_queryable' => false,
		'has_archive' => false,
		'supports' => [
			'title',
		],
		'capabilities' => [
			'edit_post' => 'edit_contact',
			'read_post' => 'read_contact',
			'delete_post' => 'delete_contact',
			'edit_posts' => 'edit_contacts',
			'edit_others_posts' => 'edit_others_contacts',
			'publish_posts' => 'publish_contacts',
			'read_private_posts' => 'read_private_contacts',
			'create_posts' => '_edit_contacts',
		],
		'map_meta_cap' => false,
		'capability_type' => 'contact',
		'menu_position' => 31,
	] );

	// edit admin columns for contacts list
	$PMW_PostType->columns( function ( $columns ) {
		$new_columns = [
			'cb' => '<input id="cb-select-all-1" type="checkbox">',
			//            'title' => __( 'Title' ),
			'username' => __( 'Name', 'artist' ),
			'mobile' => __( 'Mobile', 'artist' ),
			'_date' => __( 'Date', 'artist' ),
			'operation' => __( 'Operation', 'artist' ),
		];
		//die();
		return $new_columns;
	}, function ( $column, $post_id ) {
		$post      = Contact::find( $post_id );
		$thumbnail = get_the_post_thumbnail( $post_id, 'thumbnail', [ 'style' => 'max-width:100px;height:auto;' ] );
		$seen      = $post->meta->contact_seen ?? false;

		switch ( $column ) {
			case 'username':
				echo $post->meta->contact_username ?? '';
				break;
			case 'mobile':
				echo $post->meta->contact_user_mobile ?? '';
				break;
			case '_date':
				echo get_the_date( 'Y/m/d', $post->post_object );
				break;
			case 'operation':
				?>
				<?php if ( $seen ): ?>
				<span class="dashicons dashicons-yes-alt" style="color: forestgreen" title="دیده شده"></span>
			<?php else: ?>
				<a href="<?= site_url( 'api/admin/contact/seen/' . $post_id . '/?redirect=' . pmw_get_current_url() ) ?>" title="دیده نشده">
					<span class="dashicons dashicons-yes" style="color: blueviolet"></span>
				</a>
			<?php endif; ?>
				<a href="<?= get_edit_post_link( $post->ID, '', true ) ?>">
					<span class="dashicons dashicons-visibility" style="color: lightseagreen"></span>
				</a>
				<a href="<?= get_delete_post_link( $post->ID, '', true ) ?>" onclick="if ( ! window.confirm('آیا مطمعن هستید') ){ return false; }">
					<span class="dashicons dashicons-trash" style="color: red"></span>
				</a>
				<?php
				break;
		}
	} );
} );

add_filter( 'wp_insert_post_data', function ( $data ) {
	if ( $data[ 'post_type' ] == 'contact' ) {
		$data[ 'post_status' ] = 'draft';
	}

	return $data;
}, 1, 3 );

add_action( 'admin_init', function () {
	$roles = [
		get_role( 'administrator' ),
		get_role( 'editor' ),
	];

	// This only works, because it accesses the class instance.
	// would allow the author to edit others' posts for current theme only
	foreach ( $roles as $role ) {
		$role->add_cap( 'edit_contact' );
		$role->add_cap( 'read_contact' );
		$role->add_cap( 'delete_contact' );
		$role->add_cap( 'edit_contacts' );
		$role->add_cap( 'edit_others_contacts' );
		$role->add_cap( 'read_private_contacts' );
	}
} );

add_action( 'admin_menu', function () {
	global $table_prefix;
	$tbp = $table_prefix;
	foreach ( $GLOBALS['menu'] as $key => $menuitem ){
		if ( $menuitem[1] == 'edit_contacts' ){
			$consultations_count = Contact::notExists( PostMeta::where( 'meta_key', 'contact_seen' )
				->where( 'meta_value', '1' )
				->where( 'post_id', PostMeta::raw( $tbp . 'posts.ID' ) )->toSql()
			)->where('post_status', '!=', 'auto-draft')->count();
			if ( $consultations_count ){
				$GLOBALS['menu'][$key][0] .= ' <span class="awaiting-mod count-4"><span class="pending-count" aria-hidden="true">' . $consultations_count . '</span></span>';
			}
		}
	}
} );