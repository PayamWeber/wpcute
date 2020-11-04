<section class="section pad-md bg-grd-green _section"
	<?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
		 data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
	<?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
	<?php if ( $settings[ 'main_title' ] || $settings[ 'main_subtitle' ] ): ?>
		<div class="section-wrap pad-0">
			<div class="section-header section-header--light">
				<?php if ( $settings[ 'main_title' ] ): ?>
					<h3 class="section-title"><?= $settings[ 'main_title' ] ?></h3>
				<?php endif; ?>
				<?php if ( $settings[ 'main_subtitle' ] ): ?>
					<p class="section-subtitle"><?= $settings[ 'main_subtitle' ] ?></p>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<div data-instaqoute class="swiper-countainer max-md">
		<div class="swiper-wrapper">
			<?php foreach ( $settings[ 'items' ] as $item ): ?>
				<div class="swiper-slide">
					<div class="instaqoute">
						<a href="<?= $item[ 'post_url' ][ 'url' ] ?>" target="_blank" class="instaqoute-img video">
							<img src="<?= $image = wp_get_attachment_image_url( $item[ 'image' ][ 'id' ], 'medium' ) ?>" alt="">
							<span style="background-image: url('<?= $image ?>')"></span>
							<?php if ( $item[ 'is_video' ] == 'yes' ): ?>
								<div class="instaqoute-play">
									<svg>
										<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#play"></use>
									</svg>
								</div>
							<?php endif; ?>
						</a>
						<div class="instaqoute-content">
							<div class="instaqoute-textinner">
								<div class="instaqoute-bg">
									<div class="instaqoute-header">
										<a href="<?= $item[ 'author_url' ][ 'url' ] ?>" target="_blank" class="instaqoute-avatar"
										   style="background-image: url('<?= wp_get_attachment_image_url( $item[ 'author_image' ][ 'id' ] ) ?>')">
										</a>
										<div class="instaqoute-info">
											<img class="icon icon--instaqoute" src="<?= ConfigHelper::get('media') ?>index/insta-qoute.svg" alt="">
											<div class="instaqoute-name"><?= $item[ 'author_name' ] ?></div>
										</div>
									</div>
									<div class="instaqoute-text"><?= nl2br( $item[ 'content' ] ) ?></div>
								</div>
								<a href="<?= $item[ 'post_url' ][ 'url' ] ?>" target="_blank" class="instaqoute-btn">
									<svg class="icon icon--instagram">
										<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#instagram"></use>
									</svg>
									<span><?= $item[ 'button_text' ] ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="swiper-pagination"></div>
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
	</div>
</section>