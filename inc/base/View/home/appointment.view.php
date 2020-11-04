<section id="appointment" class="ls" >
	<div class="container-fluid">
		<div class="row d-flex align-center">
			<?php ob_start(); ?>
			<div class="col-lg-5 col-md-5 img-section">
				<img src="<?= wp_get_attachment_image_url( get_nvm_setting( 'appointment_main_image' ), 'large' ) ?>" alt="<?= get_nvm_setting( 'appointment_title' ) ?>">
			</div>
			<?php $person_image_html = ob_get_clean(); ?>
			<?php if ( pmw_get_main_template() == 'tp2' ): ?>
				<?= $person_image_html; ?>
			<?php endif; ?>
			<div class="col-lg-7 col-md-7 text-center text-section">
				<h2><?= get_nvm_setting( 'appointment_title' ) ?></h2>
				<p><?= nl2br( get_nvm_setting( 'appointment_description' ) ) ?></p>
				<?php if ( get_nvm_setting( 'appointment_button_text' ) ): ?>
					<a href="<?= pmw_get_url( get_nvm_setting( 'appointment_button_url' ) ) ?>">
						<?= get_nvm_setting( 'appointment_button_text' ) ?>
					</a>
				<?php endif; ?>
			</div>
			<?php if ( pmw_get_main_template() == 'tp1' ): ?>
				<?= $person_image_html; ?>
			<?php endif; ?>
		</div>
	</div>
</section>