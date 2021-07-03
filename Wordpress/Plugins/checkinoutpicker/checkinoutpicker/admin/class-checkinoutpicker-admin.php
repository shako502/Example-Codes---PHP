<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://tskhadadzeshako.com
 * @since      1.0.0
 *
 * @package    Checkinoutpicker
 * @subpackage Checkinoutpicker/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Checkinoutpicker
 * @subpackage Checkinoutpicker/admin
 * @author     Tskhadadze Shako <tskhadadze.shako@gmail.com>
 */
class Checkinoutpicker_Admin {

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
	 * The options names array for CheckInOutPicker
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	array 		$option_names 		Option names array for CheckInOutPicker
	 */
	private $option_names;


	/**
	 * The options prefix for CheckInOutPicker
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_names 		Option prefix for CheckInOutPicker
	 */
	private $option_prefix;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $option_names, $option_prefix ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->option_names = $option_names;
		$this->option_prefix = $option_prefix;

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {

		$this->plugin_options_page = add_options_page(
			__( 'CheckInOut Picker Options', 'checkinoutpicker' ),
			__( 'CheckInOut', 'checkinoutpicker' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'checkinout_admin_render' )
		);

	}

	/**
	 * Render the options page
	 *
	 * @since  1.0.0
	 */
	public function checkinout_admin_render() {
		$options_prefix = $this->option_prefix;
		include_once 'partials/checkinoutpicker-admin-display.php';

	}

	/**
	 * Register Plugin Options
	 * 
	 * @since 1.0.0
	 */
	public function register_checkinout_options(){
		foreach($this->option_names as $key => $val ){
			add_option($key, $val);
			$type = gettype($val);
			$args = array(
				'type' => $type,
			);
			register_setting($this->option_prefix . 'options', $key,  $args);	
		}
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
		 * defined in Checkinoutpicker_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Checkinoutpicker_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/checkinoutpicker-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		if($_GET['page'] === $this->plugin_name){
			wp_register_script( 'bootstrap-' . $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), '4.0.0', true );
			wp_enqueue_script( 'bootstrap-' . $this->plugin_name );
		
			wp_enqueue_code_editor( array( 'type' => 'text/css' ) );

			wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/checkinoutpicker-admin.js', array( 'jquery', 'bootstrap-' . $this->plugin_name, 'wp-color-picker' ), '1.4.7', true );
			wp_enqueue_script( $this->plugin_name );
			wp_localize_script($this->plugin_name, 'jsVars', array(
				'ajax_url' => admin_url( 'admin-ajax.php' )
			));
			
			wp_register_style( 'bootstrap-style', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', false, '4.0.0' );
			wp_enqueue_style( 'bootstrap-style' );
			wp_enqueue_style( 'wp-color-picker' );
		}
	}

}
