<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Hello_World
 *
 * @package NVMElementor\Widgets
 */
class SW_Dark_Image_Cards extends SW_Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since  1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'snowa-dark-image-card';
    }

    /**
     * Retrieve the widget title.
     *
     * @since  1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __( 'Dark Image Cards', 'snowa' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since  1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-gallery-justified';
    }
}
