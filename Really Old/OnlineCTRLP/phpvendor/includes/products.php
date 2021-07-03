<?php

class Orders {
	private $conn;
	private $tablename = 'MainOrders';
	private $metatable = 'Meta';
	
	public $LastInvoiceNumber;
	public $baseObject;
	public $orderStatus;

	
	public function __construct($db){
		$this->conn = $db;
	}
	
	
	function SaveOrder(){
		
		$query = "INSERT INTO " . $this->tablename . " (InvoiceNumber, Tirage, MainPaperSize, ProductFormat, InPagesWeight, InPagesQuantity, InPagesForms, CovPagesWeight, CovPagesQuantity, CovPagesForms, PagesPercent, PaperPrice, Folding, Stitch, FormatCut, OtherFee, PricePercent, CalcComment, AfterMainPaperQ, AfterAQuantity, AfterInPagesAQuantity, AfterCovAQuantity, AfterFullWeight, AfterCovWeight, AfterInPagesWeight, AfterFullFormPrice, AfterCovFormPrice, AfterInPagesFormPrice, AfterInPagesPrintTime, AfterCovPrintTime, AfterFoldPrice, AfterStitchPrice, AfterFormatCutPrice, AfterFullPrice, AfterFullPricePercent, FileName) VALUES (:InvoiceNumber, :Tirage, :MainPaperSize, :ProductFormat, :InPagesWeight, :InPagesQuantity, :InPagesForms, :CovPagesWeight, :CovPagesQuantity, :CovPagesForms, :PagesPercent, :PaperPrice, :Folding, :Stitch, :FormatCut, :OtherFee, :PricePercent, :CalcComment, :AfterMainPaperQ, :AfterAQuantity, :AfterInPagesAQuantity, :AfterCovAQuantity, :AfterFullWeight, :AfterCovWeight, :AfterInPagesWeight, :AfterFullFormPrice, :AfterCovFormPrice, :AfterInPagesFormPrice, :AfterInPagesPrintTime, :AfterCovPrintTime, :AfterFoldPrice, :AfterStitchPrice, :AfterFormatCutPrice, :AfterFullPrice, :AfterFullPricePercent, :FileName);
		INSERT INTO " . $this->metatable . " (Status, Date, ExpectDate, User, InvoiceNumber) VALUES (:Status, :Date, :ExpectDate, :User, :InvoiceNumber)";
		
		
		try{
			$stmt = $this->conn->prepare($query);
		}
		catch(PDOException $exception){
			return $exception->getMessage();
		}
		
		//Get Date; ExpectDate
		$nowDate = date('Y-m-d H:i:s');
		if(empty($this->baseObject['ExpectDate'])){
			$ExpectDate = NULL;
		}
		else {
			$ExpectDate = $this->baseObject['ExpectDate'];
		}
		
		//Bind First Query Params
		$stmt->bindParam(':InvoiceNumber', $this->baseObject['InvoiceNum'] );
		$stmt->bindParam(':Tirage', $this->baseObject['Quantity'] );
		$stmt->bindParam(':MainPaperSize', $this->baseObject['MainPaperSize'] );
		$stmt->bindParam(':ProductFormat', $this->baseObject['ProductFormat'] );
		$stmt->bindParam(':InPagesWeight', $this->baseObject['InPagesWeight'] );
		$stmt->bindParam(':InPagesQuantity', $this->baseObject['InPagesQuantity'] );
		$stmt->bindParam(':InPagesForms', $this->baseObject['InPagesForms'] );
		$stmt->bindParam(':CovPagesWeight', $this->baseObject['CovPagesWeight'] );
		$stmt->bindParam(':CovPagesQuantity', $this->baseObject['CovPagesQuantity'] );
		$stmt->bindParam(':CovPagesForms', $this->baseObject['CovPagesForms'] );
		$stmt->bindParam(':PagesPercent', $this->baseObject['PagesPercent'] );
		$stmt->bindParam(':PaperPrice', $this->baseObject['PaperPrice'] );
		$stmt->bindParam(':Folding', $this->baseObject['Folding'] );
		$stmt->bindParam(':Stitch', $this->baseObject['Stitch'] );
		$stmt->bindParam(':FormatCut', $this->baseObject['FormatCut'] );
		$stmt->bindParam(':OtherFee', $this->baseObject['OtherFee'] );
		$stmt->bindParam(':PricePercent', $this->baseObject['PricePercent'] );
		$stmt->bindParam(':CalcComment', $this->baseObject['CalcComment'] );
		$stmt->bindParam(':AfterMainPaperQ', $this->baseObject['AfterMainPaperQ'] );
		$stmt->bindParam(':AfterAQuantity', $this->baseObject['AfterAQuantity'] );
		$stmt->bindParam(':AfterInPagesAQuantity', $this->baseObject['AfterInPagesAQuantity'] );
		$stmt->bindParam(':AfterCovAQuantity', $this->baseObject['AfterCovAQuantity'] );
		$stmt->bindParam(':AfterFullWeight', $this->baseObject['AfterFullWeight'] );
		$stmt->bindParam(':AfterCovWeight', $this->baseObject['AfterCovWeight'] );
		$stmt->bindParam(':AfterInPagesWeight', $this->baseObject['AfterInPagesWeight'] );
		$stmt->bindParam(':AfterFullFormPrice', $this->baseObject['AfterFullFormPrice'] );
		$stmt->bindParam(':AfterCovFormPrice', $this->baseObject['AfterCovFormPrice'] );
		$stmt->bindParam(':AfterInPagesFormPrice', $this->baseObject['AfterInPagesFormPrice'] );
		$stmt->bindParam(':AfterInPagesPrintTime', $this->baseObject['AfterInPagesPrintTime'] );
		$stmt->bindParam(':AfterCovPrintTime', $this->baseObject['AfterCovPrintTime'] );
		$stmt->bindParam(':AfterFoldPrice', $this->baseObject['AfterFoldPrice'] );
		$stmt->bindParam(':AfterStitchPrice', $this->baseObject['AfterStitchPrice'] );
		$stmt->bindParam(':AfterFormatCutPrice', $this->baseObject['AfterFormatCutPrice'] );
		$stmt->bindParam(':AfterFullPrice', $this->baseObject['AfterFullPrice'] );
		$stmt->bindParam(':AfterFullPricePercent', $this->baseObject['AfterFullPricePercent'] );
		$stmt->bindParam(':FileName', $this->baseObject['FileName'] );
		
		//Bind Second Query Params
		$stmt->bindParam(':Status', $this->baseObject['Status'] );
		$stmt->bindParam(':Date', $nowDate );
		$stmt->bindParam(':ExpectDate', $ExpectDate);
		$stmt->bindParam(':User', $this->baseObject['User']);
		$stmt->bindParam(':InvoiceNumber', $this->baseObject['InvoiceNum']);
		
		
		if($stmt->execute()){
			return 'OK';
		}
		else{
			return $stmt->errorInfo();
		}
		
	}
	
