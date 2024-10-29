<?php

if ( !class_exists( 'AMAUCP_IrseTheme' ) ) :
	
	class AMAUCP_IrseTheme extends AdminPageFramework {
		 
		 public function setUp() {
			$this->setRootMenuPageBySlug( 'edit.php?post_type=amaucp_subscriber');
			$this->addSubMenuItems(
				 array(
					'title'         => 'UCP Optons',    // page title
					'page_slug'     => 'amaucp_irsethemes',    // page slug
					'order' => 601
				)
			);
			
			// SECTION
			$this->addSettingSections(
				'amaucp_irsethemes',    // target page slug
				array(
					'section_id'        => 'amaucp_irsethemes_options_section',
				
					'title'             => 'About',
					'description'       => ''
				)
			);
			 $this->addSettingFields(
				'amaucp_irsethemes_options_section',    // target page slug         
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
				'amaucp_irsethemes',    // target page slug
				array(
					'section_id'        => 'amaucp_irsethemes_section',
					'title'             => 'About Block',
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
				'amaucp_irsethemes_section',    // target page slug         
				array(
					'field_id'      => 'media',
					'title'         => __( 'Image', 'amaucp-admin' ),
					'type'          => 'media',
					'description'	=> 'Image size 370x150'
				),
				array( 
					'field_id'          => 'title',
					'title'             => __( 'Title', 'amaucp-admin' ),
					'type'              => 'text',
					'default'           => __( 'Job Title', 'amaucp-admin' )
				),
				
				array( 
					'field_id'          => 'description',
					'title'             => __( 'Description', 'amaucp-admin' ),
					'type'              => 'textarea',
					'default'           => __( 'Your Description', 'amaucp-admin' )
				)
			);
			
		 }
		 
		public function do_amaucp_irsethemes() {	// do_{page slug}
			submit_button();	// Add a submit button
		}
		
	}

endif;

$amaucp_irsetheme = new AMAUCP_IrseTheme;	



?>