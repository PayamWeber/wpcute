<?php

use \Elementor\Controls_Manager;

$taxonomies = [];

if ( function_exists( 'wc_get_attribute_taxonomies' ) )
{
    $taxes = wc_get_attribute_taxonomies();
    if ( $taxes )
    {
        foreach ( $taxes as $tax )
        {
            $taxonomies[ $tax->attribute_id ] = $tax->attribute_label;
        }
    }
}

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
        'label' => __( 'Categories', 'snowa' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'fields' => [
            [
                'name' => 'title',
                'label' => __( 'Title', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Title', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'attributes',
                'label' => __( 'Attributes', 'snowa' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $taxonomies,
                'label_block' => true,
            ],
        ],
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';