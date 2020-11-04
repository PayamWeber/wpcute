<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;

class NotFoundController extends Controller
{
	public $data = [];

	public function index()
	{
		return View::get( '404.index', 'master', $this->data );
	}
}