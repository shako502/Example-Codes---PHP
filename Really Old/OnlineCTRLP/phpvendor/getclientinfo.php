<?php

include('includes/session.php');

$id = $_GET['orderid'];


if($getproduct = $db -> prepare("SELECT * FROM saved WHERE id=?")){
	
	$getproduct->bind_param('i', $id);
	$getproduct->execute();
	$result = $getproduct->get_result();
	
	if($result->num_rows != 1) {
		die('Product Fetch Error');
	}
	else {
		while ($row = $result->fetch_assoc()) {
			$clientvalue = $row['name'];
			
		}
	}
	
	
	
}

if($getclient = $db -> prepare("SELECT * FROM company WHERE value=?")){
	$getclient->bind_param('s', $clientvalue);
	$getclient->execute();
	$clientresult = $getclient->get_result();
	
	if($clientresult->num_rows != 1){
		die('Client Fetch Error');
	}
	else {
		header('Content-type: application/json');
		echo json_encode($clientresult->fetch_all(MYSQLI_ASSOC), JSON_UNESCAPED_UNICODE);
	}
}

?>