<?php

if ( !class_exists( 'AMAUCP_Feature_Quote' ) ) :
	
	class AMAUCP_Feature_Quote extends AdminPageFramework {
		 
		 public function setUp() {
			$this->setRootMenuPageBySlug( 'edit.php?post_type=amaucp_subscriber');
			$this->addSubMenuItems(
				 array(
					'title'         => 'Quotes',    // page title
					'page_slug'     => 'amaucp_feature_quotes',    // page slug
					'order' => 201
				)
			);
			
			// SECTION
			$this->addSettingSections(
				'amaucp_feature_quotes',    // target page slug
				array(
					'section_id'        => 'amaucp_feature_quotes_section',
					'title'             => 'Feature Quotes',
					'description'       => '',
				)
			);
			
			// FIELDS
			 $this->addSettingFields(
				'amaucp_feature_quotes_section',    // target page slug         
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
					'field_id'          => 'quotes_list',
					'title'             => __( 'Quotes', 'amaucp-admin' ),
					'type'              => 'textarea',
					'default'           => __( 'Keep clicking on the <code>+</code> button', 'amaucp-admin' ),
					'repeatable'        => array(
						'max' => 10,
						'min' => 2,
					)
				)
			);
		 }
		 
		public function do_amaucp_feature_quotes() {	// do_{page slug}
			submit_button();	// Add a submit button
		}
		
	}

endif;



?>