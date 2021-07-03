<?php

include('session.php');


//POST ALL VALUES
$tirage = $_POST['tirage-last'];
$paperweight = $_POST['paperweight-last'];
$fullweight = $_POST['fullweight-last'];
$papersizechoice = $_POST['papersizechoice-last'];
$insidepages = $_POST['insidepages-last'];
$cover = $_POST['cover-last'];
$printform = $_POST['printform-last'];
$paperprice = $_POST['paperprice-last'];
$folding = $_POST['folding-last'];
$stitch = $_POST['stitch-last'];
$formatcut = $_POST['formatcut-last'];
$a3quantity = $_POST['a3quantity'];
$otherfees = $_POST['otherfees-last'];
$fullprice = $_POST['fullprice'];


//Generate offernumber
$count = 0;
$random_digit = '';
$maxdigit = 7;
while ( $count < $maxdigit ) {
    $random_digit = mt_rand(0, 9);
    
    $random_digit .= $random_digit;
    $count++;
}

$random = (int)$random_digit;

$offernumbersql = mysqli_query($db,"SELECT offernumber FROM offers");
$offernumberrow = mysqli_fetch_array($offernumbersql,MYSQLI_ASSOC);
$offernumberinbase = $offernumberrow['offernumber'];

if($offernumberinbase === $random) {
	$count = 0;
	$random_digit = '';
	$maxdigit = 7;
	while ( $count < $maxdigit ) {
		$random_digit = mt_rand(0, 9);

		$random_digit .= $random_digit;
		$count++;
	}
	$random = (int)$random_digit;
}




// insert INTO DATABASE
$insert = $db->prepare("INSERT INTO offers (offernumber, offername, tirage, paperweight, fullweight, papersizechoice, insidepages, cover, printform, paperprice, folding, stitch, formatcut, a3quantity, otherfees, fullprice, offermail) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$insert->bind_param("isiidsiiidisiiids", $random, $offername, $tirage, $paperweight, $fullweight, $papersizechoice, $insidepages, $cover, $printform, $paperprice, $folding, $stitch, $formatcut, $a3quantity, $otherfees, $fullprice, $offermail);
$insert->execute();
$insert->close();

?>