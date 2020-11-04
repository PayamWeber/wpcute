window.$ = jQuery;

// set global variables
var is_form_loader = 0;


$( document ).ready( function () {

    /**
     * fixed header
     */
    $( window ).on( 'scroll resize', function () {
        var _current_scroll_top = $( this ).scrollTop();
        var _top_bar_height = $( '#header .top-bar' ).height();
        var _center_bar = $( '#header .center-bar' );

        if ( Modernizr.mq( '( max-width: 768px )' ) && _current_scroll_top > _top_bar_height ) {
            _center_bar.addClass( 'fixed-top' ).prev().css( {
                'margin-bottom': _center_bar.height() + 'px'
            } );
        } else {
            _center_bar.removeClass( 'fixed-top' ).prev().css( {
                'margin-bottom': '0px'
            } );
        }
    } )

    /**
     * mobile menu
     */
    $( '#header .center-bar .mobile-menu-button' ).click( function () {
        history.pushState( "jibberish", null, null );
        var _self = $( this );
        var _mobile_nav_menu = $( '.mobile-nav-menu' );
        var _has_class = _mobile_nav_menu.hasClass( 'menu-opened' ) ? true : false;

        if ( _has_class !== true ) {
            _mobile_nav_menu.addClass( 'menu-opened' ).velocity( {
                translateX: '100%'
            }, { duration: 0 } ).velocity( {
                translateX: '0%'
            }, {
                duration: 300, visibility: 'visible', complete: function () {
                    _pmw_before_scrolled = $( window ).scrollTop();
                    $( 'body' ).removeClass( 'canScroll' );
                }
            } );
            setTimeout( function () {
                _mobile_nav_menu.addClass( 'show-bg' );
            }, 300 )
        }
    } );
    $( document ).on( 'swiperight', function ( e ) {
        window.history.go( -1 );
        // var _this = $( '.mobile-nav-menu' );
        // var _has_class = _this.hasClass( 'menu-opened' ) ? true : false;
        // if ( _has_class === true )
        // {
        //     $( 'body' ).addClass( 'canScroll' );
        //     $( 'body,html' ).velocity( 'scroll', { duration: 0, offset: _pmw_before_scrolled } );
        // _this.removeClass( 'menu-opened' ).velocity( {
        //     translateX: '100%'
        // }, { visibility: 'hidden' } );
        // setTimeout(function () {
        //     _this.removeClass('show-bg');
        // }, 300)
        // setTimeout(function () {
        //     _this.removeClass('show-bg');
        // }, 300)
        // }
    } );
    $( document ).on( 'swipeleft', function ( e ) {
        history.pushState( "jibberish", null, null );
        var _this = $( '.mobile-nav-menu' );
        var _has_class = _this.hasClass( 'menu-opened' ) ? true : false;
        var _page_x = e.swipestart.coords[ 0 ];
        var _window_width = $( window ).width();
        if ( _has_class === false && (_page_x > (_window_width - (_window_width / 5))) && Modernizr.mq( '(max-width: 992px)' ) ) {
            _this.addClass( 'menu-opened' ).velocity( {
                translateX: '100%'
            }, { duration: 0 } ).velocity( {
                translateX: '0%'
            }, {
                duration: 300, visibility: 'visible', complete: function () {
                    _pmw_before_scrolled = $( window ).scrollTop();
                    $( 'body' ).removeClass( 'canScroll' );
                }
            } );
            setTimeout( function () {
                _this.addClass( 'show-bg' );
            }, 300 )
        }
    } );
    $( '.mobile-nav-menu .nav-bg, .mobile-nav-menu .nav-close' ).click( function () {
        window.history.go( -1 );
        // var _this = $( '.mobile-nav-menu' );
        // var _has_class = _this.hasClass( 'menu-opened' ) ? true : false;
        // if ( _has_class === true )
        // {
        //     $( 'body' ).addClass( 'canScroll' );
        //     // $( 'body,html' ).velocity( 'scroll', { duration: 0, offset: _pmw_before_scrolled } );
        //     _this.removeClass( 'menu-opened' ).velocity( {
        //         translateX: '100%'
        //     }, { visibility: 'hidden' } );
        //     setTimeout(function () {
        //         _this.removeClass('show-bg');
        //     }, 300)
        // }
    } );
    $( '.mobile-nav-menu ul li a' ).click( function () {
        var _this = $( this );
        if ( _this.parent().hasClass( 'has-child' ) ) {
            if ( _this.parent().hasClass( 'active-li' ) ) {
                _this.parent().removeClass( 'active-li' );
                _this.next().slideUp( 100 );
            } else {
                _this.parent().addClass( 'active-li' );
                _this.next().slideDown( 300 );
            }
        } else {
            window.history.go( -1 );
        }
    } )

    /**
     * mobile search
     */
    $( '#header .search-input input' ).click( function () {
        var _this = $( this ).parent();
        if ( Modernizr.mq( '( max-width: 768px )' ) ) {
            _this.width( _this.width() );
            _this.width( $( window ).width() - 20 );
        }
    } )
    $( 'body' ).click( function ( e ) {
        if ( $( e.target ).parent().hasClass( 'search-input' ) )
            return;
        var _search = $( '#header .search-input' );
        _search.width( _search.parent().width() - 10 );
        setTimeout( function () {
            _search.removeAttr( 'style' );
        }, 500 )
        hide_selectable_box( $( '#header .ajax-search' ) );
    } );

    /**
     * ajax search
     */
    var pmw_url_input_ajax;
    $( 'body' ).on( 'keyup', '#header .ajax-search input', function ( e ) {
        // console.log('Watch me');
        var self = $( this );
        var body = self.parent().parent();

        var _which = e.which;

        if ( _which == 13 ) // enter
        {
            if ( body.find( "li.highlighted" ).length ) {
                selectable_item_click_event( body.find( "li.highlighted" ) );
                return false;
            }
        } else if ( _which == 38 ) // up
        {
            if ( body.find( "li" ).length ) {
                var _highlighted = body.find( "li.highlighted" );
                if ( _highlighted.length ) {
                    if ( _highlighted.prev().length ) {
                        _highlighted.prev().addClass( 'highlighted' );
                        _highlighted.removeClass( 'highlighted' );
                    }
                    else {
                        body.find( "li:last-child" ).addClass( 'highlighted' );
                        _highlighted.removeClass( 'highlighted' );
                    }
                }
                else {
                    body.find( "li:last-child" ).addClass( 'highlighted' );
                }
            }
        }
        else if ( _which == 40 ) // down
        {
            if ( body.find( "li" ).length ) {
                var _highlighted = body.find( "li.highlighted" );
                if ( _highlighted.length ) {
                    if ( _highlighted.next().length ) {
                        _highlighted.next().addClass( 'highlighted' );
                        _highlighted.removeClass( 'highlighted' );
                    }
                    else {
                        body.find( "li:first-child" ).addClass( 'highlighted' );
                        _highlighted.removeClass( 'highlighted' );
                    }
                }
                else {
                    body.find( "li:first-child" ).addClass( 'highlighted' );
                }
            }
        }

        if ( _which == 38 || _which == 40 ) {
            var _highlighted = body.find( "li.highlighted" );
            var _highlighted_offset_top = body.find( '.search_result_list' ).scrollTop() + _highlighted.position().top;
            console.log( body.find( '.search_result_list' ).scrollTop() + ' - ' + _highlighted.position().top );
            if ( body.find( '.search_result_list' ).scrollTop() < _highlighted_offset_top - 80 ) {
                body.find( '.search_result_list' ).animate( { scrollTop: _highlighted_offset_top - 50 }, 200 );
            }
            else {
                body.find( '.search_result_list' ).animate( { scrollTop: _highlighted_offset_top - 50 }, 200 );
            }
            return false;
        }

        if ( !self.val().length ) {
            hide_selectable_box( body );
            return false;
        }

        // show spinner
        $( '.pmw_url_input .inputs' ).addClass( 'has-spinner' );

        // remove previous action
        if ( pmw_url_input_ajax ) {
            pmw_url_input_ajax.abort();
            pmw_url_input_ajax = null;
        }

        // lets showing user list of pages HaHa !!!
        pmw_url_input_ajax = $.ajax( {
            url: nvm_data.ajax_url,
            method: "POST",
            data: {
                action: 'search',
                search: self.val(),
                nonce: nvm_data.search_nonce,
            },
            dataType: 'html'
        } ).done( function ( result ) {
            if ( result.includes( "<li" ) && self.val().length ) {
                body.find( '.selectable' ).removeClass( 'd-none' );
                var _selectable_width = body.outerWidth();
                if ( Modernizr.mq( '( max-width: 768px )' ) )
                    _selectable_width = $( window ).width();
                body.find( '.selectable' ).css( {
                    'width': _selectable_width + 'px'
                } ).html( result );
                body.find( '.search_result_list' ).css( {
                    'top': 20 + 'px'
                } );
                show_ajax_search_hidden_bg()
                // body.find( 'style' ).html( '.pmw_url_input .selectable:before{top:' + ( ( self.outerHeight() + 10 ) / 2 + 2 ) + 'px;}' );
            }
            else {
                hide_selectable_box( body );
            }
            $( '.ajax-search .inputs' ).removeClass( 'has-spinner' );
        } );
    } );
    $( 'body' ).on( 'click', '.ajax-search li', function () {
        selectable_item_click_event( $( this ) );
    } );
} );

