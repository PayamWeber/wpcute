<?php
return true;
use PMW\Discount;

add_action( 'init', function () {
    $PMW_PostType = new PMW_PostType( 'discount' );

// register post type
    $PMW_PostType->register( [
        'labels' => [
            'name' => __( 'Discount', 'artist' ),
            'singular_name' => __( 'Discount', 'artist' ),
            'add_new_item' => __( 'Add new Discount', 'artist' ),
            'add_new' => __( 'Add Discount', 'artist' ),
            'not_found' => __( 'No Discount found', 'artist' ),
            'view_item' => __( 'View Discount', 'artist' ),
            'edit_item' => __( 'Edit Discount', 'artist' ),
        ],
        'public' => true,
        'menu_icon' => 'dashicons-tickets-alt',
        'query_var' => 'discount',
        'publicly_queryable' => true,
        'has_archive' => true,
        'supports' => [
            'thumbnail',
            'title',
        ],
		'menu_position' => 30
    ] );

    // edit admin columns for discounts list
    $PMW_PostType->columns( function ( $columns ) {
        $new_columns = [
            'cb' => '<input id="cb-select-all-1" type="checkbox">',
            'image' => __( 'Image' ),
            'title' => __( 'Title' ),
        ];
        //die();
        return $new_columns;
    }, function ( $column, $post_id ) {
        $post                          = Discount::find( $post_id );
        $thumbnail = get_the_post_thumbnail( $post_id, 'thumbnail', [ 'style' => 'max-width:100px;height:auto;' ] );

        switch ( $column )
        {
            case 'image':
                echo $thumbnail;
                break;
        }
    } );
} );

// enable discounts
add_action( 'save_post', function ( $post_id ) {
//    $status = get_post_meta( $post_id, '_discount_status', true );
//
//    if ( ! $status )
//        update_post_meta( $post_id, '_discount_status', Discount::STATUS_ENABLED );
} );