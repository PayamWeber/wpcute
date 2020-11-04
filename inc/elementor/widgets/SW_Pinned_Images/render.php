<?php if ( $settings[ 'items' ] ): ?>
    <section class="section section--gallery <?= $settings[ 'gray_mode' ] ? 'bg-f7' : '' ?> _section"
        <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
             data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
        <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
        <div class="section-wrap">
            <?php if ( $settings[ 'main_title' ] || $settings[ 'main_subtitle' ] ): ?>
                <header class="s-header">
                    <?php if ( $settings[ 'main_title' ] ): ?>
                        <h2 class="s-title"><?= $settings[ 'main_title' ] ?></h2>
                    <?php endif; ?>
                    <?php if ( $settings[ 'main_subtitle' ] ): ?>
                        <p class="s-subtitle"><?= $settings[ 'main_subtitle' ] ?></p>
                    <?php endif; ?>
                </header>
            <?php endif; ?>
            <div class="section-body">
                <div class="gallery" data-gallery id="gallery">
                    <?php foreach ( $settings[ 'items' ] as $item ): ?>
                        <div class="gallery-item <?= $item[ 'show_video' ] == 'yes' ? 'gallery-item--video' : ''; ?>">
                            <a data-fancybox="gallery" href="<?= $item[ 'show_video' ] == 'yes' ? $item[ 'video_url' ][ 'url' ] : wp_get_attachment_image_url( $item[ 'image' ][ 'id' ], 'full' ) ?>"
                               style="background-image: url(<?= wp_get_attachment_image_url( $item[ 'image' ][ 'id' ], 'pmw-large' ) ?>)">
                                <?php if ( $item[ 'show_video' ] == 'yes' ): ?>
                                    <button class="gallery-play">
                                        <svg class="icon icon--play">
                                            <use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#play"></use>
                                        </svg>
                                    </button>
                                <?php endif; ?>
                            </a>
                            <?php if ( $item[ 'show_pin' ] == 'yes' ): ?>
                                <div class="gallery-tool"
                                     style="top:<?= $item[ 'pin_top' ] ?>%;left:<?= $item[ 'pin_left' ] ?>%;"
                                     data-tooltip="<?= $item[ 'pin_text' ] ?>">
                                    <div class="gallery-feature">
                                        <svg class="icon icon--plus">
                                            <use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#plus"></use>
                                        </svg>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
					<div class="loading loading--blue"></div>
                </div>
            </div>
            <?php if ( $settings[ 'show_button' ] == 'yes' ): ?>
                <footer class="section-footer">
                    <a href="<?= $settings[ 'button_url' ] ?>" class="btn btn--xlg"><?= $settings[ 'button_text' ] ?></a>
                </footer>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>