<?php

class InstagramHelper extends SocialMediaApiHelper
{
	/**
	 * Api Url
	 *
	 * @var string
	 */
	public $api_url         = 'https://api.instagram.com/v1/users/self/media/recent/?access_token={access_token}';
	public $profile_api_url = 'https://api.instagram.com/v1/users/self/?access_token={access_token}';

	/**
	 * Cache file path
	 */
	const CACHE_PATH = ABSPATH . '/wp-content/uploads/instagram/instagram.json';

	/**
	 * AparatHelper constructor.
	 */
	public function __construct()
	{
		parent::__construct();
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

		return [
			'posts' => $output,
			'profile' => $this->cache[ 'profile' ] ?? false,
		];
	}

	/**
	 * @return array|bool
	 */
	protected function refreshCache()
	{
		$data    = $this->getDataFromTarget( $this->getApiUrl() );
		$profile = $this->getDataFromTarget( $this->getProfileApiUrl() );

		if ( ! $data || ! is_array( $data ) || ( isset( $data[ 'meta' ] ) && $data[ 'meta' ]['code'] != '200' ) || ( isset( $profile[ 'meta' ] ) && $profile[ 'meta' ]['code'] != '200' ) )
			return false;

		$new_cache = [
			'expires_at' => date( 'Y-m-d H:i:s', strtotime( '+24 hours', time() ) ),
			'data' => $data,
			'profile' => $profile,
		];

		if ( ! file_exists( dirname( self::CACHE_PATH ) ) )
			mkdir( dirname( self::CACHE_PATH ), 0775, true );

		$cache_file = fopen( self::CACHE_PATH, "w" );
		fwrite( $cache_file, json_encode( $new_cache ) );
		fclose( $cache_file );

		return $new_cache;
	}

	/**
	 * @return mixed
	 */
	protected function getApiUrl()
	{
		return str_replace( '{access_token}', get_field( 'instagram_access_token', 'option' ), $this->api_url );
	}

	/**
	 * @return mixed
	 */
	protected function getProfileApiUrl()
	{
		return str_replace( '{access_token}', get_field( 'instagram_access_token', 'option' ), $this->profile_api_url );
	}
}