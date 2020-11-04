<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

class SW_Widget_Base extends Widget_Base
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
        return '';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since  1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return [ 'snowa' ];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since  1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return [ 'jquery' ];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     *
     * @access protected
     */
    protected function _register_controls()
    {
        include NVM_DIR_PATH . '/inc/elementor/widgets/' . static::class . '/controls.php';
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        include NVM_DIR_PATH . '/inc/elementor/widgets/' . static::class . '/render.php';
    }

    /**
     * this function returns the js file content for _content_template method
     *
     * @return mixed|string
     */
    protected function get_js_file_content()
    {
        $path = NVM_DIR_PATH . '/inc/elementor/widgets/' . static::class . '/' . static::class . '.js';
        $js   = file_exists( $path ) ? include $path : '';
        return $js;
    }
}