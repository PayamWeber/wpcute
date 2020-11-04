<?php

namespace PMW;

class Input
{
	public static function all()
	{
		return $_REQUEST;
	}

	public static function get( $name, $default = '' )
	{
		return isset( $_REQUEST[ $name ] ) ? ( ! empty( $_REQUEST[ $name ] ) ? $_REQUEST[ $name ] : $default ) : $default;
	}
}