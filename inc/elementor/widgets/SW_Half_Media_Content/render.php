<div class="section _section"
    <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
     data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
    <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
    <div class="card-video">
        <?php if ( trim( $settings[ 'main_title' ] ) || trim( $settings[ 'main_subtitle' ] ) || trim( $settings[ 'main_content_text' ] ) ): ?>
            <div class="section-wrap pad-md">
                <div class="card-video__content">
                    <div class="card-video__info">
                        <?php if ( trim( $settings[ 'main_title' ] ) ): ?>
                            <h3 class="card-video__title"><?= trim( $settings[ 'main_title' ] ) ?></h3>
                        <?php endif; ?>
                        <?php if ( trim( $settings[ 'main_subtitle' ] ) ): ?>
                            <p class="card-video__subtitle"><?= trim( $settings[ 'main_subtitle' ] ) ?></p>
                        <?php endif; ?>
                        <?php if ( trim( $settings[ 'main_content_text' ] ) ): ?>
                            <div class="card-video__text post">
                                <p><?= nl2br( $settings[ 'main_content_text' ] ) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="card-video__preview videoplayer" style="background-image: url(<?= wp_get_attachment_image_url( $settings['background_image']['id'], 'pmw-large' ) ?>)">
            <?php if ( $settings[ 'show_video' ] == 'yes' ): ?>
                <div class="videoplayer-frame">
                    <video>
                        <source src="<?= $settings['video_url']['url'] ?>" type="video/mp4">
                        Sorry, your browser doesn't support embedded videos.
                    </video>
                </div>
            <?php endif; ?>
            <div class="loading loading--blue"></div>
            <?php if ( $settings[ 'show_video' ] == 'yes' ): ?>
                <button class="videoplayer-play">
                    <svg class="icon icon--play">
                        <use xlink:href="<?= ConfigHelper::get('sprite') ?>#play"></use>
                    </svg>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
