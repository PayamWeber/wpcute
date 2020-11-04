<?php

namespace PMW\Inc\Base\Controller;

use PMW\Consultation;
use PMW\Contact;
use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;

class ContactController extends Controller
{
	public $data = [];

	public function index()
	{
		return View::get( 'contact.index', 'master', $this->data );
	}

	public function store()
	{
		$all                = Input::all();
		$all[ 'captcha' ]   = $all[ 'captcha' ] ?? '';
		$all[ 'captcha' ]   = \StringHelper::number_to_en( $all[ 'captcha' ] );
		$all[ 'user_name' ] = $all[ 'user_name' ] ?? '';
		$all[ 'mobile' ]    = $all[ 'mobile' ] ?? '';
		$all[ 'mobile' ]    = \StringHelper::number_to_en( $all[ 'mobile' ] );
		$all[ 'message' ]   = $all[ 'message' ] ?? '';
		$error              = false;

		switch ( true ) {
			case ( ! $all[ 'captcha' ] || $_SESSION[ 'captcha' ] != $all[ 'captcha' ] ):
				$error = 'لطفا کد امنیتی را وارد کنید';
				break;
			case ( ! $all[ 'user_name' ] || strlen( $all[ 'user_name' ] ) > 200 ):
				$error = 'لطفا نام را وارد کنید';
				break;
			case ( ! $all[ 'mobile' ] || strlen( $all[ 'mobile' ] ) > 100 ):
				$error = 'لطفا موبایل خود را وارد کنید';
				break;
			case ( ! $all[ 'message' ] || strlen( $all[ 'message' ] ) > 3000 ):
				$error = 'لطفا پیغام خود را وارد کنید';
				break;
		}

		session_destroy();

		if ( $error ) {
			return api_response( false, [ $error ] );
		} else {
			$contact = wp_insert_post( [
				'post_type' => 'contact',
				'post_status' => 'draft',
				'post_title' => mb_substr( str_replace( "\n", ' ', $all[ 'message' ] ), 0, 50 ) . '...',
			] );

			update_post_meta( $contact, 'contact_username', $all[ 'user_name' ] );
			update_post_meta( $contact, 'contact_user_mobile', $all[ 'mobile' ] );
			update_post_meta( $contact, 'contact_message_text', $all[ 'message' ] );

			return api_response( true );
		}
	}

	public function storeConsultation()
	{
		$all                = Input::all();
		$all[ 'captcha' ]   = $all[ 'captcha' ] ?? '';
		$all[ 'captcha' ]   = \StringHelper::number_to_en( $all[ 'captcha' ] );
		$all[ 'mobile' ]    = $all[ 'mobile' ] ?? '';
		$all[ 'mobile' ]    = \StringHelper::number_to_en( $all[ 'mobile' ] );
		$error              = false;

		switch ( true ) {
			case ( ! $all[ 'captcha' ] || $_SESSION[ 'captcha' ] != $all[ 'captcha' ] ):
				$error = 'لطفا کد امنیتی را وارد کنید';
				break;
			case ( ! $all[ 'mobile' ] || strlen( $all[ 'mobile' ] ) > 100 ):
				$error = 'لطفا موبایل خود را وارد کنید';
				break;
		}

		session_destroy();

		if ( $error ) {
			return api_response( false, [ $error ] );
		} else {
			$contact = wp_insert_post( [
				'post_type' => 'consultation',
				'post_status' => 'draft',
				'post_title' => $all[ 'mobile' ],
			] );

			update_post_meta( $contact, 'consultation_user_mobile', $all[ 'mobile' ] );

			return api_response( true );
		}
	}

	/**
	 * @param $id
	 */
	public function consultationSeen( $id )
	{
		$model = Consultation::find( $id );

		if ( is_user_logged_in() && $model ){
			update_post_meta( $model->ID, 'consultation_seen', '1' );
		}

		wp_redirect( Input::get('redirect', site_url()) );
	}

	/**
	 * @param $id
	 */
	public function seen( $id )
	{
		$model = Contact::find( $id );

		if ( is_user_logged_in() && $model ){
			update_post_meta( $model->ID, 'contact_seen', '1' );
		}

		wp_redirect( Input::get('redirect', site_url()) );
	}
}