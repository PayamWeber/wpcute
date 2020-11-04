<?php

use PMW\Service;

add_action( 'init', function () {
    $PMW_PostType = new PMW_PostType( 'service' );

// register post type
    $PMW_PostType->register( [
        'labels' => [
            'name' => __( 'Service', 'artist' ),
            'singular_name' => __( 'Service', 'artist' ),
            'add_new_item' => __( 'Add new Service', 'artist' ),
            'add_new' => __( 'Add Service', 'artist' ),
            'not_found' => __( 'No Service found', 'artist' ),
            'view_item' => __( 'View Service', 'artist' ),
            'edit_item' => __( 'Edit Service', 'artist' ),
        ],
        'public' => true,
        'menu_icon' => 'dashicons-clipboard',
        'query_var' => 'service',
        'publicly_queryable' => true,
        'has_archive' => true,
        'supports' => [
            'thumbnail',
            'title',
			'editor'
        ],
		'menu_position' => 26
    ] );

    // edit admin columns for services list
    $PMW_PostType->columns( function ( $columns ) {
        $new_columns = [
            'cb' => '<input id="cb-select-all-1" type="checkbox">',
            'image' => __( 'Image' ),
            'title' => __( 'Title' ),
        ];
        //die();
        return $new_columns;
    }, function ( $column, $post_id ) {
        $post                          = Service::find( $post_id );
        $thumbnail = get_the_post_thumbnail( $post_id, 'thumbnail', [ 'style' => 'width:100px;height:auto;' ] );

        switch ( $column )
        {
            case 'image':
                echo $thumbnail;
                break;
        }
    } );
} );

// enable services
add_action( 'save_post', function ( $post_id ) {
//    $status = get_post_meta( $post_id, '_service_status', true );
//
//    if ( ! $status )
//        update_post_meta( $post_id, '_service_status', Service::STATUS_ENABLED );
} );