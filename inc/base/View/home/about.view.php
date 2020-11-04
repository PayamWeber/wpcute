<section id="about" class="cs parallax darken_gradient page_about section_padding_top_75 columns_margin_bottom_30">
	<div class="container-fluid">
		<div class="row">
			<?php ob_start(); ?>
			<div class="col-md-6 col-md-<?= ( pmw_get_main_template() == 'tp2' ) ? 'push' : 'pull' ?>-6 text-center img-about-section bottommargin_0">
				<img src="<?= wp_get_attachment_image_url( get_nvm_setting( 'about_image' ), 'full' ) ? : get_template_directory_uri() . '/assets/theme/' . pmw_get_main_template() . '/images/person.png' ?>" class="top-overlap"/>
			</div>
			<?php $person_image_html = ob_get_clean(); ?>
			<?php if ( pmw_get_main_template() == 'tp2' ): ?>
				<?= $person_image_html; ?>
			<?php endif; ?>
			<div class="col-md-6 col-md-<?= ( pmw_get_main_template() == 'tp2' ) ? 'pull' : 'push' ?>-6 text-center dir-rtl">
				<?php if ( $variable = get_nvm_setting( 'about_main_text' ) ): ?>
					<h2 class="section_header"><?= $variable ?></h2>
				<?php endif; ?>
				<br>
				<?php if ( $variable = get_nvm_setting( 'about_desc_text' ) ): ?>
					<p class="fontsize_18"><?= nl2br( $variable ) ?></p>
				<?php endif; ?>
				<?php if ( $variable = get_nvm_setting( 'about_desc_text2' ) ): ?>
					<p class="fontsize_18"><?= nl2br( $variable ) ?></p>
				<?php endif; ?>
				<?php if ( pmw_get_main_template() == 'tp1' ): ?>
					<div class="with_icon topmargin_60">
						<h5 class="small-text text-uppercase inline-block"><?= get_nvm_setting( 'about_doctor_name' ) ?></h5>
						<span class="lightgrey"><?= get_nvm_setting( 'about_doctor_level' ) ?></span>
					</div>
					<?php if ( $variable = get_nvm_setting( 'about_sign_image' ) ): ?>
						<img src="<?= wp_get_attachment_image_url( $variable, 'full' ) ? : get_template_directory_uri() . '/assets/theme/' . pmw_get_main_template() . '/images/signature.png' ?>"/>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php if ( pmw_get_main_template() == 'tp1' ): ?>
				<?= $person_image_html; ?>
			<?php endif; ?>
		</div>
	</div>
</section>