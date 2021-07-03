<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://beon.ge
 * @since      1.0.0
 *
 * @package    Fmtc_Api
 * @subpackage Fmtc_Api/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Fmtc_Api
 * @subpackage Fmtc_Api/admin
 * @author     Tskhadadze Shako <tskhadadze.shako@gmail.com>
 */
class Fmtc_Api_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	/**
	 * The options name prefix for FMTC API Plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  		string 		$option_name 		Option name prefix for FMTC API Plugin
	 */
	private $option_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 * @param      string	 $option_name   The option prefix for this plugin.
	 */
	public function __construct( $plugin_name, $version, $option_name ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->option_name = $option_name;

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {

		$this->plugin_options_page = add_options_page(
			__( 'FMTC API Options And Logs', 'fmtc-api' ),
			__( 'FMTC API', 'fmtc-api' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'fmtc_admin_render' )
		);

	}

	/**
	 * Render the options page
	 *
	 * @since  1.0.0
	 */
	public function fmtc_admin_render() {

		include_once 'partials/fmtc-api-admin-display.php';

	}

	/**
	 * Register Plugin Options
	 * 
	 * @since 1.0.0
	 */
	public function register_fmtc_options(){
		add_option($this->option_name . 'api-key', 'ApiKey');
		register_setting('fmtc-api-key-group', $this->option_name .'api-key');
	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Fmtc_Api_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Fmtc_Api_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/fmtc-api-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Fmtc_Api_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Fmtc_Api_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if($_GET['page'] === 'fmtc-api'){
			wp_register_script( 'bootstrap-fmtc', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), '4.0.0', true );
			wp_enqueue_script( 'bootstrap-fmtc' );

			wp_register_script( 'chart-fmtc', plugin_dir_url( __FILE__ ) . 'js/Chart.bundle.min.js', array( 'jquery' ), '2.9.3', true );
			wp_enqueue_script( 'chart-fmtc' );
		
			wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/fmtc-api-adminbootstrap.js', array( 'jquery', 'bootstrap-fmtc', 'chart-fmtc' ), '1.4.7', true );
			wp_enqueue_script( $this->plugin_name );
			wp_localize_script($this->plugin_name, 'jsVars', array(
				'ajax_url' => admin_url( 'admin-ajax.php' )
			));
			
			wp_register_style( 'bootstrap-style', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', false, '4.0.0' );
			wp_enqueue_style( 'bootstrap-style' );

			wp_register_style( 'chart-style', plugin_dir_url( __FILE__ ) . 'css/Chart.min.css', false, '2.9.3' );
			wp_enqueue_style( 'chart-style' );
		}

	}


	public function getStatistics(){
		global $wpdb;
		$table_name = $wpdb->prefix . "fmtcapi_log";

		$dateInterval = "= CURDATE()";
		$postDateInterval = intval($_POST['dateInterval']);
		if(isset($postDateInterval) && $postDateInterval > 0){
			$dateInterval = "> (NOW() - INTERVAL ".$postDateInterval." DAY)";
		}

		$logs = $wpdb->get_results( "SELECT ApiAct, Added, date(LogDate) FROM ".$table_name." WHERE date(LogDate) ".$dateInterval.";", ARRAY_A);

		$catAdded = 0;
		$storeAdded = 0;
		$dealsAdded = 0;
		foreach($logs as $stat){
			switch($stat['ApiAct']){
				case 'catget':
					$catAdded += $stat['Added'];
				break;
				case 'storeget':
					$storeAdded += $stat['Added'];
				break;
				case 'dealget':
					$dealsAdded += $stat['Added'];
				break;
			}
		}

		$responseArray = array(
			"Code" => 200,
			"stores" => $storeAdded,
			"deals" => $dealsAdded,
			"cats" => $catAdded
		);
		echo json_encode($responseArray);
		wp_die();
	}

}
