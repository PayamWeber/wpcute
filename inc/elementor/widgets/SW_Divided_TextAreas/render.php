<div class="section _section bg-gray4"
    <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
     data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
    <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
    <div class="agency agency--gray">
        <div class="agency-col">
            <div class="agency-wrap">
                <div class="agency-content">
                    <?= nl2br( $settings[ 'desc1' ] ) ?>
                </div>
            </div>
        </div>
        <div class="agency-col">
            <div class="agency-wrap">
                <div class="agency-content">
                    <?= nl2br( $settings[ 'desc2' ] ) ?>
                </div>
            </div>
            <?php if ( $settings[ 'show_button' ] == 'yes' ): ?>
                <div class="agency-btn agency-btn--shift">
                    <a href="<?= $settings['button_url']['url'] ?>" class="btn btn--wide2 btn--lg"><?= $settings['button_text'] ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>