<?php

class AparatHelper extends SocialMediaApiHelper
{
	/**
	 * Api Url
	 *
	 * @var string
	 */
	public $api_url = 'https://www.aparat.com//etc/api/videoByUser/username/{id}/perpage/6';

	/**
	 * Cache file path
	 */
	const CACHE_PATH = ABSPATH . '/wp-content/uploads/aparat/aparat.json';

	/**
	 * Aparat username
	 *
	 * @var mixed|void|null
	 */
	private $aparat_id;

	/**
	 * AparatHelper constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->aparat_id = get_field( 'aparat_id', 'option' );
	}

	/**
	 * Get data as an array of videos
	 *
	 * @return array|bool|mixed
	 */
	public function getData()
	{
		$output = parent::getData();

		if ( $output === false )
		{
			return false;
		}

		return isset( $output[ 'videobyuser' ] ) ? $output[ 'videobyuser' ] : $output;
	}

	/**
	 * @return mixed
	 */
	protected function getApiUrl()
	{
		return str_replace( '{id}', $this->aparat_id, parent::getApiUrl() );
	}
}