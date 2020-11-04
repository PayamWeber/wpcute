<div class="section _section"
    <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
     data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
    <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
    <div class="waterusage">
        <div class="waterusage-main" data-full-vh>
            <div class="waterusage-center">
                <div class="waterusage-content">
                    <div class="waterusage-contentinner">
                        <?php if ( $settings[ 'main_title' ] || $settings[ 'main_subtitle' ] ): ?>
                            <header class="s-header">
                                <h2 class="s-title"><?= $settings[ 'main_title' ] ?></h2>
                                <p class="s-subtitle"><?= $settings[ 'main_subtitle' ] ?></p>
                            </header>
                        <?php endif; ?>
                        <?php if ( $settings[ 'main_desc' ] ): ?>
                            <div class="waterusage-text">
                                <?= nl2br( $settings[ 'main_desc' ] ) ?>
                            </div>
                        <?php endif; ?>
                        <div class="switch" data-nojs>
                            <span class="switch-label"><?= $settings[ 'max_text' ] ?></span>
                            <div class="switch-handle">
                                <span></span>
                            </div>
                            <span class="switch-label"><?= $settings[ 'min_text' ] ?></span>
                        </div>
                    </div>
                </div>
                <div class="waterusage-measure" data-start="<?= $settings[ 'meter_length' ] ?>" data-maxwater="<?= $settings[ 'max_number' ] ?>" data-minwater="<?= $settings[ 'min_number' ] ?>">
                    <ul>
                        <?php for ( $i = 0; $i < 31; $i++ ) { ?>
                            <li></li>
                        <?php } ?>
                    </ul>
                    <div class="waterusage-dynamic">
                        <i>
                            <i style="height: 10%;"></i>
                        </i>
                        <div class="waterusage-info" style="bottom: 10%;">
                            <span data-color1="rgb(244,118,72)" data-color2="rgb(0,190,230)"></span>
                            <i><b>20</b></i>
                            <div><?= $settings[ 'measure' ] ?></div>
                        </div>
                    </div>
                    <div class="waterusage-static"></div>
                </div>
            </div>
        </div>
    </div>
</div>