<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;
use PMW\Post;

class BlogController extends Controller
{
	public $data = [];

	public function filter()
	{
		$query_args = [
			'posts_per_page' => 12,
			'paged' => Input::get( 'page_number', 1 ),
			'post_status' => 'publish',
			'post_type' => [ 'post', 'external' ],
			's' => Input::get( 'search', '' )
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
		$this->data[ 'most_viewed' ]   = Post::query( [
			'orderby' => 'meta_value_num',
			'meta_key' => 'views_count',
			'order' => 'DESC',
			'posts_per_page' => 6,
		] );

		return View::get( 'blog.index.index', 'master', $this->data );
	}

	public function show( $post )
	{
		$this->data[ 'post' ] = $post;

		/**
		 * update views count by +1
		 */
		$views = $post->meta->views_count ?? 0;
		update_post_meta( $post->ID, 'views_count', $views + 1 );

		$this->data[ 'most_viewed' ]   = Post::query( [
			'orderby' => 'meta_value_num',
			'meta_key' => 'views_count',
			'order' => 'DESC',
			'posts_per_page' => 6,
		] );

		return View::get( 'blog.show', 'master', $this->data );
	}
}