<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
    'content_section',
    [
        'label' => __( 'Content', 'snowa' ),
    ]
);
$this->add_control(
    'reverse_mode',
    [
        'label' => __( 'Reverse Mode', 'snowa' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
    ]
);
$this->add_control(
    'dark_mode',
    [
        'label' => __( 'Dark Mode', 'snowa' ),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'default' => '',
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
    'main_desc',
    [
        'label' => __( 'Description', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => '',
    ]
);
$this->add_control(
    'style',
    [
        'label' => __( 'Media Style', 'snowa' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'multiple' => false,
        'options' => [
            '360' => __( '360 Image', 'snowa' ),
            'item_image' => __( 'Image', 'snowa' ),
        ],
        'default' => '360',
    ]
);
$this->add_control(
    'main_image',
    [
        'label' => __( 'Image', 'snowa' ),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'dynamic' => [
            'active' => true,
        ],
        'default' => [
            'url' => '',
        ],
        'condition' => [
            'style' => 'item_image',
        ],
    ]
);
$this->add_control(
    'images',
    [
        'label' => __( '360 Colors', 'snowa' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'fields' => [
            [
                'name' => 'image',
                'label' => __( 'Upload a zip file of images', 'snowa' ),
                'type' => 'file_uploader',
            ],
            [
                'name' => 'color',
                'label' => __( 'Pick a color', 'snowa' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ],
        ],
        'condition' => [
            'style' => '360',
        ],
    ]
);
$this->add_control(
    'items_style',
    [
        'label' => __( 'Items Style', 'snowa' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'multiple' => false,
        'options' => [
            'one' => __( 'One Column', 'snowa' ),
            'two' => __( 'Two Columns', 'snowa' ),
            'three' => __( 'Three Columns', 'snowa' ),
        ],
        'default' => 'one',
    ]
);
$this->add_control(
    'items',
    [
        'label' => __( 'Items', 'snowa' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'fields' => [
            [
                'name' => 'image',
                'label' => __( 'Choose An Image', 'snowa' ),
                'type' => 'file_uploader',
            ],
            [
                'name' => 'title',
                'label' => __( 'Title', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Title', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'desc',
                'label' => __( 'Description', 'snowa' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Description', 'snowa' ),
                'label_block' => true,
            ],
        ],
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';