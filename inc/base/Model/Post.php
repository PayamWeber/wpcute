<?php

namespace PMW;

use PMW\Inc\Vendor\Model;

class Post extends Model
{
	protected $post_type = 'post';

	const TYPE_DEFAULT = 5;
	const TYPE_VIDEO   = 10;

	/**
	 * @param string $except
	 *
	 * @return array
	 */
	public static function get_types( $except = '' )
	{
		$statuses = [
			self::TYPE_DEFAULT => __( 'Default', 'artist' ),
			self::TYPE_VIDEO => __( 'Video', 'artist' ),
		];

		if ( $except && is_array( $except ) ) {
			foreach ( $except as $name ) {
				if ( isset( $statuses[ $name ] ) ) {
					unset( $statuses[ $name ] );
				}
			}
		} else if ( $except && isset( $statuses[ $except ] ) ) {
			unset( $statuses[ $except ] );
		}

		return $statuses;
	}
}