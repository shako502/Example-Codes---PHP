<?php

/**
 * The Custom Endpoint
 *
 * Create the Route, Custom Endpoint & data management for FMTC API
 *
 * @package    Fmtc_Api
 * @subpackage Fmtc_Api/includes
 * @since      1.0.0
 * @author     Tskhadadze Shako
 *
 */

/**
 * Define the custom endpoint content.
 *
 * Add the route for the API Boilerplate Custom Endpoint and generate
 * the necessary data for the frontend.
 *
 * @package    Fmtc_Api
 * @subpackage Fmtc_Api/includes
 * @since      1.0.0
 * @author     Tskhadadze Shako
 */
class fmtc_api_controller {

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
	 * FMTC API User Key
	 * 
	 * @since	1.0.0
	 * @access	private
	 * @var		string		$apiKey		FMTC USER API KEY
	 */
	private $apiKey;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param 	 string 	$plugin_name 		  The name of this plugin.
	 * @param    string    	$version    		  The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $apiKey) {

		$this->plugin_name	= $plugin_name;
		$this->version		= $version;
		$this->apiKey		= $apiKey;

	}

	/**
	 * Admin message if WP API not enabled.
	 *
	 * @since    1.0.0
	 */
	public function fmtc_api_check_message() {

		global $wp_version;

		// WP v4.7 was the first WP version with the API fully baked in :)
		if ( $wp_version >= 4.7 ) {

			return;

		} elseif ( is_plugin_active( 'WP-API-develop/plugin.php' ) || is_plugin_active( 'rest-api/plugin.php' )  || is_plugin_active( 'WP-API/plugin.php' ) ) {

				return;

		} else { ?>

			<div class="update-nag notice">

				<p>
					<?php __( 'To use <strong>FMTC API</strong>, you need to update to the latest version of WordPress (version 4.7 or above). To use an older version of WordPress, you can install the <a href="https://wordpress.org/plugins/rest-api/">WP API Plugin</a> plugin. However, we&apos;d strongly advise youto update WordPress.', 'fmtc-api' ); ?>
				</p>

			</div>

		<?php
		}

	}

	/**
	 * Admin message if FMTC Key Isn't Defined.
	 *
	 * @since    1.0.0
	 */
	public function fmtc_api_apikey_check() {

		if($this->apiKey){
			return;
		}
		else if($this->apiKey === 'ApiKey' || $this->apiKey === ''){?>
			<div class="notice notice-error">
				<p>FMTC API Key is not Updated. Please Check <a href="<?php echo admin_url( "options-general.php?page=".$this->plugin_name ) ?>">FMTC-API Settings</a> and set your API KEY</p>
				<p><?php echo $this->apiKey ?></p>
			</div>
		<?php
		}
		else{?>
			<div class="notice notice-error">
				<p>FMTC API Key is not saved. Please Check <a href="<?php echo admin_url( "options-general.php?page=".$this->plugin_name ) ?>">FMTC-API Settings</a> and Update API KEY</p>
			</div>
		<?php
		}
	}

	/**
	 * API Route Constructor.
	 *
	 * @since    1.0.0
	 */
	public function fmtc_api_constructor() {

		register_rest_route( 'fmtcapi/v1', '/getMerchants', array(
			'methods' => 'GET',
			'callback' => array( $this, 'getMerchants' )
		) );

		register_rest_route( 'fmtcapi/v1', '/getCategories', array(
			'methods' => 'GET',
			'callback' => array( $this, 'getCategories' )
		) );

		register_rest_route( 'fmtcapi/v1', '/getDeals', array(
			'methods' => 'GET',
			'callback' => array( $this, 'getDeals' )
		) );
		
		register_rest_route( 'fmtcapi/v1', '/checkImage', array(
			'methods' => 'GET',
			'callback' => array( $this, 'checkImage' )
		) );

		register_rest_route( 'fmtcapi/v1', '/klaviyo-members', array(
			'methods' => 'POST',
			'callback' => array( $this, 'klaviyo_members_add')
		) );

		register_rest_route( 'fmtcapi/v1', '/klaviyo-list', array(
			'methods' => 'POST',
			'callback' => array( $this, 'klaviyo_list_subscribe')
		) );
	}

	/**
	 *  Klaviyo Member Add
	 */
	public function klaviyo_members_add(WP_REST_Request $params){
		$request_data = $params->get_params();
		$sub_email = $request_data['email'];

		if(!empty($sub_email) && $sub_email !== ''){
			$klaviyo_data = array(
				'token' => 'W6888Y',
				'properties' => array(
					'$email' => $sub_email
				)
			);

			$klaviyo_data = json_encode($klaviyo_data);

			$encoded_data = urlencode( base64_encode($klaviyo_data) );

			$klaviyo_url = 'https://a.klaviyo.com/api/identify?data=' . $encoded_data;

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $klaviyo_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);

			$klaviyo_res = curl_exec($ch);
			curl_close($ch);

			return array(
				'Status' => 200,
				'Endpoint' => 'members',
				'Message' => $klaviyo_res
			);

		} else {

			return array(
				'Status' => 404,
				'Message' => 'Email is Empty'
			);
		
		}
	}

	/**
	 * Klaviyo Subscriber Add To Newsletter List
	 * 
	 */
	public function klaviyo_list_subscribe(WP_REST_Request $params){
		$request_data = $params->get_params();
		$sub_email = $request_data['email'];

		if(!empty($sub_email) && $sub_email !== ''){

			$klaviyo_data = array(
				'profiles' => array(
					'email' => $sub_email
				)
			);
			$klaviyo_data = json_encode($klaviyo_data);

			$klaviyo_url = 'https://a.klaviyo.com/api/v2/list/V3WMMp/members';

			$ch = curl_init();

			curl_setopt_array($ch, array(
				CURLOPT_URL => $klaviyo_url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $klaviyo_data,
				CURLOPT_HTTPHEADER => array(
				  "api-key: pk_69e5846f31cad550e0ee9161b69f357aa8",
				  "Content-Type: application/json"
				),
			  ));

			$klaviyo_res = curl_exec($ch);
			curl_close($ch);

			$klaviyo_res = json_decode($klaviyo_res, true);

			return array(

				'Status' => 200,
				'Endpoint' => 'list',
				'Message' => $klaviyo_res
			);

		} else {

			return array(
				'Status' => 404,
				'Message' => 'Email is Empty'
			);
		
		}
	}

	public function checkImage(WP_REST_Request $params){
		
		$merchTermObj = wp_insert_term(
			'CouponTest4',
			'coupon_store',
			array(
				'description' => 'desc',
				'slug' => 'coupontesting4'
			)
		);

		require_once(ABSPATH . 'wp-admin/includes/media.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/image.php');

		$imageID = media_sideload_image( 'http://logos.fmtc.co/120x60/33863.gif', null, null, 'id' );
		$imageURL = wp_get_attachment_url($imageID);

		
		if(!is_wp_error($merchTermObj)){
			$newTermID = $merchTermObj['term_id'];
			if( $newTermID ) {
				add_term_meta($newTermID, '_wpc_store_url', 'https://www.amazon.ca/');
				add_term_meta($newTermID, '_wpc_store_aff_url', 'https://www.amazon.ca/');
				add_term_meta($newTermID, '_wpc_store_image_id', $imageID);
				add_term_meta($newTermID, '_wpc_store_image', $imageURL);
			}
		}

		return array(
			'AttachmentID' => $imageID,
		);
	}

	/**
	 * Get Merchants From FMTC API
	 *
	 * @since    1.0.0
	 */
	public function getMerchants( WP_REST_Request $params ) {
		global $wpdb;
		$table_name = $wpdb->prefix . "fmtcapi_merch";
		$log_table = $wpdb->prefix . "fmtcapi_log";

		$ftmcURL = 'https://services.fmtc.co/v2/getMerchants?';
		$key = $this->apiKey;
		$params = array(
			'key' => $key,
			'incremental' => 1,
			'format' => 'JSON'
		);

		$urlquery = http_build_query($params);

		$getURL = $ftmcURL . $urlquery;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $getURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		$merchants = curl_exec($ch);
		curl_close($ch);

		$responseArray = json_decode($merchants, true);

		require_once(ABSPATH . 'wp-admin/includes/media.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/image.php');

		$errorArray = array();
		$cNewTerms = 0;
		$cExistedTerms = 0;
		foreach($responseArray as $merch){

			$parentID = '';

			if($merch['nParentMerchantID']){
				$parentID = $wpdb->get_var($wpdb->prepare("SELECT termID FROM {$table_name} WHERE merchID = %d", $merch['nParentMerchantID']));
			}

			$existCheckDB = $wpdb->get_var($wpdb->prepare("SELECT termID FROM {$table_name} WHERE merchID = %d LIMIT 1 ", intval($merch['nMerchantID']) ));
			$termCheckWP = term_exists(intval($existCheckDB), 'coupon_store');
			if($existCheckDB > 0 && $termCheckWP){
				$cExistedTerms += 1;
			}
			else {
				if($existCheckDB > 0 && !$termCheckWP){
					$wpdb->delete($table_name, array('merchID' => intval($merch['nMerchantID'])), array('%d'));
				}

				$merchTermObj = wp_insert_term(
					$merch['cName'],
					'coupon_store',
					array(
						'description' => $merch['cNetworkNotes'],
						'slug' => sanitize_title($merch['cName']),
						'parent' => intval($parentID)
					)
				);

				$imageURL = '';
				foreach($merch['aLogos'] as $logo){
					if($logo['cSize'] === '120x60'){
						$imageURL = $logo['cURL'];
					}
				}
				if(empty($imageURL)){
					$imageURL = $merch['aLogos'][0]['cURL'];
				}
				$imageID = media_sideload_image( $imageURL, null, null, 'id' );
				$wpImageURL = wp_get_attachment_url($imageID);

				
				if(!is_wp_error($merchTermObj)){
					$newTermID = $merchTermObj['term_id'];
					if( $newTermID ) {
						add_term_meta($newTermID, '_wpc_store_url', $merch['cFMTCURL']);
						add_term_meta($newTermID, '_wpc_store_aff_url', $merch['cAffiliateURL']);
						add_term_meta($newTermID, '_wpc_store_image_id', $imageID);
						add_term_meta($newTermID, '_wpc_store_image', $wpImageURL);

						$merchDataRel = array(
							'merchID' => $merch['nMerchantID'],
							'termID' => $newTermID
						);
						$merchDataFormat = array(
							'%d',
							'%d'
						);
						
						$wpdb->insert($table_name, $merchDataRel, $merchDataFormat);
						$cNewTerms += 1;
					}
				}
				else {
					if($merchTermObj->get_error_code() === 'term_exists'){
						$cExistedTerms += 1;
					}
					else {
						$termError = array(
							'Code' => $merchTermObj->get_error_code(),
							'Message' => $merchTermObj->get_error_message(),
							'merchID' => $merch['nMerchantID']
						);
						array_push($errorArray, $termError);
					}
				}
			}
		}

		$errorCount = count($errorArray);
		
		$apiResponse = array(
			'Added Stores' => $cNewTerms,
			'Existed Stores' => $cExistedTerms,
			'Errors' => $errorCount
		);
		$logResStatus = 'Success';
		if($errorCount){
			$logResStatus = 'Fail';
			array_push($apiResponse, $errorArray);
		}

		// Insert data to Log Table
		$logData = array(
			'ApiAct' => 'storeget',
			'ResStatus' => $logResStatus,
			'Added' => $cNewTerms,
			'Existed' => $cExistedTerms,
			'Errors' => $errorCount,
			'LogDate' => date("Y-m-d H:i:s")
		);
		$logDataFormat = array(
			'%s',
			'%s',
			'%d',
			'%d',
			'%d',
			'%s'
		);

		if($wpdb->insert($log_table, $logData, $logDataFormat)){
			$apiResponse['Log'] = 'Saved';
		}
		else{
			$apiResponse['Log'] = 'Failed';
		}

		return $apiResponse;
	}

	public function getCategories( WP_REST_Request $params ) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'fmtcapi_cat';
		$log_table = $wpdb->prefix . "fmtcapi_log";

		$ftmcURL = 'https://services.fmtc.co/v2/getCategories?';
		$key = $this->apiKey;
		$params = array(
			'key' => $key,
			'format' => 'JSON',
			'v2' => 1
		);

		$urlquery = http_build_query($params);

		$getURL = $ftmcURL . $urlquery;
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $getURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		$categories = curl_exec($ch);
		curl_close($ch);

		$responseArray = json_decode($categories, true);

		$errorArray = array();
		$cNewTerms = 0;
		$cExistedTerms = 0;
		foreach($responseArray as $cat){
			$slug = sanitize_title($cat['cName']);

			$parentID = '';

			if($cat['nParentID']){
				$parentID = $wpdb->get_var($wpdb->prepare("SELECT termID FROM {$table_name} WHERE catID = %d", intval($cat['nParentID'])));
			}

			$existCheckDB = $wpdb->get_var($wpdb->prepare("SELECT termID FROM {$table_name} WHERE catID = %d LIMIT 1 ", intval($cat['nCategoryID']) ));
			$termCheckWP = term_exists(intval($existCheckDB), 'coupon_category');
			if($existCheckDB > 0 && $termCheckWP){
				$cExistedTerms += 1;
			}
			else{
				
				if($existCheckDB > 0 && !$termCheckWP){
					$wpdb->delete($table_name, array('catID' => intval($cat['nCategoryID'])), array('%d'));
				}

				$catTermObj = wp_insert_term(
					$cat['cName'],
					'coupon_category',
					array(
						'description' => '',
						'slug' => $slug,
						'parent' => $parentID
					)
				);
				if(!is_wp_error($catTermObj)){
					$newTermID = $catTermObj['term_id'];
					if($newTermID){
						$catDataRel = array(
							'catID' => $cat['nCategoryID'],
							'termID' => $newTermID
						);
						$catDataFormat = array(
							'%d',
							'%d'
						);
						
						$wpdb->insert($table_name, $catDataRel, $catDataFormat);
						
						$cNewTerms += 1;
					}
				}
				else {
					if($catTermObj->get_error_code() === 'term_exists'){
						$cExistedTerms += 1;
					}
					else {
						$termError = array(
							'Code' => $catTermObj->get_error_code(),
							'Message' => $catTermObj->get_error_message(),
							'TermID' => $cat['nCategoryID']
						);
						array_push($errorArray, $termError);
					}
				}
			}

		}

		$errorCount = count($errorArray);
		
		$apiResponse = array(
			'Added Categories' => $cNewTerms,
			'Existed Categories' => $cExistedTerms,
			'Errors' => $errorCount
		);
		
		$logResStatus = 'Success';
		if($errorCount){
			$logResStatus = 'Fail';
			array_push($apiResponse, $errorArray);
		}

		// Insert data to Log Table
		$logData = array(
			'ApiAct' => 'catget',
			'ResStatus' => $logResStatus,
			'Added' => $cNewTerms,
			'Existed' => $cExistedTerms,
			'Errors' => $errorCount,
			'LogDate' => date("Y-m-d H:i:s")
		);
		$logDataFormat = array(
			'%s',
			'%s',
			'%d',
			'%d',
			'%d',
			'%s'
		);

		if($wpdb->insert($log_table, $logData, $logDataFormat)){
			$apiResponse['Log'] = 'Saved';
		}
		else{
			$apiResponse['Log'] = 'Failed';
		}
		
		return $apiResponse;
	}


	public function getDeals(){
		global $wpdb;
		$catTable = $wpdb->prefix . 'fmtcapi_cat';
		$upTable = $wpdb->prefix . 'ftmcapi_parup';
		$merchTable = $wpdb->prefix . 'ftmcapi_merch';
		$log_table = $wpdb->prefix . "fmtcapi_log";

		$ftmcURL = 'https://services.fmtc.co/v2/getDeals?';
		$key = $this->apiKey;
		$params = array(
			'key' => $key,
			'incremental' => 1,
			'format' => 'JSON',
			'v2categories' => 1
		);

		$urlquery = http_build_query($params);
		$getURL = $ftmcURL . $urlquery;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $getURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		$deals = curl_exec($ch);
		curl_close($ch);

		$responseArray = json_decode($deals, true);

		$returnArray = array();

		$newDeals = 0;
		$existedDeals = 0;
		$mainErrorsArray = array();
		foreach ($responseArray as $deal){	
			$termsErrorArray = array();
			// Get Deals Properties
			$couponID = $deal['nCouponID'];
			$merchant = $deal['cMerchant'];
			$merchantID = $deal['nMerchantID'];
			$dealStatus = $deal['cStatus'];
			$dealTitle = $deal['cLabel'];
			$dealDesc = $deal['cDescription'];
			$dealRest = $deal['cRestrictions'];
			$couponCode = $deal['cCode'];
			$dealStartDate = strtotime($deal['dtStartDate']);
			$dealEndDate = $deal['dtEndDate'];
			$affiliateURL = $deal['cAffiliateURL'];
			$dealFmtcUrl = $deal['cFMTCURL'];
			$dealTypesArray = $deal['aTypes'];
			$discountPrice = $deal['fDiscount'];
			$salePrice = $deal['fSalePrice'];
			$firstPrice = $deal['fWasPrice'];
			$dealRating = $deal['fRating'];
			$dealCatArray = $deal['aCategoriesV2'];
			
			// Get Categories IDs Of the Posts
			$catTermIDs = array();
			foreach ($dealCatArray as $category){
				$termID = $wpdb->get_var($wpdb->prepare("SELECT termID FROM {$catTable} WHERE catID='%d'", $category['nCategoryID']));

				if($termID){
					array_push($catTermIDs, $termID);
				}
				else {
					$catUpData = array(
						'catID' => $category['nCategoryID'],
						'Date' => current_time('mysql', 1),
						'couponID' => $couponID
					);
					$catUpDataFormat = array(
						'%d',
						'%s',
						'%d'
					);

					$wpdb->insert($upTable, $catUpData, $catUpDataFormat);
				}
			}

			//Get Store ID
			$storeTermArray = term_exists(sanitize_title($merchant), 'coupon_store');
			$storeID = 0;
			if($storeTermArray){
				$storeID = intval($storeTermArray['term_id']);
			}
			else{
				$merchUpData = array(
					'merchID' => intval($merchantID),
					'Date' => current_time('mysql', 1),
					'couponID' => intval($couponID)
				);
				$merchUpDataFormat = array(
					'%d',
					'%s',
					'%d'
				);

				$wpdb->insert($upTable, $merchUpData, $merchUpDataFormat);
			}

			// Define Post Status From Deal Status
			$postStatus = '';
			if($dealStatus === 'active'){
				$postStatus = 'publish';
			}
			else {
				$postStatus = 'pending';
			}

			// Check Expiry Date
			$dealExpiry = '';
			if($dealEndDate){
				$dealExpiry = strtotime($dealEndDate);
			}


			/*
			 *
			 * Start Inserting Coupons
			 * 
			*/
			$checkPage = get_page_by_title($dealTitle, ARRAY_A, 'coupon');
			if($checkPage && $checkPage['post_status'] !== 'trash'){
				$postExists = array(
					'Code' => 9,
					'Message' => 'Post Already Exists',
					'CouponID' => $couponID,
					'PageObj' => $checkPage
				);

				array_push($returnArray, $postExists);
				$existedDeals += 1;
			}
			else {

				$postParameters = array(
					'post_title' => $dealTitle,
					'post_content' => $dealDesc,
					'post_status' => $postStatus,
					'post_type' => 'coupon',
					'meta_input' => array(
						'_wpc_destination_url' => $dealFmtcUrl,
						'_wpc_expires' => $dealExpiry,
						'_wpc_start_on' => $dealStartDate
					)
				);

				$newPostID = wp_insert_post($postParameters);
				if(!is_wp_error($newPostID)){
					
					$catTermIDs = array_map('intval', $catTermIDs);
					$catTermIDs = array_unique($catTermIDs);
					$addCatsToPost = wp_set_object_terms($newPostID, $catTermIDs, 'coupon_category');
					if(!is_wp_error($addCatsToPost)){
						array_push($returnArray, $addCatsToPost);
					}
					else {
						$termError = array(
							'Code' => $addCatsToPost->get_error_code(),
							'Message' => $addCatsToPost->get_error_message(),
							'CouponID' => $couponID,
							'Sector' => 'Category Edit'
						);
						array_push($termsErrorArray, $termError);
					}
					
					$addStoreToPost = wp_set_object_terms($newPostID, $storeID, 'coupon_store');
					if(!is_wp_error($addStoreToPost)){
						if ( ! add_post_meta( $newPostID, '_wpc_store', $storeID, true ) ) { 
							update_post_meta ( $newPostID, '_wpc_store', $storeID );
						}
						$storeCheckArray = array(
							'StoreID' => $storeID,
							'SetObjectTerm' => $addStoreToPost
						);
						array_push($returnArray, $storeCheckArray);
					}
					else {
						$storeCheckErrorArray = array(
							'StoreID' => $storeID,
							'Message' => $addStoreToPost->get_error_message(),
							'Code' => $addStoreToPost->get_error_code()
						);

						array_push($termsErrorArray, $storeCheckErrorArray);
					}

					/* Define Coupon Type @coupon or @sale */
					/* Add Coupon Code in case of @coupon Type */
					if($couponCode){
						// Assign Coupon Type @coupon if coupon code provided
						if ( ! add_post_meta( $newPostID, '_wpc_coupon_type', 'code', true ) ) { 
							update_post_meta ( $newPostID, '_wpc_coupon_type', 'code' );
						}
						// Assign Coupon Code
						if ( ! add_post_meta( $newPostID, '_wpc_coupon_type_code', $couponCode, true ) ) { 
							update_post_meta ( $newPostID, '_wpc_coupon_type_code', $couponCode );
						}
					}
					else {
						// Assign Coupon Type @sale if coupon code not provided
						if ( ! add_post_meta( $newPostID, '_wpc_coupon_type', 'sale', true ) ) { 
							update_post_meta ( $newPostID, '_wpc_coupon_type', 'sale' );
						}
					}
					/* ---- End Of  --- #Define Coupon Type --- */

					/* Define Free Shipping Option */
					if(in_array('freeshipping', $dealTypesArray)){
						if ( ! add_post_meta( $newPostID, '_wpc_free_shipping', 'on', true ) ) { 
							update_post_meta ( $newPostID, '_wpc_free_shipping', 'on' );
						}
					}
					/* ---- End Of  --- #Define Free Shipping Option --- */
					$newDeals += 1;
				}
				else {
					$errorArray = array(
						'Code' => $newPostID->get_error_code(),
						'Message' => $newPostID->get_error_message(),
						'CouponID' => $couponID
					);
					array_push($mainErrorsArray, $errorArray);
				}
			}
		}
		
		$dealErrorCount = count($mainErrorsArray);
		
		$apiResponse = array(
			'Added Deals' => $newDeals,
			'Existed Deals' => $existedDeals,
			'Errors' => $dealErrorCount
		);
		
		$logResStatus = 'Success';
		if($dealErrorCount){
			$logResStatus = 'Fail';
			array_push($apiResponse, $mainErrorsArray);
		}

		// Insert data to Log Table
		$logData = array(
			'ApiAct' => 'dealget',
			'ResStatus' => $logResStatus,
			'Added' => $newDeals,
			'Existed' => $existedDeals,
			'Errors' => $dealErrorCount,
			'LogDate' => date("Y-m-d H:i:s")
		);
		$logDataFormat = array(
			'%s',
			'%s',
			'%d',
			'%d',
			'%d',
			'%s'
		);

		if($wpdb->insert($log_table, $logData, $logDataFormat)){
			$apiResponse['Log'] = 'Saved';
		}
		else{
			$apiResponse['Log'] = 'Failed';
		}
		
		return $apiResponse;
	}

}
