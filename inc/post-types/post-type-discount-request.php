<?php
return true;
use PMW\Discount;
use PMW\DiscountRequest;
use PMW\Package;
use PMW\PackageRequest;
use PMW\PostMeta;
use PMW\SpecialCardRequest;

add_action( 'init', function () {
	$PMW_PostType = new PMW_PostType( 'discount_request' );

	// register post type
	$PMW_PostType->register( [
		'labels' => [
			'name' => __( 'Discount Request', 'artist' ),
			'singular_name' => __( 'Discount Request', 'artist' ),
			'add_new_item' => __( 'Add new Discount Request', 'artist' ),
			'add_new' => __( 'Add Discount Request', 'artist' ),
			'not_found' => __( 'No Discount Request found', 'artist' ),
			'view_item' => __( 'View Discount Request', 'artist' ),
			'edit_item' => __( 'Edit Discount Request', 'artist' ),
			'menu_name' => __( 'Discount Req', 'artist' ),
		],
		'public' => true,
		'menu_icon' => 'dashicons-tickets-alt',
		'query_var' => 'discount_request',
		'publicly_queryable' => false,
		'has_archive' => false,
		'supports' => [
			'title',
		],
		'capabilities' => [
			'edit_post' => 'edit_discount_request',
			'read_post' => 'read_discount_request',
			'delete_post' => 'delete_discount_request',
			'edit_posts' => 'edit_discount_requests',
			'edit_others_posts' => 'edit_others_discount_requests',
			'publish_posts' => 'publish_discount_requests',
			'read_private_posts' => 'read_private_discount_requests',
			'create_posts' => '_edit_discount_requests',
		],
		'map_meta_cap' => false,
		'capability_type' => 'discount_request',
		'menu_position' => 34
	] );

	// edit admin columns for discount_requests list
	$PMW_PostType->columns( function ( $columns ) {
		$new_columns = [
			'cb' => '<input id="cb-select-all-1" type="checkbox">',
			//            'title' => __( 'Title' ),
			'username' => __( 'Name', 'artist' ),
			'mobile' => __( 'Mobile', 'artist' ),
			'city' => __( 'City', 'artist' ),
			'gender' => __( 'Gender', 'artist' ),
			'package' => __( 'Discount', 'artist' ),
			'_date' => __( 'Date', 'artist' ),
			'operation' => __( 'Operation', 'artist' ),
		];
		//die();
		return $new_columns;
	}, function ( $column, $post_id ) {
		$post = DiscountRequest::find( $post_id );
		$seen = $post->meta->discount_request_seen ?? false;

		$genders = [
			1 => 'زن',
			2 => 'مرد',
		];

		switch ( $column ) {
			case 'username':
				echo $post->meta->discount_request_username;
				break;
			case 'mobile':
				echo $post->meta->discount_request_user_mobile;
				break;
			case '_date':
				echo '<span style="direction: ltr;display: inline-block">' . get_the_date( 'Y/m/d H:i:s', $post->post_object ) . '</span>';
				break;
			case 'gender':
				echo $genders[ $post->meta->discount_request_gender ] ?? '';
				break;
			case 'city':
				echo $post->meta->discount_request_city;
				break;
			case 'package':
				$package = Discount::find( $post->meta->discount_request_package_id ?? '' );
				$url = $package ? get_the_permalink( $package->ID ) : '';
				echo $package ? "<a target='_blank' href='$url'>$package->post_title</a>" : '';
				break;
			case 'operation':
				?>
				<?php if ( $seen ): ?>
				<span class="dashicons dashicons-yes-alt" style="color: forestgreen" title="دیده شده"></span>
			<?php else: ?>
				<a href="<?= site_url( 'api/admin/discount_request/seen/' . $post_id . '/?redirect=' . pmw_get_current_url() ) ?>" title="دیده نشده">
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
	if ( $data[ 'post_type' ] == 'discount_request' ) {
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
		$role->add_cap( 'edit_discount_request' );
		$role->add_cap( 'read_discount_request' );
		$role->add_cap( 'delete_discount_request' );
		$role->add_cap( 'edit_discount_requests' );
		$role->add_cap( 'edit_others_discount_requests' );
		$role->add_cap( 'read_private_discount_requests' );
	}
} );

add_action( 'admin_menu', function () {
	global $table_prefix;
	$tbp = $table_prefix;
	foreach ( $GLOBALS['menu'] as $key => $menuitem ){
		if ( $menuitem[1] == 'edit_discount_requests' ){
			$consultations_count = DiscountRequest::notExists( PostMeta::where( 'meta_key', 'discount_request_seen' )
				->where( 'meta_value', '1' )
				->where( 'post_id', PostMeta::raw( $tbp . 'posts.ID' ) )->toSql()
			)->where('post_status', '!=', 'auto-draft')->count();
			if ( $consultations_count ){
				$GLOBALS['menu'][$key][0] .= ' <span class="awaiting-mod count-4"><span class="pending-count" aria-hidden="true">' . $consultations_count . '</span></span>';
			}
		}
	}
} );