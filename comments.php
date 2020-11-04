<?php
if ( comments_open() ):
	?>
	<a id="respond"></a>
	<div class="comment-respond" id="respond">
		<h4 class="color-7B5 text-right mb-4 font-aviny">
			<?php comment_form_title( '', 'پاسخ دادن به %s' ) ?>
		</h4>
		<form class="comment-form" id="commentform" method="post" action="<?= site_url(); ?>/wp-comments-post.php">
			<div class="row columns_margin_bottom_40">
				<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ): ?>
					<p class="loggedinText">شما باید
						<a href="<?php echo wp_login_url( get_permalink() ); ?>">وارد سایت</a>
						شده باشید تا بتوانید دیدگاه خود را ثبت کنید .
					</p>
				<?php else: ?>
				<?php if ( is_user_logged_in() ): $current_user = wp_get_current_user(); ?>
					<div class="col-md-12">
						<p>شما با نام <?php echo $current_user->display_name ?> وارد شده اید.
							<a href="<?php echo wp_logout_url( get_the_permalink() ); ?>">خروج از حساب کاربری</a>
						</p>
					</div>
				<?php else: ?>
					<div class="col-md-6">
						<p class="comment-form-author">
							<label for="author">نام
								<span class="required">*</span>
							</label>
							<!-- <i class="rt-icon2-user-outline"></i> -->
							<input type="text" aria-required="true" size="30" value="" name="author" id="author" class="form-control" placeholder="نام شما">
						</p>
					</div>
					<div class="col-md-6">
						<p class="comment-form-email">
							<label for="comment_email">ایمیل
								<span class="required">*</span>
							</label>
							<!-- <i class="rt-icon2-mail2"></i> -->
							<input type="email" aria-required="true" size="30" value="" name="email" id="comment_email" class="form-control" placeholder="ایمیل شما">
						</p>
					</div>
				<?php endif; ?>
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
			<?php comment_id_fields(); ?>
			<?php do_action( 'comment_form', get_the_ID() ); ?>
			<p class="form-submit text-center topmargin_20">
				<button type="submit" id="submit" name="submit" class="theme_button color1 with_shadow">
					ارسال پیام
				</button>
			</p>
			<?php endif; ?>
		</form>
	</div>
<?php endif; ?>
<div class="comments-area" id="comments">
	<ol class="comment-list">
		<?php
		if ( have_comments() ) {
			wp_list_comments( [
				'walker' => new PMW_Walker_Comment(),
				'format' => 'html5',
				'style' => 'ol',
				'reverse_top_level' => true,
			] );
		}
		?>
	</ol>
</div>
