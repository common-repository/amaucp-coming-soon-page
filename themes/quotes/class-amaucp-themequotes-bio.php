<?php
	
if ( !class_exists( 'amaucp_themequotes_bio' ) ) :
// Extend the class
class amaucp_themequotes_bio extends AdminPageFramework {
	public function do_amaucp_themequote_bio() {	// do_{page slug}
		submit_button();	// Add a submit button
	}
	
		
     public function setUp() {
		$this->setRootMenuPageBySlug( 'edit.php?post_type=amaucp_subscriber');
        $this->addSubMenuItems(    
			array(
                'page_slug'     => 'amaucp_themequote_bio',
                'title' => __( 'Quote Bio', 'amaucp-admin' ),
                'order' => 601,
            )
        );	
		 $this->addSettingSections( 
            'amaucp_themequote_bio',    // target page slug
			array(
                'section_id'        => 'quote_bio_section',
                'title'             => 'Bio Information',
                'description'       => ''
            )
         );
		$this->addSettingFields(
            'quote_bio_section',    // target page slug
			array( // Single date-time picker
				'field_id'      => 'phone',
				'type'          => 'text',
				'default' 		=> '',
				'title'         => __( 'Phone', 'amaucp-admin' )
			),
			array( // Single date-time picker
				'field_id'      => 'email',
				'type'          => 'text',
				'default'		=> '',
				'title'         => __( 'Email', 'amaucp-admin' )
			),
			array( // Single date-time picker
				'field_id'      => 'company name',
				'type'          => 'text',
				'default'		=> '',
				'title'         => __( 'Company Name', 'amaucp-admin' )
			),
			array( // Single date-time picker
				'field_id'      => 'company url',
				'type'          => 'text',
				'default'		=> '',
				'title'         => __( 'Company URL', 'amaucp-admin' )
			)
		);
		 
	 }
}

endif;

$amaucp_themequotes_bio = new amaucp_themequotes_bio;	
?>