<?php
include('includes/session.php');

$orderid = $_GET['orderid'];
$fetched = array();

$getnotes = $db->prepare("SELECT * FROM savednotes WHERE orderid=?");
$getnotes->bind_param('i', $orderid);
$getnotes->execute();

$getnotesresult = $getnotes->get_result();

if($getnotesresult->num_rows < 1){
	$fetched['success'] = false;
	$fetched['message'] = 'ჩანაწერები არ მოიძებნა!';
}
else {
	$fetched = $getnotesresult->fetch_all(MYSQLI_ASSOC);
}

header('Content-type: application/json');
echo json_encode($fetched, JSON_UNESCAPED_UNICODE);


?>