<div class="social-banner social-banner--instagram">
	<div class="social-banner__col">
		<div class="social-banner__content">
			<div class="social-banner__title"><?= str_replace( [ '[', ']' ], [ '<span class="ltr">', '</span>' ], get_field( 'instagram_title', 'option' ) ) ?></div>
			<p class="social-banner__desc"><?= nl2br( get_field( 'instagram_subtitle', 'option' ) ) ?></p>
			<div class="social-banner__preview">
				<div class="insta-slider" data-action="<?= site_url( 'api/instagram' ) ?>">
					<div class="loading loading--white"></div>
					<div class="insta-slider__error">
						<button>
							<svg class="icon icon--refresh">
								<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#refresh-bold"></use>
							</svg>
						</button>
						<span>متاسفانه خطایی رخ داد. لطفا دوباره تلاش کنید.</span>
					</div>
					<div class="swiper-container">
						<div class="swiper-wrapper"></div>
					</div>
				</div>
			</div>
			<a href="https://www.instagram.com/<?= get_field( 'instagram_id', 'option' ) ?>" target="_blank" class="btn btn--w-green">
				<?= get_field( 'instagram_button_text', 'option' ) ?>
			</a>
		</div>
	</div>
	<svg class="social-banner__icon icon">
		<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#instagram"></use>
	</svg>
</div>