<!-- template sections -->

<section class="page_topline cs table_section table_section_md columns_padding_0 dir-rtl">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-9 text-center divided_content">
				<div>
					<div class="media small-teaser">
						<div class="media-left" >
							<i class="fa fa-map-marker highlight " style="margin-left: 10px"></i>
						</div>
						<div class="media-body">
							<?= str_replace( [ '[', ']' ], ['<span>', '</span>'], get_nvm_setting( 'header_welcome_text', '' ) ) ?>
						</div>
					</div>
				</div>
				<div>
					<div class="media small-teaser">
						<div class="media-left">
							<i class="fa fa-user highlight "  style="margin-left: 10px"></i>
						</div>
						<div class="media-body">
							<?= str_replace( [ '[', ']' ], ['<span>', '</span>'], get_nvm_setting( 'header_contact_text', '' ) ) ?>
						</div>
					</div>
				</div>
			</div>
			<?php $social_links = get_nvm_setting( 'header_buttons' ); ?>
			<?php if ( $social_links && is_array( $social_links ) && isset( $social_links[ 'title' ] ) ): ?>
				<div class="col-md-3 text-center bottommargin_0">
					<?php foreach ( $social_links[ 'title' ] as $key => $value ): ?>
						<a href="<?= $social_links[ 'url' ][$key] ?>" class="theme_button color1 margin_0 "><?= $social_links[ 'title' ][$key] ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>

<header class="page_header header_white table_section columns_padding_0 toggler-xs-right">
	<div class="container-fluid">
		<div class="row align-center" style="margin: 10px 0; display: flex;justify-content: space-between" >
			<div class=" col-md-4  col-sm-4  hidden-xs lightgreylinks">
				<div class="page_social_icons divided_content d-flex  justify-content-center" >
					<?php $social_links = get_nvm_setting( 'social_links' ); ?>
					<?php if ( $social_links && is_array( $social_links ) && isset( $social_links[ 'title' ] ) ): ?>
						<?php foreach ( $social_links[ 'title' ] as $key => $value ): ?>
							<span>
								<a class="" href="<?= $social_links[ 'url' ][$key] ?>" title="<?= $social_links[ 'title' ][$key] ?>">
									<img src="<?= wp_get_attachment_image_url($social_links[ 'icon' ][$key]) ?>" alt="<?= $social_links[ 'title' ][$key] ?>">
								</a>
							</span>
						<?php endforeach; ?>
					<?php endif; ?>

				</div>
			</div>
			<div class=" col-md-8 col-sm-4  text-center">
				<span class="toggle_menu hidden-xs">
					<span></span>
				</span>
				<!-- main nav start -->
				<nav class="mainmenu_wrapper">
					<ul class="mainmenu nav sf-menu dir-rtl">
						<?= (new NavHelper())->PrintMenu('main-menu') ?>
					</ul>
				</nav>
				<!-- eof main nav -->

			</div>
			<div class="col-md-4  col-sm-4   text-center-left-sm col-xs-12">
				<a href="<?= site_url() ?>" class="logo-top-menu">
					<?php if ( pmw_get_main_template() == 'tp2' ): ?>
						<h2><?= get_bloginfo('name'); ?></h2>
					<?php endif; ?>
					<img src="<?= wp_get_attachment_image_url( get_nvm_setting( 'logo_image' ), 'large' ) ?>" alt="<?= get_bloginfo('name') ?>">
				</a>
				<!-- header toggler -->
				<span class="toggle_menu visible-xs">
					<span></span>
				</span>
			</div>
		</div>
	</div>
</header>
<?php return true; ?>
