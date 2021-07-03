<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://beon.ge
 * @since      1.0.0
 *
 * @package    Fmtc_Api
 * @subpackage Fmtc_Api/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Fmtc_Api
 * @subpackage Fmtc_Api/includes
 * @author     Tskhadadze Shako <tskhadadze.shako@gmail.com>
 */
class Fmtc_Api {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Fmtc_Api_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The Option Prefix for FMTC API Plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $option_name    The option prefix for FMTC API Plugin.
	 */
	protected $option_name;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'FMTC_API_VERSION' ) ) {
			$this->version = FMTC_API_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'fmtc-api';
		$this->option_name = 'fmtcapi_';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->create_endpoint();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Fmtc_Api_Loader. Orchestrates the hooks of the plugin.
	 * - Fmtc_Api_i18n. Defines internationalization functionality.
	 * - Fmtc_Api_Admin. Defines all hooks for the admin area.
	 * - Fmtc_Api_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-fmtc-api-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-fmtc-api-i18n.php';

		/**
		 * The class responsible for creating the custom endpoint for FMTC API Controller.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-fmtc-api-custom-endpoints.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-fmtc-api-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-fmtc-api-public.php';

		$this->loader = new Fmtc_Api_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Fmtc_Api_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Fmtc_Api_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Define the Custom Endpoint for FMTC API.
	 *
	 * Create the Route, Custom Endpoint & data management for FMTC API.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function create_endpoint() {
		$plugin_endpoint = new fmtc_api_controller( $this->get_plugin_name(), $this->get_version(), $this->get_apiKey() );
		
		// Add Admin Notice if RestAPI isn't loaded with Wordpress
		$this->loader->add_action( 'admin_notices', $plugin_endpoint, 'fmtc_api_check_message' );
		
		// Add Admin Notice if FMTC API Key isn't defined
		$this->loader->add_action( 'admin_notices', $plugin_endpoint, 'fmtc_api_apikey_check' );

		// Construct Custom Endpoint
		$this->loader->add_action( 'rest_api_init', $plugin_endpoint, 'fmtc_api_constructor' );
	}


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Fmtc_Api_Admin( $this->get_plugin_name(), $this->get_version(), $this->get_option_name() );
		
		// Add FMTC API Options Page (under Settings Menu)
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_options_page' );

		// Register Plugin Options
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_fmtc_options' );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_ajax_get_statistics', $plugin_admin, 'getStatistics' );
	}


	
	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Fmtc_Api_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'register_public_script' );
		$this->loader->add_shortcode( 'klaviyo-popup', $plugin_public, 'klaviyo_front' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Fmtc_Api_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve the option prefix 
	 *
	 * @since     1.0.0
	 * @return    string    The option name prefix of the plugin.
	 */
	public function get_option_name() {

		return $this->option_name;

	}

	/**
	 * Retrieve User FMTC API KEY
	 * 
	 * @since		1.0.0
	 * @return		string	API KEY FOR FMTC API
	 */
	public function get_apiKey(){

		return get_option($this->option_name .'api-key');

	}
}
