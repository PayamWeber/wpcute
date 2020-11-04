<?php include_view( 'common.page.caption' ); ?>
<div class="section section__gallery">
	<div class="search-wrap">
		<h2 class="color-7B5 text-center mb-4 font-aviny">
			<?= get_field('gallery_page_intro_title') ?>
		</h2>
		<span class="d-block text-center color-C89 mb-5 font-aviny">
			<?= get_field('gallery_page_intro_subtitle') ?>
		</span>
		<div class="container">
			<div class="row justify-content-center">
				<?php if ( $albums ): ?>
					<?php foreach ( $albums as $album ): ?>
						<?php $image = $album ? get_term_meta( $album->term_id, 'image', true ) : ''; ?>
						<?php $image = $image ? wp_get_attachment_image_url( $image, 'large' ) : ''; ?>
						<div class="col-lg-4 col-md-4 col-sm-6 border-solid ">
							<a href="<?= get_term_link( $album ) ?>" class="select-cat">
								<img src="<?= $image ?>" alt="" class="w-100  packages-img">
							</a>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
