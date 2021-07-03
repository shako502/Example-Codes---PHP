<?php

/**
 * Fired during plugin activation
 *
 * @link       https://beon.ge
 * @since      1.0.0
 *
 * @package    Fmtc_Api
 * @subpackage Fmtc_Api/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Fmtc_Api
 * @subpackage Fmtc_Api/includes
 * @author     Tskhadadze Shako <tskhadadze.shako@gmail.com>
 */
class Fmtc_Api_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

	}

	public function fmtcApiMerchTable(){
		global $wpdb;
		global $jal_db_version;
	
		$table_name = $wpdb->prefix . 'fmtcapi_merch';
		$charset_collate = $wpdb->get_charset_collate();
		
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id INT NOT NULL AUTO_INCREMENT,
			merchID INT NOT NULL,
			termID INT NOT NULL,
			logID INT,
			PRIMARY KEY (id) )";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		add_option( 'jal_db_version', $jal_db_version );

	}

	public function fmtcApiCatTable(){
		global $wpdb;
		global $jal_db_version;
	
		$table_name = $wpdb->prefix . 'fmtcapi_cat';
		$charset_collate = $wpdb->get_charset_collate();
		
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id INT NOT NULL AUTO_INCREMENT,
			catID INT NOT NULL,
			termID INT NOT NULL,
			logID INT,
			PRIMARY KEY (id) )";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		add_option( 'jal_db_version', $jal_db_version );

	}

	public function fmtcApiLogTable(){
		global $wpdb;
		global $jal_db_version;
	
		$table_name = $wpdb->prefix . 'fmtcapi_log';
		$charset_collate = $wpdb->get_charset_collate();
		
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id INT NOT NULL AUTO_INCREMENT,
			ApiAct varchar(350),
			ResStatus varchar(56),
			Added INT,
			Existed INT,
			Errors INT,
			LogDate DATETIME NOT NULL,
			Ext varchar(350),
			PRIMARY KEY (id) )";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		add_option( 'jal_db_version', $jal_db_version );

	}

	public function fmtcApiUpTable(){
		global $wpdb;
		global $jal_db_version;
	
		$table_name = $wpdb->prefix . 'fmtcapi_parup';
		$charset_collate = $wpdb->get_charset_collate();
		
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id INT NOT NULL AUTO_INCREMENT,
			catID INT,
			merchID INT,
			Date DATETIME NOT NULL,
			couponID INT NOT NULL,
			PRIMARY KEY (id) )";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		add_option( 'jal_db_version', $jal_db_version );

	}

}
