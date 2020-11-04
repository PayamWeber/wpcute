<?php include_view( 'common.page.caption' ); ?>
<section id="services" class="ls section_padding_top_130 section_padding_bottom_100">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2 class="section_header with_icon "><?= get_field( 'services_page_intro_title' ) ?></h2>
				<p><?= nl2br( get_field( 'services_page_intro_subtitle' ) ) ?></p>
			</div>
		</div>
		<div class="row   d-flex justify-content-center flex-warp">
			<?php if ( $posts ): ?>
				<?php foreach ( $posts as $post ): ?>
					<div class="col-md-<?= pmw_get_main_template() == 'tp2' ? '3' : '4' ?>  ">
						<a href="<?= get_the_permalink( $post->post_object ) ?>" class="card-service">
							<div class="with_padding text-center teaser hover_shadow  shadow-box">
								<img src="<?= get_the_post_thumbnail_url( $post->post_object, 'medium' ) ?>" alt=""/>
								<h4>
									<?= $post->post_title ?>
								</h4>
								<?php if ( pmw_get_main_template() == 'tp1' ): ?>
									<p><?= mb_substr( strip_tags( get_the_excerpt( $post->post_object ) ), 0, 120 ) ?>
										...</p>
								<?php endif; ?>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>