<?php

namespace PMW\Inc\Base\Controller;

use PMW\Faq;
use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;

class FaqController extends Controller
{
	public $data = [];

	public function index()
	{
		$this->data['categories'] = get_terms( [
			'taxonomy' => 'faq_cat',
		] );
		$this->data['questions'] = Faq::query();

		return View::get( 'faq.index', 'master', $this->data );
	}
}