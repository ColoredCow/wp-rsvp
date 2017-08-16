<?php
/*
Plugin Name: Event and Guest Management Plugin
Description: Plugin for managing events and guests
Author: ColoredCow
Author URI: www.coloredcow.com
Version: 0.1
*/

	add_action('admin_menu', 'menu_pages');
	function menu_pages(){
	    add_menu_page('Event and Guest Management', 'Event and Guest Management', 'manage_options', 'event_and_guest_management', 'event_and_guest_management' );
	}

	function event_and_guest_management(){
		echo "Hello";		
	}

	function create_plugin_database_table() {
		 global $wpdb;
		 $events_table_name = $wpdb->prefix . 'events';
		 $guests_table_name = $wpdb->prefix . 'guests';
		 
		 $query_create_events_table = "CREATE TABLE $events_table_name (
		 event_id mediumint(9)  NOT NULL AUTO_INCREMENT,
		 event_name varchar(50) NOT NULL,
		 event_theme varchar(50) NOT NULL,
		 event_date date NOT NULL,
		 event_venue varchar(50) NOT NULL,
		 PRIMARY KEY  (event_id)
		 );";
		 
		 $query_create_guests_table = "CREATE TABLE $guests_table_name (
		 guest_id mediumint(9)  NOT NULL AUTO_INCREMENT,
		 guest_name varchar(50) NOT NULL,
		 guest_email varchar(50) NOT NULL,
		 guest_phone_number int(10) NOT NULL,
		 guest_gender varchar(50) NOT NULL,
		 guest_status varchar(50) NOT NULL,
		 guest_category varchar(50) NOT NULL,
		 PRIMARY KEY  (guest_id)
		 );";
		 

		 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		 dbDelta( $query_create_events_table );
		 dbDelta( $query_create_guests_table );
	}
	 
	register_activation_hook( __FILE__, 'create_plugin_database_table' );