<?php $caption_image = pmw_get_main_template() == 'tp2' ? get_template_directory_uri() . '/assets/theme/tp2/images/pregnancy_1366x400.png' : ''; ?>
<?php if ( is_singular() ): ?>
	<?php while ( have_posts() ): the_post(); ?>
		<?php $caption_image = wp_get_attachment_image_url( get_field( 'page_top_caption_background_image' ), 'pmw-large') ? : $caption_image; ?>
	<?php endwhile; ?>
<?php endif; ?>
<section class="page_breadcrumbs ds background_cover section_padding_50" style="background-position:center center; background-image: url(<?= $caption_image ?>)">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<?php if ( is_singular() ): ?>
					<?php while ( have_posts() ): the_post(); ?>
						<h2><?= get_the_title() ?></h2>
					<?php endwhile; ?>
				<?php endif; ?>
				<?php if ( is_tax() ): ?>
					<h2><?= get_queried_object()->name ?? '' ?></h2>
				<?php endif; ?>
				<ol class="breadcrumb divided_content wide_divider dir-rtl">
					<li>
						<a href="<?= site_url() ?>">
							صفحه اصلی
						</a>
					</li>
					<li>
						<?php if ( is_singular() ): ?>
							<?php while ( have_posts() ): the_post(); ?>
								<a href="<?= get_the_permalink() ?>"><?= get_the_title() ?></a>
							<?php endwhile; ?>
						<?php endif; ?>
						<?php if ( is_tax() ): ?>
							<a href="<?= get_term_link( get_queried_object() ) ?>"><?= get_queried_object()->name ?? '' ?></a>
						<?php endif; ?>
					</li>
				</ol>
			</div>
		</div>
	</div>
</section>
