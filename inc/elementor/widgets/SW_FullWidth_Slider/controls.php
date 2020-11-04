<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
    'slider_section',
    [
        'label' => __( 'Slider', 'snowa' ),
    ]
);
$this->add_control(
    'style',
    [
        'label' => __( 'Style', 'snowa' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'multiple' => false,
        'options' => [
            'index' => __( 'Style 1', 'snowa' ),
            'product' => __( 'Style 2', 'snowa' ),
            'about' => __( 'Style 3', 'snowa' ),
            'support' => __( 'Style 4', 'snowa' ),
        ],
        'default' => 'index',
    ]
);
$this->add_control(
    'slider_images',
    [
        'label' => __( 'Slider Images', 'snowa' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'fields' => [
            [
                'name' => 'title',
                'label' => __( 'Title', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Slide Title', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'subtitle',
                'label' => __( 'Sub Title', 'snowa' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Slide Sub Title', 'snowa' ),
                'label_block' => true,
            ],
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
                'name' => 'show_button',
                'label' => __( 'Show Button', 'snowa' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_block' => true,
            ],
            [
                'name' => 'button_text',
                'label' => __( 'Button Text', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Learn more', 'snowa' ),
                'label_block' => true,
                'condition' => [
                    'show_button' => 'yes',
                ],
            ],
            [
                'name' => 'button_url',
                'label' => __( 'Button Url', 'snowa' ),
                'type' => Controls_Manager::URL,
                'default' => '',
                'label_block' => true,
                'condition' => [
                    'show_button' => 'yes',
                ],
            ],
        ],
        'default' => [
            [
                'title' => __( 'Slide Title #1', 'snowa' ),
            ],
        ],
        'title_field' => '{{{ title }}}',
    ]
);
$this->end_controls_section();
$this->start_controls_section(
    'box_section',
    [
        'label' => __( 'Box', 'snowa' ),
    ]
);
$this->add_control(
    'show_bottom_box',
    [
        'label' => __( 'Show Box', 'snowa' ),
        'label_block' => false,
        'type' => Controls_Manager::SWITCHER,
        'default' => ''
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
                'name' => 'title',
                'label' => __( 'Title', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Slide Title', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'desc',
                'label' => __( 'Description', 'snowa' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Slide Description', 'snowa' ),
                'description' => __( 'For Special Words you can enter your text into [] brackets', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'image',
                'label' => __( 'Choose An Image', 'snowa' ),
                'type' => 'file_uploader',
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
            ],
            /*[
                'name' => 'url',
                'label' => __( 'Url', 'snowa' ),
                'type' => Controls_Manager::URL,
                'default' => '',
                'label_block' => true,
            ],*/
        ],
        'default' => [
            [
                'title' => __( 'Slide Title #1', 'snowa' ),
            ],
        ],
        'title_field' => '{{{ title }}}',
        'condition' => [
            'show_bottom_box' => 'yes',
        ],
    ]
);
$this->add_control(
    'box_button_show',
    [
        'label' => __( 'Show Button', 'snowa' ),
        'label_block' => false,
        'type' => Controls_Manager::SWITCHER,
        'default' => '',
        'condition' => [
            'show_bottom_box' => 'yes',
        ],
    ]
);
$this->add_control(
    'box_button_image',
    [
        'label' => __( 'Button Image', 'snowa' ),
        'label_block' => true,
        'type' => 'file_uploader',
        'condition' => [
            'show_bottom_box' => 'yes',
            'box_button_show' => 'yes',
        ],
    ]
);
$this->add_control(
    'box_button_text',
    [
        'label' => __( 'Button Text', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
        'condition' => [
            'show_bottom_box' => 'yes',
            'box_button_show' => 'yes',
        ],
    ]
);
$this->add_control(
    'box_button_url',
    [
        'label' => __( 'Button Url', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::URL,
        'condition' => [
            'show_bottom_box' => 'yes',
            'box_button_show' => 'yes',
        ],
    ]
);
$this->add_control(
    'box_button_is_video',
    [
        'label' => __( 'Open Modal', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::SWITCHER,
        'condition' => [
            'show_bottom_box' => 'yes',
            'box_button_show' => 'yes',
        ],
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';