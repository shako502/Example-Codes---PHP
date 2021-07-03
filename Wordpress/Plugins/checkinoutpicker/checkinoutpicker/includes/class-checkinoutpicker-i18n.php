<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://tskhadadzeshako.com
 * @since      1.0.0
 *
 * @package    Checkinoutpicker
 * @subpackage Checkinoutpicker/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Checkinoutpicker
 * @subpackage Checkinoutpicker/includes
 * @author     Tskhadadze Shako <tskhadadze.shako@gmail.com>
 */
class Checkinoutpicker_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'checkinoutpicker',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
