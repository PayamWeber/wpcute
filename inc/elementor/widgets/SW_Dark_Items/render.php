<div class="section _section bg-gray3"
    <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
     data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
    <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
    <div class="section-wrap">
        <div class="inbox">
            <div class="inbox-side">
                <?php if ( $settings[ 'main_title' ] || $settings[ 'main_subtitle' ] ): ?>
                    <header class="s-header mb-40">
                        <?php if ( $settings[ 'main_title' ] ): ?>
                            <h2 class="s-title"><?= $settings[ 'main_title' ] ?></h2>
                        <?php endif; ?>
                        <?php if ( $settings[ 'main_subtitle' ] ): ?>
                            <p class="s-subtitle"><?= $settings[ 'main_subtitle' ] ?></p>
                        <?php endif; ?>
                    </header>
                <?php endif; ?>
                <?php if ( $settings[ 'items' ] ): ?>
                    <?php foreach ( $settings[ 'items' ] as $item ): ?>
                        <div class="card-f">
                            <img class="card-f__img" src="<?= $item[ 'image' ][ 'url' ] ?>">
                            <div class="card-f__wrap">
                                <p class="card-f__title"><?= $item[ 'title' ] ?></p>
                                <div class="card-f__desc">
                                    <?= nl2br( $item[ 'desc' ] ) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="inbox-center">
                <img class="inbox-image" src="<?= $settings['main_image']['url'] ?>" alt="<?= $settings[ 'main_title' ] ?>">
            </div>
        </div>
    </div>
</div>
