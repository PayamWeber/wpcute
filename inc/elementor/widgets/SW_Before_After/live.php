<div class="section _section">
	<div class="compare">
		<div class="compare-slider">
			<# if( settings.items ){ #>
				<!-- Before -->
				<ul class="compare-main">
					<# _.each( settings.items, function( item, index ) { #>
						<li data-feature="{{{ "feature" + index }}}" style="background-image:url('{{{ item.before_image.url }}}')"></li>
					<# }) #>
				</ul>
				<!-- after -->
				<ul class="compare-resize">
					<# _.each( settings.items, function( item, index ) { #>
						<li data-feature="{{{ "feature" + index }}}" style="background-image:url('{{{ item.after_image.url }}}')"></li>
					<# }) #>
				</ul>
			<# } #>
			<span class="compare-handle"><i>
					<svg>
						<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#handle-arc"></use>
					</svg>
					<svg>
						<use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#handle-arc"></use>
					</svg>
				</i></span>
			<# if( settings.main_desc ){ #>
				<div class="compare-footer">
					<div class="compare-wrap">
						{{{ settings.main_desc  }}}
					</div>
				</div>
			<# } #>
		</div>
		<div class="compare-cards">
			<div class="compare-wrap">
				<ul class="bus bus--center">
					<# _.each( settings.items, function( item, index ) { #>
						<li class="{{{ index == 0 ? 'active' : '' }}}" data-feature="{{{ "feature" + index }}}">
							<div class="card-f card-f--smicon card-f--border">
								<img class="card-f__img" src="{{{ item.image.url }}}">
								<div class="card-f__wrap">
									<div class="card-f__title">{{{ item.title }}}</div>
								</div>
							</div>
						</li>
					<# }) #>
				</ul>
			</div>
		</div>
	</div>
</div>