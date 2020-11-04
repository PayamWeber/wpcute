<?php

// edit psot row in admin page
add_filter( 'post_row_actions', 'sp_remove_row_actions', 10, 2 );
function sp_remove_row_actions( $actions ,$post ){
    if( get_post_type() === 'contact' ){
        unset( $actions['view'] );
        unset( $actions['inline'] );
        $actions['edit'] = '<a href="'.get_edit_post_link($post->ID).'">نمایش کامل</a>';
    }
    return $actions;
}

// wordpress email name change
add_filter( 'wp_mail_from_name', 'sp_custom_wp_mail_from_name' );
function sp_custom_wp_mail_from_name( $original_email_from ) {
    return get_bloginfo("name");
}

// edit file types for upload
add_filter('upload_mimes', 'sp_file_types', 1, 1);
function sp_file_types($types){
    $types['svg'] = 'image/svg+xml';
    $types['psd'] = 'image/vnd.adobe.photoshop';
    $types['pdf'] = 'application/pdf';
    $types['rar'] = 'application/rar';
    return $types;
}




/*
 * woocommerce checkout fields
 */
add_filter('woocommerce_checkout_fields', 'pmw_woocommerce_checkout_fields');
function pmw_woocommerce_checkout_fields($field)
{
    unset($field['account']['account_password']);
    return $field;
}

/**
 * comment captcha validation
 */
add_action( 'pre_comment_on_post', function ( $post_id ) {
	if ( \PMW\Input::get('captcha') !== $_SESSION['captcha'] )
		wp_die(( new WP_Error(422, 'کد امنیتی اشتباه میباشد') ),'خطا', ['back_link'=> true]);
} );

/**
 * nav edit custom
 */


/***************************** --- //// add advanced menu properties \\\\ --- *********************************/

add_action( 'wp_update_nav_menu_item', function ( $menu_id, $menu_item_db_id, $args ) {
//	update_post_meta( $menu_item_db_id, '_menu_item_image', $_REQUEST[ 'menu-item-image' ][ $menu_item_db_id ] );
//	update_post_meta( $menu_item_db_id, '_menu_item_dark_image', $_REQUEST[ 'menu-item-dark-image' ][ $menu_item_db_id ] );
//	$custom_value = isset( $_REQUEST[ 'menu-item-side_position' ][ $menu_item_db_id ] ) ? ( $_REQUEST[ 'menu-item-side_position' ][ $menu_item_db_id ] ? $_REQUEST[ 'menu-item-side_position' ][ $menu_item_db_id ] : 'right' ) : 'right';
//	update_post_meta( $menu_item_db_id, '_menu_item_side_position', $custom_value );
}, 10, 3 );

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item', function ( $menu_item ) {
	$menu_item->image         = get_post_meta( $menu_item->ID, '_menu_item_image', TRUE );
	$menu_item->dark_image    = get_post_meta( $menu_item->ID, '_menu_item_dark_image', TRUE );
	$menu_item->side_position = get_post_meta( $menu_item->ID, '_menu_item_side_position', TRUE );

	return $menu_item;
} );

//add_filter( 'wp_edit_nav_menu_walker', function ( $walker, $menu_id ) {
//	return 'PMW_Walker_Nav_Menu_Edit';
//}, 10, 2 );

















/*
 * change tag and categories links for blog
 */

add_action('init', 'blog_term_rewrite');
function blog_term_rewrite()
{
    add_rewrite_rule('^blog/category/([^/]*)/?','index.php?category_name=$matches[1]','top');
    add_rewrite_rule('^blog/tag/([^/]*)/?','index.php?tag=$matches[1]','top');
    add_rewrite_rule('^blog/category/([^/]*)/page/([^/]*)/?','index.php?category_name=$matches[1]&paged=$matches[2]','top');
}

add_filter( 'category_link', 'pmw_blog_category_link', 10, 3 );
function pmw_blog_category_link( $url, $post )
{
    return home_url('blog/category/' . get_term_field('slug',$post) );
}

add_filter( 'tag_link', 'pmw_blog_tag_link', 10, 3 );
function pmw_blog_tag_link( $url, $post )
{
    //return $url;
    return home_url('blog/tag/' . get_term_field('slug',$post) );
}





// remove admin bar in front end
add_filter('show_admin_bar', '__return_false');

// add custom mime types
add_filter( 'wp_check_filetype_and_ext', function ( $check, $file, $filename )
{
    $extra_mime_types = [
        'image/svg' => 'svg',
        'image/svg+xml' => 'svg',
        'application/x-rar-compressed' => 'rar',
        'application/octet-stream' => [ 'rar', 'zip' ],
        'application/x-rar' => [ 'rar', 'zip' ],
        'application/zip' => 'zip',
        'application/x-zip-compressed' => 'zip',
        'multipart/x-zip' => 'zip',
        'application/x-compressed' => 'zip',
    ];
    if ( empty( $check[ 'ext' ] ) && empty( $check[ 'type' ] ) )
    {
        $real_mime_type = mime_content_type( $file );

        if ( isset( $extra_mime_types[$real_mime_type] ) )
        {
            $ext = end( explode( '.', $filename ) );
            return [
                'type' => $real_mime_type,
                'ext' => $ext,
                'proper_filename' => $filename
            ];
        }
    }
    return $check;
}, 99, 3 );