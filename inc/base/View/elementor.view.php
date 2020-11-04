<?php
use PHPHtmlParser\Dom;

if ( isset( $page_id ) && $page_id && is_numeric( $page_id ) )
{
	if ( ! pmw_is_elementor() )
	{
		$content = ( new \Elementor\Frontend() )->get_builder_content_for_display( $page_id ) ? : '';

		$dom = new Dom;
		$dom->load( $content );
		$sections = $dom->find( '._section' );

		if ( $sections )
		{
			foreach ( $sections as $section )
			{
				echo $section->outerHtml;
			}
		}
	} else
	{
		echo ( new \Elementor\Frontend() )->get_builder_content( $page_id );
	}
} else
{
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
			$sections = $dom->find( '._section' );

			if ( $sections )
			{
				foreach ( $sections as $section )
				{
					echo $section->outerHtml;
				}
			}
		} else
		{
			the_content();
		}
	}
}
