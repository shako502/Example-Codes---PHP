<?php
include('includes/session.php');

date_default_timezone_set('Asia/Tbilisi');

$errors = array();
$data = array();

if(empty($_POST['note'])){
	$errors['note'] = 'გთხოვთ შეიყვანოთ ტექსტი შენახვამდე';
}




if( !empty($errors)){
	
	
	$data['success'] = false;
	$data['errors'] = $errors;
	
	
} 
else {
	$maintext = $_POST['note'];
	$orderid = $_POST['orderid'];
	$date = date("Y-m-d/H:i:s");
	$insertnotes = $db->prepare("INSERT INTO savednotes (maintext, useradded, orderid, date) VALUES (?, ?, ?, ?)");
	$insertnotes->bind_param('ssis', $maintext, $login_session, $orderid, $date );
	$insertnotes->execute();
	if($insertnotes->errno) {
					$data['message'] = 'error base';
					$insertnotes->close();
				}
	else{
		$insertnotes->close();
		$data['success'] = true;
		$data['message'] = "მონაცემები შენახულია წარმატებით!";
	}
}

echo json_encode($data);



?>