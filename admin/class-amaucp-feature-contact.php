<?php

if ( !class_exists( 'AMAUCP_Feature_Contact' ) ) :
	
	class AMAUCP_Feature_Contact extends AdminPageFramework {
		 
		 public function setUp() {
			$this->setRootMenuPageBySlug( 'edit.php?post_type=amaucp_subscriber');
			$this->addSubMenuItems(
				 array(
					'title'         => 'Contact',    // page title
					'page_slug'     => 'amaucp_feature_contacts',    // page slug
					'order' => 205
				)
			);
			
			// SECTION
			$this->addSettingSections(
				'amaucp_feature_contacts',    // target page slug
				array(
					'section_id'        => 'amaucp_feature_contacts_options_section',
				
					'title'             => 'Feature Contact',
					'description'       => ''
				)
			);
			 $this->addSettingFields(
				'amaucp_feature_contacts_options_section',    // target page slug      
				array(
					'field_id'      => 'contact_status',
					'title'         => __( 'Contact Status', 'amaucp-admin' ),
					'type'          => 'radio',
					'default'       => 1,
					'label'         => array(
						1 => __( 'Activate', 'amaucp-admin' ),
						0 => __( 'Deactivate', 'amaucp-admin' )
					),
				),
				array( 
					'field_id'          => 'contact_title',
					'title'             => __( 'Contact Title ', 'amaucp-admin' ),
					'type'              => 'text',
					'default'           => __( 'Contact', 'amaucp-admin' )
				),
				array( 
					'field_id'          => 'contact_tagline',
					'title'             => __( 'Contact Tagline ', 'amaucp-admin' ),
					'type'              => 'text',
					'default'           => __( 'Contact is king my country', 'amaucp-admin' )
				),
				array( 
					'field_id'          => 'contact_form_title',
					'title'             => __( 'Contact Form Title', 'amaucp-admin' ),
					'type'              => 'text',
					'default'           => __( 'Leave Message', 'amaucp-admin' )
				),
				
				array(
					'field_id'      => 'list_contact_status',
					'title'         => __( 'List Contact Status', 'amaucp-admin' ),
					'type'          => 'radio',
					'default'       => 1,
					'label'         => array(
						1 => __( 'Activate', 'amaucp-admin' ),
						0 => __( 'Deactivate', 'amaucp-admin' )
					),
				),
				array( 
					'field_id'          => 'list_contact_title',
					'title'             => __( 'List Contact Title ', 'amaucp-admin' ),
					'type'              => 'text',
					'default'           => __( 'Contact Information', 'amaucp-admin' )
				)
				
			);
			
			
			$this->addSettingSections(
				'amaucp_feature_contacts',    // target page slug
				array(
					'section_id'        => 'amaucp_feature_contacts_section',
					'title'             => 'List Contact',
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
				'amaucp_feature_contacts_section',    // target page slug  
				array(
					'field_id'      => 'contact_type',
					'title'         => __( 'Icon', 'amaucp-admin' ),
					'type'          => 'select',
					'label'         => array(
						'fa-home' => 'fa-home',
						'fa-building' => 'fa-building',
						'fa-phone'	=> 'fa-phone',
						'fa-mobile'	=> 'fa-mobile',
						'fa-envelope' => 'fa-envelope',
						'fa-address-book' => 'fa-address-book',
						'fa-book'	=> 'fa-book'
						
					),
					'attributes'    => array(
						'fieldset'  => array(
							'style'  => 'width: 48%; padding-right: 2%;',
						),
					),                        
				),
				array(
					'field_id'      => 'contact_text',
					'type'          => 'text',
					'title'         => __( 'Text	', 'admin-page-framework-loader' ),
					'attributes'    => array(
						'fieldset'  => array(
							'style'  => 'width: 100%; padding-right: 2%;',
						),
				  
					),
				)
			);
			
		 }
		 
		public function do_amaucp_feature_contacts() {	// do_{page slug}
			submit_button();	// Add a submit button
		}
		
	}

endif;



?>