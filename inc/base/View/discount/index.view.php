<?php include_view( 'common.page.caption' ); ?>
	<div class="section-01-head-pages">
		<div class="section-wrap">
			<div class="container-fluid">
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-5 img-video-content">
						<video id="my-video" class="video-js" controls poster="<?= wp_get_attachment_image_url( get_field( 'discounts_page_intro_video_poster' ), 'large' ) ?>" data-setup='' loop>
							<source src="<?= get_field( 'discounts_page_intro_video_url' ) ?>" type='video/mp4'>
						</video>
					</div>
					<div class="col-lg-6 col-md-12 text-content">
						<h2 class="color-7B5  mb-4">
							<?= get_field( 'discounts_page_intro_title' ) ?>
						</h2>
						<span class="color-C89 d-block mb-4">
							<?= get_field( 'discounts_page_intro_subtitle' ) ?>
						</span>
						<p class="text-justify color-313 mb-4">
							<?= nl2br( get_field( 'discounts_page_description' ) ) ?>
						</p>
						<div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php if ( get_field( 'discounts_page_cards' ) ): ?>
	<div class="section section__discount">
		<div class="section-wrap">
			<div class="discount-content container-fluid">
				<div class="row justify-content-center">
					<?php foreach ( get_field( 'discounts_page_cards' ) as $card ): ?>
						<div class="col-lg-5 mb-4">
							<div class="img-text position-relative">
								<img src="<?= wp_get_attachment_image_url( $card[ 'discount_image' ], 'large' ) ?>" alt="" class="discount-pic">
								<div class="text-content">
									<img src="<?= get_template_directory_uri() ?>/assets/theme/svg/index/label.svg" alt="" class="label-pic position-absolute">
									<h5 class="color-C18 mb-4 mt-2">
										<?= $card[ 'discount_title' ] ?>
									</h5>
									<p class="color-9C8 text-justify">
										<?= nl2br( $card[ 'discount_description' ] ) ?>
									</p>
									<a href="<?= $card[ 'discount_url' ] ?>" class="color-C89 d-block mr-auto ">
										<?= $card[ 'discount_button_text' ] ?>
										<div class="arrows-box">
											<i class="icon-arrow-left af-icons" style="margin-right: -9px"></i>
											<i class="icon-arrow-left af-icons"></i>
										</div>
									</a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>