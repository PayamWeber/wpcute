<?php

return [
    'key' => 'campaign_group_settings',
    'title' => __( 'Campaign Settings', 'artist' ),
    'fields' => [
        [
            'key' => 'campaign_end_time',
            'label' => __( 'Campaign end time', 'artist' ),
            'name' => 'campaign_end_time',
            'type' => 'persian_datepicker',
            'required' => true,
        ],
        [
            'key' => 'campaign_image',
            'label' => __( 'Campaign image', 'artist' ),
            'name' => 'campaign_image',
            'type' => 'image',
            'preview_size' => 'medium',
            'return_format' => 'id',
        ],
        [
            'key' => 'campaign_url',
            'label' => __( 'Campaign Link', 'artist' ),
            'name' => 'campaign_url',
            'type' => 'url',
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'campaign',
            ],
        ],
    ],
];