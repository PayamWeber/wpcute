<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
    'content_section',
    [
        'label' => __( 'Content', 'artist' ),
    ]
);
$this->add_control(
    'main_title',
    [
        'label' => __( 'Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
    ]
);
$this->add_control(
    'main_subtitle',
    [
        'label' => __( 'Sub Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
    ]
);
$this->add_control(
    'main_image',
    [
        'label' => __( 'Image', 'artist' ),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'dynamic' => [
            'active' => true,
        ],
        'default' => [
            'url' => '',
        ],
    ]
);
$this->add_control(
    'items',
    [
        'label' => __( 'Items', 'artist' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'fields' => [
            [
                'name' => 'image',
                'label' => __( 'Choose An Image', 'artist' ),
                'type' => 'file_uploader',
            ],
            [
                'name' => 'title',
                'label' => __( 'Title', 'artist' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Title', 'artist' ),
                'label_block' => true,
            ],
            [
                'name' => 'desc',
                'label' => __( 'Description', 'artist' ) . '(' . __( 'Only for second style', 'artist' ) . ')',
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Description', 'artist' ),
                'label_block' => true,
            ],
        ],
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';