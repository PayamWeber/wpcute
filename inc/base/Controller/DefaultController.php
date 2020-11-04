<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;
use PMW\Music;
use PMW\Photo;
use PMW\Post;

class DefaultController extends Controller
{

	public $data = [];

	public function index()
	{
		ob_start();
		if ( function_exists( 'add_revslider' ) ){
			add_revslider('home');
		}
		$this->data['slider'] = ob_get_clean();
		$this->data['articles'] = $this->featuredArticles();
		$this->data['photos'] = $this->photos();
		return View::get( 'home.index', 'master', $this->data );
	}

	public function photos()
	{
		return Photo::query( [
			'posts_per_page' => 15,
		] );
	}

	public function featuredArticles()
	{
		$posts = Post::query([
			'posts_per_page' => 3,
		]);

		return $posts;
	}

	/**
	 * @throws \InvalidArgumentTypeException
	 */
	public function captcha()
	{
		$char = strtoupper( substr( str_shuffle( 'abcdefghjkmnpqrstuvwxyz' ), 0, 4 ) );
		$str  = rand( 1, 7 ) . rand( 1, 7 ) . rand( 1, 7 ) . rand( 1, 7 );
		$_SESSION['captcha'] = $str;

		$bg_file = get_template_directory() . '/assets/theme/captcha/bg.png';
		if ( ! isset( $bg_file ) ) {
			die();
		}

		$image = imagecreatefrompng( $bg_file );

		$colour = imagecolorallocate( $image, 123, 95, 67 );

		// font file path
		$font = get_template_directory() . '/assets/theme/captcha/Astloch-Regular.ttf';

		// if we can use custom font then use it otherwise use the simple font
		if ( function_exists( 'imagettftext' ) && file_exists( $font ) ) {
			$rotate = rand( -8, 10 );
			imagettftext( $image, 22, $rotate, rand(15, 45), rand(20, 35), $colour, $font, $str );
		} else {
			$rotateX = rand( 1, 78 );
			$rotateY = rand( 1, 28 );
			imagestring( $image, 15, $rotateX, $rotateY, $str, $colour );
		}

		header( 'Content-type: image/png' );
		header( 'Cache-control: no-cache' );
		imagepng( $image );

		die();
	}
}