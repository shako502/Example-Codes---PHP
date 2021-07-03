<?php

include('includes/session.php');


$name = $_POST['clientname'];

if(empty($_POST['address'])){
	$address = '-';
}
else {
	$address = $_POST['address'];
}

$contactnumber = $_POST['contactnumber'];

function convert($string) {
	$table = array(
		
		'ქ'=>'q', 'წ'=>'ts', 'ე'=>'e', 'რ'=>'r', 'ტ'=>'t', 'ყ'=>'y', 'უ'=>'u', 'ი'=>'i', 'ო'=>'o', 'პ'=>'p',
		
		'ა'=>'a', 'ს'=>'s', 'დ'=>'d', 'ფ'=>'f', 'გ'=>'g', 'ჰ'=>'h', 'ჯ'=>'j', 'კ'=>'k', 'ლ'=>'l',
		
		'ზ'=>'z', 'ხ'=>'x', 'ც'=>'c', 'ვ'=>'v', 'ბ'=>'b', 'ნ'=>'n', 'მ'=>'m',
		
		'ჭ'=>'ch', 'ღ'=>'gh', 'თ'=>'t', 'შ'=>'sh', 'ჟ'=>'j', 'ძ'=>'dz',' ჩ'=>'ch',
	
	
	);
	
	$string = strtr($string, $table);
	return $string;
	
}

$value = convert($name);


$insert = $db->prepare('INSERT INTO company (name, address, contact, value, useradded) VALUES (?, ?, ?, ?, ?)');
$insert->bind_param('ssiss', $name, $address, $contactnumber, $value, $login_session);
$insert->execute();
if($insert->errno) {
	printf("Error: %s.\n", $insert->error);
	$insert->close();
}
else{
$insert->close();
	header('Location: ../loggedusr/index.php?data=saved');
}

?>