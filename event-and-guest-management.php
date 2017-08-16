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