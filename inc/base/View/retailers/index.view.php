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
					<div class="page-header__search input input--solid input--icon">
						<input class="search-table" type="text" placeholder="<?= get_field( 'input_text' ) ?>">
						<button class="input-button">
							<svg>
								<use xlink:href="<?= ConfigHelper::get('sprite') ?>#search-color"></use>
							</svg>
						</button>
					</div>
				</div>
			</div>
		</header>
		<section class="section bg-f4">
			<div class="data-table">
				<div class="loading loading--blue"></div>
				<div class="data-table__error">
					<p>
						<span>خطایی رخ داده است!</span>
						لطفا با کلیک روی دکمه، دوباره سعی کنید
					</p>
					<button class="btn btn--sm btn--blue">سعی مجدد</button>
				</div>
				<table data-datatable
					   data-url="<?= ConfigHelper::get( 'themeUrl' ) ?>/pages/data/agents/agents.json"
					   data-perPage="9"
					   data-title="<?= get_field( 'table_first_column_text' ) ?>"></table>
			</div>
		</section>
	</main>
<?php endwhile; ?>