window.$ = jQuery;
var pmw_list_items_counter = 0;
$( document ).ready( function () {
    // jquery ui select
    $( ".special_settings div[tab-id*='" + $( "#select-template option.selected" ).val() + "']" ).slideDown( 0 );
    $( "#special_tab_title" ).text( "تنظیمات اختصاصی " + $( "#select-template option.selected" ).text() );
    if ( $( ".jqui_select" ).length )
        $( ".jqui_select" ).selectmenu();
    if ( $( ".ui-selectmenu-button" ).length )
    {
        $( ".ui-selectmenu-button" ).attrchange( {
            callback: function ( event ) {
                $( ".special_settings > div" ).slideUp( 0 );
                $( this ).prev().find( "option" ).removeAttr( "selected" ).removeAttr( "class" );
                $( this ).prev().find( "option:contains(" + $( this ).find( "span:last-child" ).text() + ")" ).attr( "selected", "selected" ).attr( "class", "selected" );
                $( ".special_settings div[tab-id*='" + $( "#select-template option.selected" ).val() + "']" ).slideDown( 0 );
                $( "#special_tab_title" ).text( "تنظیمات اختصاصی " + $( "#select-template option.selected" ).text() );
            }
        } );
    }

    // jquery ui tabs
    if ( $( ".jqui_tabs" ).length )
        $( ".jqui_tabs" ).tabs();

    // jquery ui sortable
    $( ".pm_sortable" ).sortable();
    $( ".pm_sortable" ).disableSelection();

    //pmw list items
    var upload_default_number = 999;
    $( "body" ).on( "click", ".pmw_list_item_box h4", function () {
        $( this ).next().fadeToggle( 100 );
        $( this ).find( "a" ).toggleClass( "rotated" );
    } );
    $( "body" ).on( "click", ".remove_pmw_item", function () {
        var items_length = $( this ).parent().parent().parent().find( ".pmw_list_item_box" ).length;
        $( this ).parent().parent().fadeOut( 200 );
        if ( !(items_length - 1) )
        {
            $( this ).parent().parent().parent().next().next().fadeIn( 200 );
        }
        var this_el = $( this );
        setTimeout( function () {
            this_el.parent().parent().remove();
            put_numbers_into_list_items_name( $( this ).parent().parent().parent().parent() );
        }, 200 );
    } );
    $( "body" ).on( "click", ".add_pmw_item", function () {
        var new_el = $( this ).parent().parent().clone();
        new_el.find( '.this-setting' ).each( function () {
            $( this ).find( 'input,textarea,select' ).each( function () {
                var _name = $( this ).attr( 'name' );
                if ( typeof _name !== 'undefined' )
                {
                    var _before_name = _name.replace( /(.*\[)([0-9]*)(\].*)/, '$1' );
                    var _after_name = _name.replace( /(.*\[)([0-9]*)(\].*)/, '$3' );
                    $( this ).attr( 'name', _before_name + 999 + _after_name );
                }
            } );
        } );
        new_el.css( { "display": "none" } );
        new_el.insertAfter( $( this ).parent().parent() );
        $( this ).parent().parent().next().fadeIn( 500 );
        var this_file_upload = $( this ).parent().parent().find( ".pmw-file-upload" );
        if ( this_file_upload.length )
        {
            $( this ).parent().parent().next().find( ".pmw-file-upload" ).each( function () {
                upload_default_number += 1;
                $( this )
                    .attr( "upload-id", $( this ).attr( "id" ) + upload_default_number )
                    .attr( "id", $( this ).attr( "id" ) + upload_default_number );
            } );
        }
        put_numbers_into_list_items_name( $( this ).parent().parent().parent().parent() );
    } );
    $( "body" ).on( "click", ".pmw_list_items_container .add_new_list_item", function () {
        var new_el = $( this ).prev().clone();
        $( this ).prev().prev().append( new_el );
        var created_el = $( this ).prev().prev().find( ".pmw_list_item_box:last-child" );
        created_el.fadeIn( 500 );
        created_el.find( "input,textarea,select" ).each( function () {
            $( this ).attr( "name", $( this ).attr( "hidden-name" ) );
        } );
        var this_file_upload = created_el.find( ".pmw-file-upload" );
        if ( this_file_upload.length )
        {
            $( this ).parent().parent().next().find( ".pmw-file-upload" ).each( function () {
                upload_default_number += 1;
                $( this )
                    .attr( "upload-id", $( this ).attr( "id" ) + upload_default_number )
                    .attr( "id", $( this ).attr( "id" ) + upload_default_number );
            } );
        }
        $( this ).fadeOut( 0 );
        put_numbers_into_list_items_name( $( this ).parent() );
    } );
    $( "body" ).on( "keyup", ".pmw_list_item_box input[type='text']:first-of-type,.pmw_list_item_box textarea.main-title", function () {
        var value = $( this ).val();
        var span = $( this ).parent().prev().find( "span" );
        if ( value.length < 50 )
        {
            span.text( value ).removeClass( 'it_is_locked' );
        } else
        {
            if ( !span.hasClass( 'it_is_locked' ) )
                span.text( span.text() + ' . . .' ).addClass( 'it_is_locked' );
        }
    } );

    check_add_new_list_items();

    /**
     * check if add new list item is empty so show new button
     * @return {[type]} [description]
     */
    function check_add_new_list_items()
    {
        $( ".add_new_list_item" ).each( function () {
            if ( !$( this ).prev().prev().find( ".pmw_list_item_box" ).length )
            {
                $( this ).fadeIn();
            }
        } );
    }


    /**
     * file uploader
     */
        //uploader
    var media_uploader = null;
    var formfield;
    var formfieldimage;
    var formtype;

    function pmw_media_uploader()
    {
        media_uploader = wp.media( {
            frame: "post",
            state: "insert",
            multiple: false
        } );

        media_uploader.on( "insert", function () {
            var json = media_uploader.state().get( "selection" ).first().toJSON();
            var image_url = json.url;
            if ( formfield )
            {
                if ( formtype === "image" )
                {
                    $( '#' + formfield + " .file-value" ).val( json.id );
                    $( '#' + formfield + " .pmw-image-preview" ).attr( 'src', image_url );
                }
                if ( formtype === "file" )
                {
                    $( '#' + formfield + " .file-value" ).val( json.id );
                    $( '#' + formfield + " .pmw-file-preview" ).html( '<p>' + 'نام  فایل : ' + json.filename + '<br> حجم : ' + json.filesizeHumanReadable + '</p>' );
                }
                if ( !$( '#' + formfield ).find( ".pmw-remove-upload-button" ).length )
                {
                    var big_image_upload = $( '#' + formfield );
                    var remove_text = (big_image_upload.attr( "upload-type" ) === "image") ? "حذف تصویر" : "حذف فایل";
                    $( '<input type="button" class="basic ui button pmw-remove-upload-button" upload-type="' + big_image_upload.attr( "upload-type" ) + '" value="' + remove_text + '">' ).insertAfter( big_image_upload.find( ".pmw-upload-button" ) );
                }
            }
        } );
        media_uploader.open();
        refresh_wp_media_folder()
    }

    $( "body" ).on( "click", ".pmw-file-upload .pmw-upload-button", function () {
        formfield = $( this ).parent().attr( 'upload-id' );
        formtype = $( this ).parent().attr( 'upload-type' );
        pmw_media_uploader();
        return false;
    } );

    $( "body" ).on( "click", ".pmw-file-upload .pmw-remove-upload-button", function () {
        $( this ).parent().find( ".file-value" ).val( "" );
        if ( $( this ).attr( "upload-type" ) === "image" )
        {
            $( this ).parent().find( ".pmw-image-preview" ).attr( "src", "" );
        } else if ( $( this ).attr( "upload-type" ) === "file" )
        {
            $( this ).parent().find( ".pmw-file-preview" ).html( '<p>' + 'نام  فایل : ' + '<br> حجم : ' + '</p>' );
        }
        $( this ).remove();
        return false;
    } );

    // remove iamge button generation
    function remove_pmw_image_btn_gen()
    {
        $( ".pmw-file-upload" ).each( function ( e ) {
            if ( $( this ).find( ".file-value" ).val() !== "" )
            {
                var remove_text = ($( this ).attr( "upload-type" ) === "image") ? "حذف تصویر" : "حذف فایل";
                $( '<input type="button" class="basic ui button pmw-remove-upload-button" upload-type="' + $( this ).attr( "upload-type" ) + '" value="' + remove_text + '">' ).insertAfter( $( this ).find( ".pmw-upload-button" ) );
            }
        } );
    }

    remove_pmw_image_btn_gen();

    $( '.acf-image-uploader .button' ).click( function () {
        refresh_wp_media_folder();
    } )


    // select items to add
    $( "body" ).delegate( ".select-items-to-add", "change", function () {
        var isset_this = $( this ).parent().find( "a[option-id='select-item-box-" + $( this ).val() + "']" ).length;
        if ( isset_this || $( this ).val() == "off" )
        {
            return false;
        }
        var el_clone = $( this ).prev().find( ".select_item_box" ).clone();
        el_clone.find( "span" ).html( $( this ).find( "option:selected" ).text() );
        el_clone.find( "input" ).val( $( this ).val() ).attr( "name", el_clone.find( "input" ).attr( "hidden-name" ) );
        el_clone.attr( "option-id", "select-item-box-" + $( this ).val() );
        $( this ).next().append( el_clone );
    } );


    // is readed contact us message
    if ( $( "body" ).hasClass( "post-type-contact" ) )
    {
        var is_readed = $( "._is_readed" );
        if ( is_readed.prev().attr( "is-readed" ) == "no" )
        {
            is_readed.val( "yes" );
            $.ajax( {
                url: is_readed.attr( "action" ) + "admin-ajax.php",
                method: "post",
                data: {
                    id: is_readed.attr( "post-id" ),
                    action: "update_is_readed_contact_us",
                    nonce: pmw_contact_us.nonce
                }
            } );
        }
    }


    /**
     * tab select in pmw list item
     * @return do the job
     */
    $( '.tab_select_list_item' ).each( function () {
        var self = $( this );
        var parent = self.parent();

        parent.find( 'input,textarea,.pmw-file-upload,label' ).css( { 'display': 'none' } );
        parent.find( '.' + self.val() ).css( { 'display': 'block' } );
    } );
    // 
    $( 'body' ).on( 'change', '.tab_select_list_item', function () {
        var self = $( this );
        var parent = self.parent();

        parent.find( 'input,textarea,.pmw-file-upload,label' ).fadeOut( 0 );
        parent.find( '.' + self.val() ).fadeIn( 200 );
    } );


    /**
     * pmw url input
     */
    var pmw_url_input_ajax;
    $( 'body' ).on( 'keyup', '.pmw_url_input input.visible', function ( e ) {
        // console.log('Watch me');
        var self = $( this );
        var body = self.parent().parent();

        var _which = e.which;

        if ( _which == 13 ) // enter
        {
            if ( body.find( "li" ).length )
            {
                input_url_item_click_event( body.find( "li.highlighted" ) );
                return false;
            }
        } else if ( _which == 38 ) // up
        {
            if ( body.find( "li" ).length )
            {
                var _highlighted = body.find( "li.highlighted" );
                if ( _highlighted.length )
                {
                    if ( _highlighted.prev().length )
                    {
                        _highlighted.prev().addClass( 'highlighted' );
                        _highlighted.removeClass( 'highlighted' );
                    } else
                    {
                        body.find( "li:last-child" ).addClass( 'highlighted' );
                    }
                }
            }
        } else if ( _which == 40 ) // down
        {
            if ( body.find( "li" ).length )
            {
                var _highlighted = body.find( "li.highlighted" );
                if ( _highlighted.length )
                {
                    if ( _highlighted.next().length )
                    {
                        _highlighted.next().addClass( 'highlighted' );
                        _highlighted.removeClass( 'highlighted' );
                    } else
                    {
                        body.find( "li:first-child" ).addClass( 'highlighted' );
                    }
                } else
                {
                    body.find( "li:first-child" ).addClass( 'highlighted' );
                }
            }
        }

        if ( _which == 38 || _which == 40 )
        {
            var _highlighted = body.find( "li.highlighted" );
            var _highlighted_offset_top = body.find( '.pmw_url_input_list' ).scrollTop() + _highlighted.position().top;
            console.log( body.find( '.pmw_url_input_list' ).scrollTop() + ' - ' + _highlighted.position().top );
            if ( body.find( '.pmw_url_input_list' ).scrollTop() < _highlighted_offset_top - 80 )
            {
                body.find( '.pmw_url_input_list' ).animate( { scrollTop: _highlighted_offset_top - 50 }, 200 );
            } else
            {
                body.find( '.pmw_url_input_list' ).animate( { scrollTop: _highlighted_offset_top - 50 }, 200 );
            }
            return false;
        }

        self.next().val( self.val() );

        if ( !self.val().length )
        {
            body.find( '.pmw_url_input_list' ).remove();
            body.find( '.selectable' ).addClass( 'hidden-before' );
            return false;
        }

        // show spinner
        $( '.pmw_url_input .inputs' ).addClass( 'has-spinner' );

        // remove previous action
        if ( pmw_url_input_ajax )
        {
            pmw_url_input_ajax.abort();
            pmw_url_input_ajax = null;
        }

        // lets showing user list of pages HaHa !!!
        pmw_url_input_ajax = $.ajax( {
            url: pmw_data.api_url + 'admin/options/find_url',
            method: "POST",
            data: {
                action: 'url_input',
                search: self.val(),
                nonce: body.find( '.pmw_nonce' ).attr( 'nonce' ),
                nonce_action: body.find( '.pmw_nonce' ).attr( 'action' )
            },
            dataType: 'html'
        } ).done( function ( result ) {
            if ( result.includes( "<li" ) && self.val().length )
            {
                body.find( '.selectable' ).removeClass( 'hidden-before' );
                body.find( '.selectable' ).css( {
                    'width': self.outerWidth() + 'px'
                } ).html( result );
                body.find( '.pmw_url_input_list' ).css( {
                    'top': 20 + 'px'
                } );
                // body.find( 'style' ).html( '.pmw_url_input .selectable:before{top:' + ( ( self.outerHeight() + 10 ) / 2 + 2 ) + 'px;}' );
            } else
            {
                body.find( '.pmw_url_input_list' ).remove();
                body.find( '.selectable' ).addClass( 'hidden-before' );
            }
            $( '.pmw_url_input .inputs' ).removeClass( 'has-spinner' );
        } );
    } );
    $( 'body' ).on( 'click', '.pmw_url_input li', function () {
        input_url_item_click_event( $( this ) );
    } );
    $( 'body' ).on( 'mouseover', '.pmw_url_input li', function () {
        var self = $( this );
        var body = self.parent().parent().parent();

        body.find( '.selectable' ).addClass( 'hidden-before' );
    } );
    $( 'body' ).on( 'mouseleave', '.pmw_url_input li', function () {
        var self = $( this );
        var body = self.parent().parent().parent();

        body.find( '.selectable' ).removeClass( 'hidden-before' );
    } );

    /*if( $('body').hasClass('nav-menus-php') )
    {
        $('[id*="locations-"]').change(function () {
            var _this_name = $(this).attr('name');
            _this_name = _this_name.replace( /.*\[(.*)\]/, '$1');
            if ( _this_name == 'main-menu' )
            {

            }
        })
    }*/
} );

