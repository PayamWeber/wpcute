<?php

namespace PMW\Inc\Base\Controller;

use PMW\Campaign;
use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;

class FestivalController extends Controller
{
    public $data = [];

    public function index()
    {
        $actives = Campaign::query( [
            'posts_per_page' => 10,
            'order' => 'ASC',
            'orderby' => 'meta_value',
            'meta_type' => 'DATETIME',
            'meta_key' => 'campaign_end_time',
            'meta_query' => [
                'relation' => 'AND',
                [
                    'key' => '_campaign_status',
                    'value' => Campaign::STATUS_ENABLED,
                    'compare' => '=',
                ],
            ],
        ] );
        $expireds = Campaign::query( [
            'posts_per_page' => 30,
            'order' => 'DESC',
            'orderby' => 'meta_value',
            'meta_type' => 'DATETIME',
            'meta_key' => 'campaign_end_time',
            'meta_query' => [
                'relation' => 'AND',
                [
                    'key' => '_campaign_status',
                    'value' => Campaign::STATUS_EXPIRED,
                    'compare' => '=',
                ],
            ],
        ] );
//        $expireds = [];
//
//        if ( $posts )
//        {
//            foreach ( $posts as $post )
//            {
//                if ( $post->get_status() == Campaign::STATUS_EXPIRED )
//                {
//                    $expireds[] = $post;
//                }else
//                {
//                    $actives[] = $post;
//                }
//            }
//        }

        $this->data['actives'] = $actives;
        $this->data['expireds'] = $expireds;
        return View::get( 'festival.index', 'master', $this->data );
    }

    public function disable_expired_campaigns()
    {
        $today_jalali = \JalaliHelper::jdate( 'Y-m-d', time(), 'en' );

        $posts = get_posts( [
            'post_type' => 'campaign',
            'post_status' => 'publish',
            'posts_per_page' => 999,
            'meta_query' => [
                'relation' => 'AND',
                [
                    'key' => 'campaign_end_time',
                    'value' => $today_jalali . ' ' . date( 'H:i:s' ),
                    'compare' => '<=',
                ],
                [
                    'key' => '_campaign_status',
                    'value' => Campaign::STATUS_EXPIRED,
                    'compare' => '!=',
                ],
            ],
        ] );

        $posts_must_be_enabled = get_posts( [
            'post_type' => 'campaign',
            'post_status' => 'publish',
            'posts_per_page' => 999,
            'meta_query' => [
                'relation' => 'AND',
                [
                    'key' => 'campaign_end_time',
                    'value' => $today_jalali . ' ' . date( 'H:i:s' ),
                    'compare' => '>',
                ],
                [
                    'key' => '_campaign_status',
                    'value' => Campaign::STATUS_EXPIRED,
                    'compare' => '==',
                ],
            ],
        ] );

        if ( $posts )
        {
            foreach ( $posts as $post )
            {
                update_post_meta( $post->ID, '_campaign_status', Campaign::STATUS_EXPIRED );
            }
        }

        if ( $posts_must_be_enabled )
        {
            foreach ( $posts_must_be_enabled as $post )
            {
                update_post_meta( $post->ID, '_campaign_status', Campaign::STATUS_ENABLED );
            }
        }
    }
}