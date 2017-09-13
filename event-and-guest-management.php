<?php
/*
Plugin Name: WP-RSVP
Description: WordPress plugin for managing events, guests and rsvp.
Author: ColoredCow
Author URI: www.coloredcow.com
Version: 0.1
*/


	add_action('admin_menu', 'menu_pages');
	add_action( 'admin_enqueue_scripts', 'cc_plugin_scripts' );
	add_action( 'admin_enqueue_scripts', 'cc_plugin_styles' );
	
	function menu_pages(){		
		add_menu_page('WP-RSVP', 'WP-RSVP', 'manage_options', 'wp-rsvp','', 'dashicons-clipboard');
		add_submenu_page( 'wp-rsvp', 'Create Event Page', 'Create Event','manage_options', 'wp-rsvp', 'add_event_page');
		add_submenu_page( 'wp-rsvp', 'Event List Page', 'Event List','manage_options', 'event_list_page', 'event_list_page');
		add_submenu_page( 'wp-rsvp', 'Create Guest Page', 'Add a Guest','manage_options', 'add_guest_page', 'add_guest_page');
		add_submenu_page( 'wp-rsvp', 'Guest List Page', 'Guest List','manage_options', 'guest_list_page', 'guest_list_page');
		add_submenu_page( 'wp-rsvp', 'Send Invitation Page', 'Send Invitation','manage_options', 'send_invitation_page', 'send_invitation_page');
	}
	
	
	function cc_plugin_scripts($hook){
		if( $hook != 'toplevel_page_wp-rsvp' && $hook != 'wp-rsvp_page_event_list_page' && $hook != 'wp-rsvp_page_add_guest_page' && $hook != 'wp-rsvp_page_guest_list_page' && $hook != 'wp-rsvp_page_send_invitation_page') {	
			return;
		}
		wp_enqueue_script('cc-bootstrap',plugin_dir_url( __FILE__ ).'/dist/lib/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script('cc-js',plugin_dir_url( __FILE__ ).'/dist/lib/js/jquery-1.11.3.min.js', array('jquery'), '1.0.0', true);
		wp_enqueue_script( 'cc-bootstrap4-script', plugin_dir_url( __FILE__ ).'/dist/lib/js/bootstrap4.min.js', array( 'jquery'), '1.0.0', true);
		wp_enqueue_script( 'cc-bootstrap-tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
		wp_enqueue_script( 'cc-fontawesome-icons', 'https://use.fontawesome.com/ffc2c94a85.js');
		wp_enqueue_script( 'main', plugin_dir_url( __FILE__ ).'/src/js/main.js', array( 'jquery'), '1.0.0', true);
		wp_localize_script( 'main', 'PARAMS', array( 'ajaxurl' => admin_url('admin-ajax.php') ) );
	}
	
	function cc_plugin_styles($hook){
		if( $hook != 'toplevel_page_wp-rsvp' && $hook != 'wp-rsvp_page_event_list_page' && $hook != 'wp-rsvp_page_add_guest_page' && $hook != 'wp-rsvp_page_guest_list_page' && $hook != 'wp-rsvp_page_send_invitation_page') {	
			return;
		
		}
			wp_enqueue_style( 'cc-bootstrap4-style', plugin_dir_url( __FILE__ ).'/dist/lib/css/bootstrap4.min.css');
			wp_enqueue_style( 'ccustom-style', plugin_dir_url( __FILE__ ).'/src/css/style.css');
			wp_enqueue_style( 'cc-fonts','https://fonts.googleapis.com/css?family=Oswald|Marcellus+SC|Roboto|Open+Sans|Baloo+Bhaijaan|Quicksand');
	}

	function add_event_page() {
		require_once("add_new_event.php");
	}

	function add_guest_page() {
		require_once("add_new_guest.php");
	}

	function event_list_page() {
		require_once("show_event.php");
	}

	function guest_list_page() {
		require_once("show_guest.php");
	}

	function send_invitation_page() {
		require_once("send_invitation.php");
	}

	function create_plugin_database_table() {
		global $wpdb;
		$events_table_name = $wpdb->prefix . 'events';
		$guests_table_name = $wpdb->prefix . 'guests';
		$event_guest_table_name = $wpdb->prefix . 'event_guest';

		$query_create_events_table = "CREATE TABLE $events_table_name (
			event_id mediumint(5)  NOT NULL AUTO_INCREMENT,
			event_name varchar(50) NOT NULL,
			event_theme varchar(50) NOT NULL,
			event_date date NOT NULL,
			event_venue varchar(150) NOT NULL,
			event_address varchar(250) NOT NULL,
			event_about varchar(1000) NOT NULL,
			event_host varchar(50) NOT NULL,
			event_time time NOT NULL,
			PRIMARY KEY  (event_id)
		);";

		$query_create_guests_table = "CREATE TABLE $guests_table_name (
			guest_id mediumint(9)  NOT NULL AUTO_INCREMENT,
			guest_name varchar(50) NOT NULL,
			guest_email varchar(50) NOT NULL,
			guest_phone_number bigint(10) NULL,
			guest_gender varchar(50) NOT NULL,
			guest_category varchar(50) NOT NULL DEFAULT 'approved',
			PRIMARY KEY  (guest_id)
		);";

		$query_create_event_guest_table = "CREATE TABLE $event_guest_table_name (
			index_id mediumint(9)  NOT NULL AUTO_INCREMENT,
			event_id mediumint(5) NOT NULL,
			guest_id mediumint(9) NOT NULL,
			email_status varchar(32) NOT NULL,
			guest_status varchar(32) NOT NULL,
			PRIMARY KEY  (index_id)
		);";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $query_create_events_table );
		dbDelta( $query_create_guests_table );
		dbDelta( $query_create_event_guest_table );
	}
 	register_activation_hook( __FILE__, 'create_plugin_database_table' );


	function add_event() {
		if(isset($_POST['event_name'])){
			global $wpdb;
			$table_name = $wpdb->prefix . 'events';
			$wpdb->insert( $table_name, array(
				'event_name'  => $event_name= stripslashes($_POST['event_name']),
				'event_theme' => $event_theme=stripslashes($_POST['event_theme']),
				'event_date'  => $event_date=$_POST['event_date'],
				'event_address' => $event_address=stripslashes($_POST['event_address']),
				'event_time'  => $event_time=$_POST['event_time'],
				'event_venue' => $event_venue=stripslashes($_POST['event_venue']),
				'event_host'  => $event_host=stripslashes($_POST['event_host']),
				'event_about' => $event_about=nl2br(stripslashes($_POST['event_about'])),
			) );		       
			  echo '<div class="alert alert-success alert-dismissable">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
						</a>
					 <strong>'.$event_name.' </strong>  has been added to your event list.
					</div>';    	
		}
		wp_die();
	}
	add_action('wp_ajax_add_event','add_event');
	add_action('wp_ajax_nopriv_add_event','add_event');

	
	function add_guest(){
		if(isset($_POST['guest_name'])){
			global $wpdb;
			$table_name = $wpdb->prefix . 'guests';
			$wpdb->insert( $table_name, array(
				'guest_name' => $guest_name=stripslashes($_POST['guest_name']),
				'guest_email' => $guest_email=$_POST['guest_email_id'],
				'guest_phone_number' => $guest_phone_number=$_POST['guest_mobile_number'],
				'guest_gender' => $guest_gender=$_POST['guest_gender'],	 
			));
			 echo '<div class="alert alert-success alert-dismissable">
					 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
						</a>
					 <strong>'.$guest_name.' </strong>  has been added to your guest list.
					</div>';
		}
		wp_die();
	}
	add_action('wp_ajax_add_guest','add_guest');
	add_action('wp_ajax_nopriv_add_guest','add_guest');


	function show_all_events(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'events';
		$result = $wpdb->get_results ( "SELECT * FROM $table_name ORDER BY event_date ASC" );
		$serial = 1;

		foreach ( $result as $page ){
			$output='';
			$event_id = $page->event_id;
			$event_name = $page->event_name;
			$event_theme = $page->event_theme;
			$event_venue = $page->event_venue;
			$date = $page->event_date;
			$modify_date = date('d-M-Y', strtotime($date));
			$no = $serial++;
			$output .='<table>
							<thead>  
								<tr class="hover-background">  
									<th>'.$no.'</th>
									<th>'.$event_name.'</th>
									<th>'.$event_theme.'</th>
									<th>'.$event_venue.'</th>
									<th>'.$modify_date.'</th>
									<th><button type="button" class="btn btn-outline-danger btn-sm send" id='.$event_id.'>Delete</button></th>
								</tr> 
							</thead> 
						</table>';
			echo $output;
		}
		wp_die();
	}
	add_action('wp_ajax_show_all_events','show_all_events');
	add_action('wp_ajax_nopriv_show_all_events','show_all_events');


	function delete_event_details(){
	   if(isset($_POST['event_id'])){
		 $event_id=$_POST['event_id'];
		   global $wpdb;
		   $table_name = $wpdb->prefix . 'events';
		   $wpdb->query( $wpdb->prepare("DELETE FROM $table_name WHERE event_id = $event_id"));
		}
	   	wp_die();
	}   
	add_action('wp_ajax_delete_event_details','delete_event_details');
	add_action('wp_ajax_nopriv_delete_event_details','delete_event_details');


	function delete_guest_details(){
	   if(isset($_POST['guest_id'])){
		 $guest_id=$_POST['guest_id'];
		   global $wpdb;
		   $table_name = $wpdb->prefix . 'guests';
		   $wpdb->query( $wpdb->prepare("DELETE FROM $table_name WHERE guest_id = $guest_id"));
		}
	   wp_die();
	}   
	add_action('wp_ajax_delete_guest_details','delete_guest_details');
	add_action('wp_ajax_nopriv_delete_guest_details','delete_guest_details');


	function show_all_guests(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'guests';
		$result = $wpdb->get_results ( "SELECT * FROM $table_name" );
		$serial = 1;

		foreach ( $result as $page ){
			$output='';
			$guest_id = $page->guest_id;
			$guest_name = $page->guest_name;
			$guest_email = $page->guest_email;
			$guest_gender = $page->guest_gender;
			$guest_phone_number = $page->guest_phone_number;
			$no= $serial++;
			$output .='<table>
							<thead>  
								<tr class="hover-background">
									<th>'.$no.'</th>  
									<th>'.$guest_name.'</th>
									<th>'.$guest_email.'</th>
									<th>'.$guest_phone_number.'</th>
									<th>'.$guest_gender.'</th>
									<th><button type="button" class="btn btn-outline-danger btn-sm delete" id='.$guest_id.'>Delete</button></th>
								</tr> 
							</thead> 
						</table>';
			echo $output;
		}
		wp_die();
	}
	add_action('wp_ajax_show_all_guests','show_all_guests');
	add_action('wp_ajax_nopriv_show_all_guests','show_all_guests');


	function fetch_events_for_select(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'events';
		$result = $wpdb->get_results ( "SELECT * FROM $table_name ORDER BY event_date ASC" );
		
		include ('template/select-event.php');

		wp_die();		
	}
	add_action('wp_ajax_fetch_events_for_select','fetch_events_for_select');
	add_action('wp_ajax_nopriv_fetch_events_for_select','fetch_events_for_select');


	function show_email_template(){
		if(isset($_POST['event_id'])){
			$event_id=$_POST['event_id'];
			global $wpdb;
			$table_name = $wpdb->prefix . 'events';

			$thepost = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $table_name WHERE event_id = $event_id "));
			$event_id = $thepost->event_id;
			$event_name = $thepost->event_name;
			$event_theme = $thepost->event_theme;
			$event_venue = $thepost->event_venue;
			$event_about = $thepost->event_about;
			$event_address = $thepost->event_address;
			$time = $thepost->event_time;
			$modify_time = date('h:i a', strtotime($time));
			$event_host = $thepost->event_host;
			$date = $thepost->event_date;
			$modify_date = date('d-M-Y', strtotime($date));

			include ('template/email-template.php');

			
		}
		wp_die();
	}
	add_action('wp_ajax_show_email_template','show_email_template');
	add_action('wp_ajax_nopriv_show_email_template','show_email_template');


	function send_test_mail(){
		if(isset($_POST['test_email_id'])){
			$fontfamily=$_POST['fontstyle'];
			$fontsize=$_POST['fontsize'];
			$test_mailto=$_POST['test_email_id'];	
			$subject=stripslashes($_POST['subject']);
			$ebody=nl2br(stripslashes($_POST['body']));
						
					$emailTo = $test_mailto;
					$subject = $subject;
						$body = 'Hi Guest Name,
								<br><br>
								<font style="font-family:'.$fontfamily.';font-size:'.$fontsize.'px; color:black;">'.$ebody.'</font>';
					$headers = array('Content-Type: text/html; charset=UTF-8');
					if(wp_mail($emailTo, $subject, $body,$headers, $attachments)){
						echo'
						<div class="alert alert-info alert-dismissable">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
							</a>
							<strong>Successfull!</strong> Test Email has been sent to  <strong> '.$test_mailto.'</strong>.
						</div>
						';									
					}
					else
					{
						echo'
						<div class="alert alert-warning">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
							</a>
							Mail function Error!
						</div>						
						';
					}
			}				
			wp_die();		
	}
	add_action('wp_ajax_send_test_mail', 'send_test_mail');
	add_action('wp_ajax_nopriv_send_test_mail', 'send_test_mail');
		
		
	function show_all_guest_invitation(){
		if(isset($_POST['event_id'])){
			$event_id=$_POST['event_id'];
			global $wpdb;
			$table_name = $wpdb->prefix . 'events';
			$number = 1;

			$thepost = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $table_name where event_id=$event_id"));	
			$current_event_id = $thepost->event_id; 
			
			$table_names = $wpdb->prefix . 'guests';
			$table = $wpdb->prefix . 'event_guest';
				$result = $wpdb->get_results ( "SELECT $table_names.guest_id, guest_name, guest_email, guest_gender, guest_phone_number, email_status FROM $table_names LEFT JOIN $table ON $table_names.guest_id = $table.guest_id And $event_id=$table.event_id" );

			include ('template/send-invitation-table.php');			
		}		
		wp_die();
	}
	add_action('wp_ajax_show_all_guest_invitation','show_all_guest_invitation');
	add_action('wp_ajax_nopriv_show_all_guest_invitation','show_all_guest_invitation');
		

	function send_message(){
		if(isset($_POST['event_id'])&&isset($_POST['guest_id'])){
			$event_id=$_POST['event_id'];
			$guest_id=$_POST['guest_id'];
			$subject=stripslashes($_POST['subject']);
			$ebody=nl2br(stripslashes($_POST['body']));
					
				global $wpdb;
				$table_name_event_guest = $wpdb->prefix . 'event_guest';
				$check_guest_id = $wpdb->get_results("SELECT * FROM $table_name_event_guest WHERE guest_id = $guest_id AND event_id = $event_id ");
					if($wpdb->num_rows > 0) {
						echo'<div class="alert alert-danger alert-dismissable">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
									</a>
								<strong>Sorry!</strong> Invitation Mail has been Already sent to this guest.
							</div>';
					} 
					else 
					{ 
						$table_name_events = $wpdb->prefix . 'events';
						$table_name_guests = $wpdb->prefix . 'guests';

							$thepost = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $table_name_guests where guest_id = $guest_id"));
							$guest_name = $thepost->guest_name;
							$guest_email = $thepost->guest_email;						

							$results = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $table_name_events where event_id = $event_id"));
							$emailTo = $guest_email;
							$subject = $subject;
								$body = 'Hi '.$guest_name.',
										<br><br>
										<font style="font-family:Tahoma;">'.$ebody.'</font>';
							$headers = array('Content-Type: text/html; charset=UTF-8');
							if(wp_mail($emailTo, $subject, $body,$headers)){
								echo '
								<div class="alert alert-success alert-dismissable">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
									</a>
									<strong>Successfull!</strong> Invitation Mail has been sent to  <strong> '.$guest_name.' </strong>.
								</div>
								';									
									$table_name = $wpdb->prefix . 'event_guest';
									$wpdb->insert( $table_name, array(
										'event_id' => $event_id,
										'guest_id' => $guest_id,
										'email_status' => 'send',
										'guest_status' => 'pending',	 
									));
							}
							else
							{
								echo "
								<div class='alert alert-warning'>Mail function Error!</div>
								";
							}
					}				
			wp_die();		
		}
	}
	add_action('wp_ajax_send_message', 'send_message');
	add_action('wp_ajax_nopriv_send_message', 'send_message');

		
	add_filter( 'wp_mail_content_type', 'set_content_type' );
	function set_content_type( $content_type ) {
		return 'text/html';
	}
?>