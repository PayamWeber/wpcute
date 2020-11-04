<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
    'content_section',
    [
        'label' => __( 'Content', 'snowa' ),
    ]
);
$this->add_control(
    'main_title',
    [
        'label' => __( 'Title', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
    ]
);
$this->add_control(
    'main_subtitle',
    [
        'label' => __( 'Sub Title', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
    ]
);
$this->add_control(
    'gray_mode',
    [
        'label' => __( 'Gray Background', 'snowa' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'default' => 'yes',
    ]
);
$this->add_control(
    'items',
    [
        'label' => __( 'Images', 'snowa' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'fields' => [
            [
                'name' => 'image',
                'label' => __( 'Choose An Image', 'snowa' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
            ],
            [
                'name' => 'show_pin',
                'label' => __( 'Pin a location', 'snowa' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ],
            [
                'name' => 'pin_text',
                'label' => __( 'Pin Text', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Pin Text', 'snowa' ),
                'label_block' => true,
                'condition' => [
                    'show_pin' => 'yes',
                ],
            ],
            [
                'name' => 'pin_top',
                'label' => __( 'Pin distance from top', 'snowa' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '50',
                'label_block' => false,
                'condition' => [
                    'show_pin' => 'yes',
                ],
            ],
            [
                'name' => 'pin_left',
                'label' => __( 'Pin distance from left', 'snowa' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '50',
                'label_block' => false,
                'condition' => [
                    'show_pin' => 'yes',
                ],
            ],
            [
                'name' => 'show_video',
                'label' => __( 'Show Video', 'snowa' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ],
            [
                'name' => 'video_url',
                'label' => __( 'Video Address', 'snowa' ),
                'type' => Controls_Manager::URL,
                'default' => '',
                'label_block' => true,
                'condition' => [
                    'show_video' => 'yes',
                ],
            ],
        ],
    ]
);
$this->add_control(
    'show_button',
    [
        'label' => __( 'Show Button', 'snowa' ),
        'label_block' => false,
        'type' => Controls_Manager::SWITCHER,
        'default' => '',
    ]
);
$this->add_control(
    'button_text',
    [
        'label' => __( 'Button Text', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
        'condition' => [
            'show_button' => 'yes',
        ],
    ]
);
$this->add_control(
    'button_url',
    [
        'label' => __( 'Button Url', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::URL,
        'condition' => [
            'show_button' => 'yes',
        ],
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';