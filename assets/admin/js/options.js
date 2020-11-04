window.$ = jQuery;
$( document ).ready( function () {
    //set pages
    //$last_active_block = $("#last_active_block").val().length?$("#last_active_block").val():"1";
    $last_active_block = getCookie( "pmw_last_active_block" ).length ? getCookie( "pmw_last_active_block" ) : "1";
    $( '#looxBody #looxBox section .singleBlock' ).fadeOut( 0 );
    $( '#looxBody #looxBox section div#block-' + $last_active_block ).fadeIn( 0 );
    $( '#looxBody #looxBox aside ul > li' ).removeClass( 'activate' );
    $( '#looxBody #looxBox aside > ul > li#' + $last_active_block ).addClass( 'activate' );
    $( '#looxBody #looxBox aside > ul > li > ul > li#' + $last_active_block ).parent().parent().addClass( 'activate' );
    $( '#looxBody #looxBox aside ul > li' ).find( "ul" ).slideUp( 200 );
    $( '#looxBody #looxBox aside ul .activate' ).find( "ul" ).slideDown( 200 );
    
    $( '#looxBody #looxBox aside ul li div' ).click( function () {
        $this_id = $( this ).parent().attr( 'id' );
        $( '#looxBody #looxBox aside ul > li' ).removeClass( 'activate' );
        $( this ).parent().addClass( 'activate' );
        $( '#looxBody #looxBox section .singleBlock' ).fadeOut( 0 );
        $( '#looxBody #looxBox section div#block-' + $this_id ).fadeIn();
        $( '#looxBody #looxBox aside ul > li' ).find( "ul" ).slideUp( 200 );
        $( '#looxBody #looxBox aside ul .activate' ).find( "ul" ).slideDown( 200 );
        //$("#last_active_block").val($this_id);
        setCookie( "pmw_last_active_block", $this_id );
    } );
    
    $( '#looxBody #looxBox aside ul li ul li' ).click( function () {
        $this_id = $( this ).attr( 'id' );
        $( '#looxBody #looxBox section .singleBlock' ).fadeOut( 0 );
        $( '#looxBody #looxBox section div#block-' + $this_id ).fadeIn();
        //$("#last_active_block").val($this_id);
        setCookie( "pmw_last_active_block", $this_id );
    } );

    $('#looxBody input,#looxBody textarea').autodir();
    
    //register color pickers
    $( '.pmwColorPicker' ).wpColorPicker();
    
    //remove alert text
    setTimeout( function () {
        $( 'footer h2' ).text( '' );
    }, 5000 );
    
    //submit save button
    $( '#pmwOptionsForm' ).submit( function ( e ) {
        e.preventDefault();
        return false;
    } );
    var save_time_out = null;
    $( '.save_pmw_options .button-primary' ).mouseup( function ( e ) {
        console.log( e );
        $( ".save_pmw_options .save_message" ).html( "" ).fadeOut( 0 );
        $( ".save_pmw_options .fa" ).fadeIn();
        clearTimeout( save_time_out );
        var b = $( '#pmwOptionsForm' ).serialize();
        var c = $( '#looxWrapper :input' ).serialize();
        $.post( 'options.php', b ).error(
            function () {
                $( ".save_pmw_options .fa" ).fadeOut( 0 );
                $( ".save_pmw_options .save_message" ).html( "<span style='color:rgb(255, 62, 62)'>متاسفانه در برقراری ارتباط با سرور مشکلی پیش آمد . لطفا مجددا تلاش نمایید.</span>" ).fadeIn();
            } ).success( function () {
            console.log( $( '.nvm-options-request' ).val() );
            $.ajax( {
                url: $( '.nvm-options-request' ).val(),
                data: c,
                method: "POST"
            } ).done( function ( value, args ) {
                $( ".save_pmw_options .fa" ).fadeOut( 0 );
                $( ".save_pmw_options .save_message" ).html( "<span>تنظیمات ذخیره شد</span>" ).fadeIn();
                save_time_out = setTimeout( function () {
                    $( ".save_pmw_options .save_message" ).html( "" ).fadeOut();
                }, 4000 );
            } );
        } );
    } );
} );

//    auto input and textarea direction
(function($) {
    $.fn.autodir = function() {
        return this.each(function() {
            $(this).on('keypress keyup change', function() {
                if ( $(this).val().length )
                    $(this).css('direction', $(this).val().match(/^[^a-z]*[^\x00-\x7E]/ig) ? 'rtl' : 'ltr');
            }).keyup();
        });
    };
})(jQuery);

function setCookie( cname, cvalue, exdays )
{
    var d = new Date();
    d.setTime( d.getTime() + (exdays * 24 * 60 * 60 * 1000) );
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue;
}

function getCookie( cname )
{
    var name = cname + "=";
    var decodedCookie = decodeURIComponent( document.cookie );
    var ca = decodedCookie.split( ';' );
    for ( var i = 0; i < ca.length; i++ )
    {
        var c = ca[ i ];
        while ( c.charAt( 0 ) == ' ' )
        {
            c = c.substring( 1 );
        }
        if ( c.indexOf( name ) == 0 )
        {
            return c.substring( name.length, c.length );
        }
    }
    return "";
}