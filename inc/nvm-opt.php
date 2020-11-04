<?php
/**
 * this file loads options
 */
$options = array();

if ( is_file( NVM_DIR_PATH . '/inc/opt.php' ) )
	$options = include( NVM_DIR_PATH . '/inc/opt.php' );

$plugins_folder_path = ABSPATH . 'wp-content/plugins';
//$plugins_folder = scandir( $plugins_folder_path );
$plugins_list = get_plugins();

//if ( $plugins_folder )
//{
//	foreach ($plugins_folder as $name) {
//		if ( is_dir( $plugins_folder_path . '/' . $name ) && is_file( $plugins_folder_path . '/' . $name . '/opt/opt.php' ) )
//		{
//			$extra = include( $plugins_folder_path . '/' . $name . '/opt/opt.php' );
//			$options['menu'] = array_merge( $options['menu'], $extra['menu'] );
//			$options['content'] = array_merge( $options['content'], $extra['content'] );
//		}
//	}
//}

if ( $plugins_list )
{
    foreach ( $plugins_list as $path => $value )
    {
    	$exploded = explode( '/', $path );
        $folder_name = reset( $exploded );
        if ( is_plugin_active( $path ) && is_file( $plugins_folder_path . '/' . $folder_name . '/opt/opt.php' ) )
        {
            $extra = include( $plugins_folder_path . '/' . $folder_name . '/opt/opt.php' );
            if ( $extra )
            {
                $options['menu'] = array_merge( $options['menu'], $extra['menu'] );
                $options['content'] = array_merge( $options['content'], $extra['content'] );
            }
        }
    }
}
$OptionsBuilder = new PMW_OptionsBuilder;
$OptionsBuilder->make_options( $options );
