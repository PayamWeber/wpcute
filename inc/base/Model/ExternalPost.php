<?php

namespace PMW;

use PMW\Inc\Vendor\Model;

class ExternalPost extends Model
{
	protected $post_type = 'external';

	const TYPE_VIDEO   = 5;
	const TYPE_QUOTE   = 10;
	const TYPE_HASHTAG = 15;
	const TYPE_IMAGE   = 20;

	/**
	 * @param string $except
	 *
	 * @return array
	 */
	public static function get_types( $except = '' )
	{
		$statuses = [
			self::TYPE_VIDEO => __( 'Video', 'snowa' ),
			self::TYPE_QUOTE => __( 'Quote', 'snowa' ),
			self::TYPE_HASHTAG => __( 'HashTag', 'snowa' ),
			self::TYPE_IMAGE => __( 'Image', 'snowa' ),
		];

		if ( $except && is_array( $except ) )
		{
			foreach ( $except as $name )
			{
				if ( isset( $statuses[ $name ] ) )
				{
					unset( $statuses[ $name ] );
				}
			}
		} else if ( $except && isset( $statuses[ $except ] ) )
		{
			unset( $statuses[ $except ] );
		}

		return $statuses;
	}
}