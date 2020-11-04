<?php while ( have_posts() ): the_post(); ?>
	<section class="section support bg-grd-blue">
		<div class="section-wrap section-wrap--posr max-md3">
			<header class="section-header">
				<h1 class="section-title white"><?php the_title() ?></h1>
				<?php if ( get_field( 'subtitle' ) ): ?>
					<p class="section-subtitle white"><?= get_field( 'subtitle' ) ?></p>
				<?php endif; ?>
			</header>
			<div class="section-body">
				<div class="support-layout">
					<div>
						<div class="support-faq">
							<?php if ( $faq_page ): ?>
								<?php if ( $faq_links ): ?>
									<h2 class="support-faq__title"><?= get_field( 'faq_title' ) ?></h2>
									<ul>
										<?php foreach ( $faq_links as $link ) { $link = is_numeric( $link ) ? \PMW\Faq::find( $link ) : $link; ?>
											<li>
												<h3>
													<a href="<?= $faq_url ?>#faq_<?= $link->ID ?>"><?= $link->post_title ?></a>
												</h3>
											</li>
										<?php } ?>
									</ul>
								<?php endif; ?>
								<a href="<?= $faq_url ?>" class="btn btn--md"><?= $faq_page->post_title ?></a>
							<?php endif; ?>
						</div>
					</div>
					<div>
						<div>
							<button data-helpOpen class="support-card support-card--contact">
								<img src="<?= ConfigHelper::get( 'media' ) ?>support/contact-us.svg" alt="آیکن تماس با ما">
								<div>
									<h2 class="support-card__title"><?= get_field( 'contact_us_title' ) ?></h2>
									<p><?= get_field( 'contact_us_subtitle' ) ?></p>
								</div>
							</button>
						</div>
						<div>
							<a href="<?= get_field( 'service_url' ) ?>" class="support-card support-card--service">
								<img src="<?= ConfigHelper::get( 'media' ) ?>support/support-service.svg" alt="آیکن انتخاب سرویس حامی">
								<div>
									<h2 class="support-card__title"><?= get_field( 'service_title' ) ?></h2>
									<p><?= get_field( 'service_subtitle' ) ?></p>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="section-footer section-footer--column text-center">
				<div class="h4 white"><?= get_field( 'bottom_text' ) ?></div>
				<div class="h6 white-7"><?= get_field( 'bottom_subtext' ) ?></div>
			</div>
			<div class="support-bg support-bg--top" style="background-image: url(<?= ConfigHelper::get( 'media' ) ?>support/bg1.svg)"></div>
			<div class="support-bg support-bg--bottom" style="background-image: url(<?= ConfigHelper::get( 'media' ) ?>support/bg2.svg)"></div>
		</div>
	</section>
<?php endwhile; ?>
<?php include_view( 'support.modal' ) ?>