$( window ).load( function () {
    $( 'body.elementor-editor-post' ).on( 'click', '.pmw-upload-button, .elementor-control-preview-area', function () {
        refresh_wp_media_folder();
    } );
} )

// special functions
function remove_pmw_url_input_list()
{
    setTimeout( function () {
        $( '.pmw_url_input_list' ).remove();
        $( '.pmw_url_input .selectable' ).addClass( 'hidden-before' );
    }, 300 );
}

function input_url_item_click_event( el )
{
    var self = el;
    var body = self.parent().parent().parent();
    var id = self.attr( 'post-id' );
    var url = self.attr( 'post-url' );

    body.find( 'input.hidden' ).val( id );
    body.find( 'input.visible' ).val( url );

    self.parent().remove();
    body.find( '.selectable' ).addClass( 'hidden-before' );
}

function put_numbers_into_list_items_name( _container )
{
    pmw_list_items_counter = 0;
    _container.find( ' > .pmw_list_items > .pmw_list_item_box' ).each( function () {
        $( this ).find( '.this-setting' ).each( function () {
            $( this ).find( 'input,textarea,select' ).each( function () {
                var _name = $( this ).attr( 'name' );
                if ( typeof _name !== 'undefined' )
                {
                    var _before_name = _name.replace( /(.*\[)([0-9]*)(\].*)/, '$1' );
                    var _after_name = _name.replace( /(.*\[)([0-9]*)(\].*)/, '$3' );
                    $( this ).attr( 'name', _before_name + pmw_list_items_counter + _after_name );
                }
            } );
        } );
        pmw_list_items_counter++;
    } );
}

function refresh_wp_media_folder()
{
    setTimeout( function () {
        if ( $( '.wpmf_btn_reload' ).length )
        {
            $( '.wpmf_btn_reload' ).trigger( 'click' );
        }
    }, 400 );
}