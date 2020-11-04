<?php

/* dont access if use directly */
if( ! defined( 'ABSPATH' ) )
	exit;



add_action('init', 'pmw_user_capabilities');

/**
 * change or add or remove users capabilities in this function
 * @return void do that works
 */
function pmw_user_capabilities()
{
	$admin = get_role( 'administrator' );

	// add capabilities for contact us in admin page
	$admin->add_cap('edit_contact', true);
	$admin->add_cap('edit_contacts', true);
	$admin->add_cap('delete_contact', true);
	$admin->add_cap('delete_contacts', true);

	// services in admin page
	$admin->add_cap('edit_service', true);
	$admin->add_cap('edit_services', true);

    add_role('writer', __(
        'Writer'),
        array(
            'read'                => true, // Allows a user to read
            'create_posts'         => true, // Allows user to create new posts
            'edit_posts'          => true, // Allows user to edit their own posts
            'edit_others_posts'   => false, // Allows user to edit others posts too
            'publish_posts'       => false, // Allows the user to publish posts
            'manage_categories'   => true, // Allows user to manage post categories
            'moderate_comments'    => false,
            'read_project'        => true,
            'edit_project'        => true,
            'edit_other_projects'  => false,
            'publish_projects'    => false,
            'delete_project'      => false,
        )
    );
}