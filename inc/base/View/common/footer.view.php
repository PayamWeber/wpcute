<footer class="page_footer cs main_color2 table_section section_padding_50 columns_padding_0">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-push-4 text-center">
				<a href="<?= site_url() ?>" class="logo big text-shadow">
					<img src="<?= wp_get_attachment_image_url( get_nvm_setting( 'footer_logo_image' ), 'large' ) ?>" alt="">
				</a>
			</div>
			<div class="col-sm-4 col-sm-pull-4 text-center text-sm-left text-md-left">
				<div class="widget widget_nav_menu greylinks">
					<ul class="menu divided_content wide_divider">
						<?= ( new NavHelper() )->PrintDividedMenu( 'footer-menu', 'left' ) ?>
					</ul>
				</div>
			</div>
			<div class="col-sm-4 text-center text-sm-right text-md-right">
				<div class="widget widget_nav_menu greylinks">
					<ul class="menu divided_content wide_divider">
						<?= ( new NavHelper() )->PrintDividedMenu( 'footer-menu', 'right' ) ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>
<section class="cs main_color2 page_copyright section_padding_15">
	<div class="container with_top_border">
		<div class="row">
			<div class="col-sm-12 text-center">
				<p class="small-text"><?= get_nvm_setting( 'footer_copyright', '&copy; 2020 Psychology and Counseling. All Rights Reserved' ) ?></p>
			</div>
		</div>
	</div>
</section>
