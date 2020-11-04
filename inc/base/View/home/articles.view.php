<section class="ls section_padding_top_130 section_padding_bottom_100 columns_margin_top_0 columns_margin_bottom_30">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h2 class="section_header with_icon"><?= get_nvm_setting( 'articles_main_text' ) ?></h2>
				<p><?= get_nvm_setting( 'articles_desc_text' ) ?></p>
			</div>
		</div>
		<div class="row">
			<?php if ( $articles ): ?>
				<?php foreach ( $articles as $article ): ?>
					<div class="col-md-4 text-center">
						<a href="<?= get_the_permalink( $article->post_object ) ?>">
							<article class="vertical-item content-padding post format-standard with_shadow">
								<div class="item-media entry-thumbnail">
									<img src="<?= get_the_post_thumbnail_url( $article->post_object, 'pmw-medium' ) ?>" alt="<?= $article->post_title ?>">
								</div>
								<div class="item-content entry-content">
									<header class="entry-header">
										<h4 class="entry-title">
											<?= $article->post_title ?>
										</h4>
										<hr class="divider_30_1">
									</header>
									<!-- .entry-header -->
									<p class="bottommargin_40 "><?= mb_substr( strip_tags( get_the_excerpt( $article->post_object ) ), 0, 100 ) ?>...</p>
									<span class="theme_button color1">ادامه مطلب</span>
								</div>
								<!-- .item-content.entry-content -->
							</article>
						</a>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>