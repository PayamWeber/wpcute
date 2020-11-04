<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;

class RetailersController extends Controller
{
	public $data = [];

	public function index()
	{

		return View::get( 'retailers.index', 'master', $this->data );
	}
}