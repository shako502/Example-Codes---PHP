<?php
header("Access-Control-Allow-Origin: *"); //Access From Any URL
header("Content-Type: application/json; charset=UTF-8"); // JSON TYPE PAGE

require('includes/conn.php');
include_once('includes/products.php');

//Initialize DATABASE class
$database = new Database();
$db = $database->ConnectServer();

//Initialize Objects
$orders = new Orders($db);

//Get Posted OBJECT
$baseObject = $_POST['BasePost'];

$orders->baseObject = $baseObject;

if($orders->SaveOrder() === 'OK'){
	echo json_encode(array(
				"Code" => 200,
				"Message" => "მონაცემები შენახულია"
	));
}
else{
	echo json_encode(array(
				"Code" => 404,
				"Message" => "ბაზის შეცდომა",
				"Error" => $orders->SaveOrder()
	));
}


?>