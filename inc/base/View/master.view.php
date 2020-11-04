<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
	<!--<![endif]-->
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
			  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta nmae="description" content="">
		<meta nmae="author" content="">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title><?php wp_title() ?></title>
		<link rel="icon" href="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/images/logo.png">
		<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/css/animations.css">
		<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/css/fonts.css">
		<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/css/main.css" class="color-switcher-link">
		<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/css/custom.css">
		<link rel="stylesheet" href="<?= get_stylesheet_uri() ?>?v=1.0.2">
		<script src="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/js/vendor/modernizr-2.6.2.min.js"></script>
		<!--[if lt IE 9]>
		<script src="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/js/vendor/html5shiv.min.js"></script>
		<script src="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/js/vendor/respond.min.js"></script>
		<script src="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/js/vendor/jquery-1.12.4.min.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
	</head>
	<body class="<?= pmw_get_main_template() ?>">
		<!--[if lt IE 9]>
		<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please
			<a href="http://browsehappy.com/" class="highlight">upgrade your browser</a>
			to improve your experience.
		</div>
		<![endif]-->
		<div class="preloader">
			<div class="preloader_image"></div>
		</div>
		<!-- search modal -->
		<div class="modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					<i class="rt-icon2-cross2"></i>
				</span>
			</button>
			<div class="widget widget_search">
				<form method="get" class="searchform search-form form-inline" action="./">
					<div class="form-group">
						<input type="text" value="" name="search" class="form-control" placeholder="Search keyword" id="modal-search-input">
					</div>
					<button type="submit" class="theme_button">Search</button>
				</form>
			</div>
		</div>
		<!-- Unyson messages modal -->
		<div class="modal fade" tabindex="-1" role="dialog" id="messages_modal">
			<div class="fw-messages-wrap ls with_padding">
				<!-- Uncomment this UL with LI to show messages in modal popup to your user: -->
				<!--
			<ul class="list-unstyled">
				<li>Message To User</li>
			</ul>
			-->
			</div>
		</div>
		<!-- eof .modal -->
		<!-- wrappers for visual page editor and boxed version of template -->
		<div id="canvas">
			<div id="box_wrapper">
				<?php include_view( 'common.header' ); ?>
				<?php include( $current_view_file ); ?>

				<?php include_view( 'common.footer' ); ?>
				<script src="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/js/compressed.js"></script>
				<script src="<?= get_template_directory_uri() ?>/assets/theme/<?= pmw_get_main_template() ?>/js/main.js"></script>
				<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/theme/fancybox-master/dist/jquery.fancybox.min.css"/>
				<script src="<?= get_template_directory_uri() ?>/assets/theme/fancybox-master/dist/jquery.fancybox.min.js"></script>
				<script>
                    function send_api_request(
                        method,
                        url,
                        data,
                        done_call = null,
                        fail_call = null
                    )
                    {
                        var _data = data instanceof FormData ? data : Object.assign( {}, data );
                        $.ajax( {
                            data: _data,
                            dataType: "JSON",
                            method: method,
                            url: url,
                            headers: {
                                Accept: "application/json",
                            },
                        } )
                            .done( function ( result ) {
                                // hide_loader();
                                if ( done_call !== null ) {
                                    done_call( result );
                                }
                            } )
                            .fail( function ( result ) {
                                if ( fail_call !== null ) {
                                    fail_call( result );
                                } else {
                                    // handle_errors(result);
                                }
                            } );
                    }

                    function send_api_file_request(
                        method,
                        url,
                        data,
                        done_call = null,
                        fail_call = null
                    )
                    {
                        var _data = data instanceof FormData ? data : Object.assign( {}, data );
                        $.ajax( {
                            data: _data,
                            dataType: "JSON",
                            method: method,
                            url: url,
                            headers: {
                                Accept: "application/json",
                            },
                            contentType: false,
                            processData: false,
                        } )
                            .done( function ( result ) {
                                // hide_loader();
                                if ( result.status ) {
                                    if ( done_call !== null ) {
                                        done_call( result );
                                    }
                                } else {

                                }
                            } )
                            .fail( function ( result ) {
                                if ( fail_call !== null ) {
                                    fail_call( result );
                                } else {
                                    // handle_errors(result);
                                }
                            } );
                    }

                    function send_post_api(
                        url,
                        data,
                        done_callback = null,
                        fail_callback = null
                    )
                    {
                        return send_api_request(
                            "POST",
                            url,
                            data,
                            done_callback,
                            fail_callback
                        );
                    }

                    function send_get_api(
                        url,
                        data,
                        done_callback = null,
                        fail_callback = null
                    )
                    {
                        return send_api_request( "GET", url, data, done_callback, fail_callback );
                    }
				</script>
				<?php do_action( 'theme_view_scripts' ) ?>
				<?php wp_footer(); ?>
			</div>
		</div>
	</body>
</html>