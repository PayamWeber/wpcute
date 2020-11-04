<?php
use \Elementor\Controls_Manager;

$this->start_controls_section(
    'section_content',
    [
        'label' => __( 'Content', 'snowa' ),
    ]
);
$this->add_control(
    'main_title',
    [
        'label' => __( 'Main Title', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
    ]
);
$this->add_control(
    'main_subtitle',
    [
        'label' => __( 'Main Sub Title', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
    ]
);
$this->add_control(
    'main_content_text',
    [
        'label' => __( 'Main Content Text', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXTAREA,
    ]
);
$this->add_control(
    'background_image',
    [
        'label' => __( 'Background Top Image', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::MEDIA,
        'dynamic' => [
            'active' => true,
        ],
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
        ],
        'default' => [
            [
                'title' => __( 'Slide Title #1', 'snowa' ),
            ],
        ],
        'title_field' => '{{{ title }}}',
    ]
);
$this->add_control(
    'images',
    [
        'label' => __( 'Images Under Slider', 'snowa' ),
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
        ],
        'default' => [
            [
                'title' => __( 'Image Title #1', 'snowa' ),
            ],
        ],
        'title_field' => '{{{ title }}}',
    ]
);
$this->add_control(
    'reverse_direction',
    [
        'label' => __( 'Reverse Direction', 'snowa' ),
        'label_block' => false,
        'type' => Controls_Manager::SWITCHER,
    ]
);
$this->add_control(
    'gray_bg',
    [
        'label' => __( 'Gray Background', 'snowa' ),
        'label_block' => false,
        'type' => Controls_Manager::SWITCHER,
    ]
);
$this->add_control(
    'show_button',
    [
        'label' => __( 'Show Button', 'snowa' ),
        'label_block' => false,
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes'
    ]
);
$this->add_control(
    'button_text',
    [
        'label' => __( 'Button Text', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
        'condition' => [
            'show_button' => 'yes'
        ]
    ]
);
$this->add_control(
    'button_url',
    [
        'label' => __( 'Button Url', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::URL,
        'condition' => [
            'show_button' => 'yes'
        ]
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';