<?php
    if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();
    global $wpdb;
    $wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . "guests" );
	$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . "events" );
	delete_option("my_plugin_db_version");
?>