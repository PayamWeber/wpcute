<div class="section section__intro">
    <div class="section-wrap">
        <div class="container-fluid p-0 slider-section-container">
			<?php if ( $slider ): ?>
				<?= $slider; ?>
			<?php else: ?>
				<img src="<?= get_template_directory_uri() ?>/assets/theme/images/index/slider-section.jpg" alt=""  class="w-100">
			<?php endif; ?>
        </div>
    </div>
</div>