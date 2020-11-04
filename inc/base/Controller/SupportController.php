<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Page;

class SupportController extends Controller
{
	public $data = [];

	public function index()
	{
		$this->data['faq_page'] = Page::find( get_field( '_page_faq', 'option' ) );
		$this->data['faq_url'] = get_permalink( $this->data['faq_page']->post_object );
		$this->data['faq_links'] = get_field( 'faq_selection' );

		return View::get( 'support.index', 'master', $this->data );
	}
}