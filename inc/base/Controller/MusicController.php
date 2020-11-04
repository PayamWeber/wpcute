<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;
use PMW\Music;
use PMW\Post;

class MusicController extends Controller
{
	public $data = [];

	public function filter()
	{
		$query_args = [
			'posts_per_page' => get_field( 'blog_posts_per_page', 'option' ) ? : 12,
			'paged' => Input::get( 'page_number', 1 ),
			'post_status' => 'publish',
			'post_type' => [ 'post', 'external' ],
		];

		if ( is_category() )
			$query_args[ 'cat' ] = get_queried_object_id();

		return new \WP_Query( $query_args );
	}

	public function index()
	{
		$this->data[ 'posts' ]         = $this->filter();
		$this->data[ 'cats' ]          = get_terms( [
			'taxonomy' => 'category',
			'hide_empty' => false,
			'exclude' => 1,
		] );
		$this->data[ 'aparat_videos' ] = get_aparat_videos();
		$this->data[ 'aparat_uid' ]    = get_field( 'aparat_id', 'option' );
		$this->data[ 'page' ]          = get_field( '_page_blog', 'option' );

		return View::get( 'blog.index.index', 'master', $this->data );
	}

	public function show( $music )
	{
		$this->data[ 'music' ]          = $music;
		$this->data[ 'related_posts' ] = Music::query( [
			'posts_per_page' => 6,
			'exclude' => $post->ID,
			'tax_query' => [
				'relation' => 'OR',
				[
					'taxonomy' => 'category',
					'field' => 'term_id',
					'terms' => $_cats,
					'operator' => 'IN',
				],
				[
					'taxonomy' => 'tag',
					'field' => 'term_id',
					'terms' => $_tags,
					'operator' => 'IN',
				],
			],
		] );

		return View::get( 'music.show', 'master', $this->data );
	}
}