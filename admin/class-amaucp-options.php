<?php
if ( !class_exists( 'AMAUCP_Options' ) ) :
// Extend the class
class AMAUCP_Options extends AdminPageFramework {
	 
     public function setUp() {
		//instantiate the class
		if ( class_exists( 'AMAUCP_CustomFieldType' ) ) {
			new AMAUCP_CustomFieldType('AMAUCP_Options');
		}
		if ( class_exists( 'AMAUCP_ThemeCustomFieldType' ) ) {
			new AMAUCP_ThemeCustomFieldType('AMAUCP_Options');
		}
     	$this->setRootMenuPageBySlug( 'edit.php?post_type=amaucp_subscriber');
        $this->addSubMenuItems(
            array(
                'title'         => 'Settings',    // page title
                'page_slug'     => 'amaucp_settings',    // page slug
            ),
			array(
                'title'         => 'Social',    // page title
                'page_slug'     => 'amaucp_social',    // page slug
            ),
			array(
                'title'         => 'Subscribe',    // page title
                'page_slug'     => 'amaucp_subscribe',    // page slug
            ),
			array(
                'title'         => 'Reset',    // page title
                'page_slug'     => 'amaucp_reset',    // page slug
            )
        );
		
		
		// Add form sections
        $this->addSettingSections(
            'amaucp_settings',    // target page slug
            array(
                'section_id'        => 'main',
                'section_tab_slug'  => 'root_section_tab',
                'title'             => 'Main',
                'description'       => '',
            ),
			array(
                'section_id'        => 'design',
                'section_tab_slug'  => 'root_section_tab',
                'title'             => 'Designs',
                'description'       => '',
            ),
			array(
                'section_id'        => 'seo',
                'section_tab_slug'  => 'root_section_tab',
                'title'             => 'SEO',
                'description'       => '',
            )		
        );
		
	
		
        // Fields in Main Section
        $this->addSettingFields(
            'main',    // target page slug         
			array(
				'field_id'      => 'status',
				'title'         => __( 'Status', 'amaucp-admin' ),
				'type'          => 'radio',
				'default'       => 1,
				'label'         => array(
					1 => __( 'Activate', 'amaucp-admin' ),
					0 => __( 'Deactivate', 'amaucp-admin' )
				),
			),
			array( // Single date-time picker
				'field_id'      => 'end_date_time',
				'type'          => 'ama-datetime',
				'title'         => __( 'Date End Maintenance Mode', 'amaucp-admin' ),
				'default'		=> '08/24/2020'
			),
			array(
				'field_id'      => 'end_hour_time',
				'title'         => __( 'Hour End Maintenance Mode', 'amaucp-admin' ),
				'type'          => 'select',
				'help'          => __( 'This is the <em>select</em> field type.', 'amaucp-admin' ),
				'default'       => '0',
				'label'         => array(
					'0' => '00','1' => '01','2' => '02','3' => '03','4' => '04','5' => '05','6' => '06','7' => '07','8' => '08','9' => '09','10' => '10','11' => '11','12' => '12','13' => '13','14' => '14','15' => '15','16' => '16','17' => '17','18' => '18','19' => '19','20' => '20','21' => '21','22' => '22','23' => '23'
				),
			),
			array(
				'field_id'      => 'end_minute_time',
				'title'         => __( 'Minute End Maintenance Mode', 'amaucp-admin' ),
				'type'          => 'select',
				'help'          => __( 'This is the <em>select</em> field type.', 'amaucp-admin' ),
				'default'       => '0',
				'label'         => array(
					'0' => '00','15' => '15','30' => '30','45' => '45'
				),
			),
			array( // Single date-time picker
				'field_id'      => 'logo',
				'type'          => 'media',
				'default'		=> '',
				'title'         => __( 'Logo (size : 100x100)', 'amaucp-admin' )
			),
			array( // Single date-time picker
				'field_id'      => 'title',
				'type'          => 'textarea',
				'default'		=> 'We are coming soon',
				'title'         => __( 'Title', 'amaucp-admin' ),
				'description'   => 'Example : THE WEBSITE RIGH NOW  &#x3C;span&#x3E; UNDER CONSTRUCTION &#x3C;/span&#x3E;',
			),
			array( // Single date-time picker
				'field_id'      => 'description',
				'type'          => 'textarea',
				'default'		=> 'We are working hard on the new version of our site. It will bring a lot featured. Stay Tuned',
				'rich' => array( 
					'media_buttons' => false, 
					'tinymce'       => false
				),    
				'title'         => __( 'Description', 'amaucp-admin' ),
				'description'	=> 'Example: We are working hard on the new version of our site. It will bring a lot featured. Stay Tuned'
			),
			array(
				'field_id'      => 'blacklisted_user_roles',
				'title'         => __( 'Do not show Underconstruction to User Roles', 'amaucp-admin' ),
				'help'          => __( 'This is the <em>select</em> field type.', 'amaucp-admin' ),
				'default'		=> array('administrator','editor'),
				'label'         =>  array(
					'administrator' => 'administrator',
					'editor' => 'editor',
					'author' => 'author',
					'contributor' => 'contributor',
					'subscriber' => 'subscriber',
					
				),
				'type'          => 'checkbox',
				'is_multiple'   => true,
				'attributes'    =>  array(
					'select'    =>  array(
						'size'  => 10,
					),
				),
			)
        );
		
		
		/**
		Fields in Designs Section
		**/
		
		// Add found themes
		$found_themes = amaucp_found_themes();
		
		$list_themes = array();
		foreach($found_themes as $key => $value) {
			$list_themes[$key]['theme'] = $key;
		}
		
		
		foreach($found_themes as $key => $value) {
			$list_themes[$key]['screenshot'] = $value['theme_url'] . '/screenshot.png';
			$list_themes[$key]['preview'] = get_home_url() .'/?amaucp_theme='. $key .'&amaucp_preview=1';
			$list_themes[$key]['enable'] = 1;
		}
		$preview_list_themes = array();
		
		/* 
		This is Reserve For Demo Addons . Add this code for preview addons : 
		$preview_list_themes['pro_1']['theme'] = 'pro_1';
		$preview_list_themes['pro_1']['screenshot'] = amaucp()->plugin_url . "images/preview/1.png";
		$preview_list_themes['pro_1']['preview'] = 'http://www.wpamanuke.com';
		$preview_list_themes['pro_1']['enable'] = 0;
		*/
		
		if(has_filter('amaucp_remove_preview_list_theme')) {
			$preview_list_themes = apply_filters('amaucp_remove_preview_list_theme', $preview_list_themes);
		}
				
		$list_themes = array_merge($list_themes,$preview_list_themes);
        $this->addSettingFields(
            'design',    // target page slug         
			array(
				'field_id'      => 'default_theme',
				'title'         => __( 'UCP Themes', 'amaucp-admin' ),
				'type'          => 'ama-theme',
				'help'          => __( 'This is the <em>select</em> field type.', 'amaucp-admin' ),
				'default'       => 'default',
				'label'         => $list_themes
			)
        );
		
		
		
		/**
		Fields in SEO Section
		**/
		// Add form fields
        $this->addSettingFields(
            'seo',    // target page slug        
			array( // Single date-time picker
				'field_id'      => 'meta_title',
				'type'          => 'text',
				'default' 		=> 'Coming Soon Page',
				'title'         => __( 'Page Meta Title', 'amaucp-admin' ),
				'description'   => 'Example : Coming Soon Page'
			),
			array( // Single date-time picker
				'field_id'      => 'meta_description',
				'type'          => 'textarea',
				'default'		=> 'Unfortunately, the website is still under development. Hopefully, we will have the first version online in a few weeks',
				'title'         => __( 'Page Meta Description', 'amaucp-admin' ),
				'description'   => 'Example : Unfortunately, the website is still under development. Hopefully, we will have the first version online in a few weeks'
			),
			array( // Single date-time picker
				'field_id'      => 'meta_keywords',
				'type'          => 'text',
				'default'		=> 'coming soon, under construction page , under development',
				'title'         => __( 'Page Meta Keywords', 'amaucp-admin' ),
				'description'   => 'Example : coming soon, under construction page , under development'
			),
			array(
				'field_id'      => 'robots_meta_tag',
				'title'         => __( 'Robots Meta Tags', 'amaucp-admin' ),
				'type'          => 'radio',
				'help'          => __( 'This is the <em>select</em> field type.', 'amaucp-admin' ),
				'default'       =>1,
				'label'         => array(
					1 => __( 'index, follow', 'admin-page-framework-loader' ),
					0 => __( 'noindex, nofollow', 'admin-page-framework-loader' )
				),
				'description'   => 'Default: index, follow'
			),
			array(
				'field_id'      => 'search_bots',
				'title'         => __( 'Bypass for Search Bots', 'amaucp-admin' ),
				'type'          => 'radio',
				'help'          => __( 'This is the <em>select</em> field type.', 'amaucp-admin' ),
				'default'       => 1,
				'label'         => array(
					1 => __( 'Yes', 'amaucp-admin' ),
					0 => __( 'No', 'amaucp-admin' )
				),
				'description'   => 'Default: Yes'
			),
			array(
				'field_id'      => 'show_503',
				'title'         => __( 'Show 503 header', 'amaucp-admin' ),
				'type'          => 'radio',
				'help'          => __( 'This is the <em>select</em> field type.', 'amaucp-admin' ),
				'default'       => 0,
				'label'         => array(
					1 => __( 'Yes', 'amaucp-admin' ),
					0 => __( 'No', 'amaucp-admin' )
				),
				'description'   => 'Default: No'
			)
        );
		
		
		// Add form sections
        $this->addSettingSections(
            'amaucp_reset',    // target page slug
			 array(
					'section_id'    => 'reset_section',
					'title'         => __( 'Reset Button', 'amaucp-admin' ),
					'order'         => 10,
				)
			);   
		$this->addSettingFields(     
            'reset_section',
            // Reset options with a check box
            array(
                'field_id'  => 'reset',
                'type'      => 'submit',
                'reset'     => true,
                'show_title_column' => false,
                'value'     => __( 'Reset', 'amaucp-admin' ),                
            )     
        );          
			
		 // SOCIAL
		 $this->addSettingSections( 
            'amaucp_social',    // target page slug
			array(
                'section_id'        => 'social_check',
                'title'             => 'Social',
                'description'       => ''
            )
         );
		 $this->addSettingFields(
            'social_check',    // target page slug
			
			array(
				'field_id'      => 'social_show',
				'title'         => __( 'Use Social Network', 'amaucp-admin' ),
				'type'          => 'radio',
				'help'          => __( 'This is the <em>select</em> field type.', 'amaucp-admin' ),
				'default'       => 1,
				'label'         => array(
					1 => __( 'Yes', 'amaucp-admin' ),
					0 => __( 'No', 'amaucp-admin' )
				),
			));
		 $this->addSettingSections( 
            'amaucp_social',    // target page slug
			array(
                'section_id'        => 'social',
                'section_tab_slug'  => 'social_sections',
                'title'             => 'Social',
                'description'       => '',
				'repeatable'    => array(   
                    'max' => 30,
                    'min' => 1,
                ),  
                'sortable'          => true
            )
        );
	
        $this->addSettingFields(
            'social',    // target page slug
			array(
                'field_id'      => 'social_title',
                'type'          => 'section_title',
                'label'         => __( 'Title', 'amaucp-admin' ),
                'attributes'    => array(
                    'size' => 10,
                    // 'type' => 'number', // change the input type 
                ),
            ),
			array(
				'field_id'      => 'social_type',
				'title'         => __( 'Social Type', 'amaucp-admin' ),
				'type'          => 'select',
				'help'          => __( 'This is the <em>select</em> field type.', 'amaucp-admin' ),
				'default'       => 'twitter',
				'label'         => array(
					'fa-twitter' => __( 'twitter', 'amaucp-admin' ),
					'fa-facebook' => __( 'facebook', 'amaucp-admin' ),
					'fa-instagram' => __( 'instagram', 'amaucp-admin' ),
					'fa-linkedin' => __( 'linkedin', 'amaucp-admin' ),
					'fa-google' => __( 'google', 'amaucp-admin' ),
					'fa-youtube' => __( 'youtube', 'amaucp-admin' ),
					'fa-vimeo' => __( 'vimeo', 'amaucp-admin' ),
					'fa-pinterest' => __( 'pinterest', 'amaucp-admin' ),
					'fa-dribbble' => __( 'dribbble', 'amaucp-admin' ),
					'fa-behance' => __( 'behance', 'amaucp-admin' ),
					'fa-tumblr' => __( 'tumblr', 'amaucp-admin' ),
					'fa-wordpress' => __( 'wordpress', 'amaucp-admin' )
					
				),
			),
			array(
				'field_id'      => 'social_url',
				'title'         => __('Social Url', 'amaucp-admin' ),
				'type'          => 'text'				
			)
			
        );
		
		/* SUBSCRIBE */
		 $this->addSettingSections(
           'amaucp_subscribe',    // target page slug
			array(
                'section_id'        => 'subscribe',
                'title'             => 'Subscribe',
                'description'       => ''
            )
         );
		$this->addSettingFields(
            'subscribe',    // target page slug         
			array(
				'field_id'      => 'subscribe_show',
				'title'         => __( 'Show Subscribe', 'amaucp-admin' ),
				'type'          => 'radio',
				'help'          => __( 'This is the <em>select</em> field type.', 'amaucp-admin' ),
				'default'       => 1,
				'label'         => array(
					1 => __( 'Activate', 'amaucp-admin' ),
					0 => __( 'Deactivate', 'amaucp-admin' )
				),
			),
			array( // Single date-time picker
				'field_id'      => 'title',
				'type'          => 'text',
				'default'		=> 'Subscribe',
				'title'         => __( 'Title', 'amaucp-admin' )
			),
			array(
				'field_id'      => 'subscribe_type',
				'title'         => __( 'Subscribe Type', 'amaucp-admin' ),
				'type'          => 'select',
				'help'          => __( 'This is the <em>select</em> field type.', 'amaucp-admin' ),
				'default'       => 'custom-post',
				'label'         => array(
					'custom_post' => __( 'Custom Post', 'amaucp-admin' ),
					'wp_mail' => __( 'WP_Mail', 'amaucp-admin' )					
				),
			),
			array( // Single date-time picker
				'field_id'      => 'admin_email',
				'type'          => 'text',
				'default'		=> '',
				'title'         => __( 'admin email (for Wp_Mail)', 'amaucp-admin' ),
				'description'	=> 'If empty than will be filled with your wordpress admin email'	
			)
		);
		do_action('amaucp_admin_setup',$this);
		
	 }
	
	public function do_amaucp_settings() {	// do_{page slug}
		submit_button();	// Add a submit button
	}

	public function do_amaucp_social() {	// do_{page slug}
		submit_button();	// Add a submit button
	}
		
	public function do_amaucp_subscribe() {	// do_{page slug}
		submit_button();	// Add a submit button
	}
    
}

endif;



?>