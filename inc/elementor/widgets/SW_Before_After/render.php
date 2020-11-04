<div class="section _section"
	<?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
	<?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
	 data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
	<?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
	<div class="compare">
		<div class="compare-slider">
			<?php if ( $settings[ 'items' ] ): ?>
				<!-- Before -->
				<ul class="compare-main">
					<?php foreach ( $settings[ 'items' ] as $key => $item ): ?>
						<li data-feature="<?= "feature{$key}" ?>" style="background-image:url('<?= $item[ 'before_image' ][ 'url' ] ?>')"></li>
					<?php endforeach; ?>
				</ul>
				<!-- after -->
				<ul class="compare-resize">
					<?php foreach ( $settings[ 'items' ] as $key => $item ): ?>
						<li data-feature="<?= "feature{$key}" ?>" style="background-image:url('<?= $item[ 'after_image' ][ 'url' ] ?>')"></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<span class="compare-handle"><i>
					<svg>
						<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#handle-arc"></use>
					</svg>
					<svg>
						<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#handle-arc"></use>
					</svg>
				</i></span>
			<?php if ( $settings[ 'main_desc' ] ): ?>
				<div class="compare-footer">
					<div class="compare-wrap">
						<?= nl2br( $settings[ 'main_desc' ] ) ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="compare-cards">
			<div class="compare-wrap">
				<ul class="bus bus--center">
					<?php foreach ( $settings[ 'items' ] as $key => $item ): ?>
						<li class="<?= $key == 0 ? 'active': '' ?>" data-feature="<?= "feature{$key}" ?>">
							<div class="card-f card-f--smicon card-f--border">
								<img class="card-f__img" src="<?= wp_get_attachment_image_url( $item[ 'image' ][ 'id' ] ) ?>">
								<div class="card-f__wrap">
									<div class="card-f__title"><?= $item[ 'title' ] ?></div>
								</div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>