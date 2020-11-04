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
    'show_video',
    [
        'label' => __( 'Show Video', 'snowa' ),
        'label_block' => false,
        'type' => Controls_Manager::SWITCHER,
    ]
);
$this->add_control(
    'video_url',
    [
        'label' => __( 'Video Url', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::URL,
        'condition' => [
            'show_video' => 'yes'
        ]
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';