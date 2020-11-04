<?php
namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;

class ProductCatController extends Controller
{
    public $data = [];

    public function index()
    {
        return View::get( 'product_cat.index', 'master', $this->data );
    }
}