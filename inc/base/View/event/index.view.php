<?php include_view( 'common.page.caption' ); ?>
<section class="ls section_padding_top_100 section_padding_bottom_100 columns_padding_25">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-push-1">
				<?php if ( $posts ): ?>
					<?php foreach ( $posts->posts as $_post ): ?>
						<?php
						$post  = \PMW\Event::find( $_post );
						$image = get_the_post_thumbnail_url( $_post, 'medium' );
						$title = $post->post_title;
						$date  = get_the_time( 'd M Y', $_post );
						$url   = get_the_permalink( $_post );
						?>
						<article class="post side-item content-padding with_shadow">
							<div class="row">
								<div class="col-md-5">
									<div class="item-media">
										<img src="<?= $image ?>" alt="<?= $title ?>" class="img-event">
										<div class="media-links">
											<a class="abs-link" href="<?= $url ?>"></a>
										</div>
									</div>
								</div>
								<div class="col-md-7">
									<div class="item-content dir-rtl">
										<a href="<?= $url ?>">
											<h3>
												<?= $title ?>
											</h3>
											<p class="item-meta grey darklinks content-justify fontsize_16">
												<span>
													<i class="fa fa-map-marker highlight"></i>
													<?= $post->meta->event_location ?? '' ?>
												</span>
												<span>
													<i class="fa fa-calendar highlight"></i>
													<?= $date ?>
												</span>
											</p>
											<p class="text-justify"><?= mb_substr( strip_tags( get_the_excerpt( $post->post_object ) ), 0, 120 ) ?>...</p>
										</a>
									</div>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				<?php endif; ?>
				<div class="row topmargin_20">
					<div class="col-sm-12 text-center">
						<ul class="pagination">
							<?php
							$base_url = is_page() ? ConfigHelper::get( 'url.blog' ) : get_term_link( get_queried_object_id() );
							pmw_special_pagination( $posts->max_num_pages, 'page_number', $base_url, 4 ); ?>
						</ul>
					</div>
				</div>
			</div>
			<!--eof .col-sm-* (main content)-->
		</div>
	</div>
</section>