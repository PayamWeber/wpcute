<?php while ( have_posts() ): the_post(); ?>
	<div class="faq">
		<div class="intro intro--search section bg-grd-blue">
			<div class="section-wrap section-wrap--posr max-md3">
				<header class="section-header">
					<h1 class="section-title white"><?php the_title() ?></h1>
					<?php if ( get_field( 'subtitle' ) ): ?>
						<p class="section-subtitle white"><?= get_field( 'subtitle' ) ?></p>
					<?php endif; ?>
				</header>
				<div class="section-body">
					<div class="input input--fat input--shadow input--icon">
						<input type="text" placeholder="در اینجا جستجو کنید...">
						<svg>
							<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#search-color"></use>
						</svg>
					</div>
					<div class="intro-links links links--center links--white">
						<ul>
							<li>
								<button class="active" data-filter-action="all">همه سوالات</button>
							</li>
							<?php if ( $categories ): ?>
								<?php foreach ( $categories as $cat ): ?>
									<li>
										<button data-filter-action="<?= $cat->term_id ?>"><?= $cat->name ?></button>
									</li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<div class="faq-bg faq-bg--top" style="background-image: url(<?= ConfigHelper::get( 'media' ) ?>support/bg2.svg)"></div>
				<div class="faq-bg faq-bg--bottom" style="background-image: url(<?= ConfigHelper::get( 'media' ) ?>faq/bg-faq.svg)"></div>
			</div>
		</div>
		<div class="section bg-f7">
			<section class="section-wrap section-wrap--lowpadtop max-md3 faq-list">
				<ul>
					<?php foreach ( $questions as $qs ) { ?>
						<?php
						$cat = wp_get_post_terms( $qs->ID, 'faq_cat' );
						$cat = $cat && is_array( $cat ) ? $cat[ 0 ] : false;
						?>
						<li data-filter-target=<?= $cat ? $cat->term_id : '' ?>>
							<article class="faq-card" data-hash="faq_<?= $qs->ID ?>">
								<h2 class="faq-card__header">
									<button><?= $qs->post_title ?>
										<span></span>
									</button>
								</h2>
								<div class="faq-card__body"><?= $qs->meta->answer ?></div>
							</article>
						</li>
					<?php } ?>
				</ul>
				<div class="faq-empty hide"><?= get_field( 'not_found_text' ) ?></div>
			</section>
		</div>
	</div>
<?php endwhile; ?>
<?php include_view( 'support.contact_section' ) ?>
<?php include_view( 'support.modal' ) ?>