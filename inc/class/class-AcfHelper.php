<?php

class AcfHelper
{
    public $files = [];
    public function load_settings( $dir = '' )
    {
        $dir = $dir ? $dir : NVM_DIR_PATH . '/inc/acf/';
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
                $this->load_settings( $dir . '/' . $file );
            }
            else if ( substr( $file, -4, 4 ) == '.php' )
            {
                $file_path = $dir . '/' . $file;
                $this->files[] = $dir . '/' . $file;
            }
        }
    }

    public function finalize()
    {
        add_action( 'init', [ $this, 'loads_init' ] );
    }

    public function loads_init()
    {
        if ( $this->files )
        {
            foreach ( $this->files as $group )
            {
                if ( function_exists( 'acf_add_local_field_group' ) )
                {
                    acf_add_local_field_group( include( $group ) );
                }
            }
        }
    }
}