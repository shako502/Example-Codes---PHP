<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://tskhadadzeshako.com
 * @since      1.0.0
 *
 * @package    Checkinoutpicker
 * @subpackage Checkinoutpicker/includes
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
 * @package    Checkinoutpicker
 * @subpackage Checkinoutpicker/includes
 * @author     Tskhadadze Shako <tskhadadze.shako@gmail.com>
 */
class Checkinoutpicker {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Checkinoutpicker_Loader    $loader    Maintains and registers all hooks for the plugin.
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
	 * The Option Prefix for CheckInOutPicker
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $option_name    The option prefix for CheckInOutPicker.
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
		if ( defined( 'CHECKINOUTPICKER_VERSION' ) ) {
			$this->version = CHECKINOUTPICKER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'checkinoutpicker';
		$this->option_prefix = 'checkinoutpicker_';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Checkinoutpicker_Loader. Orchestrates the hooks of the plugin.
	 * - Checkinoutpicker_i18n. Defines internationalization functionality.
	 * - Checkinoutpicker_Admin. Defines all hooks for the admin area.
	 * - Checkinoutpicker_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-checkinoutpicker-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-checkinoutpicker-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-checkinoutpicker-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-checkinoutpicker-public.php';

		$this->loader = new Checkinoutpicker_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Checkinoutpicker_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Checkinoutpicker_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Checkinoutpicker_Admin( $this->get_plugin_name(), $this->get_version(), $this->get_options_name(), $this->get_option_prefix() );
		
		// Add FMTC API Options Page (under Settings Menu)
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_options_page' );
		
		// Register Plugin Options
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_checkinout_options' );


		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Checkinoutpicker_Public( $this->get_plugin_name(), $this->get_version(), $this->get_option_prefix() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_shortcode( 'checkinoutpicker', $plugin_public, 'shortcode_render' );

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
	 * @return    Checkinoutpicker_Loader    Orchestrates the hooks of the plugin.
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
	public function get_options_name() {

		return array(
			$this->option_prefix . 'adult'			=> true,
			$this->option_prefix . 'child'			=> true,
			$this->option_prefix . 'border'			=> 0,
			$this->option_prefix . 'borderC'		=> '',
			$this->option_prefix . 'bgColor'		=> '',
			$this->option_prefix . 'fontColor'		=> '',
			$this->option_prefix . 'btnBgColor'		=> '',
			$this->option_prefix . 'btnHoverColor'	=> '',
			$this->option_prefix . 'btnHoverTxtC'	=> '',
			$this->option_prefix . 'btnTxtC'		=> '',
			$this->option_prefix . 'customCSS'		=> '',
			$this->option_prefix . 'gFont'			=> '',
			$this->option_prefix . 'gFontEnable'	=> false,
			$this->option_prefix . 'titleText'		=> 'Input your Details Below',
			$this->option_prefix . 'nBgColor'		=> '',
			$this->option_prefix . 'nContBgColor'	=> '',
			$this->option_prefix . 'nTextColor'		=> '',
			$this->option_prefix . 'finalBtnURL'	=> '',
			$this->option_prefix . 'finalBtnText'	=> 'Check Availability',
			$this->option_prefix . 'calBg'			=> '',
			$this->option_prefix . 'calActive'		=> '',
			$this->option_prefix . 'calBefore'		=> '',
			$this->option_prefix . 'calAfter'		=> '',
			$this->option_prefix . 'calActiveText'	=> '',
			$this->option_prefix . 'calBeforeText'	=> '',
			$this->option_prefix . 'calAfterText'	=> '',
			$this->option_prefix . 'squareLayout'	=> '',
			$this->option_prefix . 'sqrLayoutSize'	=> 0,
			$this->option_prefix . 'queryAdults'	=> 'adult',
			$this->option_prefix . 'queryChild'		=> 'child',
			$this->option_prefix . 'queryCheckin'	=> 'arrival',
			$this->option_prefix . 'queryCheckout'	=> 'depart',
		);

	}



	public function get_option_prefix(){
		return $this->option_prefix;
	}

}
