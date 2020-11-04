<section id="services" class="ls section_padding_top_130 section_padding_bottom_100">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2 class="section_header with_icon "><?= get_nvm_setting( 'services_first_title' ) ?></h2>
				<p class="text-center"><?= nl2br( get_nvm_setting( 'services_sub_title' ) ) ?></p>
			</div>
		</div>
		<div class="row   d-flex justify-content-center flex-warp">
			<?php $social_links = get_nvm_setting( 'services' ); ?>
			<?php if ( $social_links && is_array( $social_links ) && isset( $social_links[ 'title' ] ) ): ?>
				<?php foreach ( $social_links[ 'title' ] as $key => $value ): ?>
					<div class="col-md-<?= pmw_get_main_template() == 'tp2' ? '3' : '4' ?> ">
						<a href="<?= pmw_get_url( $social_links[ 'url' ][ $key ] ?? '' ) ?>">
							<div class="with_padding text-center teaser hover_shadow  shadow-box">
								<img src="<?= wp_get_attachment_image_url( $social_links[ 'image' ][ $key ] ?? '' ) ?>" alt=""/>
								<h4>
									<?= $social_links[ 'title' ][ $key ] ?? '' ?>
								</h4>
								<?php if ( $_descc = $social_links[ 'desc' ][ $key ] ?? '' ): ?>
									<p><?= nl2br( $_descc ) ?></p>
								<?php endif; ?>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<?php if ( pmw_get_main_template() == 'tp2' ): ?>
			<div class="text-center">
				<a href="<?= pmw_get_url( get_nvm_setting( 'services_home_button_url' ) ) ?>" class="theme_button color1"><?= get_nvm_setting( 'services_home_button_text', 'ادامه' ) ?></a>
			</div>
		<?php endif; ?>
	</div>
</section>
