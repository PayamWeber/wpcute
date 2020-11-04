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
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'main_subtitle',
    [
        'label' => __( 'Sub Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => '',
    ]
);
$this->end_controls_section();

//---------------------------------------------------------------------------------------------//
$this->start_controls_section(
    'content_section_top_right',
    [
        'label' => __( 'Content (Top Right)', 'artist' ),
    ]
);
$this->add_control(
    'main_title_tr',
    [
        'label' => __( 'Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'main_subtitle_tr',
    [
        'label' => __( 'Sub Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'card_image_tr',
    [
        'label' => __( 'Card Image', 'artist' ),
        'type' => 'file_uploader',
        'label_block' => true,
    ]
);
$this->end_controls_section();

//---------------------------------------------------------------------------------------------//
$this->start_controls_section(
    'content_section_bottom_right',
    [
        'label' => __( 'Content (Bottom Right)', 'artist' ),
    ]
);
$this->add_control(
    'main_title_br',
    [
        'label' => __( 'Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'main_subtitle_br',
    [
        'label' => __( 'Sub Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'card_image_br',
    [
        'label' => __( 'Card Image', 'artist' ),
        'type' => 'file_uploader',
        'label_block' => true,
    ]
);
$this->end_controls_section();

//---------------------------------------------------------------------------------------------//
$this->start_controls_section(
    'content_section_top_left',
    [
        'label' => __( 'Content (Top Left)', 'artist' ),
    ]
);
$this->add_control(
    'main_title_tl',
    [
        'label' => __( 'Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'main_subtitle_tl',
    [
        'label' => __( 'Sub Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'card_image_tl',
    [
        'label' => __( 'Card Image', 'artist' ),
        'type' => 'file_uploader',
        'label_block' => true,
    ]
);
$this->end_controls_section();

//---------------------------------------------------------------------------------------------//
$this->start_controls_section(
    'content_section_bottom_left',
    [
        'label' => __( 'Content (Bottom Left)', 'artist' ),
    ]
);
$this->add_control(
    'main_title_bl',
    [
        'label' => __( 'Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'main_subtitle_bl',
    [
        'label' => __( 'Sub Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'card_image_bl',
    [
        'label' => __( 'Card Image', 'artist' ),
        'type' => 'file_uploader',
        'label_block' => true,
    ]
);
$this->end_controls_section();

//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';