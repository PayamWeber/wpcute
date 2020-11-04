<div class="section _section"
	<?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
	 data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
	<?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
	<div class="agency">
		<div class="agency-col">
			<div class="agency-wrap">
				<img class="agency-image" src="<?= $settings[ 'image1' ][ 'url' ] ?>" alt="<?= $settings[ 'title1' ] ?>">
				<div class="agency-main">
					<div class="agency-title"><?= $settings[ 'title1' ] ?></div>
					<div class="agency-desc"><?= nl2br( $settings[ 'desc1' ] ) ?></div>
					<?php if ( $settings[ 'show_button1' ] == 'yes' ): ?>
						<a href="<?= $settings[ 'button_url1' ][ 'url' ] ?>" class="btn btn--md btn--full btn--solid-blue"><?= $settings[ 'button_text1' ] ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="agency-col">
			<div class="agency-wrap">
				<img class="agency-image" src="<?= $settings[ 'image2' ][ 'url' ] ?>" alt="<?= $settings[ 'title2' ] ?>">
				<div class="agency-main">
					<div class="agency-title"><?= $settings[ 'title2' ] ?></div>
					<div class="agency-desc"><?= nl2br( $settings[ 'desc2' ] ) ?></div>
					<?php if ( $settings[ 'show_button2' ] == 'yes' ): ?>
						<a href="<?= $settings[ 'button_url2' ][ 'url' ] ?>" class="btn btn--md btn--full btn--solid-blue"><?= $settings[ 'button_text2' ] ?></a>
					<?php endif; ?>
				</div>
			</div>
			<?php if ( $settings[ 'show_items' ] == 'yes' && $settings[ 'items' ] ): ?>
				<div class="agency-services">
					<ul class="bus bus--center">
						<?php foreach ( $settings[ 'items' ] as $item ): ?>
							<li>
								<div class="card-services">
									<img class="card-services__image" src="<?= $item[ 'image' ][ 'url' ] ?>" alt="<?= $item[ 'title' ] ?>">
									<div class="card-services__title"><?= $item[ 'title' ] ?></div>
									<div class="card-services__desc"><?= nl2br( $item[ 'desc' ] ) ?></div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>