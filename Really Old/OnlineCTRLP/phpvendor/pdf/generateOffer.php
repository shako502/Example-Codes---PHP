<?php

header("Access-Control-Allow-Origin: *"); //Access From Any URL
header("Content-Type: application/json; charset=UTF-8"); // JSON TYPE PAGE

require('fpdf/tfpdf.php');
require('../includes/conn.php');
include_once('../includes/products.php');

$ErrorArray = [];

//Initialize DATABASE class
$database = new Database();
$db = $database->ConnectServer();

//Initialize Objects
$orders = new Orders($db);

//Call Last Invoice Number Get Function
$stmt = $orders->GetLastInvoiceNum();

if($stmt === 'OK'){
	$LastInvoiceNumMessy = $orders->LastInvoiceNumber ;
	$LastInvoiceNum = ltrim($LastInvoiceNumMessy, '0');
	$InvoiceNum = sprintf('%06d', $LastInvoiceNum + 1);
}
else if($stmt === 'NData'){
	$InvoiceNum = '000001';
}
else {
	$ErrorMsg = array(
		"Message" => "DatabaseError",
		"Code" => 444,
		"HumanError" => 'ბაზის შეცდომა. ნახეთ ლოგი'
	);
	
	array_push($ErrorArray, $ErrorMsg);
}

class PDF extends tFPDF {
	// Colored table
	function FancyTable($header, $data)
	{
		// Colors, line width and bold font
		$this->SetFillColor(178, 169, 169);
		$this->SetTextColor(255);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		// Header
		$w = array(90, 35, 40, 25);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i], 15,$header[$i],1,0,'C',true);
		$this->Ln();
		// Color and font restoration
		$this->SetFillColor(234, 234, 234);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = false;
		foreach($data as $row)
		{
			if($row[0] === 'Sum'){
				$this->Cell(165,15,$row[1],'LRT',0,'R',$fill);
				$this->Cell($w[3],15,$row[2],'LRT',0,'C',$fill);
				$this->Ln();
				$fill = !$fill;
			}
			else {
				$this->Cell($w[0],15,$row[0],'LR',0,'C',$fill);
				$this->Cell($w[1],15,$row[1],'LR',0,'C',$fill);
				$this->Cell($w[2],15,$row[2],'LR',0,'C',$fill);
				$this->Cell($w[3],15,$row[3],'LR',0,'C',$fill);
				$this->Ln();
				$fill = !$fill;
			}
		}
		// Closing line
		$this->Cell(array_sum($w),0,'','T', 1);
	}
}

$PostOBJ = $_POST['MainPost'];

$pdf = new PDF();

$pdf->AddPage('P', 'A4');

//$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
//$pdf->AddFont('DejaVu','B','DejaVuSansCondensed-Bold.ttf',true);

$pdf->AddFont('DejaVu','','BpgNinoNormal.ttf',true);
$pdf->AddFont('DejaVu','B','BpgNinoBold.ttf',true);

//Logo
$pdf->Image('logo.png', 10, 10, 69, 30, 'PNG' ); //Insert CTRLP Logo

//Heading
$pdf->SetXY(120, 10); //Set XY For Right Top Text
$pdf->SetFont('DejaVu','B',14); //Set Font For CTRLP Heading
$pdf->SetDrawColor(92, 196, 97); //Set Border Color
$pdf->SetTextColor(156, 140, 131); //Set Text Color For Heading
$pdf->Cell(80, 5, 'შ.პ.ს. "კონტროლ პ"', 'B', 2, 'R' ); //Heading Text

//Address
$pdf->SetTextColor(0, 0, 0); //Set Text Color For Heading
$pdf->SetFont('DejaVu','',12); //Set Font For CTRLP Address
$pdf->Cell(80, 10, 'ქ. თბილისი, წყნეთის გზატ. #39, Tel: 597955501', '', 2, 'R'); //Address text

//Mail
$pdf->Cell(80, 5, 'E-Mail: Info@Ctrlp.ge', '', 2, 'R');

