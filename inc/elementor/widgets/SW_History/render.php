<article class="_section section section-story"
    <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
         data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
    <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
    <div class="section-wrap pad-lg">
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
            <div class="flip">
                <div class="flip-wrap">
                    <div class="post">
                        <?= nl2br( $settings['main_desc'] ) ?>
                    </div>
                    <div class="flip-empty"></div>
                    <?php if ( $settings['btn_label'] ): ?>
                        <div class="section-story__btn">
                            <a class="btn" href="<?= $settings['btn_link']['url'] ?>"><?= $settings['btn_label'] ?></a>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ( $settings['items'] ): ?>
                    <div class="flip-alone">
                        <div class="section-story__properties">
                            <div class="row row--15-80">
                                <?php foreach ( $settings['items'] as $item): ?>
                                <div class="col-xs-12">
                                    <div class="card-properties">
                                        <img class="calendar" src="<?= $item['image']['url'] ?>" alt="">
                                        <p><?= $item['title'] ?></p>
                                        <div><b class="counter" data-num="<?= $item['value'] ?>"></b><span><?= $item['prefix'] ?></span></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</article>
