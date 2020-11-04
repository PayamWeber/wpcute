<?php if ( ( $settings[ 'items' ] && $settings[ 'show_type' ] == 'custom' ) || ( $settings[ 'show_type' ] == 'product_cats' ) ): ?>
    <?php
    if ( $settings[ 'show_type' ] == 'product_cats' )
    {
        $cats = get_terms( [
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => [
                [
                    'key' => 'sort_order',
                    'type' => 'NUMERIC',
                ],
            ],
        ] );
    }
    ?>
    <div class="section _section"
        <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
         data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
        <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
        <div class="section-wrap pt-40">
            <div class="section-body">
                <div class="row row--10">
                    <?php if ( $settings[ 'show_type' ] == 'custom' ): ?>
                        <?php foreach ( $settings[ 'items' ] as $item ): ?>
                            <div class="col-xs-24 <?= $item[ 'half_width' ] == 'yes' ? 'col-sm-12' : '' ?>">
                                <a href="<?= $item[ 'button_url' ][ 'url' ] ?>" class="card-b <?= $item[ 'half_width' ] == 'yes' ? 'card-b--small' : '' ?>">
                                    <div class="card-b__content">
                                        <h2 class="card-b__title"><?= $item[ 'title' ] ?></h2>
                                        <p>
                                            <?= nl2br( $item[ 'desc' ] ) ?>
                                        </p>
                                        <button class="btn btn--lg"><?= $item[ 'button_text' ] ?></button>
                                        <div class="card-b__img"
                                             style="background-image: url(<?= wp_get_attachment_image_url( $item[ 'image' ][ 'id' ], 'pmw-large' ) ?>)"></div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php foreach ( $cats as $item ):
                            $is_half = get_term_meta( $item->term_id, 'half_width', true );
                            $large_image = get_term_meta( $item->term_id, 'large_image', true );
                            var_dump( $item );
                            ?>
                            <div class="col-xs-24 <?= $is_half ? 'col-sm-12' : '' ?>">
                                <a href="<?= get_term_link( $item->term_id ) ?>" class="card-b <?= $is_half ? 'card-b--small' : '' ?>">
                                    <div class="card-b__content">
                                        <h2 class="card-b__title"><?= $item->name ?></h2>
                                        <p>
                                            <?= nl2br( $item->description ) ?>
                                        </p>
                                        <button class="btn btn--lg">دیدن همه محصولات</button>
                                        <div class="card-b__img"
                                             style="background-image: url(<?= wp_get_attachment_image_url( $large_image, 'pmw-large' ) ?>)"></div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>