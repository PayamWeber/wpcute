<?php
$product    = \PMW\Product::find();
$attributes = $product->get_attributes();
?>
<?php if ( $settings[ 'items' ] ): ?>
	<section class="section _section section--table"
		<?= $settings[ 'section_icon' ][ 'url' ] ? 'data-menu-section' : '' ?>
		<?= $settings[ 'section_hide_menu' ] == 'yes' ? 'data-hide-menu' : '' ?>
			 data-icon="<?= $settings[ 'section_icon' ][ 'url' ] ?>"
		<?= $settings[ 'section_hashtag' ] ? 'data-hash="' . $settings[ 'section_hashtag' ] . '"' : '' ?>>
		<div class="section-wrap">
			<?php if ( $settings[ 'main_title' ] || $settings[ 'main_subtitle' ] ): ?>
				<header class="s-header mb-30">
					<?php if ( $settings[ 'main_title' ] ): ?>
						<h2 class="s-title"><?= $settings[ 'main_title' ] ?></h2>
					<?php endif; ?>
					<?php if ( $settings[ 'main_subtitle' ] ): ?>
						<p class="s-subtitle"><?= $settings[ 'main_subtitle' ] ?></p>
					<?php endif; ?>
				</header>
			<?php endif; ?>
			<div class="section-body">
				<div class="row row--35">
					<div class="col-xs-24 col-md-12 <?= count( $settings[ 'items' ] ) == 1 ? 'col-md-24' : 'col-md-12' ?>">
						<div class="table">
							<div class="table-header">
								<h3 class="table-title"><?= $settings[ 'items' ][ 0 ][ 'title' ] ?></h3>
							</div>
							<div class="table-body">
								<?php foreach ( $settings[ 'items' ][ 0 ][ 'attributes' ] as $item ): ?>
									<?php
									$attr_info = wc_get_attribute( $item );
									?>
									<?php if ( isset( $attributes[ strtolower( urlencode( $attr_info->slug ) ) ] ) ): ?>
										<?php
										$attr       = $attributes[ strtolower( urlencode( $attr_info->slug ) ) ];
										$attr_terms = get_terms( [
											'include' => $attr->get_options(),
											'hide_empty' => false,
										] );
										?>
										<div class="table-row">
											<div class="table-col table-col--50">
												<?= $attr_info->name ?>
											</div>
											<div class="table-col <?= true ? 'ltr' : '' ?> table-col--50">
												<?php if ( $attr_terms ): ?>
													<?php foreach ( $attr_terms as $i => $term ): ?>
														<?= $term->name ?><?= count( $attr_terms ) != ( $i + 1 ) ? ',' : '' ?>
													<?php endforeach; ?>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
							<?php if ( $settings[ 'items' ][ 0 ][ 'show_button' ] == 'yes' ): ?>
								<div class="table-footer">
									<a href="<?= $settings[ 'items' ][ 0 ][ 'button_url' ] ?>" class="btn btn--md"><?= $settings[ 'items' ][ 0 ][ 'button_text' ] ?></a>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php if ( count( $settings[ 'items' ] ) > 1 ): ?>
						<div class="col-xs-24 col-md-12">
							<?php foreach ( $settings[ 'items' ] as $key => $_item ): if ( ! $key ) continue; ?>
								<div class="table">
									<div class="table-header">
										<h3 class="table-title"><?= $_item[ 'title' ] ?></h3>
									</div>
									<div class="table-body">
										<?php foreach ( $_item[ 'attributes' ] as $item ): ?>
											<?php
											$attr_info = wc_get_attribute( $item );
											?>
											<?php if ( isset( $attributes[ strtolower( urlencode( $attr_info->slug ) ) ] ) ): ?>
												<?php
												$attr = $attributes[ strtolower( urlencode( $attr_info->slug ) ) ];
												$attr_terms = get_terms( [
													'include' => $attr->get_options(),
													'hide_empty' => false,
												] );
												?>
												<div class="table-row">
													<div class="table-col table-col--50">
														<?= $attr_info->name ?>
													</div>
													<div class="table-col <?= true ? 'ltr' : '' ?> table-col--50">
														<?php if ( $attr_terms ): ?>
															<?php foreach ( $attr_terms as $i => $term ): ?>
																<?= $term->name ?><?= count( $attr_terms ) != ( $i + 1 ) ? ',' : '' ?>
															<?php endforeach; ?>
														<?php endif; ?>
													</div>
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>