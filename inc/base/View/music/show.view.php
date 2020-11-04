<?php while ( have_posts() ): the_post(); ?>
	<section class="section section_first">
		<div class="container">
			<div class="row row-flex os">
				<div class="col-sm-auto col-lg-5">
					<div class="block-image">
						<div class="reveal reveal--img">
							<!--<img src="<?= get_the_post_thumbnail_url( $music->ID, 'large' ) ?>" alt="<?= $music->post_title ?>">-->
							<div class="music-player">
								<div class="cover">
									<img src="<?= get_the_post_thumbnail_url( $music->ID, 'large' ) ?>" alt="<?= $music->post_title ?>">
								</div>
								<div class="titre">
								</div>
								<div class="lecteur">
									<audio controls style="width: 100%;" class="fc-media">
										<source src="<?= $music->meta->music_file_url ?>" type="audio/mpeg"/>
									</audio>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-7">
					<div class="col-about__describe col-about__describe_right">
						<!--					<h6 class="title__h6 title__overhead">About Us</h6>-->
						<h2 class="title title__h2 title__section title_normal music__title"><?= $music->post_title ?></h2>
						<!--<audio controls class="music-player">
						<source src="<?= $music->meta->music_file_url ?>" type="audio/mpeg">
						Your browser does not support the audio element.
					</audio>-->
						<p class="block-description block-description_two-column music-spec">
							<?php if ( $music->meta->lyrics ): ?>
								<strong>LYRICS: </strong>
								<site><?= $music->meta->lyrics ?></site><br>
							<?php endif; ?>
							<?php if ( $music->meta->arrangement ): ?>
								<strong>ARRANGEMENT: </strong>
								<site><?= $music->meta->arrangement ?></site><br>
							<?php endif; ?>
							<?php if ( $music->meta->mix_mastering ): ?>
								<strong>MIX & MASTERING: </strong>
								<site><?= $music->meta->mix_mastering ?></site><br>
							<?php endif; ?>
							<?php if ( $music->meta->guitar ): ?>
								<strong>GUITAR: </strong>
								<site><?= $music->meta->guitar ?></site><br>
							<?php endif; ?>
							<?php if ( $music->meta->producer ): ?>
								<strong>PRODUCER: </strong>
								<site><?= $music->meta->producer ?></site><br>
							<?php endif; ?>
							<?php if ( $music->meta->cover_art ): ?>
								<strong>COVER: </strong>
								<site><?= $music->meta->cover_art ?></site>
							<?php endif; ?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="text-decoration text-decoration_bottom" data-100-start="transform[swing]:translateY(100px)" data--800-top="transform[swing]:translateY(-100px)">
			Music
		</div>
	</section>
	<section class="section news-singel">
		<div class="container">
			<!-- Post -->
			<article class="item-news item-news__main">
				<div class="item-news__paragraph">
					<?php the_content() ?>
					<footer class="item-news__footer">
						<div class="share-post">
							<a href="https://www.facebook.com/dialog/share?href=<?php the_permalink() ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i>
								<span>Facebook</span>
							</a>
							<a href="https://twitter.com/intent/tweet?url=<?php the_permalink() ?>&text=<?= $music->post_title ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i>
								<span>Twitter</span>
							</a>
							<a href="https://telegram.me/share/url?url=<?php the_permalink() ?>&text=<?= $music->post_title ?>" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i>
								<span>Telegram</span>
							</a>
							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?= $music->post_title ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i>
								<span>Linkedin</span>
							</a>
						</div>
					</footer>
				</div>
			</article>
			<!-- /Post -->
		</div>
	</section>
<?php endwhile; ?>