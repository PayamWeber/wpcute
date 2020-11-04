<?php
if ( $settings[ 'style' ] == '360' && pmw_is_elementor() )
{
	$GLOBALS[ 'current_360' ]          = $settings[ 'images' ];
	$GLOBALS[ 'current_elementor_id' ] = $this->get_id();
	\PMW\Inc\Vendor\Controller::grab( 'i360Controller@update', [
		'current_360' => $settings[ 'images' ],
		'current_elementor_id' => $this->get_id(),
	] );
}
$post        = \PMW\Post::find();
$cache_text  = get_post_meta( $post->ID, $this->get_id() . '_cache_text', true ) ?: '1.0.0';
$config_file = site_url() . '/wp-content/uploads/360/' . $post->ID . '/' . $this->get_id() . '/' . $this->get_id() . '.json' . '?v=' . $cache_text;
?>
<div class="section _section section--feature <?= $settings[ 'style' ] == '360' ? 'section--360' : '' ?> <?= $settings[ 'dark_mode' ] == 'yes' ? 'bg-black' : '' ?>"
	<?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
	<?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
	 data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
	<?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
	<div class="section-wrap <?= $settings[ 'dark_mode' ] == 'yes' ? 'pad-lg' : '' ?>">
		<?= $settings[ 'dark_mode' ] == 'yes' ? '<div class="darkness">' : '' ?>
		<article class="flip <?= $settings[ 'reverse_mode' ] == 'yes' ? 'flip--left' : '' ?> flip--center">
			<div class="flip-wrap">
				<?= $settings[ 'dark_mode' ] == 'yes' ? '<div class="darkness-wrap">' : '' ?>
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
				<?php if ( $settings[ 'main_desc' ] ): ?>
					<div class="post"><?= nl2br( $settings[ 'main_desc' ] ) ?></div>
				<?php endif; ?>
				<?php if ( $settings[ 'items_style' ] == 'three' && $settings[ 'items' ] ): ?>
					<ul class="bus bus--center bus--3">
						<?php foreach ( $settings[ 'items' ] as $item ): ?>
							<li>
								<div class="card-f card-f--vertical <?= $settings[ 'dark_mode' ] == 'yes' ? 'card-f--light' : '' ?>">
									<img class="card-f__img" src="<?= $item[ 'image' ][ 'url' ] ?>"/>
									<p class="card-f__title"><?= $item[ 'title' ] ?></p>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php elseif ( $settings[ 'items_style' ] == 'one' && $settings[ 'items' ] ): ?>
					<ul>
						<?php foreach ( $settings[ 'items' ] as $item ): ?>
							<li>
								<div class="card-f card-f--smicon <?= $settings[ 'dark_mode' ] == 'yes' ? 'card-f--light' : '' ?>">
									<img class="card-f__img" src="<?= $item[ 'image' ][ 'url' ] ?>"/>
									<div class="card-f__wrap">
										<div class="card-f__title"><?= $item[ 'title' ] ?></div>
										<p class="card-f__desc"><?= nl2br( $item[ 'desc' ] ) ?></p>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php elseif ( $settings[ 'items_style' ] == 'two' && $settings[ 'items' ] ): ?>
					<ul class="bus <?= $settings[ 'dark_mode' ] == 'yes' ? 'bus--white' : '' ?> bus--bottom bus--2">
						<?php foreach ( $settings[ 'items' ] as $item ): ?>
							<li>
								<div class="card-f card-f--vertical card-f--right <?= $settings[ 'dark_mode' ] == 'yes' ? 'card-f--light' : '' ?>">
									<img class="card-f__img" src="<?= $item[ 'image' ][ 'url' ] ?>"/>
									<p class="card-f__title"><?= $item[ 'title' ] ?></p>
									<p class="card-f__desc"><?= nl2br( $item[ 'desc' ] ) ?></p>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<div class="flip-empty"></div>
				<?= $settings[ 'dark_mode' ] == 'yes' ? '</div>' : '' ?>
			</div>
			<div class="flip-alone <?= $settings[ 'style' ] == 'item_image' ? 'ltr' : '' ?>">
				<?php if ( $settings[ 'style' ] == '360' ): ?>
					<div class="spin-slider"
						 data-spin-slider
						 data-base-path=""
						 data-ajax="<?= $config_file ?>">
						<div class="loading loading--blue"></div>
					</div>
				<?php elseif ( $settings[ 'style' ] == 'item_image' ): ?>
					<div class="features-image features-image--400">
						<img class="features-image__img" src="<?= wp_get_attachment_image_url( $settings[ 'main_image' ][ 'id' ], 'pmw-medium' ) ?>">
					</div>
				<?php endif; ?>
			</div>
		</article>
		<?= $settings[ 'dark_mode' ] == 'yes' ? '</div>' : '' ?>
	</div>
</div>
