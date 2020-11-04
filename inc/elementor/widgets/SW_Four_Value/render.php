<section class="_section section"
    <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
         data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
    <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
    <div class="section-body">
        <div class="values">
            <div class="values-col">
                <header class="section-header s-header">
                    <h2 class="s-title"><?= $settings['main_title'] ?></h2>
                    <p class="s-subtitle"><?= $settings['main_subtitle'] ?></p>
                </header>
                <div class="values-wrap">
                    <div class="card-f card-f--vertical">
                        <img class="card-f__img" src="<?= $settings['card_image_tr']['url'] ?>">
                        <div class="card-f__wrap">
                            <h3 class="card-f__title"><?= $settings['main_title_tr'] ?></h3>
                            <div class="card-f__desc"><?= $settings['main_subtitle_tr'] ?></div>
                        </div>
                    </div>
                    <div class="card-f card-f--vertical">
                        <img class="card-f__img" src="<?= $settings['card_image_br']['url'] ?>">
                        <div class="card-f__wrap">
                            <h3 class="card-f__title"><?= $settings['main_title_br'] ?></h3>
                            <div class="card-f__desc"><?= $settings['main_subtitle_br'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="values-col">
                <div class="values-wrap">
                    <div class="card-f card-f--vertical">
                        <img class="card-f__img" src="<?= $settings['card_image_tl']['url'] ?>">
                        <div class="card-f__wrap">
                            <h3 class="card-f__title"><?= $settings['main_title_tl'] ?></h3>
                            <div class="card-f__desc"><?= $settings['main_subtitle_tl'] ?></div>
                        </div>
                    </div>
                    <div class="card-f card-f--vertical">
                        <img class="card-f__img" src="<?= $settings['card_image_bl']['url'] ?>">
                        <div class="card-f__wrap">
                            <h3 class="card-f__title"><?= $settings['main_title_bl'] ?></h3>
                            <div class="card-f__desc"><?= $settings['main_subtitle_bl'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>