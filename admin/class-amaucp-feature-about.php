<?php

if ( !class_exists( 'AMAUCP_Feature_About' ) ) :
	
	class AMAUCP_Feature_About extends AdminPageFramework {
		 
		 public function setUp() {
			$this->setRootMenuPageBySlug( 'edit.php?post_type=amaucp_subscriber');
			$this->addSubMenuItems(
				 array(
					'title'         => 'About',    // page title
					'page_slug'     => 'amaucp_feature_abouts',    // page slug
					'order' => 202
				)
			);
			
			// SECTION
			$this->addSettingSections(
				'amaucp_feature_abouts',    // target page slug
				array(
					'section_id'        => 'amaucp_feature_abouts_section',
					'title'             => 'Feature About',
					'description'       => '',
				)
			);
			
			// FIELDS
			 $this->addSettingFields(
				'amaucp_feature_abouts_section',    // target page slug         
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
				)
			);
		 }
		 
		public function do_amaucp_feature_abouts() {	// do_{page slug}
			submit_button();	// Add a submit button
		}
		
	}

endif;



?>