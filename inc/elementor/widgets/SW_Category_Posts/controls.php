<?php

use \Elementor\Controls_Manager;

$_cats = get_terms( [
    'taxonomy' => 'category'
] );
$cats = [];

if ( $_cats )
{
    foreach ( $_cats as $cat )
    {
        $cats[ $cat->term_id ] = $cat->name;
    }
}

$this->start_controls_section(
    'slider_section',
    [
        'label' => __( 'Slider', 'snowa' ),
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
    'category',
    [
        'label' => __( 'Category', 'snowa' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'multiple' => true,
        'options' => $cats,
        'default' => '',
    ]
);
for( $i = 1;$i <= 8;$i++ )
{
    $this->add_control(
        "post_{$i}_is_wide",
        [
            'label' => sprintf( __( "Post %s be wide", 'snowa' ), $i ),
            'label_block' => false,
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => '',
        ]
    );
}
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';