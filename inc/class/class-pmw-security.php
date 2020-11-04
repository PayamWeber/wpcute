<?php
/* dont access if use directly */
if( ! defined( 'ABSPATH' ) )
	exit;

/**
* security works for pmw wordpress projects
*/
class PMW_Security
{

	public $nonce_args;

	public $token_args;

    /**
     * PMW_Security constructor.
     *
     * @param array $nonce_args including 'post' and 'action' members
     * @param array $token_args including 'post' and 'session' members
     */
	public function __construct( array $nonce_args = array(), array $token_args = array() )
	{
		/**
		 * setup nonce and token
		 */
		$this->nonce_args = $nonce_args;

		$this->token_args = $token_args;
	}

	/**
	 * [pmw_admin_security description]
	 * @param  array  $nonce_args [description]
	 * @param  array  $token_args [description]
	 * @return [type]             [description]
	 */
	public function admin_security()
	{
		$nonce_args = $this->nonce_args;
		$token_args = $this->token_args;

	    /**
	     * if is user not logged in or is not admin then return false
	     */
	    if( ! is_admin() && ! is_super_admin() )
	        return false;

	    /**
	     * is nonce valid
	     */
	    if( $nonce_args )
	    {
	    	if ( ! wp_verify_nonce( $nonce_args['post'], $nonce_args['action'] ) )
	    		return false;
	    }

	    /**
	     * is token valid
	     */
	    if( $token_args )
	    {
	    	/**
	    	 * start session for access session variables
	    	 */
	    	if ( ! $token_args['post'] || $token_args['post'] != $token_args['session'] )
	    		return false;
	    }

	    return true;
	}

	/**
	 * [pmw_public_security description]
	 * @return [type] [description]
	 */
	public function public_security()
	{
		$nonce_args = $this->nonce_args;
		$token_args = $this->token_args;

	    /**
	     * is nonce valid
	     */
	    if( $nonce_args )
	    {
	    	if ( ! wp_verify_nonce( $nonce_args['post'], $nonce_args['action'] ) )
	    		return false;
	    }

	    /**
	     * is token valid
	     */
	    if( $token_args )
	    {
	    	/**
	    	 * start session for access session variables
	    	 */
	    	if ( ! $token_args['post'] || $token_args['post'] != $token_args['session'] )
	    		return false;
	    }

	    return true;
	}


	/**
	 * this function register tokens for security
	 * @param  [array] $tokens [an array or tokens]
	 * @return [void]         [register tokens]
	 */
	public function register_tokens( array $tokens )
	{
		if( is_array( $tokens ) && $tokens )
		{
			foreach ($tokens as $name => $value) {
				$name = stripslashes( $name );

				$_SESSION[$name] = $value;
			}
		}
	}


	/**
	 * get token value
	 * @param  string 			$name 		token name
	 * @return string/boolean       		return value or boolean
	 */
	public function get_token( $name )
	{
		$this->syntax_check( 'is_string', $name );

		// return session variable as token
		return $_SESSION[$name] ? $_SESSION[$name] : false;
	}


	/**
	 * check custom syntax error and print error
	 * @param  callable     $check_function         external function for check syntex
	 * @param  mixed        $var                    variable to check
	 * @param  string       $error_text             custom error text
	 * @return void                                 print error
	 */
	public function syntax_check( $check_function, $var, $error_text = '' )
	{
	    if ( ! function_exists( $check_function ) || ! $var )
	        return false;

	    // current line number
	    $func_called = debug_backtrace();

	    // before and after error text
	    $before_error = "<h4 style=\"font-weight: normal;\"> <strong>PMW Error:</strong> ";
	    $after_error = " in file [ <strong>{$func_called[0]['file']}</strong> ] ( On line <strong>{$func_called[0]['line']}</strong> ) </h4>";

	    if ( ! $check_function( $var ) )
	    {
	        if ( $error_text && is_string( $error_text ) )
	            die( $before_error . $error_text . $after_error );

	        if ( $check_function == 'is_string' )
	            die( $before_error . "Variable must be string" . $after_error );
	    }
	}



	/**
	 * google recaptcha generation for valid response 
	 * @param  string 	$response      		response code given in form
	 * @param  string 	$secret_key      	a secret code given from google
	 * @param  string 	$generation_type 	generation type for low and high php versions
	 * @return boolean                  	return false if unseccess and return true if success
	 */
	public function grecaptcha_generation( $response, $secret_key, $generation_type = 'new' )
	{
		if ( ! $response || ! $secret_key )
			return false;

		if ( $generation_type == 'new' )
		{
			$data = array(
		        'secret' => $secret_key,
		        'response' => $response
		    );
		    $verify = curl_init();
		    curl_setopt( $verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify" );
		    curl_setopt( $verify, CURLOPT_POST, true );
		    curl_setopt( $verify, CURLOPT_POSTFIELDS, http_build_query( $data ) );
		    curl_setopt( $verify, CURLOPT_SSL_VERIFYPEER, false );
		    curl_setopt( $verify, CURLOPT_RETURNTRANSFER, true );
		    $responseKeys = json_decode( curl_exec( $verify ), true );

		    return $responseKeys['success'];
		}
		else if ( $generation_type == 'old' )
		{
		    $response=file_get_contents( "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response=" . $response );
		    $responseKeys = json_decode( $response, true );

		    return $responseKeys['success'];
		}
		return false;
	}

}