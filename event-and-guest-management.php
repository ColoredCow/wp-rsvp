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
	    add_submenu_page('event_and_guest_management', 'Event and Guest Management', 'Add New Event', 'manage_options', 'event_and_guest_management' );    
	    add_submenu_page('event_and_guest_management', 'Event and Guest Management', 'Event List', 'manage_options', 'event_and_guest_management' );
	    add_submenu_page('event_and_guest_management', 'Event and Guest Management', 'Add New guest', 'manage_options', 'event_and_guest_management' );    
	    add_submenu_page('event_and_guest_management', 'Event and Guest Management', 'Guest List', 'manage_options', 'event_and_guest_management' );
	    add_submenu_page('event_and_guest_management', 'Event and Guest Management', 'Send Invites', 'manage_options', 'event_and_guest_management' );
	    add_submenu_page('event_and_guest_management', 'Event and Guest Management', 'Attendance', 'manage_options', 'event_and_guest_management' );
	}

	function event_and_guest_management(){
		echo "Hello";		
	}