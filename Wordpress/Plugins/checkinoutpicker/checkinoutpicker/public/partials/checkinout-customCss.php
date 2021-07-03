<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

header('Content-type: text/css');

if(!is_null($customCSS = get_option('checkinoutpicker_customCSS', null)) && $customCSS !== ''){
    echo $customCSS;
}
else {
    echo '';
}

?>