	function SaveAfterSend(){
		
		$query = "UPDATE " . $this->metatable . " SET Status = :Status, ProductName = :ProductName, ProductReceiver = :ProductReceiver, ReceiverID = :ReceiverID, ReceiverAddress = :ReceiverAddress, SentQuantity = :SentQuantity, SentPrice = :SentPrice, PriceVerbal = :PriceVerbal, ReceiverMainMail = :ReceiverMainMail, ReceiverCopyMail = :ReceiverCopyMail, MailText = :MailText WHERE InvoiceNumber = :InvoiceNumber";
		
		try{
			$stmt = $this->conn->prepare($query);
		}
		catch(PDOException $exception){
			return $exception->getMessage();
		}
		
		if(empty($this->baseObject['CopyMail'])){
			$CopyMail = NULL;
		}
		else {
			$CopyMail = $this->baseObject['CopyMail'];
		}
		
		$stmt->bindParam(':Status', $this->baseObject['Status']);
		$stmt->bindParam(':ProductName', $this->baseObject['ProductName']);
		$stmt->bindParam(':ProductReceiver', $this->baseObject['ReceiverName']);
		$stmt->bindParam(':ReceiverID', $this->baseObject['ReceiverSK']);
		$stmt->bindParam(':ReceiverAddress', $this->baseObject['ReceiverAddress']);
		$stmt->bindParam(':SentQuantity', $this->baseObject['OfferQuantity']);
		$stmt->bindParam(':SentPrice', $this->baseObject['OfferPrice']);
		$stmt->bindParam(':PriceVerbal', $this->baseObject['PriceVerb']);
		$stmt->bindParam(':ReceiverMainMail', $this->baseObject['MainMail']);
		$stmt->bindParam(':ReceiverCopyMail', $CopyMail);
		$stmt->bindParam(':MailText', strip_tags($this->baseObject['MailText']));
		$stmt->bindParam(':InvoiceNumber', $this->baseObject['InvoiceNumber']);
		
		if($stmt->execute()){
			return 'OK';
		}
		else{
			return $stmt->errorInfo();
		}
		
	}
	
	
	function GetLastInvoiceNum(){
		$query = "SELECT InvoiceNumber FROM ". $this->tablename . " ORDER BY ID DESC LIMIT 1";
		
		try{ //Check Prepare For Errors
			$stmt = $this->conn->prepare($query);
		}
		catch(PDOException $exception){
			$message = $exception->getMessage();
			$code = $exception->getCode();
			$errfile = $exception->getFile();
			$line = $exception->getLine();
			$txt = 'Message : ' . $message . ' \r\n Code: ' . $code . ' \r\n ErrorFile: ' . $errfile . ' \r\n Line: ' . $line; 
			file_put_contents('ErrorLog.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
			return 'Database Error. See Logs!'; // Return PDO Error if there is any
		}
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if(!$row) {
			return 'NData';
		}
		
		else {
			$this->LastInvoiceNumber = $row['InvoiceNumber'];
			
			return 'OK';
		}
	}
	
	
	public function GetOffers(){
		$query = "SELECT m.ID, m.Status, m.Date, m.ProductName, m.ProductReceiver, o.Tirage FROM Meta AS m INNER JOIN MainOrders AS o ON m.ID = o.ID";
		
		try {
			$stmt = $this->conn->prepare($query);
		}
		catch(PDOException $exception){
			$message = $exception->getMessage();
			$code = $exception->getCode();
			$errfile = $exception->getFile();
			$line = $exception->getLine();
			$txt = 'Message : ' . $message . ' \r\n Code: ' . $code . ' \r\n ErrorFile: ' . $errfile . ' \r\n Line: ' . $line; 
			file_put_contents('ErrorLog.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
			return 'Database Error. See Logs!'; // Return PDO Error if there is any
		}
		
		$stmt->execute();
		
		return $stmt;
		
	}
	
}

?>