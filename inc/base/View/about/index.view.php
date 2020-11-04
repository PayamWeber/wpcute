<?php include_view( 'common.page.caption' ); ?>
<section class="ls section_padding_100 columns_padding_25">
	<div class="container">
		<div class="row img-text-about">
			<div class="col-md-<?= ( pmw_get_main_template() == 'tp2' ) ? '4' : '6' ?> img-about ">
				<img src="<?= wp_get_attachment_image_url( get_field( 'about_page_intro_video_poster' ), 'large' ) ?>"/>
			</div>
			<div class="col-md-<?= ( pmw_get_main_template() == 'tp2' ) ? '8' : '6' ?> dir-rtl">
				<h2 class="section_header"><?= get_field( 'about_page_intro_title' ) ?></h2>
				<hr class="divider_30_1">
				<p class="text-justify"><?= nl2br( get_field( 'about_page_intro_desc' ) ) ?></p>
			</div>
		</div>
	</div>
</section>
<section id="about" class="cs parallax darken_gradient page_about section_padding_top_75 columns_margin_bottom_30">
	<div class="container-fluid">
		<div class="row">
			<?php ob_start(); ?>
			<div class="col-md-6 col-md-<?= ( pmw_get_main_template() == 'tp2' ) ? 'push' : 'pull' ?>-6 text-center img-about-section bottommargin_0">
				<img src="<?= wp_get_attachment_image_url( get_field( 'about_page_intro2_image' ), 'large' ) ?>" class="top-overlap"/>
			</div>
			<?php $person_image_html = ob_get_clean(); ?>
			<?php if ( pmw_get_main_template() == 'tp2' ): ?>
				<?= $person_image_html; ?>
			<?php endif; ?>
			<div class="col-md-6 col-md-<?= ( pmw_get_main_template() == 'tp2' ) ? 'pull' : 'push' ?>-6 text-center dir-rtl">
				<h2 class="section_header"><?= get_field( 'about_page_intro2_title' ) ?></h2>
				<br>
				<p class=" "><?= nl2br( get_field( 'about_page_intro2_desc' ) ) ?></p>
				<p class=""><?= nl2br( get_field( 'about_page_intro2_desc2' ) ) ?></p>
				<?php if ( pmw_get_main_template() == 'tp1' ): ?>
					<div class="with_icon topmargin_60">
						<h5 class="small-text text-uppercase inline-block"><?= nl2br( get_field( 'about_page_intro2_doctor_name' ) ) ?></h5>
						<span class="lightgrey"><?= nl2br( get_field( 'about_page_intro2_doctor_level' ) ) ?></span>
					</div>
					<img src="<?= wp_get_attachment_image_url( get_field( 'about_page_intro2_sign_image' ), 'large' ) ?>"/>
				<?php endif; ?>
			</div>
			<?php if ( pmw_get_main_template() == 'tp1' ): ?>
				<?= $person_image_html; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<section id="services" class="ls section_padding_top_130 section_padding_bottom_100">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2 class="section_header with_icon "><?= get_field( 'about_page_services_title' ) ?></h2>
				<p><?= nl2br( get_field( 'about_page_services_subtitle' ) ) ?></p>
			</div>
		</div>
		<div class="row   d-flex justify-content-center flex-warp">
			<?php if ( $services = get_field( 'about_page_services' ) ): foreach ( $services as $service ): ?>
				<div class="col-md-<?= pmw_get_main_template() == 'tp2' ? '3' : '4' ?>  ">
					<a href="<?= get_the_permalink( $service[ 'about_page_service_post' ] ) ?>" class="card-service">
						<div class="with_padding text-center teaser hover_shadow  shadow-box">
							<img src="<?= wp_get_attachment_image_url( $service[ 'about_page_service_image' ], 'large' ) ?>" alt="<?= $service[ 'about_page_service_title' ] ?>"/>
							<h4><?= $service[ 'about_page_service_title' ] ?></h4>
							<p><?= nl2br( $service[ 'about_page_service_description' ] ) ?></p>
						</div>
					</a>
				</div>
			<?php endforeach; endif; ?>
		</div>
	</div>
</section>
