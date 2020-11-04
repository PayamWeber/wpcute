<?php include_view( 'common.page.caption' ); ?>
<section class="ls page_portfolio section_padding_top_100 section_padding_bottom_75">
	<div class="container">
		<div class="row  gallery-img">
			<?php foreach ( $posts as $post ): ?>
				<div class="col-lg-4 col-md-4 col-sm-6 border-solid ">
					<a data-fancybox="gallery" href="<?= get_the_post_thumbnail_url( $post->ID, 'full' ) ?>">
						<img src="<?= get_the_post_thumbnail_url( $post->ID, 'large' ) ?>" alt="" CLASS="w-100"/>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

