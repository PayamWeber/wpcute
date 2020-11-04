<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Hello_World
 *
 * @package NVMElementor\Widgets
 */
class SW_ThermoMeter extends SW_Widget_Base
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
        return 'snowa-thermometer';
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
        return __( 'ThermoMeter', 'snowa' );
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
        return 'eicon-dashboard';
    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since  1.0.0
     *
     * @access protected
     */
    protected function _content_template()
    {
        include 'live.php';
    }
}
