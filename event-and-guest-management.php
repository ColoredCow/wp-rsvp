<?php
/*
Plugin Name: RSVP Invitation Plugin
Description: Plugin for managing events and guests.
Author: ColoredCow
Author URI: www.coloredcow.com
Version: 0.1
*/

	add_action('admin_menu', 'menu_pages');
	add_action( 'admin_enqueue_scripts', 'cc_plugin_scripts' );
	add_action( 'admin_enqueue_scripts', 'cc_plugin_styles' );
	
	function menu_pages(){
		add_menu_page('RSVP Invitation', 'RSVP Invitation', 'manage_options', 'rsvp_invitation','', 'dashicons-clipboard');
		add_submenu_page( 'rsvp_invitation', 'Create Event Page', 'Create Event','manage_options', 'rsvp_invitation', 'add_event_page');
		add_submenu_page( 'rsvp_invitation', 'Event List Page', 'Event List','manage_options', 'event_list_page', 'event_list_page');
		add_submenu_page( 'rsvp_invitation', 'Create Guest Page', 'Add a Guest','manage_options', 'add_guest_page', 'add_guest_page');

	}
	
	function cc_plugin_scripts(){
		wp_enqueue_script( 'cc-bootstrap4-script', plugin_dir_url( __FILE__ ).'/dist/lib/js/bootstrap4.min.js', array( 'jquery'), '1.0.0', true);
		wp_enqueue_script( 'cc-bootstrap-tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
		wp_enqueue_script( 'cc-fontawesome-icons', 'https://use.fontawesome.com/ffc2c94a85.js');
		wp_enqueue_script( 'main', plugin_dir_url( __FILE__ ).'/src/js/main.js', array( 'jquery'), '1.0.0', true);
		wp_localize_script( 'main', 'PARAMS', array( 'ajaxurl' => admin_url('admin-ajax.php') ) );
	}
	
	function cc_plugin_styles(){
		wp_enqueue_style( 'cc-bootstrap4-style', plugin_dir_url( __FILE__ ).'/dist/lib/css/bootstrap4.min.css');
		wp_enqueue_style( 'custom-style', plugin_dir_url( __FILE__ ).'/src/css/style.css');
		wp_enqueue_style( 'cc-fonts','https://fonts.googleapis.com/css?family=Oswald|Marcellus+SC|Roboto|Open+Sans');
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

	function create_plugin_database_table() {
		global $wpdb;
		$events_table_name = $wpdb->prefix . 'events';
		$guests_table_name = $wpdb->prefix . 'guests';

		$query_create_events_table = "CREATE TABLE $events_table_name (
			event_id mediumint(5)  NOT NULL AUTO_INCREMENT,
			event_name varchar(50) NOT NULL,
			event_theme varchar(50) NOT NULL,
			event_date date NOT NULL,
			event_venue varchar(250) NOT NULL,
			PRIMARY KEY  (event_id)
		);";

		$query_create_guests_table = "CREATE TABLE $guests_table_name (
			guest_id mediumint(9)  NOT NULL AUTO_INCREMENT,
			guest_name varchar(50) NOT NULL,
			guest_email varchar(50) NOT NULL,
			guest_phone_number int(10) NOT NULL,
			guest_gender varchar(50) NOT NULL,
			guest_category varchar(50) NOT NULL DEFAULT 'approved',
			PRIMARY KEY  (guest_id)
		);";


		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $query_create_events_table );
		dbDelta( $query_create_guests_table );
	}
	 
	register_activation_hook( __FILE__, 'create_plugin_database_table' );


	function add_event() {
		if(isset($_POST['event_name'])&&isset($_POST['event_theme'])&&isset($_POST['event_date'])&&isset($_POST['event_venue'])){
			$event_name=$_POST['event_name'];
			$event_theme=$_POST['event_theme'];
			$event_date=$_POST['event_date'];
			$event_venue=$_POST['event_venue'];
			
			global $wpdb;
			$table_name = $wpdb->prefix . 'events';
			$wpdb->insert( $table_name, array(
				'event_name' => $event_name,
				'event_theme' => $event_theme,
				'event_date' => $event_date,
				'event_venue' => $event_venue,
			) );		       
	   	}
	}

	add_action('wp_ajax_add_event','add_event');
	add_action('wp_ajax_nopriv_add_event','add_event');

	function add_guest(){
		if(isset($_POST['guest_name'])&&isset($_POST['guest_email_id'])&&isset($_POST['guest_phone_number'])&&isset($_POST['guest_gender'])){
			$guest_name=$_POST['guest_name'];
			$guest_email=$_POST['guest_email_id'];
			$guest_phone_number=$_POST['guest_mobile_number'];
			$guest_gender=$_POST['guest_gender'];

			global $wpdb;
			$table_name = $wpdb->prefix . 'guests';
			$wpdb->insert( $table_name, array(
				'guest_name' => $guest_name,
				'guest_email' => $guest_email,
				'guest_phone_number' => $guest_phone_number,
				'guest_gender' => $guest_gender,	 
			));
		}
	}
	add_action('wp_ajax_add_guest','add_guest');
	add_action('wp_ajax_nopriv_add_guest','add_guest');


	function show_approved_guest(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'events';
		$result = $wpdb->get_results ( "SELECT * FROM $table_name" );

		foreach ( $result as $page ){
			$output='';
			$event_name = $page->event_name;
			$event_theme = $page->event_theme;
			$event_venue = $page->event_venue;
			$date = $page->event_date;
			$modify_date = date('d-M-Y', strtotime($date));
			$output .='<table>';
			$output .='		<thead>';				  
			$output .='			<tr>';  
			$output .='				<th>'.$event_name.'</th>
									<th>'.$event_theme.'</th>
									<th>'.$event_venue.'</th>
									<th>'.$modify_date.'</th>';
			$output .='			<tr>';
			$output .='		<thead>';			  
			$output .='</table>';
			echo $output;
		}
		wp_die();
	}

	add_action('wp_ajax_show_approved_guest','show_approved_guest');
	add_action('wp_ajax_nopriv_show_approved_guest','show_approved_guest');
?>