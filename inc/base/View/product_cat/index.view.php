<header class="page-header page-header--customers">
	<div class="max-md">
		<div class="col">
			<?php while ( have_posts() ): the_post(); ?>
				<h1 class="page-header__title"><?= the_title() ?></h1>
				<?php if ( get_field( 'subtitle' ) ): ?>
					<p class="page-header__subtitle"><?= get_field( 'subtitle' ) ?></p>
				<?php endif; ?>
			<?php endwhile; ?>
		</div>
	</div>
</header>
<?php
use PHPHtmlParser\Dom;
while ( have_posts() )
{
    the_post();
    if ( ! pmw_is_elementor() )
    {
        $content = get_the_content( null, false );
        $content = apply_filters( 'the_content', $content );
        $content = str_replace( ']]>', ']]&gt;', $content );

        $dom = new Dom;
        $dom->load( $content );
        $sections = $dom->find('._section');

        if ( $sections )
        {
            foreach ( $sections as $section )
            {
                echo $section->outerHtml;
            }
        }
    }
    else
    {
        the_content();
    }
}