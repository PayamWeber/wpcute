<section id="gallery_section" class="ls page_portfolio section_padding_top_100 section_padding_bottom_75">
	<div class="container">
		<div class="row gallery-img">
			<h2 class="text-center section_header"><?= get_nvm_setting( 'gallery_main_text' ) ?></h2>
			<?php if ( pmw_get_main_template() == 'tp1' ): ?>
				<?php foreach ( $photos as $post ): ?>
					<div class="col-lg-4 col-md-4 col-sm-6 border-solid ">
						<a data-fancybox="gallery" href="<?= get_the_post_thumbnail_url( $post->ID, 'full' ) ?>">
							<img src="<?= get_the_post_thumbnail_url( $post->ID, 'pmw-medium' ) ?>" alt="" CLASS="w-100"/>
						</a>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="active-gallery-image" style="background-image: url(<?= get_the_post_thumbnail_url( reset( $photos )->ID ?? 0, 'full' ) ?>)">
					<img src="<?= get_the_post_thumbnail_url( reset( $photos )->ID ?? 0, 'full' ) ?>">
				</div>
				<div class="owl-carousel testimonials-carousel top-dots" data-responsive-sm="1" data-responsive-md="2" data-responsive-lg="3" data-dots="true">
					<?php $active_photo = ''; ?>
					<?php foreach ( $photos as $post ): ?>
						<div class="border-solid single-gallery-item <?= ( ! $active_photo ) ? ( $active_photo = 'sgi-active' ) : '' ?>">
							<a href="<?= get_the_post_thumbnail_url( $post->ID, 'full' ) ?>">
								<img src="<?= get_the_post_thumbnail_url( $post->ID, 'pmw-medium' ) ?>" data-large-image="<?= get_the_post_thumbnail_url( $post->ID, 'full' ) ?>" CLASS="w-100"/>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php add_action( 'theme_view_scripts', function () {
	?>
	<?php if ( pmw_get_main_template() == 'tp2' ): ?>
		<script>
            $( document ).ready( function () {
                $( '.single-gallery-item' ).click( function ( e ) {
                    e.preventDefault();
                    $( '.single-gallery-item' ).removeClass( 'sgi-active' );
                    $( this ).addClass( 'sgi-active' );
                    $( '.active-gallery-image' ).css( {
                        'background-image': 'url(' + $( this ).find( 'img' ).data('large-image') + ')'
                    } );
                    $( '.active-gallery-image img' ).css( {
                        'height': $( '.active-gallery-image img' ).height() + 'px'
                    } ).attr( 'src', $( this ).find( 'img' ).attr( 'src' ) );
                } )
            } )
		</script>
	<?php endif; ?>
	<?php
} ); ?>