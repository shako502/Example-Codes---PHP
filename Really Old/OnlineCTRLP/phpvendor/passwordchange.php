<?php 
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
   exit;
 }

include('../phpvendor/includes/session.php');

$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];
$passcheck = $_POST['retypenewpass'];
$url = $_POST['url'];
$makenewhash = password_hash($newpass, PASSWORD_DEFAULT);

// GET PASS FROM SERVER
if($getpass = $db -> prepare("SELECT * FROM usrs WHERE saxeli=?")){
	$getpass->bind_param('s', $login_session);
	$getpass->execute();
	$result = $getpass->get_result();
	
	if($result ->num_rows != 1){
			die('Undefined User');
		}
	else {
		while ($row = $result->fetch_assoc()) {
			$serverpass = $row['paroli'];
			if(password_verify($oldpass, $serverpass)){
				
				$insertpass = $db->prepare('UPDATE usrs SET paroli=? WHERE saxeli=?');
				$insertpass -> bind_param('ss', $makenewhash, $login_session );
				$insertpass -> execute();
				if($insertpass -> errno){
					printf("Error: %s.\n", $insert->error);
					$insertpass->close();
				}
				else {
					$getpass->free_result();
					$getpass->close();
					$insertpass->close();

					session_unset();
					session_destroy();
					
					header('Location: ../index.html?password=changed');
				}
				
				
			}
			else {
				$getpass->free_result();
				$getpass->close();
				header('Location:'. $url .'?password=oldnotmatch');
			}
		}
	}
}

$db->close();

if($newpass !== $passcheck) {
	header('Location:'. $url .'?password=notmatch');
}


?>