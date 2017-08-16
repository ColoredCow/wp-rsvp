<?php
/*
Plugin Name: Event and Guest Management Plugin
Description: Plugin for managing events and guests
Author: ColoredCow
Author URI: www.coloredcow.com
Version: 0.1
*/

add_action('admin_menu', 'my_menu_pages');
function my_menu_pages(){
    add_menu_page('Event and Guest Management', 'Event and Guest Management', 'manage_options', 'attendance', 'attendance' );
    add_submenu_page('attendance', 'Event and Guest Management', 'Add New Event', 'manage_options', 'attendance' );    
    add_submenu_page('attendance', 'Event and Guest Management', 'Event List', 'manage_options', 'attendance' );
    add_submenu_page('attendance', 'Event and Guest Management', 'Add New guest', 'manage_options', 'attendance' );    
    add_submenu_page('attendance', 'Event and Guest Management', 'Guest List', 'manage_options', 'attendance' );
    add_submenu_page('attendance', 'Event and Guest Management', 'Send Invites', 'manage_options', 'attendance' );
    add_submenu_page('attendance', 'Event and Guest Management', 'Attendance', 'manage_options', 'attendance' );
}