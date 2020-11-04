<?php while ( have_posts() ): the_post(); ?>
	<div class="section bg-f4"
		 data-menu-section
		 data-icon="<?= ConfigHelper::get( 'images' ) ?>intro/active.svg"
		 data-hash="active">
		<div class="section-wrap">
			<div class="section-header">
				<h1 class="section-title"><?php the_title() ?></h1>
				<p class="section-subtitle"><?= get_field( 'first_subtitle' ) ?></p>
			</div>
			<div class="festivals">
				<?php foreach ( $actives as $festival ): ?>
					<?php
					$image = wp_get_attachment_image_url( $festival->meta->campaign_image, 'pmw-large' );
					?>
					<div class="card-festival">
						<a href="<?= $festival->meta->campaign_url ?>">
							<h2>
								<img src="<?= $image ?>" alt="<?= $festival->post_title ?>" title="<?= $festival->post_title ?>">
							</h2>
							<div class="card-festival__img" style="background-image: url('<?= $image ?>')"></div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php if ( $expireds ): ?>
		<div class="section"
			 data-menu-section
			 data-icon="<?= ConfigHelper::get( 'images' ) ?>intro/history.svg"
			 data-hash="expired">
			<div class="section-wrap">
				<div class="section-header">
					<h3 class="section-title"><?= get_field( 'second_title' ) ?></h3>
					<p class="section-subtitle"><?= get_field( 'second_subtitle' ) ?></p>
				</div>
				<div class="festivals">
					<?php foreach ( $expireds as $festival ): ?>
						<?php
						$image = get_the_post_thumbnail_url( $festival->ID, 'pmw-medium' );
						?>
						<div class="card-festival card-festival--past card-festival--33">
							<a href="<?= $festival->meta->campaign_url ?>">
								<h4>
									<img src="<?= $image ?>" alt="<?= $festival->post_title ?>" title="<?= $festival->post_title ?>">
								</h4>
								<div class="card-festival__img" style="background-image: url('<?= $image ?>')"></div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endwhile; ?>

