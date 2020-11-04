<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;
use PMW\Package;
use PMW\PackageRequest;
use PMW\Post;
use PMW\SpecialCard;
use PMW\SpecialCardRequest;

class SpecialCardController extends Controller
{
	public $data = [];

	public function index()
	{
		$this->data[ 'special_cards' ] = SpecialCard::query( [
			'posts_per_page' => 0,
		] );

		return View::get( 'special_card.index', 'master', $this->data );
	}

	public function show( $post )
	{
		return View::get( 'special_card.show', 'master', $this->data );
	}

	public function storeRequest()
	{
		$all                      = Input::all();
		$all[ 'captcha' ]         = $all[ 'captcha' ] ?? '';
		$all[ 'captcha' ]         = \StringHelper::number_to_en( $all[ 'captcha' ] );
		$all[ 'user_name' ]       = $all[ 'user_name' ] ?? '';
		$all[ 'mobile' ]          = $all[ 'mobile' ] ?? '';
		$all[ 'mobile' ]          = \StringHelper::number_to_en( $all[ 'mobile' ] );
		$all[ 'city' ]            = $all[ 'city' ] ?? '';
		$all[ 'gender' ]          = $all[ 'gender' ] ?? '';
		$all[ 'special_card_id' ] = $all[ 'special_card_id' ] ?? '';
		$error                    = false;

		switch ( true ) {
			case ( ! $all[ 'captcha' ] || $_SESSION[ 'captcha' ] != $all[ 'captcha' ] ):
				$error = 'لطفا کد امنیتی را وارد کنید';
				break;
			case ( ! $all[ 'user_name' ] || strlen( $all[ 'user_name' ] ) > 200 ):
				$error = 'لطفا نام را وارد کنید';
				break;
			case ( ! $all[ 'mobile' ] || ! is_numeric( $all[ 'mobile' ] ) || strlen( $all[ 'mobile' ] ) > 100 ):
				$error = 'لطفا موبایل خود را وارد کنید';
				break;
			case ( ! $all[ 'city' ] || strlen( $all[ 'city' ] ) > 200 ):
				$error = 'لطفا شهر خود را وارد کنید';
				break;
			case ( ! is_numeric( $all[ 'gender' ] ) || $all[ 'gender' ] > 2 || $all[ 'gender' ] < 1 ):
				$error = 'لطفا جنسیت خود را وارد کنید';
				break;
			case ( ! is_numeric( $all[ 'special_card_id' ] ) || ! $package = SpecialCard::find( $all[ 'special_card_id' ] ) ):
				$error = 'لطفا کارت را وارد کنید';
				break;
		}

		session_destroy();

		if ( $error ) {
			return api_response( false, [ $error ] );
		} else {
			$contact = wp_insert_post( [
				'post_type' => 'special_card_request',
				'post_status' => 'draft',
				'post_title' => mb_substr( str_replace( "\n", ' ', $all[ 'user_name' ] ), 0, 50 ) . '',
			] );

			update_post_meta( $contact, 'special_card_request_username', $all[ 'user_name' ] );
			update_post_meta( $contact, 'special_card_request_user_mobile', $all[ 'mobile' ] );
			update_post_meta( $contact, 'special_card_request_city', $all[ 'city' ] );
			update_post_meta( $contact, 'special_card_request_gender', $all[ 'gender' ] );
			update_post_meta( $contact, 'special_card_request_package_id', $package->ID );

			return api_response( true );
		}
	}

	/**
	 * @param $id
	 */
	public function seen( $id )
	{
		$model = SpecialCardRequest::find( $id );

		if ( is_user_logged_in() && $model ) {
			update_post_meta( $model->ID, 'special_card_request_seen', '1' );
		}

		wp_redirect( Input::get( 'redirect', site_url() ) );
	}
}