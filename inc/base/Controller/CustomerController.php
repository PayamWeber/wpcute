<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;
use PMW\Post;

class CustomerController extends Controller
{
	public $data = [];

	public function login()
	{
		$this->data['image'] = wp_get_attachment_image_url( get_field( 'image' ), 'full' );
		$this->data['text2'] = strip_tags( get_field( 'text2' ), '<a><br><p>' );

		if ( mb_substr( $this->data['text2'], 0, 2 ) != '<p' )
			$this->data['text2'] = '<p>' . $this->data['text2'] . '</p>';

		return View::get( 'customers.login', 'master', $this->data );
	}
}