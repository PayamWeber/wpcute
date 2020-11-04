<?php if ( $featured_products ): ?>
	<div class="intro intro--productlist" id="intro">
		<div class="intro-slider fpslider active" data-parallax js-parallax-intro>
			<ul class="fpslider__content">
				<?php foreach ( $featured_products as $product ): ?>
					<?php
					$product->meta->image_in_slider    = $product->meta->image_in_slider ?? '';
					$product->meta->title_in_slider    = $product->meta->title_in_slider ?? '';
					$product->meta->subtitle_in_slider = $product->meta->subtitle_in_slider ?? '';
					$product->meta->desc_in_slider     = $product->meta->desc_in_slider ?? '';
					$product->meta->desc_in_slider2    = $product->meta->desc_in_slider2 ?? '';
					$product->meta->button_in_slider_text    = $product->meta->button_in_slider_text ?? '';
					?>
					<li class="intro-slide fpslider__content-item">
						<div class="intro-bg" data-parallax-bg>
							<div class="intro-image" style="background-image: url('<?= wp_get_attachment_image_url( $product->meta->image_in_slider, 'full' ) ?>')"></div>
						</div>
						<div class="intro-content">
							<div class="intro-wrap">
								<div class="s-header">
									<div class="s-title"><?= $product->meta->title_in_slider ? : $product->post_title ?></div>
									<div class="s-subtitle"><?= $product->meta->subtitle_in_slider ?></div>
								</div>
								<div class="intro-desc">
									<div class="intro-descwrap">
										<p><?= $product->meta->desc_in_slider ?></p>
										<span><?= str_replace( [ '[', ']' ], [ '<i>', '</i>' ], $product->meta->desc_in_slider2 ) ?></span>
										<a href="<?= get_permalink( $product->get_id() ) ?>" class="btn btn--sm btn--border btn--gray-9"><?= $product->meta->button_in_slider_text ?></a>
									</div>
								</div>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="fpslider__nav">
				<ul class="fpslider__bullet"></ul>
			</div>
		</div>
	</div>
<?php endif; ?>