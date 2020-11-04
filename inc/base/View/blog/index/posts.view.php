<?php

use PMW\ExternalPost;
use PMW\Post;

?>
<?php if ( pmw_get_main_template() == 'tp1' ): ?>
	<section class="ls page_portfolio section_padding_top_100 section_padding_bottom_75">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="isotope_container isotope row masonry-layout columns_bottom_margin_30">
						<?php if ( $posts ): ?>
							<?php foreach ( $posts->posts as $_post ): ?>
								<?php
								$post  = Post::find( $_post );
								$image = get_the_post_thumbnail_url( $_post, 'medium' );
								$title = $post->post_title;
								$date  = get_the_time( 'M Y', $_post );
								$url   = get_the_permalink( $_post );
								?>
								<div class="col-md-4 text-center">
									<a href="<?= $url ?>">
										<article class="vertical-item content-padding post format-standard with_shadow">
											<div class="item-media entry-thumbnail">
												<img src="<?= $image ?>" alt="">
											</div>
											<div class="item-content entry-content">
												<header class="entry-header">
													<h4 class="entry-title">
														<?= $title ?>
													</h4>
													<hr class="divider_30_1">
												</header>
												<!-- .entry-header -->
												<p class="bottommargin_40 "><?= mb_substr( strip_tags( get_the_excerpt( $post->post_object ) ), 0, 100 ) ?>
													...</p>
												<span class="theme_button color1">ادامه مطلب</span>
											</div>
											<!-- .item-content.entry-content -->
										</article>
									</a>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<div class="row topmargin_20">
						<div class="col-sm-12 text-center">
							<ul class="pagination">
								<?php
								$base_url = is_page() ? ConfigHelper::get( 'url.blog' ) : get_term_link( get_queried_object_id() );
								pmw_special_pagination( $posts->max_num_pages, 'page_number', $base_url, 4 ); ?>
							</ul>
						</div>
					</div>
					<!-- eof .isotope_container.row -->
					<!--				<div class="row">-->
					<!--					<div class="col-sm-12 text-center">-->
					<!--						<i class="fa fa-circle-o-notch fa-spin loadmore_spinner"></i>-->
					<!--					</div>-->
					<!--				</div>-->
				</div>
			</div>
		</div>
	</section>
<?php else: ?>
	<section class="ls page_portfolio section_padding_top_100 section_padding_bottom_75">
		<div class="container">
			<div class="row columns_padding_25">
				<div class="col-sm-7 col-md-8">
					<?php if ( $posts ): ?>
						<?php foreach ( $posts->posts as $_post ): ?>
							<?php
							$post  = Post::find( $_post );
							$image = get_the_post_thumbnail_url( $_post, 'medium' );
							$title = $post->post_title;
							$date  = get_the_time( 'M Y', $_post );
							$url   = get_the_permalink( $_post );
							?>
							<article class="post side-item content-padding with_shadow">
								<div class="row">
									<div class="col-md-7">
										<div class="item-content dir-rtl">
											<a href="<?= $url ?>">
												<h3>
													<?= $title ?>
												</h3>
												<p class="item-meta grey darklinks content-justify fontsize_16">
													<span>
														<i class="fa fa-calendar highlight"></i>
														<?= $date ?>
													</span>
												</p>
												<p class="text-justify"><?= mb_substr( strip_tags( get_the_excerpt( $post->post_object ) ), 0, 120 ) ?>
													...</p>
											</a>
										</div>
									</div>
									<div class="col-md-5">
										<div class="item-media">
											<img src="<?= $image ?>" alt="<?= $title ?>" class="img-event">
											<div class="media-links">
												<a class="abs-link" href="<?= $url ?>"></a>
											</div>
										</div>
									</div>
								</div>
							</article>
						<?php endforeach; ?>
					<?php endif; ?>
					<div class="isotope_container isotope row masonry-layout columns_bottom_margin_30">
					</div>
					<div class="row topmargin_20">
						<div class="col-sm-12 text-center">
							<ul class="pagination">
								<?php
								$base_url = is_page() ? ConfigHelper::get( 'url.blog' ) : get_term_link( get_queried_object_id() );
								pmw_special_pagination( $posts->max_num_pages, 'page_number', $base_url, 4 ); ?>
							</ul>
						</div>
					</div>
					<!-- eof .isotope_container.row -->
					<!--				<div class="row">-->
					<!--					<div class="col-sm-12 text-center">-->
					<!--						<i class="fa fa-circle-o-notch fa-spin loadmore_spinner"></i>-->
					<!--					</div>-->
					<!--				</div>-->
				</div>
				<aside class="col-sm-5 col-md-4">
					<div class="widget widget_mailchimp">
						<h3 class="widget-title">جستجو در سایت</h3>
						<form class=" form-inline" action="./" method="get">
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
			</div>
		</div>
	</section>
<?php endif; ?>