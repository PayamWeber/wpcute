<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
    'right_content_section',
    [
        'label' => __( 'Right Content', 'snowa' ),
    ]
);
$this->add_control(
    'main_title_right',
    [
        'label' => __( 'Title', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
    ]
);
$this->add_control(
    'main_desc_right',
    [
        'label' => __( 'Description', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => '',
    ]
);
$this->add_control(
    'main_image_right',
    [
        'label' => __( 'Image', 'snowa' ),
        'type' => 'file_uploader',
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
$this->start_controls_section(
    'left_content_section',
    [
        'label' => __( 'Left Content', 'snowa' ),
    ]
);
$this->add_control(
    'main_title_left',
    [
        'label' => __( 'Title', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
    ]
);
$this->add_control(
    'main_desc_left',
    [
        'label' => __( 'Description', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => '',
    ]
);
$this->add_control(
    'main_image_left',
    [
        'label' => __( 'Image', 'snowa' ),
        'type' => 'file_uploader',
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
$this->start_controls_section(
    'center_content_section',
    [
        'label' => __( 'Center Content', 'snowa' ),
    ]
);
$this->add_control(
    'main_desc_center',
    [
        'label' => __( 'Description', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => '',
    ]
);
$this->add_control(
    'main_title_center',
    [
        'label' => __( 'Title', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
    ]
);
$this->add_control(
    'second_title_center',
    [
        'label' => __( 'Subtitle', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
    ]
);
$this->end_controls_section();

//---------------------------------------------------------------------------------------------//
$this->start_controls_section(
    'menu_section_right',
    [
        'label' => __( 'Side Menu (Right Section)', 'snowa' ),
    ]
);
$this->add_control(
    'section_icon_right',
    [
        'label' => __( 'Section Icon', 'snowa' ),
        'label_block' => true,
        'type' => 'file_uploader',
    ]
);
$this->add_control(
    'section_menu_title_right',
    [
        'label' => __( 'Section Title', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
    ]
);
$this->add_control(
    'section_hashtag_right',
    [
        'label' => __( 'Section Hashtag', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
$this->start_controls_section(
    'menu_section_left',
    [
        'label' => __( 'Side Menu (Left Section)', 'snowa' ),
    ]
);
$this->add_control(
    'section_icon_left',
    [
        'label' => __( 'Section Icon', 'snowa' ),
        'label_block' => true,
        'type' => 'file_uploader',
    ]
);
$this->add_control(
    'section_menu_title_left',
    [
        'label' => __( 'Section Title', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
    ]
);
$this->add_control(
    'section_hashtag_left',
    [
        'label' => __( 'Section Hashtag', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
    ]
);
$this->end_controls_section();