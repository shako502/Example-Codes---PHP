<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://beon.ge
 * @since      1.0.0
 *
 * @package    Fmtc_Api
 * @subpackage Fmtc_Api/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !current_user_can( 'manage_options' ) ) {
	return;
}

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class fmtc_api_logs_table extends WP_List_Table {

    function __construct(){
        parent::__construct( array(
            'ajax' => false
        ) );
    }
    
    function get_columns(){
        $columns = array(
            'ApiAct' => 'API Action',
            'ResStatus' => 'Status',
            'Added' => 'Added',
            'Existed' => 'Existed',
            'Errors' => 'Errors',
            'LogDate' => 'Date'
        );
        
        return $columns;
    }

    function column_ApiAct($item){
        $text = '';
        $itemValue = $item['ApiAct'];
        switch($itemValue){
            case 'catget':
                $text = 'Get Categories API Call';
                break;
            case 'dealget':
                $text = 'Get Deals API Call';
                break;
            case 'storeget':
                $text = 'Get Stores API Call';
                break;
            default:
                $text = 'N/A';
        }
        return $text;
    }

    function column_default( $item, $column_name ) {
        switch( $column_name ) { 
            case 'ApiAct':
            case 'ResStatus':
            case 'Added':
            case 'Existed':
            case 'Errors':
            case 'LogDate':
                return $item[ $column_name ];
            default:
                return print_r( $item, true ) ;
        }
    }
    
    protected function get_views() { 
        $views = array();
         $current = ( !empty($_REQUEST['customvar']) ? $_REQUEST['customvar'] : 'all');
   
         //All link
         $class = ($current == 'all' ? ' class="current"' :'');
         $all_url = remove_query_arg('customvar');
         $views['all'] = "<a href='{$all_url }' {$class} >All</a>";
   
         //Success link
         $success_url = add_query_arg('customvar','Success');
         $class = ($current == 'Success' ? ' class="current"' :'');
         $views['Success'] = "<a href='{$success_url}' {$class} >Success</a>";
   
         //Failed
         $fail_url = add_query_arg('customvar','Fail');
         $class = ($current == 'Fail' ? ' class="current"' :'');
         $views['Fail'] = "<a href='{$fail_url}' {$class} >Failed</a>";
   
         return $views;
    }

    function usort_reorder( $a, $b ) {
        // If no sort, default to title
        $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'LogDate';
        // If no order, default to asc
        $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'desc';
        // Determine sort order
        $result = strcmp( $a[$orderby], $b[$orderby] );
        // Send final sort direction to usort
        return ( $order === 'asc' ) ? $result : -$result;
    
    }

    function get_sortable_columns() {
		$sortable_columns = array(
            'LogDate'  => array('LogDate',false),
            'ResStatus' => array('ResStatus', false)
        );
        
		return $sortable_columns;
	}

    /**
	 * Prepare admin view
	 */	
	function prepare_items() {
        global $wpdb;
        $table_name = $wpdb->prefix . "fmtcapi_log";
 
		$per_page = 25;
		$current_page = $this->get_pagenum();
		if ( 1 < $current_page ) {
			$offset = $per_page * ( $current_page - 1 );
        }
        else {
			$offset = 0;
		}
		
		$search = '';
		//Retrieve $customvar for use in query to get items.
		$customvar = ( isset($_REQUEST['customvar']) ? $_REQUEST['customvar'] : '');
		if($customvar != '') {
			$search_custom_vars= "AND ResStatus LIKE '%" . esc_sql( $wpdb->esc_like( $customvar ) ) . "%'";
        } 
        else{
			$search_custom_vars = '';
		}		
		
		$items = $wpdb->get_results( "SELECT id,ApiAct,ResStatus,Added,Existed,Errors,LogDate FROM ".$table_name." WHERE 1=1 {$search} {$search_custom_vars}" . $wpdb->prepare( "ORDER BY id DESC LIMIT %d OFFSET %d;", $per_page, $offset ),ARRAY_A);
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);	
		usort( $items, array( &$this, 'usort_reorder' ) );
		$count = $wpdb->get_var( "SELECT COUNT(id) FROM ".$table_name." WHERE 1 = 1 {$search} {$search_custom_vars}" );
 
		$this->items = $items;
 
		// Set the pagination
		$this->set_pagination_args( array(
			'total_items' => $count,
			'per_page'    => $per_page,
			'total_pages' => ceil( $count / $per_page )
		) );
	}
}

$logsTable = new fmtc_api_logs_table();
?>
<style>
.loader_slh {
    display: none;
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('<?php echo esc_url( plugins_url('67.gif', __FILE__)); ?>') 50% 50% no-repeat rgb(249,249,249);
    /*text-indent:-9999px;*/
}
</style>
<div class="loader_slh">loading</div>

<!-- Modal -->
<div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="responseModalTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="responseContent"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form action="options.php" method="post">
		<?php
			settings_fields( 'fmtc-api-key-group' );
		?>
        <table>
            <tr valign="top">
                <th scope="row">
                    <label for="fmtcapi_api-key">Enter Your FMTC API Key</label>
                </th>
                <td>
                    <input type="text" id="fmtcapi_api-key" name="fmtcapi_api-key" value="<?php echo get_option('fmtcapi_api-key'); ?>" />
                </td>
            </tr>
        </table>
        <?php 
            submit_button( 'Save Settings' );
        ?>
	</form>
    <h3>API CALL LOG INFO</h3>
<?php
    $logsTable->prepare_items();
    $logsTable->views();
    $logsTable->display();
?>
    <h3>Call API</h3>
    <button id="getStoresAPI" data-url="getMerchants" class="button-primary callApi">GET Stores</button>
    <button id="getCatsAPI" data-url="getCategories" class="button-primary callApi">GET Categories</button>
    <button id="getDealsAPI" data-url="getDeals" class="button-primary callApi">GET Deals</button>

    <div class="row">
        <div class="col-lg-12">
            <h3 align="center">Statistics</h3>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-3">
            <div class="form-group">
                <label for="statDateSel">Select Date Range: </label>
                <select class="form-control" id="statDateSel">
                    <option value="1">Today</option>
                    <option value="7">Last Week</option>
                    <option value="30">Last Month</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="w-50">
                <canvas id="statPie"></canvas>
            </div>
        </div>
    </div>
</div>
