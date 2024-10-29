<?php
/*
Plugin Name: AMAUCP | Coming Soon Page / Maintenance Mode
Plugin URI: http://amaucp.wpamanuke.com/amaucp-coming-soon-page
Description: Create your coming soon page / maintenance mode / under construction page in wordpress easily without coding knowledge. AMAUCP Coming Soon Page is a wordpresss plugin to build coming soon page with  responsive design and will adapt to any device.
Version: 1.0.2
Author: WPAmaNuke
Author URI: http://amaucp.wpamanuke.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2017-2018 WPAmaNuke
*/

if ( !defined( 'ABSPATH' ) ) exit;

define( 'AMAUCP_PLUGIN_URL', plugin_dir_url( __FILE__ )); 

// Must have class
require_once( dirname( __FILE__ ) . '/library/apf/admin-page-framework.php' );
require_once( dirname( __FILE__ ) . '/class-amaucp.php');
require_once( dirname( __FILE__ ) . '/class-amaucp-subscriber.php');

// Admin Options
require_once ( dirname( __FILE__ ) . '/admin/class-amaucp-options.php' );

// Features Class
require_once ( dirname( __FILE__ ) . '/admin/class-amaucp-feature-quote.php' );
require_once ( dirname( __FILE__ ) . '/admin/class-amaucp-feature-about.php' );
require_once ( dirname( __FILE__ ) . '/admin/class-amaucp-feature-service.php' );
require_once ( dirname( __FILE__ ) . '/admin/class-amaucp-feature-team.php' );
require_once ( dirname( __FILE__ ) . '/admin/class-amaucp-feature-contact.php' );
require_once ( dirname( __FILE__ ) . '/admin/class-amaucp-contact.php' );

if (class_exists( 'AMAUCP_Contact' ) ) :
	new AMAUCP_Contact;
endif;

// Create Subscribe Post Type
function amaucp_subscriber() {
	$res = AMAUCP_Subscriber::instance();	
	return $res;
}
add_action( 'plugins_loaded', 'amaucp_subscriber' );

// Create UCP Options
function amaucp() {
	$res = AMAUCP::instance();	
	return $res;
}
add_action( 'plugins_loaded' , 'amaucp' );

// Load any function for addons
function amaucp_addons() {
	$amaucp_admin = new AMAUCP_Options;
	do_action( 'amaucp_require_addons' );
}
add_action( 'plugins_loaded', 'amaucp_addons');

// AMAUCP theme functions
function amaucp_style_enqueue( $css_name , $data='' ) {
	amaucp()->add_style_enqueue( $css_name , $data );
}
function amaucp_script_enqueue( $js_name , $data='' ) {
	amaucp()->add_script_enqueue($js_name,$data);
}
function amaucp_var_enqueue( $var_name , $data ) {
	amaucp()->add_var_enqueue( $var_name , $data );
}
function amaucp_found_themes() {
	return amaucp()->found_themes;
}
function amaucp_get_theme_url(){
	return amaucp()->theme_default_url;
}
function amaucp_get_theme_dir(){
	return amaucp()->theme_default_dir;
}
function amaucp_head(){
	do_action( 'amaucp_head' );
}
function amaucp_footer(){
	do_action( 'amaucp_footer' );
}
function amaucp_get_data( $section , $var , $default='' ) {
	return amaucp()->get_data( $section , $var , $default );
}
function amaucp_get_logo() {
	return amaucp_get_data( 'main' , 'logo' , '' );
}
function amaucp_get_title() {
	return amaucp_get_data( 'main' , 'title' , 'Underconstruction Page' );
}
function amaucp_get_description() {
	return amaucp_get_data( 'main' , 'description' , 'Unfortunately, the website is still under development. Hopefully, we will have the first version online in a few weeks' );
}

function amaucp_get_date( $format ) {
	return amaucp_get_data( 'main' , 'end_date_time' );
	$date = new DateTime( amaucp_get_end_date() );
	return date_format( $date , $format );
}
function amaucp_show_subscribe_form() {
	amaucp()->show_subscribe_form();
}
function amaucp_socialmedia() {
	$socialArray = "";
	if (isset(amaucp()->data['social'])) {
		$socialArray = amaucp()->data['social'];
	}
	
	$use_social = amaucp_get_data( 'social_check' , 'social_show' , 0 );
	if ($use_social) {
		$default = array( "social_url" => "" , "social_title" => "" , "social_type" => "" );
		$socialArray = array_diff_key( $socialArray ,$default);
		if ( array_key_exists( 0, $socialArray ) ) {
			$i = 0;
			echo "<ul>";
			foreach ( $socialArray as $key => $aSocial ) {
				if (array_key_exists($i, $socialArray)) {
					echo '<li><a href="' . esc_url($aSocial['social_url']) .'" target="_blank" title="'. esc_attr($aSocial['social_title']) .'" target="_blank"><i class="fa '. $aSocial['social_type'] .'"></i></a></li>';
				}	
				$i++;
			}
			echo "</ul>";
		}
	}
	
}


// Get data options (from get_option)
function amaucp_get_datax( $data,$section , $var , $default='' ) {
	if ( isset( $data ) ) {
		if ( isset( $data[ $section ] ) ){
			if ( isset( $data[ $section ][ $var ] ) ) {
					return $data[ $section ][ $var ];
			}
		}
	}
	return $default;
}
function amaucp_get_datay( $data,$section , $default='' ) {
	if ( isset( $data ) ) {
		if ( isset( $data[ $section ] ) ){
			return $data[ $section ];
		}
	}
	return $default;
}
?>