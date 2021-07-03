<?php

header("Access-Control-Allow-Methods: GET"); //Allow Only Get Method
header("Content-Type: application/json; charset=UTF-8"); // JSON TYPE PAGE

require_once('includes/conn.php'); //Require Database PDO Connection
require_once('includes/products.php'); //Require Employee Class

$database = new Database();
$db = $database->ConnectServer();

$orders = new Orders($db);

$stmt = $orders->GetOffers();

$num = $stmt->rowCount();

if($num > 0 ){
	//Create Orders Array
	$orders_array = [];
	
	//Create Data Array iN Orders
	$orders_array['data'] = [];
	
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$single_array = array(
			"ID" => $row['ID'],
			"Status" => $row['Status'],
			"ProductName" => $row['ProductName'],
			"Date" => $row['Date'],
			"ProductReceiver" => $row['ProductReceiver'],
			"Tirage" => $row['Tirage']
		);
		
		array_push($orders_array['data'], $single_array);
	}
	
	echo json_encode($orders_array);
}

else {
	
	echo json_encode(array(
		"Code" => 404,
		"Message" => 'No Data In Database'
	));
}

?>

