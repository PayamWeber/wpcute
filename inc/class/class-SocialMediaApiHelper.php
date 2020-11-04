<?php

abstract class SocialMediaApiHelper
{
	/**
	 * Api Url
	 *
	 * @var string
	 */
	public $api_url = '';

	/**
	 * Cache file path
	 */
	const CACHE_PATH = ABSPATH . '/wp-content/uploads/test/test.json';

	/**
	 * @var array
	 */
	protected $cache;

	/**
	 * AparatHelper constructor.
	 */
	public function __construct()
	{
	}

	/**
	 * Get data as an array of videos
	 *
	 * @return array|bool|mixed
	 */
	public function getData()
	{
		$this->cache = $this->getCache();

		if ( ! $this->cache || ! is_array( $this->cache ) )
		{
			$this->cache = $this->refreshCache();

			if ( ! $this->cache || ! is_array( $this->cache ) )
			{
				// when aparat has an error or returning empty response
				return false;
			}
		}

		$this->cache[ 'expires_at' ] = $this->cache[ 'expires_at' ] ?? false;

		if ( $this->cache[ 'expires_at' ] === false || $this->cache[ 'expires_at' ] < date( 'Y-m-d H:i:s' ) )
		{
			$this->cache = $this->refreshCache();

			if ( ! $this->cache || ! is_array( $this->cache ) )
			{
				// when aparat has an error or returning empty response
				return false;
			}
		}

		$output = isset( $this->cache[ 'data' ] ) ? $this->cache[ 'data' ] : [];

		return $output;
	}

	/**
	 * @return array|bool|mixed|object
	 */
	protected function getDataFromTarget( $url = null )
	{
		$curl = curl_init();

		curl_setopt_array( $curl, [
			CURLOPT_URL => $url ? : $this->getApiUrl(),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_CUSTOMREQUEST => "GET",
		] );
		$response = curl_exec( $curl );
		curl_close( $curl );

		return $response ? json_decode( $response, true ) : false;
	}

	/**
	 * @return array|bool
	 */
	protected function refreshCache()
	{
		$data = $this->getDataFromTarget();

		if ( ! $data || ! is_array( $data ) )
			return false;

		$new_cache = [
			'expires_at' => date( 'Y-m-d H:i:s', strtotime( '+24 hours', time() ) ),
			'data' => $data,
		];

		if ( ! file_exists( dirname( static::CACHE_PATH ) ) )
			mkdir( dirname( static::CACHE_PATH ), 0775, true );

		$cache_file = fopen( static::CACHE_PATH, "w" );
		fwrite( $cache_file, json_encode( $new_cache ) );
		fclose( $cache_file );

		return $new_cache;
	}

	/**
	 * @return array|bool|mixed|object
	 */
	protected function getCache()
	{
		if ( ! file_exists( static::CACHE_PATH ) )
			return false;

		$cache_file = fopen( static::CACHE_PATH, "r" );
		$cache      = fread( $cache_file, filesize( static::CACHE_PATH ) );
		fclose( $cache_file );

		return $cache ? json_decode( $cache, true ) : false;
	}

	/**
	 * @return mixed
	 */
	protected function getApiUrl()
	{
		return $this->api_url;
	}
}