// back button in browser
window.onload = function () {
    if ( typeof history.pushState === "function" ) {
        window.onpopstate = function () {
            var _this = $( '.mobile-nav-menu' );
            var _has_class = _this.hasClass( 'menu-opened' ) ? true : false;

            if ( _has_class === true ) {
                $( 'body' ).addClass( 'canScroll' );
                // $( 'body,html' ).velocity( 'scroll', { duration: 0, offset: _pmw_before_scrolled } );
                _this.removeClass( 'menu-opened' ).velocity( {
                    translateX: '100%'
                } );
                _this.removeClass( 'show-bg' );
            }
        };
    }
};


function show_alert_cu( el, type, message ) {
    var res_el = el.find( ".alert-" + type.toString() ).clone();
    res_el.text( message.toString() );
    $( ".form-results" ).html( res_el );
    $( ".form-results div" ).removeAttr( 'style' ).css( { 'display': 'none' } );
    $( ".form-results div" ).fadeIn( 600 );
    $( "html,body" ).animate( {
        scrollTop: $( ".form-results" ).offset().top - 80
    } )
    hide_form_loading();
    el.fadeIn();
}


/**
 * this function validate email
 * @param  string email email address given
 * @return boolean       if email is valid return true if not return false
 */
function validateEmail( email ) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test( email );
}


