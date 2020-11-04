<?php

use PMW\Inc\Vendor\Routes;
use PMW\Input;

/**
 * Admin Options
 */
Routes::post( 'api/admin/options/save', 'OptionsController@save' );
Routes::post( 'api/admin/options/find_url', 'OptionsController@find_url' );
Routes::get( 'api/admin/consultation/seen/{id}', 'ContactController@consultationSeen' );
Routes::get( 'api/admin/package_request/seen/{id}', 'PackageController@seen' );
Routes::get( 'api/admin/special_card_request/seen/{id}', 'SpecialCardController@seen' );
Routes::get( 'api/admin/discount_request/seen/{id}', 'DiscountController@seen' );
Routes::get( 'api/admin/contact/seen/{id}', 'ContactController@seen' );

/**
 * captcha
 */
Routes::get( 'api/captcha', 'DefaultController@captcha' );

/**
 * contact us form
 */
Routes::post( 'api/contact_us/send', 'ContactController@store' );

/**
 * package request form
 */
Routes::post( 'api/package_request', 'PackageController@storeRequest' );

/**
 * special card request form
 */
Routes::post( 'api/special_card_request', 'SpecialCardController@storeRequest' );

/**
 * special card request form
 */
Routes::post( 'api/discount_request', 'DiscountController@storeRequest' );

/**
 * consultation request form
 */
Routes::post( 'api/consultation_request', 'ContactController@storeConsultation' );

