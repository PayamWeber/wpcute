<?php
return true;

use PMW\Consultation;
use PMW\Package;
use PMW\PackageRequest;
use PMW\PostMeta;

add_action( 'init', function () {
	$PMW_PostType = new PMW_PostType( 'consultation' );

	// register post type
	$PMW_PostType->register( [
		'labels' => [
			'name' => __( 'Consultation', 'artist' ),
			'singular_name' => __( 'Consultation', 'artist' ),
			'add_new_item' => __( 'Add new Consultation', 'artist' ),
			'add_new' => __( 'Add Consultation', 'artist' ),
			'not_found' => __( 'No Consultation found', 'artist' ),
			'view_item' => __( 'View Consultation', 'artist' ),
			'edit_item' => __( 'Edit Consultation', 'artist' ),
		],
		'public' => true,
		'menu_icon' => 'dashicons-businesswoman',
		'query_var' => 'consultation',
		'publicly_queryable' => false,
		'has_archive' => false,
		'supports' => [
			'title',
		],
		'capabilities' => [
			'edit_post' => 'edit_consultation',
			'read_post' => 'read_consultation',
			'delete_post' => 'delete_consultation',
			'edit_posts' => 'edit_consultations',
			'edit_others_posts' => 'edit_others_consultations',
			'publish_posts' => 'publish_consultations',
			'read_private_posts' => 'read_private_consultations',
			'create_posts' => '_edit_consultations',
		],
		'map_meta_cap' => false,
		'capability_type' => 'consultation',
		'menu_position' => 32
	] );

	// edit admin columns for consultations list
	$PMW_PostType->columns( function ( $columns ) {
		$new_columns = [
			'cb' => '<input id="cb-select-all-1" type="checkbox">',
			//            'title' => __( 'Title' ),
			'mobile' => __( 'Mobile', 'artist' ),
			'_date' => __( 'Date', 'artist' ),
			'operation' => __( 'Operation', 'artist' ),
		];
		//die();
		return $new_columns;
	}, function ( $column, $post_id ) {
		$post = Consultation::find( $post_id );
		$seen = $post->meta->consultation_seen ?? false;

		$genders = [
			1 => 'زن',
			2 => 'مرد',
		];

		switch ( $column ) {
			case 'mobile':
				echo $post->meta->consultation_user_mobile ?? '';
				break;
			case '_date':
				echo '<span style="direction: ltr;display: inline-block">' . get_the_date( 'Y/m/d H:i:s', $post->post_object ) . '</span>';
				break;
			case 'operation':
				?>
				<?php if ( $seen ): ?>
				<span class="dashicons dashicons-yes-alt" style="color: forestgreen" title="دیده شده"></span>
			<?php else: ?>
				<a href="<?= site_url( 'api/admin/consultation/seen/' . $post_id . '/?redirect=' . pmw_get_current_url() ) ?>" title="دیده نشده">
					<span class="dashicons dashicons-yes" style="color: blueviolet"></span>
				</a>
			<?php endif; ?>
				<a href="<?= get_delete_post_link( $post->ID, '', true ) ?>" onclick="if ( ! window.confirm('آیا مطمعن هستید') ){ return false; }">
					<span class="dashicons dashicons-trash" style="color: red"></span>
				</a>
				<?php
				break;
		}
	} );
} );

add_filter( 'wp_insert_post_data', function ( $data ) {
	if ( $data[ 'post_type' ] == 'consultation' ) {
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
		$role->add_cap( 'edit_consultation' );
		$role->add_cap( 'read_consultation' );
		$role->add_cap( 'delete_consultation' );
		$role->add_cap( 'edit_consultations' );
		$role->add_cap( 'edit_others_consultations' );
		$role->add_cap( 'read_private_consultations' );
	}
} );

add_action( 'admin_menu', function () {
	global $table_prefix;
	$tbp = $table_prefix;
	foreach ( $GLOBALS['menu'] as $key => $menuitem ){
		if ( $menuitem[1] == 'edit_consultations' ){
			$consultations_count = Consultation::notExists( PostMeta::where( 'meta_key', 'consultation_seen' )
					->where( 'meta_value', '1' )
					->where( 'post_id', PostMeta::raw( $tbp . 'posts.ID' ) )->toSql()
				)->count();
			if ( $consultations_count ){
				$GLOBALS['menu'][$key][0] .= ' <span class="awaiting-mod count-4"><span class="pending-count" aria-hidden="true">' . $consultations_count . '</span></span>';
			}
		}
	}
} );