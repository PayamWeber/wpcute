<?php

namespace PMW;

use PMW\Inc\Vendor\Model;

class Campaign extends Model
{
    protected $post_type = 'campaign';

    const STATUS_EXPIRED = 'expired';
    const STATUS_ENABLED = 'enabled';

    /**
     * @return mixed
     */
    public function get_status()
    {
        return $this->meta->_campaign_status;
    }

    /**
     * @param string $except
     *
     * @return array
     */
    public static function get_statuses( $except = '' )
    {
        $statuses = [
            self::STATUS_EXPIRED => [
                'name' => __( 'Expired', 'jibit' ),
                'color' => '#ED3B3B',
            ],
            self::STATUS_ENABLED => [
                'name' => __( 'Enable', 'jibit' ),
                'color' => '#32CD32',
            ],
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