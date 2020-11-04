<div class="section support-section bg-grd-green">
	<div class="section-wrap">
		<div class="section-header">
			<img class="mb-30" src="<?= ConfigHelper::get('media') ?>support/envelope.svg" alt="آیکن پشتیبانی">
			<p class="section-title h4 white"><?= get_field( 'contact_us_section_title', 'option' ) ?></p>
			<p class="section-subtitle white"><?= get_field( 'contact_us_section_subtitle', 'option' ) ?></p>
		</div>
		<div class="section-footer">
			<button data-helpOpen class="btn btn--xlg"><?= get_field( 'contact_us_section_button_text', 'option' ) ?></button>
		</div>
	</div>
</div>