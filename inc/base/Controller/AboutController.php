<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;
use PMW\Post;

class AboutController extends Controller
{
	public $data = [];

	public function index()
	{
		return View::get( 'about.index', 'master', $this->data );
	}
}