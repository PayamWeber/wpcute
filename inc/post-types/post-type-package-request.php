<?php
return true;
use PMW\Package;
use PMW\PackageRequest;
use PMW\PostMeta;

add_action( 'init', function () {
	$PMW_PostType = new PMW_PostType( 'package_request' );

	// register post type
	$PMW_PostType->register( [
		'labels' => [
			'name' => __( 'Package Request', 'artist' ),
			'singular_name' => __( 'Package Request', 'artist' ),
			'add_new_item' => __( 'Add new Package Request', 'artist' ),
			'add_new' => __( 'Add Package Request', 'artist' ),
			'not_found' => __( 'No Package Request found', 'artist' ),
			'view_item' => __( 'View Package Request', 'artist' ),
			'edit_item' => __( 'Edit Package Request', 'artist' ),
		],
		'public' => true,
		'menu_icon' => 'dashicons-portfolio',
		'query_var' => 'package_request',
		'publicly_queryable' => false,
		'has_archive' => false,
		'supports' => [
			'title',
		],
		'capabilities' => [
			'edit_post' => 'edit_package_request',
			'read_post' => 'read_package_request',
			'delete_post' => 'delete_package_request',
			'edit_posts' => 'edit_package_requests',
			'edit_others_posts' => 'edit_others_package_requests',
			'publish_posts' => 'publish_package_requests',
			'read_private_posts' => 'read_private_package_requests',
			'create_posts' => '_edit_package_requests',
		],
		'map_meta_cap' => false,
		'capability_type' => 'package_request',
		'menu_position' => 33
	] );

	// edit admin columns for package_requests list
	$PMW_PostType->columns( function ( $columns ) {
		$new_columns = [
			'cb' => '<input id="cb-select-all-1" type="checkbox">',
			//            'title' => __( 'Title' ),
			'username' => __( 'Name', 'artist' ),
			'mobile' => __( 'Mobile', 'artist' ),
			'city' => __( 'City', 'artist' ),
			'gender' => __( 'Gender', 'artist' ),
			'package' => __( 'Package', 'artist' ),
			'_date' => __( 'Date', 'artist' ),
			'operation' => __( 'Operation', 'artist' ),
		];
		//die();
		return $new_columns;
	}, function ( $column, $post_id ) {
		$post = PackageRequest::find( $post_id );
		$seen = $post->meta->package_request_seen ?? false;

		$genders = [
			1 => 'زن',
			2 => 'مرد',
		];

		switch ( $column ) {
			case 'username':
				echo $post->meta->package_request_username;
				break;
			case 'mobile':
				echo $post->meta->package_request_user_mobile;
				break;
			case '_date':
				echo '<span style="direction: ltr;display: inline-block">' . get_the_date( 'Y/m/d H:i:s', $post->post_object ) . '</span>';
				break;
			case 'gender':
				echo $genders[ $post->meta->package_request_gender ] ?? '';
				break;
			case 'city':
				echo $post->meta->package_request_city;
				break;
			case 'package':
				$package = Package::find( $post->meta->package_request_package_id ?? '' );
				$url = $package ? get_the_permalink( $package->ID ) : '';
				echo $package ? "<a target='_blank' href='$url'>$package->post_title</a>" : '';
				break;
			case 'operation':
				?>
				<?php if ( $seen ): ?>
				<span class="dashicons dashicons-yes-alt" style="color: forestgreen" title="دیده شده"></span>
			<?php else: ?>
				<a href="<?= site_url( 'api/admin/package_request/seen/' . $post_id . '/?redirect=' . pmw_get_current_url() ) ?>" title="دیده نشده">
					<span class="dashicons dashicons-yes" style="color: blueviolet"></span>
				</a>
			<?php endif; ?>
				<a href="<?= get_edit_post_link( $post->ID, '', true ) ?>">
					<span class="dashicons dashicons-edit" style="color: lightseagreen"></span>
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
	if ( $data[ 'post_type' ] == 'package_request' ) {
		$data[ 'post_status' ] = 'draft';
	}

	return $data;
}, 1, 3 );

add_action( 'admin_init', function(){
	$roles = [
		get_role( 'administrator' ),
		get_role( 'editor' ),
	];

	// This only works, because it accesses the class instance.
	// would allow the author to edit others' posts for current theme only
	foreach ( $roles as $role ){
		$role->add_cap( 'edit_package_request' );
		$role->add_cap( 'read_package_request' );
		$role->add_cap( 'delete_package_request' );
		$role->add_cap( 'edit_package_requests' );
		$role->add_cap( 'edit_others_package_requests' );
		$role->add_cap( 'read_private_package_requests' );
	}
} );

add_action( 'admin_menu', function () {
	global $table_prefix;
	$tbp = $table_prefix;
	foreach ( $GLOBALS['menu'] as $key => $menuitem ){
		if ( $menuitem[1] == 'edit_package_requests' ){
			$consultations_count = PackageRequest::notExists( PostMeta::where( 'meta_key', 'package_request_seen' )
				->where( 'meta_value', '1' )
				->where( 'post_id', PostMeta::raw( $tbp . 'posts.ID' ) )->toSql()
			)->where('post_status', '!=', 'auto-draft')->count();
			if ( $consultations_count ){
				$GLOBALS['menu'][$key][0] .= ' <span class="awaiting-mod count-4"><span class="pending-count" aria-hidden="true">' . $consultations_count . '</span></span>';
			}
		}
	}
} );