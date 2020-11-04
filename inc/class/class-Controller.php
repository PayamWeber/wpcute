<?php

namespace PMW\Inc\Vendor;

class Controller
{
    private static $controllers_loaded = true;
    public static  $namespace_prefix   = 'PMW\Inc\Base\Controller\\';

    /**
     * @param       $controller
     * @param array $args
     *
     * @return string
     */
    public static function grab( $controller, array $args = [] )
    {
        $controller        = explode( '@', $controller );
        $controller_method = $controller[ 1 ];
        $controller        = ( strpos( $controller[ 0 ], self::$namespace_prefix ) === false ) ? self::$namespace_prefix . $controller[ 0 ] : $controller[ 0 ];
        $controller        = class_exists( $controller ) ? new $controller : false;

        if ( $args )
        {
            return $controller ? call_user_func_array( [ $controller, $controller_method ], $args ) : '';
        }

        return $controller ? $controller->$controller_method() : '';
    }

    private static function load_controllers()
    {
        $dir   = NVM_DIR_PATH . '/inc/base/Controller';
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
                listFolderFiles( $dir . '/' . $file );
            } else if ( substr( $file, -4, 4 ) == '.php' )
            {
                include( $dir . '/' . $file );
            }
        }
        self::$controllers_loaded = true;
    }
}