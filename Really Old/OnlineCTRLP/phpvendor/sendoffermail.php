<?php
header("Access-Control-Allow-Origin: *"); //Access From Any URL
header("Content-Type: application/json; charset=UTF-8"); // JSON TYPE PAGE

include('PHPMailer.php');
include('Exception.php');
include('SMTP.php');
require('includes/conn.php');
include_once('includes/products.php');

$MailPostObj = $_POST['Mail'];
//$company = $_POST['companyname'];
$destaddress = $MailPostObj['MainMail'];
$copymail = $MailPostObj['CopyMail'];
$mailtext = $MailPostObj['MailText'];
$filename = $MailPostObj['FileName'];
$invoicenum = $MailPostObj['InvoiceNumber'];
$filelocation = '../Invoices/' . $filename;

$dateForName = date('d-m-Y');

$email = new PHPMailer\PHPMailer\PHPMailer;
$email->CharSet = 'UTF-8';
$email->Encoding = 'base64';
try {
	$email->isSMTP();                                      // Set mailer to use SMTP
	$email->Host = 'mail.onlinectrlp.ge';  // Specify main and backup SMTP servers
	$email->SMTPAuth = true;                               // Enable SMTP authentication
	$email->Username = 'offers@onlinectrlp.ge';                 // SMTP username
	$email->Password = 'FirstFloor1412';                           // SMTP password
	$email->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$email->Port = 465;             

	$email->From      = 'offers@onlinectrlp.ge';
	$email->FromName  = 'CTRL-P Offers System';
	$email->Subject   = 'CTRL-P - შეთავაზება #' . $invoicenum;
	$email->Body      = $mailtext;
	$email->AddAddress( $destaddress );
	if(!empty($copymail)){
		$email->AddAddress( $copymail );	
	}
	$email->addReplyTo('offers@onlinectrlp.ge', 'CTRL-P Offers');
	$email->addCC('karazani@gmx.at');

	$email->AddAttachment($filelocation, 'CTRLP-OFFER-' . $dateForName . '.pdf');
	$email->isHTML(true);

	
	// ------------- Update And Save Info In base --------- //
	
	//Initialize DATABASE class
	$database = new Database();
	$db = $database->ConnectServer();

	//Initialize Objects
	$orders = new Orders($db);
	$orders->baseObject = $MailPostObj;
	
	if($orders->SaveAfterSend() === 'OK'){
		
		$email->Send();
		
		echo json_encode(array(
			"Code" => 250,
			"Message" => 'მეილი წარმატებით გაიგზავნა, ბაზა განახლებულია'
		));	
	}
	else {
		echo json_encode(array(
			"Code" => 255,
			"Message" => 'ბაზის განახლება ვერ ხერხდება, მეილი არ გაიგზავნა',
			"Error" => $orders->SaveAfterSend()
		));
	}
}
catch (Exception $e) {
	echo json_encode(array(
		"Code" => 404,
		"Message" => 'მეილი არ გაიგზავნა',
		"Error" => $email->ErrorInfo
	));
}

?>