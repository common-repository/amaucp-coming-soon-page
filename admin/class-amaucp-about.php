<?php

if ( !class_exists( 'AMAUCP_About' ) ) :
	
	class AMAUCP_About extends AdminPageFramework {
		 
		 public function setUp() {
			$this->setRootMenuPageBySlug( 'edit.php?post_type=amaucp_subscriber');
			$this->addSubMenuItems(
				array(
					'href'  => 'http://wpamanuke.com',
					'title' => __( 'About', 'admin-page-framework-loader' ),
					'order' => 101,
				)
			);
		 }
	}

endif;

function amaucp_about() {
	$amaucp_about = new AMAUCP_About;
}


?>