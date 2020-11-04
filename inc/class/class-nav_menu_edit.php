<?php

/**
 * Copied from Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since   3.0.0
 * @uses    Walker_Nav_Menu
 */
class PMW_Walker_Nav_Menu_Edit extends Walker_Nav_Menu
{
    /**
     * @see   Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function start_lvl( &$output, $depth = 0, $args = [] ) { }

    /**
     * @see   Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function end_lvl( &$output, $depth = 0, $args = [] )
    {
    }

    /**
     * @see   Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param object $args
     */
    function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 )
    {
        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        ob_start();
        $item_id      = esc_attr( $item->ID );
        $removed_args = [
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        ];

        $original_title = '';
        if ( 'taxonomy' == $item->type )
        {
            $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
            if ( is_wp_error( $original_title ) )
            {
                $original_title = FALSE;
            }
        } else
        {
            if ( 'post_type' == $item->type )
            {
                $original_object = get_post( $item->object_id );
                $original_title  = $original_object->post_title;
            }
        }

        $classes = [
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr( $item->object ),
            'menu-item-edit-' . ( ( isset( $_GET[ 'edit-menu-item' ] ) && $item_id == $_GET[ 'edit-menu-item' ] ) ? 'active' : 'inactive' ),
        ];

        $title = $item->title;

        if ( ! empty( $item->_invalid ) )
        {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf( __( '%s (Invalid)' ), $item->title );
        } else
        {
            if ( isset( $item->post_status ) && 'draft' == $item->post_status )
            {
                $classes[] = 'pending';
                /* translators: %s: title of menu item in draft status */
                $title = sprintf( __( '%s (Pending)' ), $item->title );
            }
        }

        $title = empty( $item->label ) ? $title : $item->label;
        ?>
    <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode( ' ', $classes ); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html( $title ); ?></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                        echo wp_nonce_url(
                            add_query_arg(
                                [
                                    'action' => 'move-up-menu-item',
                                    'menu-item' => $item_id,
                                ],
                                remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
                            ),
                            'move-menu_item'
                        );
                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up' ); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                        echo wp_nonce_url(
                            add_query_arg(
                                [
                                    'action' => 'move-down-menu-item',
                                    'menu-item' => $item_id,
                                ],
                                remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
                            ),
                            'move-menu_item'
                        );
                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down' ); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e( 'Edit Menu Item' ); ?>" href="<?php
                    echo ( isset( $_GET[ 'edit-menu-item' ] ) && $item_id == $_GET[ 'edit-menu-item' ] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                    ?>"><?php _e( 'Edit Menu Item' ); ?></a>
                </span>
            </dt>
        </dl>
        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
            <?php if ( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                        <?php _e( 'URL' ); ?><br/>
                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>"/>
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                    <?php _e( 'Navigation Label' ); ?><br/>
                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>"/>
                </label>
            </p>
            <?php
            /*
             * This is the added field
             */
            if ( $depth == 0 ):
                ?>
                <p style="display:block; clear:both;"></p>
                <label style="display:block; clear:both;"><?php _e( 'position', 'snowa' ); ?></label>
                <p class="field-image description description-wide">
                    <label>
                        <input type="radio" name="menu-item-side_position[<?php echo $item_id; ?>]" <?php echo ( $item->side_position == 'left' ) ? 'checked' : ''; ?> value="left">
                        <?php get_user_locale() == 'fa_IR' ? _e( 'right', 'snowa' ) : _e( 'left', 'snowa' ); ?>
                    </label>
                    <label>
                        <input type="radio" name="menu-item-side_position[<?php echo $item_id; ?>]" <?php echo ( $item->side_position == 'right' ) ? 'checked' : ''; ?> value="right">
                        <?php get_user_locale() == 'fa_IR' ? _e( 'left', 'snowa' ) : _e( 'right', 'snowa' ); ?>
                    </label>
                </p>
            <?php
            endif;
            ?>
            <div class="image" style="display: block;clear: both;">
                <label>
                    <strong><?php _e( 'Icon', 'snowa' ); ?></strong>
                </label>
                <?php pmw_create_image_upload( "nav-menu-upload-image-$item_id", "menu-item-image[$item_id]", $item->image ) ?>
            </div>
            <?php if ( $depth == 1 ): ?>
                <div class="image" style="display: block;clear: both;margin-top: 20px;">
                    <label>
                        <strong><?php _e( 'Dark Icon', 'snowa' ); ?></strong>
                        <small>(<?php _e( 'Only used for main top menu', 'snowa' ); ?>)</small>
                    </label>
                    <?php pmw_create_image_upload( "nav-menu-upload-dark-image-$item_id", "menu-item-dark-image[$item_id]", $item->dark_image ) ?>
                </div>
            <?php endif ?>
            <div class="menu-item-actions description-wide submitbox">
                <?php if ( 'image' != $item->type && $original_title !== FALSE ) : ?>
                    <p class="link-to-original">
                        <?php printf( __( 'Original: %s' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                echo wp_nonce_url(
                    add_query_arg(
                        [
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                        ],
                        remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
                    ),
                    'delete-menu_item_' . $item_id
                ); ?>"><?php _e( 'Remove' ); ?></a>
                <span class="meta-sep"> |</span>
                <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( [
                    'edit-menu-item' => $item_id,
                    'cancel' => time(),
                ], remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e( 'Cancel' ); ?></a>
            </div>
            <div style="clear: both;display: block;"></div>
            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>"/>
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>"/>
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>"/>
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>"/>
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>"/>
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>"/>
        </div><!-- .menu-item-settings-->
        <ul class="menu-item-transport"></ul>
        <?php
        $output .= ob_get_clean();
    }
}
