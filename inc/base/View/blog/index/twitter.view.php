<?php
/** decode data from json */
$dataPath = ConfigHelper::get( 'themeUrl' ) . '/pages/data/blog/twitter-slider.json';
$data     = getJSONData( $dataPath );
$data     = json_decode( $data, true );
$data     = $data[ "slides" ];
?>
<div class="social-banner social-banner--twitter">
	<div class="social-banner__col">
		<div class="social-banner__content">
			<div class="social-banner__title">با هشتگ
				<span class="ltr">#SNOWA</span>
			</div>
			<p class="social-banner__desc">عکس‌های خود را به اشتراک بگذارید…</p>
			<div class="social-banner__preview">
				<div class="twitter-slider">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php foreach ( $data as $slide ) { ?>
								<div class="swiper-slide">
									<div class="twitter-slide">
										<div class="twitter-slide__inner">
											<div class="twitter-slide__user">
												<div class="twitter-slide__avatar" style="background-image: url('<?= ConfigHelper::get( 'media' ) ?>blog/avatar.jpg')"></div>
												<div>
													<p class="twitter-slide__name">AHMAD</p>
													<p class="twitter-slide__email">@mr.ahmad75</p>
												</div>
											</div>
											<div class="twitter-slide__text">
												ما که از محصولات آبسال، فیلور، پارس خزر، پاکشوما هفت ساله
												استفاده می‌کنیم و دوستام هم که اسنوا و دونار استفاده می کنن
												راضین یه بار هم خراب نشدن…
											</div>
											<div class="twitter-slide__details">
												<div class="twitter-slide__info">
													<span>3289</span>
													<svg class="icon icon--heart">
														<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#heart"></use>
													</svg>
												</div>
												<div class="twitter-slide__info">
													<span>7</span>
													<svg class="icon icon--retweet">
														<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#retweet"></use>
													</svg>
												</div>
												<div class="twitter-slide__info">
													<span>9</span>
													<svg class="icon icon--comment">
														<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#comment"></use>
													</svg>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
				</div>
			</div>
			<button class="btn btn--w-blue">مشاهده در توییتر</button>
		</div>
		<svg class="social-banner__icon icon">
			<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#twitter"></use>
		</svg>
	</div>
</div>