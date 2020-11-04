<?php if ( $settings[ 'slider_images' ] ): ?>
	<div class="intro _section intro--<?= $settings[ 'style' ] ?>" id="intro" data-parallax js-parallax-intro data-intro
		<?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
		 data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
		<?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
		<div class="intro-slider fpslider active">
			<ul class="fpslider__content">
				<?php foreach ( $settings[ 'slider_images' ] as $key => $item ): ?>
					<li class="intro-slide fpslider__content-item <?= ! $key ? 'active' : '' ?>">
						<div class="intro-bg" data-parallax-bg>
							<div class="intro-image" style="background-image: url('<?= $item[ 'image' ][ 'url' ] ?>')"></div>
						</div>
						<div class="intro-content">
							<div class="intro-wrap">
								<div class="s-header">
									<div class="s-title"><?= $item[ 'title' ] ?></div>
									<div class="s-subtitle">
										<?php if ( $settings[ 'style' ] == 'index' ): ?>
											<p>
												<?= nl2br( $item[ 'subtitle' ] ) ?>
											</p>
										<?php else: ?>
											<?= $item[ 'subtitle' ] ?>
										<?php endif; ?>
									</div>
								</div>
								<?php if ( $item[ 'show_button' ] == 'yes' ): ?>
									<a href="<?= esc_url( $item[ 'button_url' ][ 'url' ] ) ?>" class="intro-btn btn btn--long btn--gray-3"><?= $item[ 'button_text' ] ?></a>
								<?php endif; ?>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="fpslider__nav">
				<ul class="fpslider__bullet"></ul>
			</div>
		</div>
		<?php if ( $settings[ 'show_bottom_box' ] == 'yes' && $settings[ 'items' ] ): ?>
			<div class="intro-nav">
				<div class="intro-wrap">
					<ul class="bus bus--white">
						<?php foreach ( $settings[ 'items' ] as $item ): ?>
							<li>
								<?php if ( $settings[ 'style' ] == 'about' ): ?>
									<button data-menu-second>
										<div class="card-f card-f--vertical">
											<img class="card-f__img" src="<?= $item[ 'image' ][ 'url' ] ?>">
											<p class="card-f__title"><?= $item[ 'title' ] ?></p>
										</div>
									</button>
								<?php elseif ( $settings[ 'style' ] == 'product' ): ?>
									<div class="card-f">
										<img class="card-f__img" src="<?= $item[ 'image' ][ 'url' ] ?>">
										<div class="card-f__wrap">
											<b class="card-f__title"><?= $item[ 'title' ] ?></b>
											<p class="card-f__desc"><?= $item[ 'desc' ] ?></p>
										</div>
									</div>
								<?php elseif ( $settings[ 'style' ] == 'support' ): ?>
									<div class="card-f">
										<img class="card-f__img" src="<?= $item[ 'image' ][ 'url' ] ?>">
										<div class="card-f__wrap">
											<b class="card-f__title"><?= $item[ 'title' ] ?></b>
											<p class="card-f__desc"><?= str_replace( [ '[', ']' ], [ '<span>', '</span>' ], $item[ 'desc' ] ) ?></p>
										</div>
									</div>
								<?php else: ?>
									<button data-menu-second class="card-f card-f--vertical">
										<img class="card-f__img" src="<?= $item[ 'image' ][ 'url' ] ?>">
										<p class="card-f__title"><?= $item[ 'title' ] ?></p>
									</button>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
						<?php if ( $settings[ 'box_button_show' ] == 'yes' ): ?>
							<li class="intro-shop">
								<a href="<?= esc_url( $settings[ 'box_button_url' ][ 'url' ] ) ?>" class="card-f card-f--vertical" <?= $settings[ 'box_button_is_video' ] == 'yes' ? 'data-fancybox="intro"' : '' ?>>
									<img class="card-f__img" src="<?= $settings[ 'box_button_image' ][ 'url' ] ?>">
									<?php if ( $settings[ 'box_button_text' ] ): ?>
										<p class="card-f__title"><?= $settings[ 'box_button_text' ] ?></p>
									<?php endif; ?>
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>