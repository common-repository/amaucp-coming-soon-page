<?php
	
/* Add CSS */
amaucp_style_enqueue('bootstrap');
amaucp_style_enqueue('font-awesome');
amaucp_style_enqueue('css',amaucp_get_theme_url() . '/style.css');

/* Add JS */
amaucp_script_enqueue('jquery');
amaucp_script_enqueue('jq.countdown.plugin');
amaucp_script_enqueue('jq.countdown');
amaucp_script_enqueue('jq.subscribe');

amaucp_script_enqueue('myscript',amaucp_get_theme_url() . '/js/script.js');

	
?>