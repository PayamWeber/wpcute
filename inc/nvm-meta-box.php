<?php
// add_meta_boxes
//add_action( 'add_meta_boxes', 'selak_add_meta_boxes' );
function selak_add_meta_boxes()
{
    add_meta_box( 'selak_page_meta', 'تنظیمات', 'page_meta_content', array('page'), 'normal', 'high' );
    // remove meta boxes
}

//get_template_part('inc/pmw',"page_meta_content");

// save meta boxes
//add_action( 'save_post', 'meta_box_save_action' );
function meta_box_save_action($pid){
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    if( !current_user_can( 'edit_post' ) ) return;

    //update meta box values
    if(isset($_POST['show_in_main']))
        update_post_meta($pid,'show_in_main',$_POST['show_in_main']);
    //new updates
    if(isset($_POST['top_image']))
        update_post_meta($pid,'top_image',$_POST['top_image']);
    if(isset($_POST['_top_desc']))
        update_post_meta($pid,'_top_desc',$_POST['_top_desc']);
    if(isset($_POST['sp_page_template']))
        update_post_meta($pid,'sp_page_template',$_POST['sp_page_template']);
    if(isset($_POST['_contact_name']))
        update_post_meta($pid,'_contact_name',$_POST['_contact_name']);
    if(isset($_POST['_contact_email']))
        update_post_meta($pid,'_contact_email',$_POST['_contact_email']);
    if(isset($_POST['_contact_subject']))
        update_post_meta($pid,'_contact_subject',$_POST['_contact_subject']);
    if(isset($_POST['_contact_message']))
        update_post_meta($pid,'_contact_message',$_POST['_contact_message']);
    if(isset($_POST['_is_readed']))
        update_post_meta($pid,'_is_readed',$_POST['_is_readed']);
    if(isset($_POST['_text_bellow_doctors']))
        update_post_meta($pid,'_text_bellow_doctors',$_POST['_text_bellow_doctors']);
    ///////////////////////////////////////////////////
    if(isset($_POST['_faq_items_title']))
        update_post_meta( $pid, '_faq_items_title', array_map( 'sanitize_text_field', $_POST[ '_faq_items_title' ] ) );
    if(isset($_POST['_faq_items_desc']))
        update_post_meta( $pid, '_faq_items_desc', array_map( 'sanitize_textarea', $_POST[ '_faq_items_desc' ] ) );
    if(!isset($_POST['_faq_items_title']) && !isset($_POST['_faq_items_desc']) ){
        update_post_meta( $pid, '_faq_items_title', "" );
        update_post_meta( $pid, '_faq_items_desc', "" );
    }
    ///////////////////////////////////////////////////
    if(isset($_POST['_contact_us_properties']))
        update_post_meta( $pid, '_contact_us_properties', json_encode( $_POST[ '_contact_us_properties' ], JSON_UNESCAPED_UNICODE ) );
    if( ! isset($_POST['_contact_us_properties']))
        update_post_meta( $pid, '_contact_us_properties', '' );
    ///////////////////////////////////////////////////
    if(isset($_POST['_aboutus_settings']))
        pmw_update_post_meta( $pid, '_aboutus_settings', json_encode( $_POST[ '_aboutus_settings' ], JSON_UNESCAPED_UNICODE ) );
    if( ! isset($_POST['_aboutus_settings']))
        update_post_meta( $pid, '_aboutus_settings', '' );
    ///////////////////////////////////////////////////
    if(isset($_POST['_service_settings']))
        pmw_update_post_meta( $pid, '_service_settings', json_encode( $_POST[ '_service_settings' ], JSON_UNESCAPED_UNICODE ) );
    if( ! isset($_POST['_service_settings']))
        update_post_meta( $pid, '_service_settings', '' );
    ///////////////////////////////////////////////////
    $_text_boxes['title'] = array_map( 'sanitize_textarea', $_POST[ '_text_boxes' ]['title'] );
    $_text_boxes['content'] = array_map( 'sanitize_textarea', $_POST[ '_text_boxes' ]['content'] );
    if(isset($_POST['_text_boxes']))
        update_post_meta( $pid, '_text_boxes', $_text_boxes );
    if( ! isset($_POST['_text_boxes']))
        update_post_meta( $pid, '_text_boxes', '' );
    ///////////////////////////////////////////////////
    if(isset($_POST['_pmw_product_properties']))
        update_post_meta( $pid, '_pmw_product_properties', array_map( 'sanitize_text_field', $_POST[ '_pmw_product_properties' ] ) );
    if(!isset($_POST['_pmw_product_properties']) ){
        update_post_meta( $pid, '_pmw_product_properties', "" );
    }
    ///////////////////////////////////////////////////
}

//function sanitize_textarea( $text ){
//    return esc_html( esc_textarea( $text ) );
//}