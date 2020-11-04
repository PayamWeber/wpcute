<?php
$isFeature = $settings[ 'style' ] == 'feature';
$isDesc    = $settings[ 'style' ] == 'desc';

$classname = $settings[ 'style' ] != 'image_only' ? 'jumbotron--' . $settings[ 'style' ] : '';
?>
<div class="jumbotron _section pad-md <?= $classname ?>"
     data-parallax
     data-full-vh
    <?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
     data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
    <?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
    <div class="jumbotron-bg" data-parallax-bg style="background-image: url('<?= wp_get_attachment_image_url( $settings[ 'main_image' ][ 'id' ], 'full' ) ?>')"></div>
    <div class="jumbotron-footer">
        <?php if ( $isFeature ): ?>
            <?php if ( $settings[ 'items' ] ): ?>
                <ul class="bus">
                    <?php foreach ( $settings[ 'items' ] as $item ): ?>
                        <li>
                            <div class="card-f card-f--light">
                                <img class="card-f__img" src="<?= $item[ 'image' ][ 'url' ] ?>"/>
                                <div class="card-f__wrap">
                                    <h4 class="card-f__title"><?= $item[ 'title' ] ?></h4>
                                    <div class="card-f__desc"><?= nl2br( $item[ 'desc' ] ) ?></div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php elseif ( $isDesc ): ?>
            <div class="s-header">
                <h3 class="s-title"><?= $settings[ 'main_title' ] ?></h3>
                <p class="s-subtitle"><?= $settings[ 'main_subtitle' ] ?></p>
            </div>
            <div class="post"><?= nl2br( $settings[ 'main_desc' ] ) ?></div>
        <?php endif; ?>
    </div>
</div>
