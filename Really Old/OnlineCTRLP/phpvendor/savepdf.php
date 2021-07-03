<?php

$nameext = $_POST['date'];
$company = $_POST['companyname'];
$newname = "CtrlpOffer_" . $company . '_' . $nameext .".pdf"; 

$target = '../offers/'.$newname;
if(move_uploaded_file( $_FILES['savedpdf']['tmp_name'], $target)) {
	echo 'success';
}
else {
	echo 'fail';
}



?>