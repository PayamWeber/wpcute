<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Hello_World
 *
 * @package NVMElementor\Widgets
 */
class SW_Small_Slider extends SW_Widget_Base
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
        return 'snowa-small-slider';
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
        $extra_css = "
        #elementor-panel-category-snowa .icon i{
            color: rgb(155, 201, 53);
            font-size: 50px;
        }
        #elementor-panel-category-snowa .icon i{
            color: rgb(155, 201, 53);
            font-size: 50px;
        }
        #elementor-panel-category-snowa .title{
            color: rgb(1, 130, 198);
            font-size: 13px;
        }
        #elementor-panel-category-snowa .elementor-panel-category-title{
            color: rgb(211, 12, 92);
            font-size: 18px;
        }
        #elementor-panel-category-basic, #elementor-panel-category-general{
            display:none;
        }
        ";
        return "<style>$extra_css</style>" . __( 'Small Slider', 'snowa' );
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
        return 'eicon-gallery-grid';
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
