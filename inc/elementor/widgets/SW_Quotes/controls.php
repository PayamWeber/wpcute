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
    'items',
    [
        'label' => __( 'Items', 'snowa' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'fields' => [
            [
                'name' => 'image',
                'label' => __( 'Main Image', 'snowa' ),
                'type' => Controls_Manager::MEDIA,
            ],
            [
                'name' => 'author_image',
                'label' => __( 'Author Image', 'snowa' ),
                'type' => Controls_Manager::MEDIA,
            ],
            [
                'name' => 'author_name',
                'label' => __( 'Author', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Author', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'content',
                'label' => __( 'Content', 'snowa' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Content', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'post_url',
                'label' => __( 'Post Url', 'snowa' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ],
            [
                'name' => 'author_url',
                'label' => __( 'Author Url', 'snowa' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ],
			[
				'name' => 'button_text',
				'label' => __( 'Instagram Text', 'snowa' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'See more at instagram', 'snowa' ),
				'label_block' => true,
			],
			[
				'name' => 'is_video',
				'label' => __( 'Video', 'snowa' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'label_block' => true,
			],
        ],
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';