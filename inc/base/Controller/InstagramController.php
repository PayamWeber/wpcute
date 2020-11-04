<?php

namespace PMW\Inc\Base\Controller;

use InstagramHelper;
use PMW\Inc\Vendor\Controller;

class InstagramController extends Controller
{
	public function index()
	{
		$instagram = new InstagramHelper();

		return $instagram->getData();
	}
}