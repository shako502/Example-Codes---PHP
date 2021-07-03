<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://tskhadadzeshako.com
 * @since      1.0.0
 *
 * @package    Checkinoutpicker
 * @subpackage Checkinoutpicker/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Checkinoutpicker
 * @subpackage Checkinoutpicker/public
 * @author     Tskhadadze Shako <tskhadadze.shako@gmail.com>
 */
class Checkinoutpicker_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $option_prefix ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options_prefix = $option_prefix;
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
		 * defined in Checkinoutpicker_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Checkinoutpicker_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
	

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
		 * defined in Checkinoutpicker_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Checkinoutpicker_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
	

	}

	public function enqueue_styles_and_scripts(){
		/* Styles */
		$gFontEnabled = get_option($this->options_prefix . 'gFontEnable');
		if($gFontEnabled == '1'){
			wp_enqueue_style('googleFont', 'https://fonts.googleapis.com/css?family='. get_option($this->options_prefix . 'gFont'), array(), null, 'all');
		}
		wp_enqueue_style('checkinoutpicker-flatpickr', plugin_dir_url( __FILE__ ) . 'css/flatpickr.min.css', array(), null, 'all');
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/checkinoutpicker-public.css', array(), $this->version, 'all' );


		/* Scripts */
		wp_enqueue_script('checkinoutpicker-flatpickr', plugin_dir_url( __FILE__ ) . 'js/flatpickr.js', array(), '4.6.3', true);
		wp_enqueue_script('checkinoutpicker-popper', 'https://unpkg.com/popper.js@1', array(), '1.16.1', true);
		wp_enqueue_script('checkinoutpicker-tippy', 'https://unpkg.com/tippy.js@5', array('checkinoutpicker-popper'), '5.2.0', true);
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/checkinoutpicker-public.js', array( 'jquery', 'checkinoutpicker-flatpickr', 'checkinoutpicker-popper', 'checkinoutpicker-tippy' ), $this->version, true );
		wp_localize_script($this->plugin_name, 'jsVars', array(
			'queryAdults' => get_option($this->options_prefix . 'queryAdults' ),
			'queryChild' => get_option($this->options_prefix . 'queryChild' ),
			'queryCheckin' => get_option($this->options_prefix . 'queryCheckin' ),
			'queryCheckout' => get_option($this->options_prefix . 'queryCheckout' ),
		));
	}

	public function enqueue_inline_css(){
		$gFontEnabled = get_option($this->options_prefix . 'gFontEnable');

		$css = '';

		// Google Fonts
		if($gFontEnabled == '1'){
			$css .= '.checkinout-main-container, .checkinout-date-input, .checkinout-numbers button {font-family: '. preg_replace('/[\s\+]/', ' ', get_option($this->options_prefix . 'gFont') ) .' !important;}';
		}

		$mainContainerStyles = '';
		if(!is_null($borderSize = get_option($this->options_prefix . 'border', null)) && $borderSize !== ''){
			$mainContainerStyles .= 'border-width: '.$borderSize.'px !important;';
		}

		if(!is_null($borderC = get_option($this->options_prefix . 'borderC', null)) && $borderC !== ''){
			$mainContainerStyles .= 'border-color: '.$borderC.' !important;';
		}

		if($mainContainerStyles !== ''){
			$css .= '.checkinout-main-container {'.$mainContainerStyles.'}';
		}

		///////////////////////////
		if(!is_null($fontC = get_option($this->options_prefix . 'fontColor', null)) && $fontC !== ''){
			$css .= '.checkinout-main-container, .checkinout-section-head span, .checkinout-section-input input {color: '.$fontC.' !important;}';
		}
		///////////////////////////

		///////////////////////////
		$btn_static_styles = '';
		if(!is_null($btnBgColor = get_option($this->options_prefix . 'btnBgColor', null)) && $btnBgColor !== ''){
			$btn_static_styles .= 'background-color: '.$btnBgColor.' !important;';
		}

		if(!is_null($btnFontC = get_option($this->options_prefix . 'btnTxtC', null)) && $btnFontC !== ''){
			$btn_static_styles .= 'color: '.$btnFontC.' !important;';
		}

		if($btn_static_styles !== ''){
			$css .= '.checkinout-submit {'. $btn_static_styles.'}';
		}
		///////////////////////////

		///////////////////////////
		$btn_hover_styles = '';
		if(!is_null($btnHoverBgC = get_option($this->options_prefix . 'btnHoverColor', null)) && $btnHoverBgC !== ''){
			$btn_hover_styles .= 'background-color: '.$btnHoverBgC.' !important;';
		}

		if(!is_null($btnHoverFontC = get_option($this->options_prefix . 'btnHoverTxtC', null)) && $btnHoverFontC !== ''){
			$btn_hover_styles .= 'color: '.$btnHoverFontC.' !important;';
		}

		if($btn_hover_styles !== ''){
			$css .= '.checkinout-submit:hover {'. $btn_hover_styles .'}';
		}
		///////////////////////////

		///////////////////////////
		$pick_numbers_styles = '';
		if(!is_null($nBgColor = get_option($this->options_prefix . 'nBgColor', null)) && $nBgColor !== ''){
			$pick_numbers_styles .= 'background-color: '.$nBgColor.' !important;';
		}
		if(!is_null($nTextColor = get_option($this->options_prefix . 'nTextColor', null)) && $nTextColor !== ''){
			$pick_numbers_styles .= 'color: '.$nTextColor.' !important;';
		}
		
		if($pick_numbers_styles !== ''){
			$css .= '.checkinout-numbers button {'. $pick_numbers_styles .'}';
		}
		///////////////////////////
		
		///////////////////////////
		if(!is_null($nContBgColor = get_option($this->options_prefix . 'nContBgColor', null)) && $nContBgColor !== ''){
			$css .= '.tippy-content {background-color: '.$nContBgColor.' !important;}';
		}
		///////////////////////////
		
		///////////////////////////
		if(!is_null($calBg = get_option($this->options_prefix . 'calBg', null)) && $calBg !== ''){
			$css .= '.flatpickr-calendar {background-color: '.$calBg.' !important;}';
		}
		///////////////////////////
		
		///////////////////////////
		$cal_active_num_styles = '';
		if(!is_null($calActive = get_option($this->options_prefix . 'calActive', null)) && $calActive !== ''){
			$cal_active_num_styles .= 'background-color: '.$calActive.' !important;';
		}
		if(!is_null($calActiveText = get_option($this->options_prefix . 'calActiveText', null)) && $calActiveText !== ''){
			$cal_active_num_styles .= 'color: '.$calActiveText.' !important;';
		}
		if($cal_active_num_styles !== ''){
			$css .= '.flatpickr-day.selected {'. $cal_active_num_styles .'}';
		}
		///////////////////////////
		
		///////////////////////////
		$cal_before_num_styles = '';
		if(!is_null($calBefore = get_option($this->options_prefix . 'calBefore', null)) && $calBefore !== ''){
			$cal_before_num_styles .= 'background-color: '.$calBefore.' !important;';
		}
		if(!is_null($calBeforeText = get_option($this->options_prefix . 'calBeforeText', null)) && $calBeforeText !== ''){
			$cal_before_num_styles .= 'color: '.$calBeforeText.' !important;';
		}
		if($cal_before_num_styles !== ''){
			$css .= '.flatpickr-disabled {'. $cal_before_num_styles .'}';
		}
		///////////////////////////
		
		///////////////////////////
		$cal_after_num_styles = '';
		if(!is_null($calAfter = get_option($this->options_prefix . 'calAfter', null)) && $calAfter !== ''){
			$cal_after_num_styles .= 'background-color: '.$calAfter.' !important;';
		}
		if(!is_null($calAfterText = get_option($this->options_prefix . 'calAfterText', null)) && $calAfterText !== ''){
			$cal_after_num_styles .= 'color: '.$calAfterText.' !important;';
		}
		if($cal_after_num_styles !== ''){
			$css .= '.flatpickr-day:not(.flatpickr-disabled):not(.selected) {'. $cal_after_num_styles .'}';
		}
		///////////////////////////

		$vsquareLayout = get_option($this->options_prefix . 'squareLayout');
		if($vsquareLayout === '1'){
			if(!is_null($sqrLayoutSize = get_option($this->options_prefix . 'sqrLayoutSize', null)) && $sqrLayoutSize !== '0'){
				$css .= '.checkinout-main-container {width: '.$sqrLayoutSize.'px !important; height: auto !important;}';
			}
		}

		if(!empty($css)){
			wp_register_style('checkinout-custom-options', false);
			wp_enqueue_style('checkinout-custom-options');
			wp_add_inline_style('checkinout-custom-options', $css);
		}
		
	}

	public function enqueue_custom_css(){
		wp_register_style('checkinout-custom-css', plugin_dir_url( __FILE__ ) . 'partials/checkinout-customCss.php');
		wp_enqueue_style('checkinout-custom-css', null, array('checkinoutpicker-flatpickr', $this->plugin_name, 'checkinout-custom-options'), $this->version, 'all');
	}

	
	public function shortcode_render($atts){
		$this->enqueue_styles_and_scripts();
		$this->enqueue_inline_css();
		$this->enqueue_custom_css();
		$prefix = $this->options_prefix;
		include dirname( __FILE__ ) . '/partials/checkinoutpicker-public-display.php';
	}

}
