<?php

namespace PMW\Inc\Base\Controller;

use PMW\Event;
use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;
use PMW\Post;

class EventController extends Controller
{
	public $data = [];

	public function index()
	{
		$query_args = [
			'posts_per_page' => 10,
			'paged' => Input::get( 'page_number', 1 ),
			'post_status' => 'publish',
			'post_type' => [ 'event' ],
		];
		$this->data[ 'posts' ] = new \WP_Query( $query_args );

		return View::get( 'event.index', 'master', $this->data );
	}

	public function show( $post )
	{
		return View::get( 'event.show', 'master', $this->data );
	}
}