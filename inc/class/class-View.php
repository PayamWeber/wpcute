<?php
namespace PMW\Inc\Vendor;

class View
{
    public static $data = array();

    const ABSPATH = NVM_DIR_PATH . '/inc/base/View/';

    /**
     * @param        $path
     * @param string $parent
     * @param array  $with
     *
     * @return string
     */
    public static function make( $path, $parent = '', array $with = array() )
    {
        if ( $with )
        {
            foreach ( $with as $key => $value )
            {
                $GLOBALS['view_args'][$key] = $value;
            }
        }
        $GLOBALS['current_view_file'] = self::ABSPATH . str_replace( '.', '/', $path ) . '.view.php';
        $GLOBALS['current_parent_view_file'] = $parent ? self::ABSPATH . str_replace( '.', '/', $parent ) . '.view.php' : '';
        self::$data['view_path'] = NVM_DIR_PATH . '/inc/base/views.php';
        return new self;
    }

    public static function get( $path, $parent = '', array $with = array() )
    {
        return self::make( $path, $parent, $with )->content();
    }

    public function path()
    {
        return self::$data['view_path'];
    }

    public function content()
    {
        include( self::$data['view_path'] );
        return '';
    }
}