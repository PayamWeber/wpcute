<?php include_view( 'common.page.caption' ); ?>
<?php if ( pmw_get_main_template() == 'tp1' ): ?>
	<?php while ( have_posts() ): the_post(); ?>
		<section class="ls section_padding_top_130 section_padding_bottom_130">
			<div class="container">
				<div class="row d-flex single-service-content">
					<div class="col-lg-8  col-md-12 dir-rtl">
						<h2 class="section_header small"><?php the_title() ?></h2>
						<hr class="divider_30_1">
						<?php the_content(); ?>
					</div>
					<div class="col-lg-4   single-service-img ">
						<img src="<?= wp_get_attachment_image_url( get_field('service_single_image'), 'pmw-medium' ) ?>" alt="<?php the_title() ?>"/>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php else: ?>
	<?php while ( have_posts() ): the_post(); ?>
		<section class="ls section_padding_top_130 section_padding_bottom_130 columns_padding_25">
			<div class="container">
				<div class="row">
					<div class="col-sm-7 col-md-8">
						<div class="vertical-item content-padding with_shadow">
							<div class="entry-thumbnail item-media blog-title-pic">
								<img src="<?= wp_get_attachment_image_url( get_field('service_single_image'), 'pmw-medium' ) ?>" style="height: auto" alt="<?= get_the_title() ?>">
							</div>
							<div class="item-content dir-rtl">
								<header class="entry-header">
									<!-- .entry-meta -->
									<h1 class="entry-title">
										<?= get_the_title() ?>
									</h1>
									<hr class="divider_30_1">
								</header>
								<!-- .entry-header -->
								<div class="entry-content">
									<?php the_content(); ?>
								</div>
							</div>
						</div>
					</div>
					<aside class="col-sm-5 col-md-4">
						<div class="widget widget_mailchimp">
							<h3 class="widget-title">جستجو در سایت</h3>
							<form class=" form-inline" action="<?= site_url( 'blog' ) ?>" method="get">
								<div class="form-group">
									<input name="search" type="text" class="form-control" placeholder="جستجو">
								</div>
								<button type="submit" class="theme_button">جستجو</button>
								<div class="response"></div>
							</form>
						</div>
						<div class="widget widget_apsc_widget">
							<h3 class="widget-title">با ما در ارتباط باشید</h3>
							<div class="apsc-icons-wrapper clearfix apsc-theme-4">
								<div class="apsc-each-profile">
									<a class="apsc-instagram-icon clearfix" href="<?= get_nvm_setting( 'instagram_url', '' ) ?>">
										<div class="apsc-inner-block">
											<span class="social-icon">
												<i class="apsc-instagram fa fa-instagram"></i>
												<span class="media-name">Instagram</span>
											</span>
										</div>
									</a>
								</div>
								<div class="apsc-each-profile">
									<a class="apsc-twitter-icon clearfix" href="<?= get_nvm_setting( 'telegram_url', '' ) ?>">
										<div class="apsc-inner-block">
											<span class="social-icon">
												<i class="apsc-twitter-icon fa fa-paper-plane"></i>
												<span class="media-name">Telegram</span>
											</span>
										</div>
									</a>
								</div>
							</div>
						</div>
						<?php if ( $services ): ?>
							<div class="widget widget_recent_posts">
								<h3 class="widget-title">خدمات ما</h3>
								<ul>
									<?php foreach ( $services as $most_viewed_post ): ?>
										<li>
											<h4>
												<a href="<?= get_the_permalink( $most_viewed_post->post_object ) ?>"><?= $most_viewed_post->post_title ?></a>
											</h4>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
					</aside>
					<!--eof .col-sm-8 (main content)-->
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>
