<?php if ( $settings[ 'items' ] ): ?>
    <div class="section _section timeline"
         data-full-vh
        <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
         data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
        <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
        <div class="section-wrap">
            <?php if ( $settings[ 'main_title' ] || $settings[ 'main_subtitle' ] ): ?>
                <header class="timeline-header">
                    <?php if ( $settings[ 'main_title' ] ): ?>
                        <div class="timeline-title"><?= $settings[ 'main_title' ] ?></div>
                    <?php endif; ?>
                    <?php if ( $settings[ 'main_subtitle' ] ): ?>
                        <div class="timeline-subtitle"><?= $settings[ 'main_subtitle' ] ?></div>
                    <?php endif; ?>
                </header>
            <?php endif; ?>
            <div class="timelineslider">
                <div class="timelineslider-wrap">
                    <div class="timelineslider-scrollbar">
                        <ul>
                            <?php for ( $i = 0; $i < 32; $i++ ) { ?>
                                <li></li>
                            <?php } ?>
                        </ul>
                        <input type="range"
                               min="0"
                               max="<?= count( $settings[ 'items' ] ) ?>"
                               step="1"
                               value="0">
                    </div>
                    <ul class="timelineslider-info">
                        <li>
                            <p><?= $settings[ 'text1' ] ?></p>
                            <div>
                                <b id="sliderYear"></b>
                                <span><?= $settings[ 'measure1' ] ?></span>
                            </div>
                        </li>
                        <li>
                            <p><?= $settings[ 'text2' ] ?></p>
                            <div>
                                <b id="sliderPersonnel"></b>
                                <span><?= $settings[ 'measure2' ] ?></span>
                            </div>
                        </li>
                        <li>
                            <p><?= $settings[ 'text3' ] ?></p>
                            <div>
                                <b id="sliderArea"></b>
                                <span><?= $settings[ 'measure3' ] ?></span>
                            </div>
                        </li>
                    </ul>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach ( $settings[ 'items' ] as $item ) { ?>
                                <div class="swiper-slide"
                                     data-year="<?= $item[ 'value1' ] ?>"
                                     data-personnel="<?= $item[ 'value2' ] ?>"
                                     data-area="<?= $item[ 'value3' ] ?>">
                                    <div class="timelineslider-slide">
                                        <?= nl2br( $item[ 'desc' ] ) ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>