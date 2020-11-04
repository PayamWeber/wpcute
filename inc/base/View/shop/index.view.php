<?php include_view( 'shop.slider', [ 'page_id' => $shop_id ] ) ?>
<div class="sort" id="sort">
	<div class="sort-wrap">
		<div class="sort-container">
			<button class="sort-filter">
				<svg class="icon icon--filter" viewBox="0 0 30 28.8">
					<use xlink:href="#svg_filter"></use>
				</svg>
			</button>
			<div class="sort-info sort-info--select">
				<span>مرتب سازی بر اساس:</span>
				<div class="select">
					<select data-islink>
						<option value="javascript:void(0)" data-display="انتخاب کنید">انتخاب کنید</option>
						<?php if ( $sort_options ): ?>
							<?php foreach ( $sort_options as $sort ): ?>
								<option <?= ( isset( $filters_used[ '_sort' ] ) && $filters_used[ '_sort' ][ 'value' ] == $sort['value'] && isset( $filters_used[ '_sort_order' ] ) && $filters_used[ '_sort_order' ][ 'value' ] == $sort['order'] ) ? 'selected disabled' : '' ?>
										value="<?= $sort['url'] ?>" data-display="<?= $sort['title'] ?>"><?= $sort['title'] ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>
			</div>
			<?php if ( $filters_used ): ?>
				<div class="sort-info sort-info--clear">
					<?= count( $filters_used ) ?> فیلتر
					<div class="sort-divider"></div>
					<a class="sort-btn" href="<?= $shop_url ?>">
						پاک‌کردن فیلتر‌ها
						<svg class="icon icon--close">
							<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#close"></use>
						</svg>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="section">
	<div class="section-wrap nopadd-top">
		<div class="row row--20-0">
			<div class="col-xs-24 col-lg-5">
				<form action="<?= $shop_url ?>">
					<div class="filters">
						<div class="filters-wrap">
							<div class="filters-group visible-md slide">
								<button class="filters-title slide-btn" type="button">مرتب‌سازی براساس:</button>
								<ul class="slide-content">
									<?php if ( $sort_options ): ?>
										<?php foreach ( $sort_options as $sort ): ?>
											<li>
												<div class="radiobtn">
													<input type="radio" name="_sort" value="<?= $sort['value'] ?>" <?= isset( $filters_used[ '_sort' ] ) && $filters_used[ '_sort' ][ 'value' ] == $sort['value'] ? 'checked' : '' ?>>
													<i></i>
													<span><?= $sort['title'] ?></span>
												</div>
											</li>
										<?php endforeach; ?>
									<?php endif; ?>
								</ul>
							</div>
							<div class="filters-group visible-md slide">
								<button class="filters-title slide-btn" type="button">ترتیب:</button>
								<ul class="slide-content">
									<?php if ( $sort_order_options ): ?>
										<?php foreach ( $sort_order_options as $sort_order_key => $sort_order_title ): ?>
											<li>
												<div class="radiobtn">
													<input type="radio" name="_sort_order" value="<?= $sort_order_key ?>" <?= isset( $filters_used[ '_sort_order' ] ) && $filters_used[ '_sort_order' ][ 'value' ] == $sort_order_key ? 'checked' : '' ?>>
													<i></i>
													<span><?= $sort_order_title ?></span>
												</div>
											</li>
										<?php endforeach; ?>
									<?php endif; ?>
								</ul>
							</div>
							<?php if ( $advanced_search_fields ): ?>
								<?php foreach ( $advanced_search_fields as $attr_id => $field ): ?>
									<?php if ( $field[ 'data' ] ): ?>
										<div class="filters-group slide <?= $attr_id == '_color' ? 'filters-group--colors' : '' ?>">
											<button type="button" class="filters-title slide-btn"><?= $field[ 'title' ] ?></button>
											<ul class="slide-content">
												<?php if ( $attr_id == '_color' ): ?>
													<?php foreach ( $field[ 'data' ] as $choice ): ?>
														<li>
															<div class="radiobtn radiobtn--color">
																<input <?= isset( $filters_used[ $attr_id ] ) && $filters_used[ $attr_id ][ 'value' ] == $choice->term_id ? 'checked' : '' ?> name="<?= $attr_id ?>" type="radio" value="<?= $choice->term_id ?>">
																<i style="background: <?= get_term_meta( $choice->term_id, 'color', true ) ?>"></i>
															</div>
														</li>
													<?php endforeach; ?>
												<?php else: ?>
													<?php foreach ( $field[ 'data' ] as $choice ): ?>
														<li>
															<div class="checkbox">
																<input <?= ( isset( $filters_used[ $attr_id ] ) && ( $filters_used[ $attr_id ][ 'value' ] == $choice->term_id || ( is_array( $filters_used[ $attr_id ][ 'value' ] ) && in_array( $choice->term_id, $filters_used[ $attr_id ][ 'value' ] ) ) ) ) ? 'checked' : '' ?> type="checkbox" name="<?= $attr_id ?>[]" value="<?= $choice->term_id ?>">
																<i></i>
																<span><?= $choice->name ?></span>
															</div>
														</li>
													<?php endforeach; ?>
												<?php endif; ?>
											</ul>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<div class="filters-header">
							<span>فیلتر‌ کنید</span>
							<button class="filter-close" type="button">
								<svg>
									<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#close"></use>
								</svg>
							</button>
						</div>
						<div class="filters-footer">
							<button class="btn btn--md btn--full" type="submit">اعمال فیلترها</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-xs-24 col-lg-19 pt-50">
				<?php if ( $filters_used ): ?>
					<div class="list-filters">
						<h3 class="list-filters__title">فیلتر‌های اعمال‌شده</h3>
						<div class="list-filters__slider">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<?php foreach ( $filters_used as $tag_key => $tag ) { ?>
										<?php
										$new_query_string = $query_args;
										unset( $new_query_string[ $tag_key ] );
										if ( isset( $new_query_string[ 'page_number' ] ) )
											unset( $new_query_string[ 'page_number' ] );
										$url = $shop_url . '?' . http_build_query( $new_query_string );
										?>
										<div class="swiper-slide">
											<a class="tag" href="<?= $url ?>">
												<span><?= $tag[ 'title' ] ?></span>
												<svg class="icon icon--close-circle">
													<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#close-circle"></use>
												</svg>
											</a>
										</div>
									<?php } ?>
								</div>
								<div class="swiper-button-prev"></div>
								<div class="swiper-button-next"></div>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<ul>
					<?php
					if ( $products->posts ):
						foreach ( $products->posts as $product ):
							$post = $product;
							$product = \PMW\Product::find( $product );
							?>
							<li class="card-product">
								<div class="card-product__preview">
									<a href="<?= $product->get_permalink(); ?>">
										<img src="<?= get_the_post_thumbnail_url( $post ) ?>" alt="<?= $product->get_name() ?>">
									</a>
								</div>
								<div class="card-product__content">
									<div class="card-product__header">
										<a href="<?= $product->get_permalink(); ?>" class="card-product__title">
											<?= $product->get_name() ?>
											<span><?= $product->enTitle; ?></span>
										</a>
										<?php if ( isset( $product->meta->is_featured ) && $product->meta->is_featured ): ?>
											<div>
												<div class="card-product__offer">پیشنهاد ویژه</div>
											</div>
										<?php endif; ?>
									</div>
									<p class="card-product__info">
										<?= ( $short_desc = mb_substr( strip_tags( $product->get_short_description() ), 0, 270 ) ) ? $short_desc . '...' : '' ?>
									</p>
									<footer class="card-product__footer">
										<div class="card-product__spec">
											<?php if ( $energy = $energy_usages[ $product->get_id() ] ): ?>
												<div class="card-product__energy">
													<svg style="fill:<?= get_term_meta( $energy->term_id, 'color', true ); ?>" class="icon icon--label">
														<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#energy-label"></use>
													</svg>
													<span><?= $energy->name; ?></span>
												</div>
											<?php endif; ?>
										</div>
										<div class="card-product__btn">
											<a href="<?= $product->get_permalink(); ?>" class="btn btn--wide">اطلاعات
												بیشتر
											</a>
										</div>
									</footer>
								</div>
							</li>
						<?php endforeach; endif; ?>
				</ul>
				<div class="pagination">
					<?php
					pmw_special_pagination( $products->max_num_pages, 'page_number', $shop_url, 4 ); ?>
				</div>
			</div>
		</div>
	</div>
</div>