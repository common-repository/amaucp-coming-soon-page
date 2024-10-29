<?php

if ( !class_exists( 'AMAUCP_Feature_Service' ) ) :
	
	class AMAUCP_Feature_Service extends AdminPageFramework {
		 
		 public function setUp() {
			$this->setRootMenuPageBySlug( 'edit.php?post_type=amaucp_subscriber');
			$this->addSubMenuItems(
				 array(
					'title'         => 'Service',    // page title
					'page_slug'     => 'amaucp_feature_services',    // page slug
					'order' => 203
				)
			);
			
			// SECTION
			$this->addSettingSections(
				'amaucp_feature_services',    // target page slug
				array(
					'section_id'        => 'amaucp_feature_services_options_section',
				
					'title'             => 'Feature Service',
					'description'       => ''
				)
			);
			 $this->addSettingFields(
				'amaucp_feature_services_options_section',    // target page slug         
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
				'amaucp_feature_services',    // target page slug
				array(
					'section_id'        => 'amaucp_feature_services_section',
					'title'             => 'Block Service',
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
				'amaucp_feature_services_section',    // target page slug         
				array(
					'field_id'      => 'icon',
					'title'         => __( 'Icon', 'amaucp-admin' ),
					'type'          => 'select',
					'label'         => array(
						'fa-money' => 'fa-money',
						'fa-heartbeat' => 'fa-heartbeat',
						'fa-handshake-0' => 'fa-handshake-0',
						'fa-film'		=> 'fa-film',
						'fa-audio'		=> 'fa-audio',
						'fa-envelop'	=> 'fa-envelope',
						'fa-camera'		=> 'fa-camera',
						'fa-car'		=> 'fa-car',
						'fa-bicycle'	=> 'fa-bicycle',
						'fa-coffee'		=> 'fa-coffee',
						'fa-bed'		=> 'fa-bed',
						'fa-desktop'	=> 'fa-desktop',
						'fa-database'	=> 'fa-databse',
						'fa-life-ring'	=> 'fa-life-ring',
						'fa-car'		=> 'fa-car',
						'fa-bus'		=> 'fa-bus',
						'fa-building'	=> 'fa-building',
						'fa-home'		=> 'fa-home',
						'fa-television'	=> 'fa-television'
					),
				),
				array( 
					'field_id'          => 'title',
					'title'             => __( 'Title', 'amaucp-admin' ),
					'type'              => 'text',
					'default'           => __( 'About', 'amaucp-admin' )
				),
				
				array( 
					'field_id'          => 'description',
					'title'             => __( 'Description', 'amaucp-admin' ),
					'type'              => 'textarea',
					'default'           => __( 'Our About Tagline', 'amaucp-admin' )
				)
			);
			
		 }
		 
		public function do_amaucp_feature_services() {	// do_{page slug}
			submit_button();	// Add a submit button
		}
		
	}

endif;



?>