<?php
return [
	'menu' => [
		'general' => [
			'id' => 'general',
			'title' => __( 'General Settings', 'artist' ),
			'icon' => '',
			'children' => [],
			'class' => '',
			'before_content' => '',
			'after_content' => '',
		],
		'header' => [
			'id' => 'header',
			'title' => __( 'Header', 'artist' ),
			'icon' => 'dashicons-welcome-learn-more',
			'children' => [],
			'class' => '',
			'before_content' => '',
			'after_content' => '',
		],
		//		'template' => [
		//			'id' => 'template',
		//			'title' => __( 'Template', 'artist' ),
		//			'icon' => 'dashicons-theme',
		//			'children' => [],
		//			'class' => '',
		//			'before_content' => '',
		//			'after_content' => '',
		//		],
		'intro' => [
			'id' => 'intro',
			'title' => __( 'Home Page', 'artist' ),
			'icon' => 'dashicons-welcome-view-site',
			'children' => [
				[
					'id' => 'services_section',
					'title' => __( 'Services Section', 'artist' ),
				],
				[
					'id' => 'about_section',
					'title' => __( 'About Section', 'artist' ),
				],
				[
					'id' => 'articles_section',
					'title' => __( 'Articles Section', 'artist' ),
				],
				[
					'id' => 'customers_section',
					'title' => __( 'Customers Section', 'artist' ),
				],
				[
					'id' => 'gallery_section',
					'title' => __( 'Gallery Section', 'artist' ),
				],
				[
					'id' => 'appointment_section',
					'title' => __( 'Appointments Section', 'artist' ),
				],
			],
			'class' => '',
			'before_content' => '',
			'after_content' => '',
		],
		'internal' => [
			'id' => 'internal',
			'title' => __( 'Internal Pages', 'artist' ),
			'icon' => 'dashicons-feedback',
			'children' => [],
			'class' => '',
			'before_content' => '',
			'after_content' => '',
		],
		'footer' => [
			'id' => 'footer',
			'title' => __( 'Footer', 'artist' ),
			'icon' => 'dashicons-feedback',
			'children' => [],
			'class' => '',
			'before_content' => '',
			'after_content' => '',
		],
	],
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	// <<<<<<<<<<<<<<<<<<<<<<<<<<< ################################################ >>>>>>>>>>>>>>>>>>>>>>>>>>>
	'content' => [
		'general' => [
			'id' => 'general',
			'title' => __( 'General Settings', 'artist' ),
			'class' => '',
			'before_content' => function () {
			},
			'after_content' => '',
			'settings' => [
				[
					'title' => __( 'Site Name', 'artist' ),
					'value' => get_bloginfo( 'name' ),
					'type' => '',
					'input_args' => [
						'name' => 'blogname',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Admin Email', 'artist' ),
					'value' => get_bloginfo( 'admin_email' ),
					'type' => '',
					'input_args' => [
						'name' => 'admin_email',
						'class' => 'pmw_number',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => 'از این نشانی برای کارهای مدیریتی، همانند اطلاعیه کاربر تازه استفاده می‌شود.',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // #-- end block --#
		'template' => [
			'id' => 'template',
			'title' => __( 'Template', 'artist' ),
			'class' => '',
			'before_content' => '',
			'after_content' => '',
			'settings' => [
				[
					'title' => __( 'Main Template', 'artist' ),
					'value' => pmw_get_main_template(),
					'type' => 'radio',
					'input_args' => [
						'items' => [
							'tp1' => __( 'First Template', 'artist' ),
							'tp2' => __( 'Second Template', 'artist' ),
						],
						'name' => 'nvm_setting[main_template]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // <<<<<<<< end block >>>>>>>>
		'header' => [
			'id' => 'header',
			'title' => __( 'Header', 'artist' ),
			'class' => '',
			'before_content' => '',
			'after_content' => '',
			'settings' => [
				[
					'title' => __( 'Logo Image', 'artist' ),
					'value' => get_nvm_setting( 'logo_image' ),
					'type' => 'image',
					'input_args' => [
						'name' => 'nvm_setting[logo_image]',
						'class' => '',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Address Text', 'artist' ),
					'value' => get_nvm_setting( 'header_welcome_text' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[header_welcome_text]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Contact Text', 'artist' ),
					'value' => get_nvm_setting( 'header_contact_text' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[header_contact_text]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Social Icons', 'artist' ),
					'value' => get_nvm_setting( 'social_links' ),
					'type' => 'list_item',
					'input_args' => '',
					'list_item_args' => [
						'fields' => [
							'title' => [
								'title' => __( 'Title', 'artist' ),
								'type' => 'input',
								'name' => 'nvm_setting[social_links][title][]',
							],
							'url' => [
								'title' => __( 'Url', 'artist' ),
								'type' => 'input',
								'name' => 'nvm_setting[social_links][url][]',
							],
							'icon' => [
								'title' => __( 'Icon', 'artist' ),
								'type' => 'image',
								'name' => 'nvm_setting[social_links][icon][]',
							],
						],
						'items' => get_nvm_setting( 'social_links' ),
						'singular_name' => __( 'Social Icon', 'artist' ),
					],
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Header Buttons', 'artist' ),
					'value' => get_nvm_setting( 'header_buttons' ),
					'type' => 'list_item',
					'input_args' => '',
					'list_item_args' => [
						'fields' => [
							'title' => [
								'title' => __( 'Title', 'artist' ),
								'type' => 'input',
								'name' => 'nvm_setting[header_buttons][title][]',
							],
							'url' => [
								'title' => __( 'Url', 'artist' ),
								'type' => 'input',
								'name' => 'nvm_setting[header_buttons][url][]',
							],
							//							'icon' => [
							//								'title' => __( 'Icon', 'artist' ),
							//								'type' => 'input',
							//								'name' => 'nvm_setting[header_buttons][icon][]',
							//							],
						],
						'items' => get_nvm_setting( 'header_buttons' ),
						'singular_name' => __( 'Button', 'artist' ),
					],
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // <<<<<<<< end block >>>>>>>>
		'about_section' => [
			'id' => 'about_section',
			'title' => __( 'About Section', 'artist' ),
			'class' => '',
			'before_content' => '',
			'after_content' => '',
			'settings' => [
				[
					'title' => __( 'Image', 'artist' ),
					'value' => get_nvm_setting( 'about_image' ),
					'type' => 'image',
					'input_args' => [
						'name' => 'nvm_setting[about_image]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Sign Image', 'artist' ),
					'value' => get_nvm_setting( 'about_sign_image' ),
					'type' => 'image',
					'input_args' => [
						'name' => 'nvm_setting[about_sign_image]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Main Title', 'artist' ),
					'value' => get_nvm_setting( 'about_main_text' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[about_main_text]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Description Text', 'artist' ),
					'value' => get_nvm_setting( 'about_desc_text' ),
					'type' => 'textarea',
					'input_args' => [
						'name' => 'nvm_setting[about_desc_text]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Second Description Text', 'artist' ),
					'value' => get_nvm_setting( 'about_desc_text2' ),
					'type' => 'textarea',
					'input_args' => [
						'name' => 'nvm_setting[about_desc_text2]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Doctor Name', 'artist' ),
					'value' => get_nvm_setting( 'about_doctor_name' ),
					'type' => 'input',
					'input_args' => [
						'name' => 'nvm_setting[about_doctor_name]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Doctor Level', 'artist' ),
					'value' => get_nvm_setting( 'about_doctor_level' ),
					'type' => 'input',
					'input_args' => [
						'name' => 'nvm_setting[about_doctor_level]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // <<<<<<<< end block >>>>>>>>
		'services_section' => [
			'id' => 'services_section',
			'title' => __( 'Services Section', 'artist' ),
			'class' => '',
			'before_content' => '',
			'after_content' => '',
			'settings' => [
				//				[
				//					'title' => __( 'Image', 'artist' ),
				//					'value' => get_nvm_setting( 'services_main_image' ),
				//					'type' => 'image',
				//					'input_args' => [
				//						'name' => 'nvm_setting[services_main_image]',
				//					],
				//					'list_item_args' => '',
				//					'class' => '',
				//					'id' => '',
				//					'description' => '',
				//					'before_content' => '',
				//					'after_content' => '',
				//				], // ------------ setting ------------
				[
					'title' => __( 'Services', 'artist' ),
					'value' => get_nvm_setting( 'services' ),
					'type' => 'list_item',
					'input_args' => '',
					'list_item_args' => [
						'fields' => [
							'title' => [
								'title' => __( 'Title', 'artist' ),
								'type' => 'input',
								'name' => 'nvm_setting[services][title][]',
							],
							'desc' => [
								'title' => __( 'Description', 'artist' ),
								'type' => 'textarea',
								'name' => 'nvm_setting[services][desc][]',
							],
							'image' => [
								'title' => __( 'Image', 'artist' ),
								'type' => 'image',
								'name' => 'nvm_setting[services][image][]',
							],
							'url' => [
								'title' => __( 'Url', 'artist' ),
								'type' => 'input-url',
								'name' => 'nvm_setting[services][url][]',
							],
						],
						'items' => get_nvm_setting( 'services' ),
						'singular_name' => __( 'Service', 'artist' ),
					],
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Title', 'artist' ),
					'value' => get_nvm_setting( 'services_first_title' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[services_first_title]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Sub Title', 'artist' ),
					'value' => get_nvm_setting( 'services_sub_title' ),
					'type' => 'textarea',
					'input_args' => [
						'name' => 'nvm_setting[services_sub_title]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Button Text', 'artist' ),
					'value' => get_nvm_setting( 'services_home_button_text' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[services_home_button_text]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => 'services_home_button_text',
					'description' => '',
					'before_content' => function () { echo pmw_get_main_template() == 'tp1' ? "<style>#services_home_button_text{display: none}</style>" : ''; },
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Button Url', 'artist' ),
					'value' => get_nvm_setting( 'services_home_button_url' ),
					'type' => 'input-url',
					'input_args' => [
						'name' => 'nvm_setting[services_home_button_url]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => 'services_home_button_url',
					'description' => '',
					'before_content' => function () { echo pmw_get_main_template() == 'tp1' ? "<style>#services_home_button_url{display: none}</style>" : ''; },
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // <<<<<<<< end block >>>>>>>>
		'articles_section' => [
			'id' => 'articles_section',
			'title' => __( 'Articles Section', 'artist' ),
			'class' => '',
			'before_content' => '',
			'after_content' => '',
			'settings' => [
				[
					'title' => __( 'Main Title', 'artist' ),
					'value' => get_nvm_setting( 'articles_main_text' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[articles_main_text]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Description Text', 'artist' ),
					'value' => get_nvm_setting( 'articles_desc_text' ),
					'type' => 'textarea',
					'input_args' => [
						'name' => 'nvm_setting[articles_desc_text]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // <<<<<<<< end block >>>>>>>>
		'gallery_section' => [
			'id' => 'gallery_section',
			'title' => __( 'Gallery Section', 'artist' ),
			'class' => '',
			'before_content' => '',
			'after_content' => '',
			'settings' => [
				[
					'title' => __( 'Title', 'artist' ),
					'value' => get_nvm_setting( 'gallery_main_text' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[gallery_main_text]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // <<<<<<<< end block >>>>>>>>
		'customers_section' => [
			'id' => 'customers_section',
			'title' => __( 'Customers Section', 'artist' ),
			'class' => '',
			'before_content' => '',
			'after_content' => '',
			'settings' => [
				[
					'title' => __( 'Quotes', 'artist' ),
					'value' => get_nvm_setting( 'quotes' ),
					'type' => 'list_item',
					'input_args' => '',
					'list_item_args' => [
						'fields' => [
							'title' => [
								'title' => __( 'Title', 'artist' ),
								'type' => 'input',
								'name' => 'nvm_setting[quotes][title][]',
							],
							'desc' => [
								'title' => __( 'Description', 'artist' ),
								'type' => 'textarea',
								'name' => 'nvm_setting[quotes][desc][]',
							],
						],
						'items' => get_nvm_setting( 'quotes' ),
						'singular_name' => __( 'Quotes', 'artist' ),
					],
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // <<<<<<<< end block >>>>>>>>
		'appointment_section' => [
			'id' => 'appointment_section',
			'title' => __( 'Appointment Section', 'artist' ),
			'class' => '',
			'before_content' => '',
			'after_content' => '',
			'settings' => [
				[
					'title' => __( 'Image', 'artist' ),
					'value' => get_nvm_setting( 'appointment_main_image' ),
					'type' => 'image',
					'input_args' => [
						'name' => 'nvm_setting[appointment_main_image]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Title', 'artist' ),
					'value' => get_nvm_setting( 'appointment_title' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[appointment_title]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Description', 'artist' ),
					'value' => get_nvm_setting( 'appointment_description' ),
					'type' => 'textarea',
					'input_args' => [
						'name' => 'nvm_setting[appointment_description]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Button Text', 'artist' ),
					'value' => get_nvm_setting( 'appointment_button_text', 'Discover' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[appointment_button_text]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Button Url', 'artist' ),
					'value' => get_nvm_setting( 'appointment_button_url', '#hello' ),
					'type' => 'input-url',
					'input_args' => [
						'name' => 'nvm_setting[appointment_button_url]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // <<<<<<<< end block >>>>>>>>
		'cards_section' => [
			'id' => 'cards_section',
			'title' => __( 'Cards Section', 'artist' ),
			'class' => '',
			'before_content' => '',
			'after_content' => '',
			'settings' => [
				[
					'title' => __( 'Title', 'artist' ),
					'value' => get_nvm_setting( 'customers_title' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[customers_title]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Sub Title', 'artist' ),
					'value' => get_nvm_setting( 'customers_sub_title' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[customers_sub_title]',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Cards', 'artist' ),
					'value' => get_nvm_setting( 'cards' ),
					'type' => 'list_item',
					'input_args' => '',
					'list_item_args' => [
						'fields' => [
							'title' => [
								'title' => __( 'Title', 'artist' ),
								'type' => 'input',
								'name' => 'nvm_setting[cards][title][]',
							],
							'tag' => [
								'title' => __( 'Tag', 'artist' ),
								'type' => 'input',
								'name' => 'nvm_setting[cards][tag][]',
							],
							'first_text' => [
								'title' => __( 'First Text', 'artist' ),
								'type' => 'input',
								'name' => 'nvm_setting[cards][first_text][]',
							],
							'second_text' => [
								'title' => __( 'Second Text', 'artist' ),
								'type' => 'input',
								'name' => 'nvm_setting[cards][second_text][]',
							],
							'button_text' => [
								'title' => __( 'Button Text', 'artist' ),
								'type' => 'input',
								'name' => 'nvm_setting[cards][button_text][]',
							],
							'url' => [
								'title' => __( 'Url', 'artist' ),
								'type' => 'input-url',
								'name' => 'nvm_setting[cards][url][]',
							],
						],
						'items' => get_nvm_setting( 'cards' ),
						'singular_name' => __( 'Card', 'artist' ),
					],
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // <<<<<<<< end block >>>>>>>>
		'internal' => [
			'id' => 'internal',
			'title' => __( 'Internal Pages', 'artist' ),
			'class' => '',
			'before_content' => '',
			'after_content' => '',
			'settings' => [
				[
					'title' => __( 'Instagram Url', 'artist' ),
					'value' => get_nvm_setting( 'instagram_url', '' ),
					'type' => 'url',
					'input_args' => [
						'name' => 'nvm_setting[instagram_url]',
					],
					'list_item_args' => [],
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Telegram Url', 'artist' ),
					'value' => get_nvm_setting( 'telegram_url', '' ),
					'type' => 'url',
					'input_args' => [
						'name' => 'nvm_setting[telegram_url]',
					],
					'list_item_args' => [],
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // <<<<<<<< end block >>>>>>>>
		'footer' => [
			'id' => 'footer',
			'title' => __( 'Footer', 'artist' ),
			'class' => '',
			'before_content' => '',
			'after_content' => '',
			'settings' => [
				[
					'title' => __( 'Copyright Text', 'artist' ),
					'value' => get_nvm_setting( 'footer_copyright', '&copy; 2020 Psychology and Counseling. All Rights Reserved' ),
					'type' => '',
					'input_args' => [
						'name' => 'nvm_setting[footer_copyright]',
					],
					'list_item_args' => [],
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
				[
					'title' => __( 'Logo Image', 'artist' ),
					'value' => get_nvm_setting( 'footer_logo_image' ),
					'type' => 'image',
					'input_args' => [
						'name' => 'nvm_setting[footer_logo_image]',
						'class' => '',
					],
					'list_item_args' => '',
					'class' => '',
					'id' => '',
					'description' => '',
					'before_content' => '',
					'after_content' => '',
				], // ------------ setting ------------
			],
		], // <<<<<<<< end block >>>>>>>>
	],
];