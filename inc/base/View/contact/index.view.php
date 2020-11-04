<?php include_view( 'common.page.caption' ); ?>
<section class="ls section_padding_top_100 section_padding_bottom_75">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<section id="map" class="ls ms" data-address="sydney, australia, Liverpool street">
					<!-- marker description and marker icon goes here -->
					<iframe src="<?= get_field( 'contact_page_map_url' ) ?>" width="100%" height="100%"></iframe>
				</section>
			</div>
		</div>
		<div class="row topmargin_40 d-flex dir-rtl flex-warp itemBarContact">
			<div class="col-sm-4 to_animate" data-animation="pullDown">
				<div class="teaser text-center">
					<div class="teaser_icon highlight size_normal">
						<i class="rt-icon2-phone5"></i>
					</div>
					<div style="direction: ltr !important;">
						<?= get_field( 'contact_page_phone_number' ) ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4 to_animate" data-animation="pullDown">
				<div class="teaser text-center">
					<div class="teaser_icon highlight size_normal">
						<i class="rt-icon2-location2"></i>
					</div>
					<p><?= nl2br( get_field( 'contact_page_address' ) ) ?></p>
				</div>
			</div>
			<div class="col-sm-4 to_animate" data-animation="pullDown">
				<div class="teaser text-center">
					<div class="teaser_icon highlight size_normal">
						<i class="rt-icon2-mail"></i>
					</div>
					<p><?= nl2br( get_field( 'contact_page_email' ) ) ?></p>
				</div>
			</div>
		</div>
		<div class="comment-respond dir-rtl" id="respond">
			<form class="comment-form" id="commentform" method="post" action="./">
				<div class="row columns_margin_bottom_40">
					<div class="col-md-6">
						<p class="comment-form-author">
							<label for="author">نام
								<span class="required">*</span>
							</label>
							<!-- <i class="rt-icon2-user-outline"></i> -->
							<input type="text" aria-required="true" size="30" value="" name="author" id="username" class="form-control" placeholder="نام شما">
						</p>
					</div>
					<div class="col-md-6">
						<p class="comment-form-email">
							<label for="comment_email">شماره موبایل
								<span class="required">*</span>
							</label>
							<!-- <i class="rt-icon2-mail2"></i> -->
							<input type="email" aria-required="true" size="30" value="" name="comment_email" id="mobile-number" class="form-control" placeholder="شماره موبایل">
						</p>
					</div>
					<div class="col-md-12">
						<p class="comment-form-chat">
							<label for="comment">متن پیام</label>
							<!-- <i class="rt-icon2-pencil3"></i> -->
							<textarea aria-required="true" rows="1" cols="45" name="comment" id="comment" class="form-control" placeholder="متن پیام"></textarea>
						</p>
					</div>
					<div class="col-md-12">
						<p class="comment-form-chat">
						<div for="name" class="mb-2 text-right color-7B5">
							<img id="captcha-image" src="<?= site_url( 'api/captcha' ) ?>" alt="">
							<span onclick="$('#captcha-image').attr('src', '<?= site_url() ?>/api/captcha?' + Math.random() )" class="captcha-reload"></span>
						</div>
						<!-- <i class="rt-icon2-pencil3"></i> -->
						<input aria-required="true" rows="1" cols="45" name="captcha" id="captcha" class="form-control" placeholder="اعداد درون تصویر را وارد کنید">
						</p>
					</div>
				</div>
				<div class="alert alert-danger" style="display: none"></div>
				<p class="form-submit text-center topmargin_20">
					<button type="submit" id="submit" name="submit" class="theme_button color1 with_shadow btn-send-contact">ارسال پیام
					</button>
				</p>
			</form>
		</div>
	</div>
</section>
<?php add_action( 'theme_view_scripts', function () {
	?>
	<script>
        var is_loading = false;
        $( document ).ready( function () {
            $( 'form' ).submit( function () {
                return false;
            } )
            $( '.btn-send-contact' ).click( function () {
                var _self = $( this );
                if ( is_loading === false ) {
                    is_loading = true;
                    _self.text( 'لطفا صبر کنید...' );
                    send_post_api( '<?= site_url( 'api/contact_us/send' ) ?>', {
                        'captcha': $( '#captcha' ).val(),
                        'mobile': $( '#mobile-number' ).val(),
                        'user_name': $( '#username' ).val(),
                        'message': $( 'textarea' ).val(),
                    }, function ( result ) {
                        _self.text( 'ارسال پیام' );
                        is_loading = false;
                        $( '#captcha-image' ).attr( 'src', "<?= site_url( 'api/captcha' ) ?>?" + Math.random() );
                        $( '#captcha' ).val('');

                        if ( result.status === true ) {
                            $( '#captcha' ).val( '' );
                            $( '#mobile-number' ).val( '' );
                            $( '#username' ).val( '' );
                            $( 'textarea' ).val( '' );
                            $( '.alert-danger' ).first().removeClass( 'alert-danger' ).addClass( 'alert-success' ).text( 'پیام شما با موفقیت ارسال شد' ).show();
                        } else {
                            $( '.alert-danger' ).first().text( result.error[ 0 ] ).show();
                            $( '#captcha' ).val( '' );
                        }
                    }, function () {
                        _self.text( 'ارسال پیام' );
                        is_loading = false;
                    } );
                }
            } )
        } );
	</script>
	<?php
} ); ?>