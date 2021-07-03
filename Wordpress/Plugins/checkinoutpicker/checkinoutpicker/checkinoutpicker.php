<?php

/**
 * The plugin Main File
 *
 *
 * @link              https://tskhadadzeshako.com
 * @since             1.0.0
 * @package           Checkinoutpicker
 *
 * @wordpress-plugin
 * Plugin Name:       CheckInOutPicker
 * Plugin URI:        https://tskhadadzeshako.com/checkinoutpicker
 * Description:       Simple, highly customizable Check-In/Out Data Picker For Redirections
 * Version:           1.0.0
 * Author:            Tskhadadze Shako
 * Author URI:        https://tskhadadzeshako.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       checkinoutpicker
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
define( 'CHECKINOUTPICKER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-checkinoutpicker-activator.php
 */
function activate_checkinoutpicker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-checkinoutpicker-activator.php';
	Checkinoutpicker_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-checkinoutpicker-deactivator.php
 */
function deactivate_checkinoutpicker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-checkinoutpicker-deactivator.php';
	Checkinoutpicker_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_checkinoutpicker' );
register_deactivation_hook( __FILE__, 'deactivate_checkinoutpicker' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-checkinoutpicker.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_checkinoutpicker() {

	$plugin = new Checkinoutpicker();
	$plugin->run();

}
run_checkinoutpicker();
