<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;

class AgentsController extends Controller
{
	public $data = [];

	public function index()
	{

		return View::get( 'agents.index', 'master', $this->data );
	}
}