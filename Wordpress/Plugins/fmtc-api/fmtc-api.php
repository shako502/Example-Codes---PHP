<?php

/**
 *
 *
 * @link              https://beon.ge
 * @since             1.0.0
 * @package           Fmtc_Api
 *
 * @wordpress-plugin
 * Plugin Name:       FMTC API
 * Plugin URI:        https://beon.ge/projects/fmtc-api
 * Description:       Integrate FMTC API To the Wordpress Website
 * Version:           1.0.0
 * Author:            Tskhadadze Shako
 * Author URI:        https://beon.ge
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fmtc-api
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'FMTC_API_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-fmtc-api-activator.php
 */
function activate_fmtc_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fmtc-api-activator.php';
	Fmtc_Api_Activator::activate();
	Fmtc_Api_Activator::fmtcApiMerchTable();
	Fmtc_Api_Activator::fmtcApiLogTable();
	Fmtc_Api_Activator::fmtcApiCatTable();
	Fmtc_Api_Activator::fmtcApiUpTable();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-fmtc-api-deactivator.php
 */
function deactivate_fmtc_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fmtc-api-deactivator.php';
	Fmtc_Api_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_fmtc_api' );
register_deactivation_hook( __FILE__, 'deactivate_fmtc_api' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-fmtc-api.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_fmtc_api() {

	$plugin = new Fmtc_Api();
	$plugin->run();

}
run_fmtc_api();
