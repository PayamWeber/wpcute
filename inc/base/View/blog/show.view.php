<?php if ( pmw_get_main_template() == 'tp1' ): ?>
	<?php while ( have_posts() ): the_post(); ?>
		<?php if ( ( $post->meta->visual_type ?? \PMW\Post::TYPE_DEFAULT ) == \PMW\Post::TYPE_VIDEO ): ?>
			<section class="ls ms">
				<div class="container">
					<div class="row columns_padding_0">
						<div class="col-sm-10 col-sm-push-1">
							<div class="embed-responsive embed-responsive-3by2">
								<a href="<?= $post->meta->post_video_url ?? '' ?>" class="embed-placeholder">
									<img src="<?= wp_get_attachment_image_url( get_field( 'large_image' ), 'large' ) ?>" alt="<?= $post->post_title ?>" class="w-100">
								</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>
		<section class="ls section_padding_top_130 section_padding_bottom_130 columns_padding_25">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-push-1">
						<div class="vertical-item content-padding with_shadow">
							<?php if ( ( $post->meta->visual_type ?? \PMW\Post::TYPE_DEFAULT ) == \PMW\Post::TYPE_DEFAULT ): ?>
								<div class="entry-thumbnail item-media blog-title-pic">
									<img src="<?= wp_get_attachment_image_url( get_field( 'large_image' ), 'large' ) ?>" style="height: auto" alt="<?= $post->post_title ?>">
								</div>
							<?php endif; ?>
							<div class="item-content dir-rtl">
								<header class="entry-header">
									<!-- .entry-meta -->
									<div class="entry-date small-text highlight">
										<a href="" rel="bookmark">
											<time class="entry-date">
												<?= get_the_time( 'd M Y', $post->post_object ) ?>
											</time>
										</a>
									</div>
									<h1 class="entry-title">
										<a href="" rel="bookmark"><?= $post->post_title ?></a>
									</h1>
									<hr class="divider_30_1">
								</header>
								<!-- .entry-header -->
								<div class="entry-content">
									<?php the_content(); ?>
								</div>
								<!-- .entry-content -->
								<!--							<div class="author-meta side-item content-padding">-->
								<!--								<div class="row display_table_md">-->
								<!--									<div class="col-md-4 display_table_cell_md">-->
								<!--										<div class="item-media">-->
								<!--											<img src="images/s-5.jpg" alt="">-->
								<!--										</div>-->
								<!--									</div>-->
								<!--									<div class="col-md-8 display_table_cell_md">-->
								<!--										<div class="item-content">-->
								<!--											<p>-->
								<!--												اصول بهداشتی، شستشوی مداوم دست‌ها، رعایت فاصله گذاری بین افراد می‌شود؛-->
								<!--												ممکن است این امر در برخی افراد به ویژه افرادی که زمینه اختلالات اضطراب و-->
								<!--												وسواس را دارا هستند، باعث بروز وسواس و یا تشدید اضطراب و ترس ر در افراد-->
								<!--												دارای این علائم شود.-->
								<!--											</p>-->
								<!--										</div>-->
								<!--									</div>-->
								<!--								</div>-->
								<!--							</div>-->
								<?php comments_template(); ?>
							</div>
						</div>
					</div>
					<!--eof .col-sm-8 (main content)-->
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php else: ?>
	<?php while ( have_posts() ): the_post(); ?>
		<?php if ( ( $post->meta->visual_type ?? \PMW\Post::TYPE_DEFAULT ) == \PMW\Post::TYPE_VIDEO ): ?>
			<section class="ls ms">
				<div class="container">
					<div class="row columns_padding_0">
						<div class="col-sm-10 col-sm-push-1">
							<div class="embed-responsive embed-responsive-3by2">
								<a href="<?= $post->meta->post_video_url ?? '' ?>" class="embed-placeholder">
									<img src="<?= wp_get_attachment_image_url( get_field( 'large_image' ), 'large' ) ?>" alt="<?= $post->post_title ?>" class="w-100">
								</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>
		<section class="ls section_padding_top_130 section_padding_bottom_130 columns_padding_25">
			<div class="container">
				<div class="row">
					<div class="col-sm-7 col-md-8">
						<div class="vertical-item content-padding with_shadow">
							<?php if ( ( $post->meta->visual_type ?? \PMW\Post::TYPE_DEFAULT ) == \PMW\Post::TYPE_DEFAULT ): ?>
								<div class="entry-thumbnail item-media blog-title-pic">
									<img src="<?= wp_get_attachment_image_url( get_field( 'large_image' ), 'large' ) ?>" style="height: auto" alt="<?= $post->post_title ?>">
								</div>
							<?php endif; ?>
							<div class="item-content dir-rtl">
								<header class="entry-header">
									<!-- .entry-meta -->
									<div class="entry-date small-text highlight">
										<a href="" rel="bookmark">
											<time class="entry-date">
												<?= get_the_time( 'd M Y', $post->post_object ) ?>
											</time>
										</a>
									</div>
									<h1 class="entry-title">
										<a href="" rel="bookmark"><?= $post->post_title ?></a>
									</h1>
									<hr class="divider_30_1">
								</header>
								<!-- .entry-header -->
								<div class="entry-content">
									<?php the_content(); ?>
								</div>
								<!-- .entry-content -->
								<!--							<div class="author-meta side-item content-padding">-->
								<!--								<div class="row display_table_md">-->
								<!--									<div class="col-md-4 display_table_cell_md">-->
								<!--										<div class="item-media">-->
								<!--											<img src="images/s-5.jpg" alt="">-->
								<!--										</div>-->
								<!--									</div>-->
								<!--									<div class="col-md-8 display_table_cell_md">-->
								<!--										<div class="item-content">-->
								<!--											<p>-->
								<!--												اصول بهداشتی، شستشوی مداوم دست‌ها، رعایت فاصله گذاری بین افراد می‌شود؛-->
								<!--												ممکن است این امر در برخی افراد به ویژه افرادی که زمینه اختلالات اضطراب و-->
								<!--												وسواس را دارا هستند، باعث بروز وسواس و یا تشدید اضطراب و ترس ر در افراد-->
								<!--												دارای این علائم شود.-->
								<!--											</p>-->
								<!--										</div>-->
								<!--									</div>-->
								<!--								</div>-->
								<!--							</div>-->
								<?php comments_template(); ?>
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
						<?php if ( $most_viewed ): ?>
							<div class="widget widget_recent_posts">
								<h3 class="widget-title">مقالات پربازدید</h3>
								<ul>
									<?php foreach ( $most_viewed as $most_viewed_post ): ?>
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