/**
 * show error for html form
 * @param  object el      element object
 * @param  string type    alert type
 * @param  string message alert message
 * @return html/void         show alert for validate form
 */


/**
 * hide form loading when validate form
 * @return void hide the loader spinner
 */
function hide_form_loading() {
    $( '.form-loading' ).removeClass( 'show_this' )
    $( '.form-loading' ).next( '.form-content' ).removeClass( 'blur_this' );
    grecaptcha.reset()
}

function hide_form_loading_after_seconds( uniqid ) {
    is_form_loader = uniqid;
    setTimeout( function () {
        if ( is_form_loader == uniqid ) {
            hide_form_loading();
            is_form_loader = 0;
        }
    }, 30000 );
}

function add_to_comparison( product_id ) {
    var _previous_products = my_get_cookie( 'wc_compare_products' );
    if ( _previous_products.length ) {
        _previous_products = JSON.parse( _previous_products );
        var _final_products = merge_array( _previous_products, [ product_id ] );
        my_set_cookie( 'wc_compare_products', JSON.stringify( _final_products ), 365 )
    }
    else {
        var new_product = [ product_id ];
        my_set_cookie( 'wc_compare_products', JSON.stringify( new_product ), 365 )
    }
}

function my_set_cookie( cname, cvalue, exdays ) {
    var d = new Date();
    d.setTime( d.getTime() + (exdays * 24 * 60 * 60 * 1000) );
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function my_get_cookie( cname ) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent( document.cookie );
    var ca = decodedCookie.split( ';' );
    for ( var i = 0; i < ca.length; i++ ) {
        var c = ca[ i ];
        while ( c.charAt( 0 ) == ' ' ) {
            c = c.substring( 1 );
        }
        if ( c.indexOf( name ) == 0 ) {
            return c.substring( name.length, c.length );
        }
    }
    return "";
}

function merge_array( array1, array2 ) {
    var result_array = [];
    var arr = array1.concat( array2 );
    var len = arr.length;
    var assoc = {};

    while ( len-- ) {
        var item = arr[ len ];

        if ( !assoc[ item ] ) {
            result_array.unshift( item );
            assoc[ item ] = true;
        }
    }

    return result_array;
}

// special functions
function remove_search_result_list() {
    setTimeout( function () {
        $( '.search_result_list' ).remove();
        $( '.pmw_url_input .selectable' ).addClass( 'd-none' );
    }, 300 );
}

function selectable_item_click_event( el ) {
    var self = el;
    var body = self.parent().parent().parent();
    var url = self.attr( 'url' );

    window.location.href = url;

    self.parent().remove();
    body.find( '.selectable' ).addClass( 'd-none' );
}

function hide_selectable_box( container ) {
    container.find( '.search_result_list' ).remove();
    container.find( '.selectable' ).addClass( 'd-none' );
    hide_ajax_search_hidden_bg()
}

function show_ajax_search_hidden_bg() {
    $( '.ajax-search-hidden-bg' ).addClass( 'show-this' );
}

function hide_ajax_search_hidden_bg() {
    $( '.ajax-search-hidden-bg' ).removeClass( 'show-this' );
}