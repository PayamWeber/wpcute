<section class="section _section bg-f7"
    <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
         data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
    <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
    <div class="section-wrap section-wrap--posr pad-md">
        <div class="section-bg section-bg--va" style="background-image:url('<?= $settings['main_image']['url'] ?>')"></div>
        <?php if ( $settings[ 'main_title' ] || $settings[ 'main_subtitle' ] ): ?>
            <header class="s-header mb-70">
                <?php if ( $settings[ 'main_title' ] ): ?>
                    <h2 class="s-title"><?= $settings[ 'main_title' ] ?></h2>
                <?php endif; ?>
                <?php if ( $settings[ 'main_subtitle' ] ): ?>
                    <p class="s-subtitle"><?= $settings[ 'main_subtitle' ] ?></p>
                <?php endif; ?>
            </header>
        <?php endif; ?>
        <div class="section-body">
            <ul class="features">
                <?php foreach ( $settings[ 'items' ] as $item ): ?>
                    <li>
                        <div class="card-f card-f--vertical">
                            <img class="card-f__img" src="<?= $item[ 'image' ][ 'url' ] ?>">
                            <p class="card-f__title"><?= $item[ 'title' ] ?></p>
                            <div class="card-f__desc"><?= nl2br( $item[ 'desc' ] ) ?></div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>