//Site
$pdf->Cell(80, 10, 'CTRLP.GE', 'B', 1, 'R');

//Bank Info And Body Heading
$pdf->Ln(15);

//Body Heading
$pdf->SetFont('DejaVu','B', 24); //Set Font For Heading
//$pdf->SetTextColor(0, 0, 0); //Set Text Color For Heading
$pdf->Cell(110, 10, 'ინვოისი', '', 0, 'L');  //Heading Text

//Banking
$pdf->SetFont('DejaVu','',12); //Set Font For banking info
//$pdf->SetTextColor(156, 140, 131); //Set Text Color For banking

//SK
$pdf->Cell(80, -20, 'ს.კ: 405202212', '', 2, 'R');

//Bank Name
$pdf->Cell(80, 35, 'ს.ს. "თიბისი ბანკის"', '', 2, 'R');

//bank code
$pdf->Cell(80, -20, 'საბანკო კოდი: TBCBGE22', '', 2, 'R');

//Bank Account Number
$pdf->Cell(80, 35, 'ა/ა: GE13TB7375436080100005', '', 1, 'R');

//Head End Line
$pdf->Cell(190,-10, '', 'B', 1, 'L');

//Calculate Some Datas
$SinglePrice = round(floatval($PostOBJ['Price']) / intval($PostOBJ['Quantity']) , 2);
$NowDate = date('m.d.Y');

//Start Body
$pdf->SetFont('DejaVu','',18); //Set Font For Invoice Number
$pdf->Cell(110, 10, '#' . $InvoiceNum, '', 0, 'L'); //Invoice Number Text

$pdf->SetFont('DejaVu','',12); //Set Font For Buyer
$pdf->Cell(80, 7, 'მყიდველი: ' . $PostOBJ['ReceiverName'], '', 2, 'R'); //Buyer Name
$pdf->Cell(80, 5, 'მის.: ' . $PostOBJ['ReceiverAddress'], '', 2, 'R'); //Buyer Address
$pdf->Cell(80, 7, 'ს/კ.: ' . $PostOBJ['ReceiverSK'], '', 1, 'R'); //Buyer Sk

$pdf->Cell(80, 7, 'თარიღი: ' . $NowDate , '', 1, 'L');


//Table header
$header = array('საქონლის დასახელება', 'რაოდენობა', 'ერთეულის ფასი', 'თანხა');
$data = array(
	array(
		$PostOBJ['ProductName'], $PostOBJ['Quantity'], $SinglePrice , $PostOBJ['Price']
	),
	array(
		'Sum', 'თანხა სულ დღგ-ს ჩათვლით:', $PostOBJ['Price']
	)
);

$pdf->FancyTable($header,$data);


$pdf->Cell(190, 10, $PostOBJ['PriceVerb'], '', 1, 'R');

$pdf->SetXY(10, 260);
$pdf->Cell(40, 4, 'შპს "კონტროლ პ"-ს დირექტორი:', '', 2, 'L');
$pdf->Cell(40, 4, 'იოსებ ფეიქრიშვილი', '', 2, 'L');
$pdf->Image('sign.png', 140, 240, 50, 37, 'PNG' );

if(empty($ErrorArray)){
	$pdf->Output('../../Invoices/' . $InvoiceNum . '.pdf', 'F');
	if(file_exists('../../Invoices/' . $InvoiceNum . '.pdf')){
		$returnMsg = array(
			"Message" => 'ფაილი შენახულია',
			"Code" => 201,
			"InvoiceNum" => $InvoiceNum,
			"FileName" => $InvoiceNum . '.pdf'
		);
	}
	else {
		$returnMsg = array(
			"Message" => 'ფაილის შენახვა ვერ მოხერხდა',
			"Code" => 204,
			"HumanError" => 'ფაილის შენახვა ვერ ხერხდება. გთხოვთ გადაამოწმოთ მონაცემების სიზუსტე'
		);
	}
	
	echo json_encode($returnMsg);
}
else {
	echo json_encode($ErrorMsg);
}



?>