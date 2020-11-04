<?php while ( have_posts() ): the_post(); ?>
	<main>
		<header class="page-header">
			<div class="max-md">
				<div class="col">
					<h1 class="page-header__title"><?php the_title() ?></h1>
					<?php if ( get_field( 'subtitle' ) ): ?>
						<p class="page-header__subtitle"><?= get_field( 'subtitle' ) ?></p>
					<?php endif; ?>
				</div>
				<div class="col">
					<div id="mapinput" class="page-header__search input input--solid input--icon">
						<input type="text" placeholder="<?= get_field( 'input_text' ) ?>">
						<button class="input-button">
							<svg>
								<use xlink:href="<?= ConfigHelper::get('sprite') ?>#search-color"></use>
							</svg>
						</button>
					</div>
					<div class="mapsearch">
						<div class="loading loading--blue"></div>
						<div class="scrollbar-inner dragscroll">
							<ul></ul>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="section">
			<div id="map"
				 data-token="pk.eyJ1IjoiYW1pcnEiLCJhIjoiY2pwNTRndnprMHprODNsczA1aHVqb3M4biJ9.V4f5c0UJwhNCdxaD1aGBbA"
				 data-startPoint="35.689369,51.389231"
				 data-points="<?= ConfigHelper::get('themeUrl') ?>/pages/data/agents/agents.json"
				 data-startText="تهران"
				 data-noresult="<?= get_field( 'not_found_text' ) ?>"></div>
		</div>
	</main>
<?php endwhile; ?>