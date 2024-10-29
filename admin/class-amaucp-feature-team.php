<?php

if ( !class_exists( 'AMAUCP_Feature_Team' ) ) :
	
	class AMAUCP_Feature_Team extends AdminPageFramework {
		 
		 public function setUp() {
			$this->setRootMenuPageBySlug( 'edit.php?post_type=amaucp_subscriber');
			$this->addSubMenuItems(
				 array(
					'title'         => 'Team',    // page title
					'page_slug'     => 'amaucp_feature_teams',    // page slug
					'order' => 204
				)
			);
			
			// SECTION
			$this->addSettingSections(
				'amaucp_feature_teams',    // target page slug
				array(
					'section_id'        => 'amaucp_feature_teams_options_section',
				
					'title'             => 'Feature Team',
					'description'       => ''
				)
			);
			 $this->addSettingFields(
				'amaucp_feature_teams_options_section',    // target page slug         
				array(
					'field_id'      => 'status',
					'title'         => __( 'Status', 'amaucp-admin' ),
					'type'          => 'radio',
					'default'       => 1,
					'label'         => array(
						1 => __( 'Activate', 'amaucp-admin' ),
						0 => __( 'Deactivate', 'amaucp-admin' )
					),
				)
			);
			
			
			$this->addSettingSections(
				'amaucp_feature_teams',    // target page slug
				array(
					'section_id'        => 'amaucp_feature_teams_section',
					'title'             => 'Block Team',
					'description'       => '',
					 'collapsible'       => array(
						'toggle_all_button' => array( 'top-left', 'bottom-left' ),
						'container'         => 'section',
						'is_collapsed'      => false,
					),
					'repeatable'        => true, // this makes the section repeatable
					'sortable'          => true,
				)
			);
			
			// FIELDS
			 $this->addSettingFields(
				'amaucp_feature_teams_section',    // target page slug  
				array( 
					'field_id'          => 'media',
					'title'             => __( 'Media', 'amaucp-admin' ),
					'type'              => 'media',
					'default'           => ''
				),
				array( 
					'field_id'          => 'title',
					'title'             => __( 'Title', 'amaucp-admin' ),
					'type'              => 'text',
					'default'           => __( 'About', 'amaucp-admin' )
				),
				array( 
					'field_id'          => 'tagline',
					'title'             => __( 'Tagline', 'amaucp-admin' ),
					'type'              => 'text',
					'default'           => __( 'Our About Tagline', 'amaucp-admin' )
				),
				array( 
					'field_id'          => 'description',
					'title'             => __( 'Description', 'amaucp-admin' ),
					'type'              => 'textarea',
					'default'           => __( 'Our About Tagline', 'amaucp-admin' )
				),
				array(
					'field_id'      => 'social_media',
					'title'         => __( 'Social Media', 'admin-page-framework-loader' ),
					'type'          => 'inline_mixed',
					'repeatable'    => true,
					'sortable'      => true,
					'content'       => array(
						array(
							'field_id'      => 'social_type',
							'title'         => __( 'Icon', 'amaucp-admin' ),
							'type'          => 'select',
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
							'attributes'    => array(
								'fieldset'  => array(
									'style'  => 'width: 48%; padding-right: 2%;',
								),
							),                        
						),
						array(
							'field_id'      => 'social_url',
							'type'          => 'text',
							'title'         => __( 'Url	', 'admin-page-framework-loader' ),
							'attributes'    => array(
								'fieldset'  => array(
									'style'  => 'width: 100%; padding-right: 2%;',
								),
						  
							),
						),
					),
				)
			);
			
		 }
		 
		public function do_amaucp_feature_teams() {	// do_{page slug}
			submit_button();	// Add a submit button
		}
		
	}

endif;



?>