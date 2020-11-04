<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;
use PMW\Post;
use PMW\Service;

class ServiceController extends Controller
{
	public $data = [];

	public function index()
	{
		$this->data[ 'posts' ] = Service::query();

		return View::get( 'service.index', 'master', $this->data );
	}

	public function show( $post )
	{
		$this->data[ 'services' ]   = Service::query();

		return View::get( 'service.show', 'master', $this->data );
	}
}