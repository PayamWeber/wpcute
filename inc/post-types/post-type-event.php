<?php
use PMW\Event;

add_action( 'init', function () {
    $PMW_PostType = new PMW_PostType( 'event' );

// register post type
    $PMW_PostType->register( [
        'labels' => [
            'name' => __( 'Event', 'artist' ),
            'singular_name' => __( 'Event', 'artist' ),
            'add_new_item' => __( 'Add new Event', 'artist' ),
            'add_new' => __( 'Add Event', 'artist' ),
            'not_found' => __( 'No Event found', 'artist' ),
            'view_item' => __( 'View Event', 'artist' ),
            'edit_item' => __( 'Edit Event', 'artist' ),
        ],
        'public' => true,
        'menu_icon' => 'dashicons-portfolio',
        'query_var' => 'event',
        'publicly_queryable' => true,
        'has_archive' => true,
        'supports' => [
            'thumbnail',
            'title',
			'editor',
			'comments'
        ],
		'menu_position' => 29
    ] );

    // edit admin columns for events list
    $PMW_PostType->columns( function ( $columns ) {
        $new_columns = [
            'cb' => '<input id="cb-select-all-1" type="checkbox">',
            'image' => __( 'Image' ),
            'title' => __( 'Title' ),
        ];
        //die();
        return $new_columns;
    }, function ( $column, $post_id ) {
        $post                          = Event::find( $post_id );
        $thumbnail = get_the_post_thumbnail( $post_id, 'thumbnail', [ 'style' => 'max-width:100px;height:auto;' ] );

        switch ( $column )
        {
            case 'image':
                echo $thumbnail;
                break;
        }
    } );
} );

// enable events
add_action( 'save_post', function ( $post_id ) {
//    $status = get_post_meta( $post_id, '_event_status', true );
//
//    if ( ! $status )
//        update_post_meta( $post_id, '_event_status', Event::STATUS_ENABLED );
} );