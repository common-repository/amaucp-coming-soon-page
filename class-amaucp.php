<?php
if ( !defined( 'ABSPATH' ) ) exit;
include( dirname( __FILE__ ) . '/library/field/ama-date-custom-field-type/class-amaucp-customfieldtype.php' );
include( dirname( __FILE__ ) . '/library/field/ama-theme-custom-field-type/class-amaucp-themecustomfieldtype.php' );

if ( !class_exists( 'AMAUCP' ) ) :
/**
 * Main AmaUCP Class
 *
 */
class AMAUCP {
	private function __construct() { /* Do nothing here */ }
	public function __clone() { _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'amaucp' ), '1.0' ); }
	
	public static function instance() {

		// Store the instance locally to avoid private static replication
		static $instance = null;
		// Only run these methods if they haven't been ran previously
		if ( null === $instance ) {
			$instance = new AMAUCP;
			$instance->setup_globals();
			$instance->add_actions();
		}

		// Always return the instance
		return $instance;
	}
		
	
	
	/**
	 * Set some smart defaults to class variables. 
	 */
	private function setup_globals() {
		
		$this->file       = __FILE__;
		$this->basename   = plugin_basename( $this->file );
		$this->plugin_dir = plugin_dir_path( $this->file );
		$this->plugin_url = plugin_dir_url( $this->file );
		$this->includes_dir = $this->plugin_dir . 'includes/';
		$this->data = $this->get_options();
		$found_themes = $this->theme_search_directories();
		$default_template = $this->get_default_template();
		$this->theme_default_dir = '';
		$this->theme_default_url = '';
		if (isset($found_themes[$default_template])) {
			$this->theme_default_dir = $found_themes[ $default_template ]['theme_root'];
			$this->theme_default_url = $found_themes[ $default_template ]['theme_url'];
			
		}
		$this->style_enqueue = array();
		$this->script_enqueue = array();
		$this->var_enqueue = array();
		$this->setup_default_var_enqueue();		
		$this->include_theme_functions();
		
	}
	
	/**
	* Include theme functions
	**/
	public function include_theme_functions() {
		
		$filename = $this->theme_default_dir . '/functions.php';
		if ( file_exists( $filename ) ) {
			require_once( $filename );
		}
	}
	
	/**
	 * Setup the default hooks and actions
	 *
	 */
	private function add_actions() {
		add_action( 'template_redirect' , array( $this , 'template_redirect' ) );	
		add_action( 'amaucp_head' ,array( $this , 'seo_meta' ), 9 );
		add_action( 'amaucp_head' , array( $this , 'head' ), 9 );	
		add_action( 'amaucp_footer' , array( $this, 'footer' ), 9 );	
		add_action( 'admin_bar_menu' , array( $this , 'admin_bar_menu' ), 1000);
		
		// Admin plugin install menu links 
		$plugin = plugin_basename(__FILE__); 
		add_filter( "plugin_action_links_$plugin" , array( $this , 'settings_link' ) );
	}
	
	// Get Data from Options
	public function get_options() {
		$data = get_option( 'AMAUCP_Options' );
		return $data;
	}
	
	// Print Data on Head Template
	public function head() {
		$this->print_styles( $this->style_enqueue );
	}
	
	// Print Data on Footer Template
	public function footer() {
		$this->print_var( $this->var_enqueue );
		$this->print_scripts( $this->script_enqueue );
		
	}
	
	// Include CSS File on Template
	public function add_style_enqueue( $css_name , $data = '' ) {
		$styles_default = $this->css_default();
		
		if ($data=='') {
			
			if ( isset( $styles_default[ $css_name ] ) ) {
				
				$this->style_enqueue[ $css_name ] = $styles_default[$css_name];
				
			}
		} else {
			$this->style_enqueue[ $css_name ] = $data;
			
		}
		
	}
	
	// Include JS File on Template
	public function add_script_enqueue( $script_name , $data = '' ) {
		$scripts_default = $this->js_default();
		if ( $data == '' ) {
			if ( isset( $scripts_default[ $script_name ] ) ) {
				$this->script_enqueue[ $script_name ] = $scripts_default[ $script_name ];
			}
		} else {
			$this->script_enqueue[ $script_name ] = $data;
		}
	}
	
	// Include Data on Template 
	public function add_var_enqueue( $var_name , $data ) {
		if ( $data ) {
			$this->var_enqueue[ $var_name ] = $data;
		} 
	}
	
	// Default Data on Template
	public function setup_default_var_enqueue() {
		
		$args_array = array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ) , 
			'till_date' => $this->get_till_date( 'j' ),
			'till_month' => $this->get_till_date( 'n' ),
			'till_year' => $this->get_till_date( 'Y' ),
			'till_hour' => $this->get_till_date( 'G' ),
			'till_minute' => $this->get_till_date( 'i' )
		);
		
		$args_array_add = array();
		if( has_filter( 'amaucp_default_var_enqueue_add' ) ) {
			$args_array_add = apply_filters( 'amaucp_default_var_enqueue_add' , $args_array_add );
		}
		
		$args_array =  array_merge( $args_array , $args_array_add );
		$this->add_var_enqueue( 'amaucp' , $args_array );
	}
	
	
	// Default js file which can be used
	public function js_default() {
		$wp_scripts = wp_scripts();
		$scripts = array(
			'jquery' => site_url( $wp_scripts->registered['jquery-core']->src ),
			'jq.countdown.plugin' => $this->plugin_url . 'public/js/keith-wood/jquery.countdown.plugin.js',
			'jq.countdown' => $this->plugin_url . 'public/js/keith-wood/jquery.countdown.js',
			'jq.countdown.do' => $this->plugin_url . 'public/js/keith-wood/jquery.countdown.do.js',	
			'jq.subscribe'=> $this->plugin_url . 'public/js/amaucp/jquery.subscribe.do.js',
			'jq.contact.do'=> $this->plugin_url . 'public/js/amaucp/jquery.contact.do.js',			
			'jq.textslider'=> $this->plugin_url . 'public/js/jq.textslider.js',
			'jq.colequalizer.mod'=> $this->plugin_url . 'public/js/jq.bootstrap-colequalizer-mod.js',
			
		);
		return $scripts;
	}
	
	// Default CSS File which can be used
	public function css_default() {
		$styles_default = array(
			'bootstrap' => $this->plugin_url . 'public/css/bootstrap.css',
			'font-awesome' => $this->plugin_url . 'public/css/font-awesome.css',
			'google-open-sans' => 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i',
			'google-raleway' => 'https://fonts.googleapis.com/css?family=Raleway:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i'
		);
		
		return $styles_default;
	}
	
	// echo the css file in template
	public function print_styles( $styles ){
		foreach ( $styles as $src ) {
			echo '<link rel="stylesheet" href="'. esc_url($src) .'">' . "\n"; 
		}
	}
	
	// echo the js file in template
	public function print_scripts( $scripts ){
		foreach ( $scripts as $src ) {
			echo '<script src="'. esc_url( $src ) .'"></script>' .  "\n"; 
		}
	}
	
	// echo variable in template
	public function print_var( $vars ){
		$output = '';
		
		foreach ( $vars as $name => $dataArray ) {
			$output_val = '';
			$length = count( $dataArray );
			$count = 1;
			foreach ( $dataArray as $key => $value ){
			  $output_val = $output_val . "'" . $key . "':" . wp_json_encode( $value );
			  if ( $count != $length ) {
				  $output_val = $output_val . ",";
			  }
			  $count++;
			  
			}
					
			$output = $output . "\n" . $name . " = { " . $output_val  ." };";
		}
		
		echo "<script type='text/javascript'>\n"; // CDATA and type='text/javascript' is not needed for HTML 5
        echo "/* <![CDATA[ */\n";
        echo "$output\n";
        echo "/* ]]> */\n";
        echo "</script>\n";
 
	}
	
	// redirect to ucp before become theme
	public function template_redirect() {
		
		$preview = $this->is_preview();
		if ( $this->is_search_bots() ) {
			$preview = false;
		}
		if ( $preview ) {
				$preview = $this->is_user_can_preview();
		}
		if ( $preview ) {
			$preview = $this->is_date_expired();
		}
		if ( isset( $_GET['amaucp_preview'] ) ) {
			if ( ! empty( $_GET['amaucp_preview'] ) ) {
				$preview = sanitize_text_field( $_GET['amaucp_preview'] );
			}
		}
		
		if ( $this->is_404() ) {
			$preview = false;
		}
		if ( $preview ) {
			$this->show_503();
			$theme_dir = $this->get_theme_dir();
			$filename = $theme_dir . '/index.php';
			if ( file_exists( $filename ) ) {
				require_once( $filename );
				die();
			}
		}
	}
	
	
	// theme root for template in another plugin
	public function theme_roots() {
		$this->theme_paths['theme_roots'][] = $this->plugin_dir. 'themes/';
		$this->theme_paths['theme_urls'][] = $this->plugin_url . 'themes/';
	
		if( has_filter( 'amaucp_theme_roots_add' ) ) {
			$this->theme_paths = apply_filters( 'amaucp_theme_roots_add', $this->theme_paths );
			
		}
	
		return $this->theme_paths;
	}
	
	// search ucp theme in another plugin
	public function theme_search_directories() {
		$this->found_themes = array();
		$theme_roots = 	$this->theme_roots();
		foreach ( $theme_roots['theme_roots'] as $key => $theme_root) {
			 
			 $dirs = @ scandir( $theme_root );
			 foreach ( $dirs as $dir ) {
				 if ($dirs ) {
					if ( file_exists( $theme_root . '/' . $dir . '/style.css' ) ) {
						$this->found_themes[ $dir ] = array(
							'theme_base' => $dir,	
							'theme_file' => $dir . '/style.css',
							'theme_root' => $theme_root . $dir,	
							'theme_url'	=> $theme_roots['theme_urls'][ $key ] .  $dir
						);
					}
				 }
			 }
			
		}
		return $this->found_themes;
	}
	
	public function get_stylesheet() {
		return get_option( 'amaucp_stylesheet' );
	}
	
	// default template which is used
	public function get_default_template() {
		$default_template = $this->get_data( 'design' , 'default_theme' );
		if ( $default_template == '') {
			$default_template = 'default';
		}
		if ( isset( $_GET['amaucp_theme'] ) ) {
			if ( !empty( $_GET['amaucp_theme'] ) ) {
				$default_template = sanitize_text_field( $_GET['amaucp_theme'] );
			}
		}
		return $default_template;
	}
	
	
	public function get_theme_url() {
		return $this->theme_default_url;
	}
	public function get_theme_dir() {
		return $this->theme_default_dir;
	}
	
	// get data from admin
	public function get_data( $section , $var , $default='' ) {
		
		$temp = $this->data;
		if ( isset( $temp ) ) {
			if ( isset( $temp[ $section ] ) ){
				if ( isset( $temp[ $section ][ $var ] ) ) {
						return $this->data[ $section ][ $var ];
				}
			}
		}
		return $default;
	}
	
	// is ucp active ?
	public function is_preview() {
		return $this->get_data( 'main' , 'status' , 1 );
	}
	
	
	// don't show ucp to certain user
	public function is_user_can_preview() {
		if (is_user_logged_in()) {
			$current_user = wp_get_current_user();
			$roles = $current_user->roles;   //$roles -array
			$blacklisted_user_roles = $this->get_data( 'main' , 'blacklisted_user_roles' , array() );
			$blacklisted_user_roles_data = array();
			foreach ($blacklisted_user_roles as $key => $value) {
				if ( $value == 1 ) {
					$blacklisted_user_roles_data[] = $key;
				}
			}
			if ( in_array( $roles[0] , $blacklisted_user_roles_data ) ) {	
				return false;
			}			
		}
		return true;
	}
	
	public function show_503() {
		if ( $this->get_data( 'seo' , 'show_503' , 0 )) {
			
			header( 'HTTP/1.1 503 Service Temporarily Unavailable' );
			header( 'Status: 503 Service Temporarily Unavailable' );
			header( 'Retry-After: 86400' ); //a day
			
			//add_filter('status_header', array($this,'maintenance_header'), 10, 4);
		}
		
	}
	
	public function is_404() {
		global $wp_query;
		return $wp_query->is_404;
	}
	
	public function maintenance_header($status_header, $header, $text, $protocol) {
		if ( ! is_user_logged_in() ) {
            return "$protocol 503 Service Unavailable";
        }
	}
	public function is_search_bots() {
		$is_search_bots = false;

		if ( $this->get_data( 'seo' , 'search_bots',1 ) ) {
			$bots = array(
				'Abacho' => 'AbachoBOT',
				'Accoona' => 'Acoon',
				'AcoiRobot' => 'AcoiRobot',
				'Adidxbot' => 'adidxbot',
				'AltaVista robot' => 'Altavista',
				'Altavista robot' => 'Scooter',
				'ASPSeek' => 'ASPSeek',
				'Atomz' => 'Atomz',
				'Bing' => 'bingbot',
				'BingPreview' => 'BingPreview',
				'CrocCrawler' => 'CrocCrawler',
				'Dumbot' => 'Dumbot',
				'eStyle Bot' => 'eStyle',
				'FAST-WebCrawler' => 'FAST-WebCrawler',
				'GeonaBot' => 'GeonaBot',
				'Gigabot' => 'Gigabot',
				'Google' => 'Googlebot',
				'ID-Search Bot' => 'IDBot',
				'Lycos spider' => 'Lycos',
				'MSN' => 'msnbot',
				'MSRBOT' => 'MSRBOT',
				'Rambler' => 'Rambler',
				'Scrubby robot' => 'Scrubby',
				'Yahoo' => 'Yahoo'
			);

			$is_search_bots = (bool) preg_match('~(' . implode('|', array_values($bots)) . ')~i', $_SERVER['HTTP_USER_AGENT']);
		}

		return $is_search_bots;
	}
	
	// Add settings link on plugin page
	public function settings_link( $links ) { 
	  $settings_link = '<a href="'.  get_admin_url() .'admin.php?page=amaucp_settings">Settings</a>'; 
	  array_unshift( $links , $settings_link ); 
	  return $links; 
	}
	
	
	// show in admin area if ucp active
	public function admin_bar_menu()
	{

	global $wp_admin_bar;
	$msg = 'AmaUCP Mode Active';
	$meta = array( 'class' => 'amaucp-active' );
	$preview = $this->is_user_can_preview();
	if ( !$preview ) {
		$msg = $msg . ' ' . ",  User Roles Can't View";
	}
	if ($this->get_data('main','status',1)==0) 
	{
		$msg = 'AmaUCP Mode is Not Active';
		$meta = array( 'class' => 'amaucp-active-not' );
	}
	// Add Parent Menu
	$argsParent=array(
		'id' => 'amaucp_CustomMenu',
		'title' => $msg ,
		'parent' => 'top-secondary' ,
		'href' => get_admin_url() .'admin.php?page=amaucp_settings',
		'meta'   => $meta ,
	);
	$wp_admin_bar->add_menu( $argsParent );
	?>
	<style>
		.amaucp-active a {
			background: #1e88ff !important;
			color: #fff !important;
		}
		.amaucp-active a:hover {
			background: #550044 !important;
			color: #fff !important;
		}
		.amaucp-active-not a {
			background: #990000 !important;
			color: #fff !important;
		}
		.amaucp-active-not a:hover {
			background: #333344 !important;
			color: #fff !important;
		}
	</style>
	<?php

	}
	
	// get date from admin options
	public function get_till_date_default() {
		$date = $this->get_data( 'main' , 'end_date_time','08/24/2020');
		
		$format = 'n/j/Y'; //date/month/year
		$d = DateTime::createFromFormat($format, $date);
		$isTrue = ( $d && $d->format($format) == $date );
		if (!$isTrue) {
			$date = '08/24/2020';
		} 
		return $date . ' '. sprintf( "%02d",$this->get_data( 'main' , 'end_hour_time' ) ) . ':' . sprintf( "%02d" , $this->get_data( 'main' , 'end_minute_time' ) );
		
	}
	
	// format the date
	public function get_till_date( $format ) {
		$AtillDate = $this->get_till_date_default();
		$tilldate = new DateTime( $AtillDate );
		
		return date_format( $tilldate , $format ); 
	}
	
	// is the date expired ?
	public function is_date_expired() {
		$tillDate = $this->get_till_date_default();
		$expireDate = DateTime::createFromFormat( 'm/d/Y G:i' , $tillDate );
		$nowDate = new DateTime();			
		
		if ( $nowDate >$expireDate) {
			return false;
		}
		return true;
	}
	
	// echo seo meta
	public function seo_meta() {
		$title = $this->get_data( 'seo' , 'meta_title','Coming Soon Page' );
		$description = $this->get_data( 'seo' , 'meta_description','The website is still under development' );
		$keywords = $this->get_data( 'seo' , 'meta_keywords', 'coming soon , under construction page' );
		$robots_meta_tag = $this->get_data( 'seo' , 'robots_meta_tag',1 );
		
	
		echo '<title>'. esc_attr($title) .'</title>' . "\n";
		echo '<meta name="description" content="'. esc_attr( $description ) .'">' . "\n";
		echo '<meta name="keywords" content="'. esc_attr( $keywords ) .'">' . "\n";
		$robot_content = 'index';
		if ( $robots_meta_tag == 0 ) {
			$robot_content = 'noindex';
		}
		echo '<meta name="robots" content="'. esc_attr( $robot_content ) .'" />' . "\n";
		
		
	}
	
	// show subscribe form default
	public function show_subscribe_form(){
		?>
	
			<form id="form-subscribe" class="form-subscribe" action="" method="post">
				<input type="text" class="email" name="email" placeholder="Input your e-mail address here..." required />
				<button type="submit" class="submit" value="Let me Notified" />Subscribe</button>
			</form>
		
		<?php
	}
}

endif;



?>