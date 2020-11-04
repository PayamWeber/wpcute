<?php include_view( 'common.page.caption' ); ?>
<div class="section-01-head-pages">
	<div class="section-wrap">
		<div class="container-fluid">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-5 img-video-content">
					<video id="my-video" class="video-js" controls poster="<?= wp_get_attachment_image_url( get_field( 'special_card_page_intro_video_poster' ), 'large' ) ?>" data-setup='' loop>
						<source src="<?= get_field( 'special_card_page_intro_video_url' ) ?>" type='video/mp4'>
					</video>
				</div>
				<div class="col-lg-6 col-md-12 text-content">
					<h2 class="color-7B5  mb-4">
						<?= get_field( 'special_card_page_intro_title' ) ?>
					</h2>
					<span class="color-C89 d-block mb-4">
						<?= get_field( 'special_card_page_intro_subtitle' ) ?>
					</span>
					<p class="text-justify color-313 mb-4">
						<?= nl2br( get_field( 'special_card_page_description' ) ) ?>
					</p>
					<div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="section section__club">
	<div class="section-wrap">
		<div class="container">
			<h6 class="d-block color-C89 text-center mb-5 font-aviny">
				<?= get_nvm_setting( 'customers_sub_title' ) ?>
			</h6>
			<div class="position-relative">
				<section class="responsive slider club-slider  ">
					<?php foreach ( $special_cards as $special_card ): ?>
						<div class="main-div-slick">
							<div class="club-packages">
								<a href="<?= get_the_permalink( $special_card->ID ) ?>">
									<img src="<?= get_template_directory_uri() ?>/assets/theme/svg/index/club-pic.svg" alt="" class="club-pack">
									<h6 class="discount-text color-C89 ">
										<?= $special_card->meta->special_card_show_tag ?? '' ?>
									</h6>
									<h4 class=" title-package color-C18 mb-4 mt-5">
										<?= $special_card->post_title ?? '' ?>
									</h4>
									<p class="color-7B5 mb-3">
										<?= str_replace( [ '[', ']' ], ['<span>', '</span>'], $special_card->meta->special_card_show_text_1 ?? '' ) ?>
									</p>
									<p class="color-7B5 mb-2">
										<?= str_replace( [ '[', ']' ], ['<span>', '</span>'], $special_card->meta->special_card_show_text_2 ?? '' ) ?>
									</p>
									<span class="view-buy">
										مشاهده و خرید
										<i class="icon-arrow-left af-icons"></i>
									</span>
								</a>
							</div>
						</div>
					<?php endforeach; ?>

				</section>
				<div class="arrows">
					<div class="arrow-right-club">
						<i class="icon-arrow-right af-icons"></i>
					</div>
					<div class="arrow-left-club">
						<i class="icon-arrow-left af-icons"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>