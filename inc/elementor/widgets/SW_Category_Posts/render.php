<?php

use PMW\Post;

$posts = Post::query( [
	'posts_per_page' => 8,
	'cat' => $settings[ 'category' ],
] );
?>
<?php if ( $posts && ! is_page_template( ConfigHelper::get( 'pages.' . ConfigHelper::PAGE_BLOG ) ) && ! is_category() ): ?>
	<section class="section _section"
		<?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
 <?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
			 data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
		<?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
		<div class="section-wrap">
			<?php if ( $settings[ 'main_title' ] || $settings[ 'main_subtitle' ] ): ?>
				<div class="section-header">
					<?php if ( $settings[ 'main_title' ] ): ?>
						<h3 class="section-title"><?= $settings[ 'main_title' ] ?></h3>
					<?php endif; ?>
					<?php if ( $settings[ 'main_subtitle' ] ): ?>
						<p class="section-subtitle"><?= $settings[ 'main_subtitle' ] ?></p>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="section-body">
				<div class="row row--10">
					<?php
					$counter = 0;
					foreach ( $posts as $key => $post ):
						$counter++;
						$className = 'col-lg-6';
						if ( $settings[ "post_" . ( $key + 1 ) . "_is_wide" ] == 'yes' )
						{
							$className = 'col-lg-12';
							$counter++;
						}
						if ( $counter > 8 )
						{
							continue;
						}
						$img = get_the_post_thumbnail_url( $post->ID, 'pmw-medium' );
						?>
						<div class="col-xs-24 col-md-12 <?= $className ?>">
							<a href="<?= get_the_permalink( $post->ID ) ?>" class="blog-post">
								<div class="blog-post__img">
									<img src="<?= $img ?>" alt="<?= $post->post_title ?>">
									<span style="background-image: url('<?= $img ?>')"></span>
								</div>
								<div class="blog-post__info">
									<h4 class="blog-post__title">
										<?= $post->post_title ?>
									</h4>
									<time class="blog-post__date" datetime=""><?= get_the_time( 'M Y', $post->ID ) ?></time>
								</div>
								<div class="blog-post__hover">
									<i>...</i>
									<p>بیشتر بخوانید</p>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
<?php else: ?>
	<div class="row row--10 _section">
		<?php
		$counter = 0;
		foreach ( $posts as $key => $post ):
			$counter++;
			$className = 'col-lg-6';
			if ( $settings[ "post_" . ( $key + 1 ) . "_is_wide" ] == 'yes' )
			{
				$className = 'col-lg-12';
				$counter++;
			}
			if ( $counter > 8 )
			{
				continue;
			}
			$img = get_the_post_thumbnail_url( $post->ID, 'pmw-medium' );
			?>
			<div class="col-xs-24 col-md-12 <?= $className ?>">
				<a href="<?= get_the_permalink( $post->ID ) ?>" class="blog-post">
					<div class="blog-post__img">
						<img src="<?= $img ?>" alt="<?= $post->post_title ?>">
						<span style="background-image: url('<?= $img ?>')"></span>
					</div>
					<div class="blog-post__info">
						<h4 class="blog-post__title">
							<?= $post->post_title ?>
						</h4>
						<time class="blog-post__date" datetime=""><?= get_the_time( 'M Y', $post->ID ) ?></time>
					</div>
					<div class="blog-post__hover">
						<i>...</i>
						<p>بیشتر بخوانید</p>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>