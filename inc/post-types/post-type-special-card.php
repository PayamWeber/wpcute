<?php
return true;
use PMW\SpecialCard;

add_action( 'init', function () {
    $PMW_PostType = new PMW_PostType( 'special_card' );

// register post type
    $PMW_PostType->register( [
        'labels' => [
            'name' => __( 'Special Card', 'artist' ),
            'singular_name' => __( 'Special Card', 'artist' ),
            'add_new_item' => __( 'Add new Special Card', 'artist' ),
            'add_new' => __( 'Add Special Card', 'artist' ),
            'not_found' => __( 'No Special Card found', 'artist' ),
            'view_item' => __( 'View Special Card', 'artist' ),
            'edit_item' => __( 'Edit Special Card', 'artist' ),
        ],
        'public' => true,
        'menu_icon' => 'dashicons-tickets',
        'query_var' => 'special_card',
        'publicly_queryable' => true,
        'has_archive' => true,
        'supports' => [
            'thumbnail',
            'title',
        ],
		'menu_position' => 27
    ] );

    // edit admin columns for special_cards list
    $PMW_PostType->columns( function ( $columns ) {
        $new_columns = [
            'cb' => '<input id="cb-select-all-1" type="checkbox">',
            'image' => __( 'Image' ),
            'title' => __( 'Title' ),
        ];
        //die();
        return $new_columns;
    }, function ( $column, $post_id ) {
        $post                          = SpecialCard::find( $post_id );
        $thumbnail = get_the_post_thumbnail( $post_id, 'thumbnail', [ 'style' => 'max-width:100px;height:auto;' ] );

        switch ( $column )
        {
            case 'image':
                echo $thumbnail;
                break;
        }
    } );
} );

// enable special_cards
add_action( 'save_post', function ( $post_id ) {
//    $status = get_post_meta( $post_id, '_special_card_status', true );
//
//    if ( ! $status )
//        update_post_meta( $post_id, '_special_card_status', Special Card::STATUS_ENABLED );
} );