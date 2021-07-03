<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://beon.ge
 * @since      1.0.0
 *
 * @package    Fmtc_Api
 * @subpackage Fmtc_Api/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Fmtc_Api
 * @subpackage Fmtc_Api/public
 * @author     Tskhadadze Shako <tskhadadze.shako@gmail.com>
 */
class Fmtc_Api_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/fmtc-api-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/fmtc-api-public.js', array( 'jquery' ), $this->version, false );

	}

	public function register_public_script(){
		wp_register_script( $this->plugin_name . 'klaviyo-script', plugin_dir_url( __FILE__ ) . 'js/klaviyo-public.js', array( 'jquery' ), $this->version, true );
		wp_register_style( $this->plugin_name . 'klaviyo-styles', plugin_dir_url( __FILE__ ) . 'css/klaviyo-popup.css', $this->version, 'all' );
	}


	public function klaviyo_front($atts) {
		wp_enqueue_script( $this->plugin_name . 'klaviyo-script' );
		wp_localize_script( $this->plugin_name . 'klaviyo-script', 'php_vars', array('baseurl' => site_url()) );
		wp_enqueue_style($this->plugin_name . 'klaviyo-styles');
		?>
		<div class="box" >
		<p1>STAY UPDATED WITH THE BEST DEALS!</p1><br>
		<img src="https://whypayfullprice.ca/wp-content/uploads/2020/03/WhyPayLogo1.0-e1586186656557.png" width="170px;", height="90px;"><br>
		<div class="input-field">
			<i class="envelop icon"></i>
			<input type="text" name="klaviyo-subscriber-email" id="klaviyo-subscriber-email" placeholder="Your Email" required="">
		</div>  
		<input type="button" value="START SAVING" id="klaviyo-email-submit" class="submit"/>
		<br>
		<div class="subsc-loader">Loading...</div>
		<div class="newsletter-response">
		</div>
		<p2>You can opt out of our newsletters at any time. See our <a href="https://whypayfullprice.ca/privacy-policy/">Privacy Policy.</a></p2>
		</div>
	
	<?php }

}
