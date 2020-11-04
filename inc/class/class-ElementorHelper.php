<?php

class ElementorHelper
{
    public static $widgets_path  = '/inc/elementor/widgets';
    public static $controls_path = '/inc/elementor/controls';

    public function __construct()
    {
        // Register widgets
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'load_widgets' ] );

        // Register controls
//        add_action( 'elementor/controls/controls_registered', [ $this, 'load_controls' ] );

        // add custom categories
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_categories' ] );

        // add custom scripts
		if ( pmw_is_elementor() )
		{
			add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		}
    }

    public function load_widgets()
    {
        include NVM_DIR_PATH . '/inc/class/SW_Widget_Base.php';
        $this->register_widgets();
    }

    public function register_widgets( $dir = '' )
    {
        $dir   = $dir ? $dir : get_template_directory() . self::$widgets_path;
        $files = scandir( $dir );
        // remove dot member from array
        unset( $files[ array_search( '.', $files, TRUE ) ] );
        unset( $files[ array_search( '..', $files, TRUE ) ] );
        // prevent empty ordered elements
        if ( count( $files ) < 1 )
        {
            return;
        }
        foreach ( $files as $file )
        {
            if ( is_dir( $dir . '/' . $file ) )
            {
                $this->register_widgets( $dir . '/' . $file );
            } else if ( substr( $file, -4, 4 ) == '.php' )
            {
                $first_name = explode( '.', $file );
                $first_name = reset( $first_name );
                if ( $first_name != 'index' && mb_substr( $dir, strlen( $dir ) - strlen( $first_name ), strlen( $first_name ) ) == $first_name )
                {
                    include( $dir . '/' . $file );
                    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $first_name );
                }
            }
        }
    }

    public function load_controls()
    {
        $this->register_controls();
    }

    public function register_controls( $dir = '' )
    {
        $dir   = $dir ? $dir : get_template_directory() . self::$controls_path;
        $files = scandir( $dir );
        // remove dot member from array
        unset( $files[ array_search( '.', $files, TRUE ) ] );
        unset( $files[ array_search( '..', $files, TRUE ) ] );
        // prevent empty ordered elements
        if ( count( $files ) < 1 )
        {
            return;
        }
        foreach ( $files as $file )
        {
            if ( is_dir( $dir . '/' . $file ) )
            {
                $this->register_controls( $dir . '/' . $file );
            } else if ( substr( $file, -4, 4 ) == '.php' )
            {
                $first_name = reset( explode( '.', $file ) );
                if ( $first_name != 'index' && mb_substr( $dir, strlen( $dir ) - strlen( $first_name ), strlen( $first_name ) ) == $first_name )
                {
                    include( $dir . '/' . $file );
                    \Elementor\Plugin::instance()->controls_manager->register_control( $first_name::$_id, new $first_name );
                }
            }
        }
    }

    public function add_categories( $elements_manager )
    {
        $elements_manager->add_category(
            'snowa',
            [
                'title' => __( 'Snowa Widgets', 'snowa' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script( 'wp-media-folder-fix', NVM_DIR_URL . '/assets/admin/js/admin_scripts.js' );
    }
}