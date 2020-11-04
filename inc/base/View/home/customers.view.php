<?php $social_links = get_nvm_setting( 'quotes' ); ?>
<?php if ( $social_links && is_array( $social_links ) && isset( $social_links[ 'title' ] ) ): ?>
	<section id="customerComments" class="cs main_color2 parallax page_testimonials section_padding_75 parallax page_about">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="owl-carousel testimonials-carousel top-dots" data-responsive-sm="1" data-responsive-md="1" data-responsive-lg="1" data-dots="true">
						<?php foreach ( $social_links[ 'title' ] as $key => $value ): ?>
							<blockquote>
								<?= nl2br( $social_links[ 'desc' ][ $key ] ?? '' ) ?>
								<div class="item-meta">
									<h5><?= $social_links[ 'title' ][ $key ] ?? '' ?></h5>
								</div>
							</blockquote>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php return true; ?>