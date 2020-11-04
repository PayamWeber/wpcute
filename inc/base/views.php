<?php
if( isset( $GLOBALS['view_args'] ) && $GLOBALS['view_args'] && is_array( $GLOBALS['view_args'] ) )
    extract( $GLOBALS['view_args'] );

$current_view_file = $GLOBALS['current_view_file'];
if ( $GLOBALS['current_parent_view_file'] )
    include( $GLOBALS['current_parent_view_file'] );
else
    include( $GLOBALS['current_view_file'] );