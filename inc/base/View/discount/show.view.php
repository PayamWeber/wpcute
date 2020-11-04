<?php while ( have_posts() ): the_post(); ?>
	<div class="section section__about-content-P-details">
		<div class="section-01-head-pages">
			<div class="section-wrap">
				<div class="container-fluid">
					<div class="row justify-content-center align-items-center">
						<div class="col-lg-5 img-video-content">
							<video id="my-video" class="video-js" controls poster="<?= wp_get_attachment_image_url( get_field( 'discount_single_intro_video_poster' ), 'large' ) ?>" data-setup='' loop>
								<source src="<?= get_field( 'discount_single_intro_video_url' ) ?>" type='video/mp4'>
							</video>
						</div>
						<div class="col-lg-6 col-md-12 text-content">
							<h2 class="color-7B5  mb-4">
								<?= get_field( 'discount_single_intro_title' ) ?>
							</h2>
							<span class="color-C89 d-block mb-4">
								<?= get_field( 'discount_single_intro_subtitle' ) ?>
							</span>
							<p class="text-justify color-313 mb-4">
								<?= nl2br( get_field( 'discount_single_description' ) ) ?>
							</p>
							<div class="items-about">
								<?php if ( $features = get_field( 'discount_single_discount_features' ) ): ?>
									<?php foreach ( $features as $key => $feature ): $n = $key + 1; ?>
										<?= ( ! pmw_is_even( $n ) ) ? '<div class="d-flex row-items  justify-content-around">' : '' ?>
										<p class="mb-3 text-center color-7B5">
											<img src="<?= get_template_directory_uri() ?>/assets/theme/svg/icons/tick.svg" alt="" class=" ">
											<?= $feature['title'] ?>
										</p>
										<?= ( pmw_is_even( $n ) || $n == count( $features ) ) ? '</div>' : '' ?>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section-02">
			<div class="section-wrap">
				<div class="container-fluid">
					<div class="row justify-content-center align-items-center">
						<div class="col-lg-12 col-md-12 text-content text-center">
							<h2 class="color-7B5  mb-4">
								فرم دریافت این تخفیف
							</h2>
							<span class="color-C89 d-block mb-4">
								ما با دریافت فرم تکمیل شده توسط شما قادر به تماس و ارائه نوبت در زمان دلخواه شما خواهیم
								بود
							</span>
						</div>
						<div class="col-lg-6  col-md-12 text-center form-content  mt-4  ">
							<form action="">
								<div class="d-flex row-items-form">
									<div class="input-content mb-4">
										<label for="username" class="color-7B5 mb-2">
											نام کامل شما:
										</label>
										<input class="form-control" id="username" type="text" placeholder="نام و نام خانوادگی خود را وارد کنید">
									</div>
									<div class="input-content mb-4">
										<label for="mobile-number" class="color-7B5 mb-2">
											شماره موبایل:
										</label>
										<input class="form-control" id="mobile-number" type="number" placeholder="شماره موبایل خود را وارد کنید">
									</div>
								</div>
								<div class="d-flex row-items-form">
									<div class="input-content mb-4">
										<label for="" class="color-7B5 mb-2">
											جنسیت:
										</label>
										<select class="browser-default custom-select  select-gender" id="gender">
											<option selected disabled>جنسیت خود را انتخاب</option>
											<option value="1">خانم</option>
											<option value="2">آقا</option>
										</select>
									</div>
									<div class="input-content mb-4">
										<label for="" class="color-7B5 mb-2">
											شهر:
										</label>
										<input class="form-control" id="city" type="text" placeholder="شهر خود را وارد کنید">
									</div>
								</div>
								<div class="d-flex row-items-form">
									<div class="input-content mb-4">
										<label for="name" class="mb-2 text-right color-7B5">
											<img id="captcha-image" src="<?= site_url( 'api/captcha' ) ?>" alt="">
											<span onclick="$('#captcha-image').attr('src', '<?= site_url() ?>/api/captcha?' + Math.random() )" class="captcha-reload"></span>
										</label>
										<input class="form-control" id="captcha" type="text" placeholder="اعداد درون تصویر را وارد کنید">
									</div>
								</div>
								<p class="success-text" style="display:none;">
									<img src="<?= get_template_directory_uri() ?>/assets/theme/svg/icons/green-tick.svg" alt="" class="">
									تبریک! ثبت نام شما برای پکیج ویژه جوانسازی پوست با موفقیت انجام شد. کارشناسان ما به
									زودی با شما تماس می‌گیرند تا این سرویس فوق‌العاده را تجربه کنید
								</p>
								<div class="alert alert-danger" style="display: none"></div>
								<input type="hidden" id="special-id" value="<?= get_the_ID() ?>">
								<button class="btn-style-01 mt-4 btn-send-discount-request">
									ثبت نام
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>
<?php add_action( 'theme_view_scripts', function () {
	?>
	<script>
        var is_loading = false;
        $( document ).ready( function () {
            $('form').submit(function(){
                return false;
            })
            $( '.btn-send-discount-request' ).click( function () {
                var _self = $(this);
                if ( is_loading === false ) {
                    is_loading = true;
                    _self.text( 'لطفا صبر کنید...' );
                    send_post_api( '<?= site_url( 'api/discount_request' ) ?>', {
                        'captcha': $( '#captcha' ).val(),
                        'mobile': $( '#mobile-number' ).val(),
                        'user_name': $( '#username' ).val(),
                        'gender': $( '#gender' ).val(),
                        'city': $( '#city' ).val(),
                        'discount_id': $( '#special-id' ).val(),
                    }, function ( result ) {
                        _self.text( 'ارسال پیام' );
                        is_loading = false;
                        $('#captcha-image').attr('src', "<?= site_url( 'api/captcha' ) ?>?" + Math.random());

                        if ( result.status === true ) {
                            $( '#captcha' ).val('');
                            $( '#mobile-number' ).val('');
                            $( '#username' ).val('');
                            $( '#city' ).val('');
                            $('.alert-danger').first().hide();
                            $('.success-text').show();
                        } else {
                            $('.alert-danger').first().text(result.error[0]).show();
                            $( '#captcha' ).val('');
                        }
                    }, function(){
                        _self.text( 'ارسال پیام' );
                        is_loading = false;
                    } );
                }
            } )
        } );
	</script>
	<?php
} ); ?>
