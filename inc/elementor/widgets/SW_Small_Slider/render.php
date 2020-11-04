<div class="section _section <?= $settings[ 'gray_bg' ] == 'yes' ? 'bg-f7' : '' ?>"
    <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
     data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
    <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
    <div class="section-wrap section-wrap--posr pad-lg">
        <div class="section-bg section-bg--<?= $settings[ 'reverse_direction' ] == 'yes' ? 'va' : 'ref' ?>" style="background-image:url('<?= wp_get_attachment_image_url( $settings[ 'background_image' ][ 'id' ], 'pmw-large' ) ?>')"></div>
        <article class="flip flip--<?= $settings[ 'reverse_direction' ] == 'yes' ? 'left' : 'center' ?> card-a">
            <div class="flip-wrap">
                <div class="card-a__content">
                    <header class="card-a__header">
                        <?php if ( trim( $settings[ 'main_title' ] ) ): ?>
                            <h2 class="card-a__title"><?= trim( $settings[ 'main_title' ] ) ?></h2>
                        <?php endif; ?>
                        <?php if ( trim( $settings[ 'main_subtitle' ] ) ): ?>
                            <p class="card-a__subtitle"><?= trim( $settings[ 'main_subtitle' ] ) ?></p>
                        <?php endif; ?>
                    </header>
                    <div class="card-a__body">
                        <?php if ( trim( $settings[ 'main_content_text' ] ) ): ?>
                            <p><?= nl2br( $settings[ 'main_content_text' ] ) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flip-empty"></div>
                    <?php if ( $settings[ 'show_button' ] == 'yes' ): ?>
                        <div class="card-a__btn">
                            <a href="<?= $settings[ 'button_url' ][ 'url' ] ?>" class="btn btn--xlg btn--shadow">
                                <?= $settings[ 'button_text' ] ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flip-alone">
                <div class="row row--10 row--10-xs">
                    <?php if ( $settings[ 'slider_images' ] ): ?>
                        <div class="col-xs-24">
                            <div class="card-a__slider">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php foreach ( $settings[ 'slider_images' ] as $key => $card ): $card = (object) $card; ?>
                                            <div class="swiper-slide" style="background-image: url(<?= wp_get_attachment_image_url( $card->image[ 'id' ], 'pmw-medium' ) ?>)"></div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ( $settings[ 'images' ] ): ?>
                        <?php foreach ( $settings[ 'images' ] as $key => $card ): $card = (object) $card; ?>
                            <div class="col-xs-12">
                                <div class="card-a__preview" style="background-image: url(<?= wp_get_attachment_image_url( $card->image[ 'id' ], 'pmw-medium' ) ?>)"></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    </div>
</div>
