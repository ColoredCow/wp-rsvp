<?php
/*
Plugin Name: RSVP Invitationsss
Description: Easy-to-use event management plugin for sending invitation to your guests.
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
		add_submenu_page( 'rsvp_invitation', 'Guest List Page', 'Guest List','manage_options', 'guest_list_page', 'guest_list_page');
	}
	
	function cc_plugin_scripts(){
        wp_enqueue_script('cc-bootstrap',plugin_dir_url( __FILE__ ).'/dist/lib/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('cc-js',plugin_dir_url( __FILE__ ).'/dist/lib/js/jquery-1.11.3.min.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script( 'cc-bootstrap4-script', plugin_dir_url( __FILE__ ).'/dist/lib/js/bootstrap4.min.js', array( 'jquery'), '1.0.0', true);
		wp_enqueue_script( 'cc-bootstrap-tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
		wp_enqueue_script( 'cc-fontawesome-icons', 'https://use.fontawesome.com/ffc2c94a85.js');
		wp_enqueue_script( 'main', plugin_dir_url( __FILE__ ).'/src/js/main.js', array( 'jquery'), '1.0.0', true);
		wp_localize_script( 'main', 'PARAMS', array( 'ajaxurl' => admin_url('admin-ajax.php') ) );
	}
	
	function cc_plugin_styles(){
		wp_enqueue_style( 'cc-bootstrap4-style', plugin_dir_url( __FILE__ ).'/dist/lib/css/bootstrap4.min.css');
		wp_enqueue_style( 'custom-style', plugin_dir_url( __FILE__ ).'/src/css/style.css');
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


	function create_plugin_database_table() {
		global $wpdb;
		$events_table_name = $wpdb->prefix . 'events';
		$guests_table_name = $wpdb->prefix . 'guests';

		$query_create_events_table = "CREATE TABLE $events_table_name (
			event_id mediumint(5)  NOT NULL AUTO_INCREMENT,
			event_name varchar(50) NOT NULL,
			event_theme varchar(50) NOT NULL,
			event_date date NOT NULL,
			event_venue varchar(150) NOT NULL,
			event_address varchar(250) NOT NULL,
			event_about varchar(150) NOT NULL,
			event_host varchar(50) NOT NULL,
			event_time time NOT NULL,
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
		if(isset($_POST['event_name'])){
			$event_name=$_POST['event_name'];
			$event_theme=$_POST['event_theme'];
			$event_date=$_POST['event_date'];
			$event_address=$_POST['event_address'];
			$event_time=$_POST['event_time'];
			$event_about=$_POST['event_about'];
			$event_venue=$_POST['event_venue'];
			$event_host=$_POST['event_host'];
			global $wpdb;
			$table_name = $wpdb->prefix . 'events';
			$wpdb->insert( $table_name, array(
				'event_name' => $event_name,
				'event_theme' => $event_theme,
				'event_date' => $event_date,
				'event_venue' => $event_venue,
				'event_address' => $event_address,
				'event_time' => $event_time,
				'event_venue' => $event_venue,
				'event_host' => $event_host,
				'event_about' => $event_about,
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



	function show_all_events(){global $wpdb;
		$table_name = $wpdb->prefix . 'events';
		$result = $wpdb->get_results ( "SELECT * FROM $table_name ORDER BY event_date ASC" );

		foreach ( $result as $page ){
			$output='';
			$event_id = $page->event_id;
			$event_name = $page->event_name;
			$event_theme = $page->event_theme;
			$event_venue = $page->event_venue;
			$date = $page->event_date;
			$modify_date = date('d-M-Y', strtotime($date));
			$output .='<table class="table">
							<thead>  
								<tr class="tr">  
									<th class="th">'.$event_name.'</th>
									<th class="th">'.$event_theme.'</th>
									<th class="th">'.$event_venue.'</th>
									<th class="th">'.$modify_date.'</th>
									<th class="th"><button type="button" class="btn btn-outline-danger btn-sm send" id='.$event_id.'>Delete</button></th>
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

		foreach ( $result as $page ){
			$output='';
			$guest_id = $page->guest_id;
			$guest_name = $page->guest_name;
			$guest_email = $page->guest_email;
			$guest_gender = $page->guest_gender;
			$guest_phone_number = $page->guest_phone_number;
			$output .='<table class="table">
							<thead>  
								<tr class="tr">  
									<th class="th">'.$guest_name.'</th>
									<th class="th">'.$guest_email.'</th>
									<th class="th">'.$guest_phone_number.'</th>
									<th class="th">'.$guest_gender.'</th>
									<th class="th"><button type="button" class="btn btn-outline-danger btn-sm delete" id='.$guest_id.'>Delete</button></th>
								</tr> 
							</thead> 
						</table>';
			echo $output;
		}

		wp_die();
	}

	add_action('wp_ajax_show_all_guests','show_all_guests');
	add_action('wp_ajax_nopriv_show_all_guests','show_all_guests');
		
?>