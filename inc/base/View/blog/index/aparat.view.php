<?php if ( $aparat_videos ): ?>
	<section class="section">
		<div class="section-wrap">
			<header class="section-header">
				<h3 class="section-title"><?= get_field( 'aparat_title', 'option' ) ?></h3>
				<p class="section-subtitle"><?= get_field( 'aparat_subtitle', 'option' ) ?></p>
			</header>
			<div class="section-body">
				<div class="aparat">
					<div class="aparat-header">
						<div class="aparat-logo">
							<img src="<?= ConfigHelper::get( 'images' ) ?>logo.svg" alt="">
							<span>اسنوا</span>
						</div>
						<a href="<?= 'https://www.aparat.com/' . $aparat_uid ?>" target="_blank" class="aparat-archive">
							<span>نمایش همه</span>
							<svg>
								<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#arrow-left"></use>
							</svg>
						</a>
					</div>
					<div class="row row--10-50">
						<?php foreach ( $aparat_videos as $video ): $video = (object) $video; ?>
							<div class="col-xs-24 col-sm-12 col-md-8">
								<a class="card-aparat" href="<?= 'https://www.aparat.com/v/' . $video->uid ?>" target="_blank">
									<div class="card-aparat__img">
										<img src="<?= $video->small_poster ?>" alt="<?= $video->title ?>">
										<div class="card-aparat__cover"
											 style="background-image: url('<?= $video->small_poster ?>')"></div>
										<button class="card-aparat__play">
											<svg class="icon icon--play">
												<use xlink:href="<?= ConfigHelper::get('sprite') ?>#play"></use>
											</svg>
										</button>
									</div>
									<div class="card-aparat__title"><?= $video->title ?></div>
									<div class="card-aparat__info">
										<span><?= $video->visit_cnt ?> بازدید -</span>
										<time datetime="<?= $video->create_date ?>"><?= $video->sdate ?></time>
									</div>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="section-footer">
				<a href="<?= 'https://www.aparat.com/' . $aparat_uid ?>" target="_blank" class="btn btn--pink btn--xlg">
					<?= get_field( 'aparat_button_text', 'option' ) ?>
				</a>
			</div>
		</div>
	</section>
<?php endif; ?>