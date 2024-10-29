<?php

if ( !class_exists( 'AMAUCP_Contact' ) ) :

class AMAUCP_Contact {
	 public function __construct() {
		 add_action( 'wp_ajax_amaucp_send_contact' , array( $this , 'send_contact_ajax' ) );
		 add_action( 'wp_ajax_nopriv_amaucp_send_contact' , array( $this , 'send_contact_ajax' ) );
		 add_filter( 'amaucp_default_var_enqueue_add' , array( $this , 'default_var_enqueue_add' ) );
	 }
	 
	 // ajax data
	public function default_var_enqueue_add($args_array_add) {
		$random_nonce = wp_create_nonce( 'send_contact_nonce' );
		$temp = array( 'send_contact_security' => $random_nonce );
		$args_array_add = array_merge( $args_array_add , $temp );
		return $args_array_add;
	}
	
	// change data to JSON
	public function echo_json($myObj) {
		$myJSON = json_encode( $myObj );
		echo $myJSON;
	}
	
	public function send_contact_ajax() {
		$random_nonce = $_POST['send_contact_security'];
		$temp = wp_create_nonce( 'send_contact_nonce' );
		$myObj->success = 0;
		$myObj->message = "You have no acces for this action ";
		if ($temp!=$random_nonce) {
			$this->echo_json($myObj);
			die();
		}
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$to = get_option( 'admin_email' );
		$subject = "Contact by $email at ". date('Y-m-d H:i:s');
		
		$body = "From : ". $name . " Email : ". $email . " Message : " . $message;
		$res = wp_mail( $to, $subject, $body );
		if ($res) {
			$myObj->success = 1;
			$myObj->message = "Your email has been send to administrator ";
		} else {
			$myObj->success = 0;
			$myObj->message = "There is error using wp_mail. Perhaps the server using Windows Server or admin email not set yet";
		}
		$this->echo_json( $myObj );
		wp_die();
	
	}
}
endif;



?>