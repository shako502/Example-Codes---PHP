<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 *
 *
 * @link       https://beon.ge
 * @since      1.0.0
 *
 * @package    Fmtc_Api
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	global $wpdb;
	$merchTable = $wpdb->prefix . 'fmtcapi_merch';
	$catTable = $wpdb->prefix . 'fmtcapi_cat';
	$logTable = $wpdb->prefix . 'fmtcapi_log';
	$wpdb->query( "DROP TABLE IF EXISTS " . $merchTable);
	$wpdb->query( "DROP TABLE IF EXISTS " . $catTable);
	$wpdb->query( "DROP TABLE IF EXISTS " . $logTable );
}
