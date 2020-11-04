<?php

namespace PMW\Inc\Base\Controller;

use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use ZipArchive;

class i360Controller extends Controller
{
    public $data = [];

	/**
	 * Update images
	 *
	 * @param $current_360
	 * @param $current_elementor_id
	 *
	 * @return string
	 */
    public function update( $current_360, $current_elementor_id )
    {
        $post        = \PMW\Post::find();
        $destination = ABSPATH . '/wp-content/uploads/360/' . $post->ID . '/' . $current_elementor_id;

        if ( $current_360 )
        {
            if ( $folders = $this->need_to_upload( $destination, $current_elementor_id, $current_360 ) === true )
            {
                $this->rmdir( $destination );
                $folders = [];
                foreach ( $current_360 as $item )
                {
                    if ( ! $item[ 'image' ][ 'url' ] )
                        break;

                    $file_path = str_replace( site_url(), '', $item[ 'image' ][ 'url' ] );
                    $file_path = ABSPATH . $file_path;

                    $file_ext = explode( '.', $file_path );
                    $file_ext = end( $file_ext );
                    if ( $file_ext != 'zip' )
                        break;

                    $file_name = basename( $file_path, '.zip' );

                    $unzip = $this->unzip( $file_path, $destination . '/' . $file_name );

                    if ( $unzip )
                    {
                        $images_path = '/wp-content/uploads/360/' . $post->ID . '/' . $current_elementor_id . '/' . $file_name . '/';
                        $folders[] = [
                            'file_id' => $item[ 'image' ][ 'id' ],
                            'color' => $item[ 'color' ],
                            'imagesCount' => count( $unzip[ 'files' ] ),
                            'imageExtension' => $this->check_files_extension_in_dir( ABSPATH . $images_path ),
                            'imagesPath' => site_url() . $images_path,
                        ];
                        // make a cache hash text for json file
                        update_post_meta( $post->ID, $current_elementor_id . '_cache_text', date( 'YmdHis') );
                    }
                }
            }

            if ( $folders !== false )
            {
                $config_file = fopen( $destination . '/' . $current_elementor_id . '.json', 'w' );
                fwrite( $config_file, json_encode( $folders, JSON_PRETTY_PRINT ) );
                fclose( $config_file );
            }
        }

        return $destination . '/' . $current_elementor_id . '.json';
    }

    /**
	 * Check is images need to upload or not
	 *
     * @param $destination
     * @param $current_elementor_id
     * @param $current_360
     *
     * @return bool
     */
    public function need_to_upload( $destination, $current_elementor_id, $current_360 )
    {
        $config_file_path = $destination . '/' . $current_elementor_id . '.json';
        $config_file      = fopen( $config_file_path, 'r' );
        $config           = json_decode( fread( $config_file, filesize( $config_file_path ) ), true );
        fclose( $config_file );
        $result = 'no';

        if ( $current_360 && $config )
        {
            foreach ( $current_360 as $key => $item )
            {
                if ( ! isset( $config[ $key ] ) ||
                    $item[ 'image' ][ 'id' ] != $config[ $key ][ 'file_id' ] )
                {
                    $result = 'yes';
                } else if ( $item[ 'color' ] != $config[ $key ][ 'color' ] )
                {
                    $config[ $key ][ 'color' ] = $item[ 'color' ];
                    $result                    = 'color_only';
                }
            }
        } else
        {
            $result = 'yes';
        }
        switch ( $result )
        {
            case 'no':
                return false;
                break;
            case 'yes':
                return true;
                break;
            case 'color_only':
                return $config;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * @param $file
     * @param $new_location
     *
     * @return array|bool
     */
    function unzip( $file, $new_location )
    {
        if ( file_exists( $file ) )
        {
            if ( ! is_dir( $new_location ) )
            {
                mkdir( $new_location, 0777, true );
            }
            copy( $file, $new_location . '/' . basename( $file ) );
            $file = $new_location . '/' . basename( $file );
            if ( class_exists( 'ZipArchive' ) )
            {
                $zip = new ZipArchive;
                if ( $zip->open( $file ) === TRUE )
                {
                    $path = dirname( $file );
                    $zip->extractTo( $path );
                    $zip->close();
                    unlink( $file );
                    $info  = [];
                    $files = scandir( $path );

                    foreach ( $files as $file )
                    {
                        if ( $file == '.' || $file == '..' )
                            continue;
                        $info[ 'files' ][] = $file;
                    }

                    return $info;
                }
            } else
            {
                if ( exec( "unzip $file", $output ) )
                {
                    $info = [];
                    for ( $i = 1; $i < count( $output ); $i++ )
                    {
                        $exfile            = trim( preg_replace( "~inflating: ~", "", $output[ $i ] ) );
                        $info[ 'files' ][] = $exfile;
                    }
                    unlink( $file );
                    return $info;
                }
            }
        }
        return false;
    }

    /**
     * remove a directory with files in it
     *
     * @param $dir
     */
    public function rmdir( $dir )
    {
        foreach ( glob( $dir ) as $file )
        {
            if ( is_dir( $file ) )
            {
                $this->rmdir( "$file/*" );
                rmdir( $file );
            } else
            {
                unlink( $file );
            }
        }
    }

    /**
     * this method will check file extensions and tell us what is the format of images in provided folder
     *
     * @param $path
     *
     * @return bool|mixed|string
     */
    public function check_files_extension_in_dir( $path )
    {
        if ( ! is_dir( $path ) )
            return false;

        $files = scandir( $path );
        unset( $files[ 0 ], $files[ 1 ] );

        if ( isset( $files[ 2 ] ) )
		{
			$ext = explode( '.', $files[ 2 ] );
			return end( $ext );
		}

        return '';
    }
}