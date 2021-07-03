<?php

include('includes/session.php');
include('includes/connection.php');

//POST ALL VALUES
$tirage = $_POST['tirage-last']; //1 
$mainpaperquantity = $_POST['mainpaperquantity-last']; //2 
$paperweight = $_POST['paperweight-last']; //3
$a3quantity = $_POST['a3quantity']; //4
$papersizechoice = $_POST['papersizechoice-last']; //5
$insidepages = $_POST['insidepages-last']; //6
$cover = $_POST['cover-last']; //7
$printform = $_POST['printform-last']; //8
$paperprice = $_POST['paperprice-last']; //9
$folding = $_POST['folding-last']; //10
$stitch = $_POST['stitch-last']; //11
$formatcut = $_POST['formatcut-last']; //12
$otherfees = $_POST['otherfees-last']; //13
$insidea3q = $_POST['insidea3q-last']; //14
$covera3q = $_POST['covera3q-last']; //15
$fullweight = $_POST['fullweight-last']; //16
$printimeprice = $_POST['printime-last']; //17
$foldprice = $_POST['foldprice-last']; //18
$stitchprice = $_POST['kindzva-last']; //19
$pricewithoutfee = $_POST['pricewithoutfee']; //20
$fullprice = $_POST['fullprice']; //21
$name = $_POST['savename']; //22
$productname = $_POST['productname']; //23
$orderstatus = $_POST['orderstatus']; //24
$filepath = $_POST['filepath']; //25



// insert INTO DATABASE
$insert = $db->prepare("INSERT INTO saved (name, tirage, mainpaperquantity, paperweight, a3quantity, papersizechoice, insidepages, cover, printform, paperprice, folding, stitch, formatcut, otherfees, insidea3q, covera3q, fullweight, printimeprice, foldprice, stitchprice, pricewithoutfee, fullprice, productname, orderstatus, filepath) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$insert->bind_param("siidisiisdisidiididdddsss", $name, $tirage, $mainpaperquantity, $paperweight, $a3quantity, $papersizechoice, $insidepages, $cover, $printform, $paperprice, $folding, $stitch, $formatcut, $otherfees, $insidea3q, $covera3q, $fullweight, $printimeprice, $foldprice, $stitchprice, $pricewithoutfee, $fullprice, $productname, $orderstatus, $filepath);
$insert->execute();
if($insert->errno) {
	printf("Error: %s.\n", $insert->error);
	$insert->close();
}
else{
$insert->close();
	if($filepath === '0') {
		header('Location: ../loggedusr/calc.php?data=saved');
	}
	else {
		header('Location: ../loggedusr/calc.php?data=offered');
	}
}
?>