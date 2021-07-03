<!-- MENU TEMPLATE FOR ALL PAGES -->
 <?php   
	$pagename = basename($_SERVER['PHP_SELF'],'.php');
	
	$indexclass = '';
	$calculatorclass ='';
	$savedcalcsclass = '';
	$ordersclass = '';
	$offersclass = '';
	switch($pagename) {
		case 'index':
			$indexclass='activelink';
			break;
		case 'savedcalcs':
			$savedcalcsclass = 'activelink';
			break;
		case 'calc':
			$calculatorclass = 'activelink';
			break;
		case 'orders':
			$ordersclass = 'activelink';
			break;
		case 'offers':
			$offersclass = 'activelink';
			break;
	}

function currentUrlforSideMenu($server){
    //Figure out whether we are using http or https.
    $http = 'http';
    //If HTTPS is present in our $_SERVER array, the URL should
    //start with https:// instead of http://
    if(isset($server['HTTPS'])){
        $http = 'https';
    }
    //Get the HTTP_HOST.
    $host = $server['HTTP_HOST'];
	
	return $http . '://' . htmlentities($host);
}

$basesidemenu = currentUrlforSideMenu($_SERVER);
	
?>  
<div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand <?php echo $indexclass ?>" id="index">
                    <a href="<?php echo $basesidemenu; ?>/loggedusr/index.php">
                        მთავარი
                    </a>
                </li>
                <li id="calc" class="<?php echo $calculatorclass ?>">
                    <a href="<?php echo $basesidemenu; ?>/loggedusr/calc.php">კალკულატორი</a>
                </li>
				<li id="savedcalcs" class="<?php echo $savedcalcsclass ?>">
                    <a href="<?php echo $basesidemenu; ?>/loggedusr/savedcalcs.php">შენახულები</a>
                </li>
                <li id="orders" class="<?php echo $ordersclass ?>">
                    <a href="#">შეკვეთები</a>
                </li>
                <li id="offers" class="<?php echo $offersclass ?>">
                    <a href="#">შეთავაზებები</a>
                </li>
            </ul>
        </div>