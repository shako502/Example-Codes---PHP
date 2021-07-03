<?php
include('includes/session.php');

date_default_timezone_set('Asia/Tbilisi');

$username = $_POST['newusername'];
$pass = $_POST['newpassword'];
$role = $_POST['role'];

if($getusers = $db -> prepare("SELECT * FROM usrs WHERE saxeli=?")) {
	$getusers ->bind_param('s', $username);
	$getusers ->execute();
	$result = $getusers ->get_result();
		if($result ->num_rows != 1){
				$getusers->free_result();
				$getusers->close();
			
			
				$hashpass = password_hash($pass, PASSWORD_DEFAULT);

				$addedby = $login_session;
				$date = date("Y-m-d");

				$insert = $db->prepare("INSERT INTO usrs (saxeli, paroli, role, addedby, date) VALUE (?, ?, ?, ?, ?)");
				$insert->bind_param("sssss", $username, $hashpass, $role, $addedby, $date);
				$insert->execute();
				if($insert->errno) {
					printf("Error: %s.\n", $insert->error);
					$insert->close();
				}
				else{
				$insert->close();
					header('Location: ../loggedusr/index.php?user=added');
				}
			}
		else{
			header('Location: ../loggedusr/index.php?user=double');
		}
	
}

$db ->close();
?>