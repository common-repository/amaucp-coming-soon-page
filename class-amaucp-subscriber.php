<?php
if ( !defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'AMAUCP_Subscriber' ) ) :
/**
 * Main AmaUCP Class
 *
 */
class AMAUCP_Subscriber {
	public static function instance() {
	// Store the instance locally to avoid private static replication
		static $instance = null;
		// Only run these methods if they haven't been ran previously
		if ( null === $instance ) {
			$instance = new AMAUCP_Subscriber;
			$instance->add_actions();
		}

		// Always return the instance
		return $instance;
	}
	
	public function add_actions() {
		add_action( 'init', array( $this , 'create_posttype' ) );
		add_action( 'wp_ajax_amaucp_insert_subscriber' , array( $this , 'insert_subscriber_ajax' ) );
		add_action( 'wp_ajax_nopriv_amaucp_insert_subscriber' , array( $this , 'insert_subscriber_ajax' ) );
		add_filter( 'amaucp_default_var_enqueue_add' , array( $this , 'default_var_enqueue_add' ) );
	}
	
	// ajax data
	public function default_var_enqueue_add($args_array_add) {
		$random_nonce = wp_create_nonce( 'insert_subscriber_nonce' );
		$temp = array( 'send_subscriber_security' => $random_nonce );
		$args_array_add = array_merge( $args_array_add , $temp );
		return $args_array_add;
	}
	
	// change data to JSON
	public function echo_json($myObj) {
		$myJSON = json_encode( $myObj );
		echo $myJSON;
	}
	
	// here is the process ajax subscriber
	public function insert_subscriber_ajax () {
		$random_nonce = $_POST['send_subscriber_security'];
		$subscriber_type = amaucp_get_data( 'subscribe' , 'subscribe_type','custom_post' );
		$temp = wp_create_nonce( 'insert_subscriber_nonce' );
		$myObj->success = 0;
		$myObj->message = "You have no acces for this action " . $subscriber_type;
		
		if ( $temp != $random_nonce ) {
			$myObj->success = 0;
			$myObj->message = " You have no acces for this action ";
			$this->echo_json($myObj);
			die();
		}
		
		$email = $_POST['email'];
		$res = false;
		if ( $subscriber_type == 'custom_post' ) {
			if ( ! filter_var( $email , FILTER_VALIDATE_EMAIL ) ) {
				$myObj->success = 0;
				$myObj->message = "Your email is not valid";
				$this->echo_json( $myObj );
				die();			
			} else {
				$my_post = array(
				  'post_title'    => $email,
				  'post_status'   => 'publish',
				  'post_type'	  => 'amaucp_subscriber'
				);
				$res = wp_insert_post( $my_post );
				
			}
			if ($res) {
				$myObj->success = 1;
				$myObj->message = "Your email has been received to our database ";
			} else {
				$myObj->success = 0;
				$myObj->message = "There is error in the server";
			}
		} else if ( $subscriber_type == 'wp_mail' ) {
			$to = amaucp_get_data( 'subscribe' , 'admin_email' );
			$subject = "Subscribe by $email";
			if ( $to == '') {
				$to = get_option( 'admin_email' );
			}
			$message = "Subscribe by $email at ". date('Y-m-d H:i:s');
			$res = wp_mail( $to, $subject, $message );
			if ($res) {
				$myObj->success = 1;
				$myObj->message = "Your email has been send to administrator ";
			} else {
				$myObj->success = 0;
				$myObj->message = "There is error using wp_mail. Perhaps the server using Windows Server or admin email not set yet";
			}
		}
		
		
		$this->echo_json( $myObj );

		wp_die();
		
	}
	
	// Our custom post type function
	public function create_posttype() {
	 
		 register_post_type( 'amaucp_subscriber',
		// CPT Options
			array(
				'labels' => array(
					'name'                => __( 'Subscribers' , 'Post Type General Name', 'amaucp-admin' ),
					'singular_name'       => __('Subscriber' , 'Post Type Singular Name', 'amaucp-admin' ),
					'menu_name'           => __( 'AMAUCP UnderConstruction' , 'amaucp-admin' ),
					'parent_item_colon'   => __( 'Parent Subscriber' , 'amaucp-admin' ),
					'all_items'           => __( 'All Subscribers' , 'amaucp-admin' ),
					'view_item'           => __( 'View Subscriber' , 'amaucp-admin' ),
					'add_new_item'        => __( 'Add New Subscriber' , 'amaucp-admin' ),
					'add_new'             => __( 'Add New Subscriber' , 'amaucp-admin' ),
					'edit_item'           => __( 'Edit Subscriber' , 'amaucp-admin' ),
					'update_item'         => __( 'Update Subscriber' , 'amaucp-admin' ),
					'search_items'        => __( 'Search Subscriber' , 'amaucp-admin' ),
					'not_found'           => __( 'Not Found' , 'amaucp-admin' ),
					'not_found_in_trash'  => __( 'Not found in Trash' , 'amaucp-admin' ),
				),
				'supports' => array('title'),
				'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
				'publicly_queryable' => false,  // you should be able to query it
				'show_ui' => true,  // you should be able to edit it in wp-admin
				'exclude_from_search' => true,  // you should exclude it from search results
				'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
				'has_archive' => false,  // it shouldn't have archive page
				'rewrite' => false,  // it shouldn't have rewrite rules
				'menu_position' => 100,
				'capabilities' => array(
					'create_posts' => false,
				),
				'map_meta_cap' => true
				
			)
		);
	}
	
}
endif;






?>