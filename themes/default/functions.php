<?php
	
/* Add CSS */
amaucp_style_enqueue('bootstrap');
amaucp_style_enqueue('font-awesome');
amaucp_style_enqueue('google-open-sans');
amaucp_style_enqueue('css',amaucp_get_theme_url() . '/style.css');



/* Add JS */
amaucp_script_enqueue('jquery');
amaucp_script_enqueue('jq.countdown.plugin');
amaucp_script_enqueue('jq.countdown');
amaucp_script_enqueue('jq.subscribe');
amaucp_script_enqueue('jq.colequalizer.mod');

amaucp_script_enqueue('amaucp-script',amaucp_get_theme_url() . '/js/script.js');

if ( class_exists( 'AMAUCP_Options' ) ) {
	require_once( dirname( __FILE__ ) . '/class-amaucp-irsetheme.php' );
}
	
?>