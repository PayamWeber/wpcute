<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;
use PMW\Photo;
use PMW\Post;

class GalleryController extends Controller
{
	public $data = [];

	public function albums()
	{
		$this->data[ 'albums' ] = get_terms( [
			'taxonomy' => 'photo_album',
			'hide_empty' => false,
		] );
		return View::get( 'gallery.albums', 'master', $this->data );
	}

	public function showAlbum()
	{
		$this->data[ 'posts' ] = Photo::query( [
			'posts_per_page' => 999,
//			'tax_query' => [
//				'relation' => 'AND',
//				[
//					'taxonomy' => 'photo_album',
//					'field' => 'term_id',
//					'terms' => get_queried_object_id(),
//					'operator' => 'IN',
//				],
//			],
		] );
		$this->data[ 'intro_title' ] = get_term_meta( get_queried_object_id(), 'introduction_album_title', true );
		$this->data[ 'intro_subtitle' ] = get_term_meta( get_queried_object_id(), 'introduction_album_subtitle', true );
		return View::get( 'gallery.show_album', 'master', $this->data );
	}
}