<?php
include('includes/session.php');

$id = $_GET['id'];

if($getproduct = $db -> prepare("SELECT * FROM saved WHERE id=?")){
	
	$getproduct->bind_param('i', $id);
	$getproduct->execute();
	$result = $getproduct->get_result();
	
	if($result->num_rows != 1) {
		die('Product Fetch Error');
	}
	else {
		header('Content-type: application/json');
		echo json_encode($result->fetch_all(MYSQLI_ASSOC), JSON_UNESCAPED_UNICODE);
	}
	
}


?>