<?php while ( have_posts() ): the_post(); ?>
	<main>
		<div class="section bg-grd-blue">
			<div class="section-wrap">
				<div class="row row--flex">
					<div class="col-xs-24 col-md-10">
						<article class="login">
							<div class="login-wrap">
								<h1 class="login-title"><?= the_title() ?></h1>
								<div class="input">
									<input type="text" placeholder="نام کاربری و یا شماره تلفن همراه">
									<a class="login-link" href="">نام کاربری ندارید؟</a>
								</div>
								<div class="input">
									<input type="text" placeholder="کلمه عبور">
									<a class="login-link" href="">کلمه عبور خود را فراموش کرده ام</a>
								</div>
								<div class="checkbox">
									<input type="checkbox">
									<i></i>
									<span>مرا به خاطر بسپار</span>
								</div>
								<div class="login-captcha">
									<img src="<?= ConfigHelper::get('media') ?>customers/captcha.jpg" alt="">
									<button>
										<svg class="icon icon--refresh">
											<use xlink:href="<?= ConfigHelper::get('sprite') ?>#refresh"></use>
										</svg>
									</button>
								</div>
								<div class="input">
									<input type="text" placeholder="اعداد درون تصویر فوق">
								</div>
								<div class="login-btns">
									<button class="btn btn--md btn--solid-blue btn--full" title="btn .btn--md .btn--wide">
										ورود
									</button>
									<button class="btn btn--md btn--green btn--full" title="btn .btn--md .btn--wide">ثبت
										نام
									</button>
								</div>
							</div>
						</article>
					</div>
					<div class="col-xs-24 col-md-14">
						<article class="customers">
							<?php if ( get_field( 'subtitle' ) ): ?>
								<h2 class="customers-title"><?= get_field( 'subtitle' ) ?></h2>
							<?php endif; ?>
							<?php if ( $cards = get_field( 'cards' ) ): ?>
								<div class="row row--10 row--flex">
									<?php foreach ( $cards as $card ): ?>
										<section class="col-xs-24 col-sm-12">
											<div class="card-customers">
												<div class="card-customers__wrap">
													<img class="card-customers__image" src="<?= wp_get_attachment_image_url( $card['image'] ) ?>" alt="">
													<h3 class="card-customers__title"><?= $card['title'] ?></h3>
													<div class="card-customers__text"><?= $card['subtitle'] ?></div>
												</div>
											</div>
										</section>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<div class="customers-hr"></div>
							<p class="customers-subtitle"><?= nl2br( get_field( 'text1' ) ) ?></p>
							<div class="customers-text">
								<?= $text2 ?>
							</div>
						</article>
					</div>
				</div>
			</div>
		</div>
	</main>
<?php endwhile; ?>