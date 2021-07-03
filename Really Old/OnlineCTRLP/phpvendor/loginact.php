<?php

include("includes/connection.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      if($getusers = $db -> prepare("SELECT * FROM usrs WHERE saxeli=?")) {
		  
		  
      $myusername = mysqli_real_escape_string($db,$_POST['saxeli']);
      $mypassword = mysqli_real_escape_string($db,$_POST['paroli']); 
	  
		$getusers ->bind_param('s', $myusername);
		$getusers ->execute();
		$result = $getusers ->get_result();
		if($result ->num_rows!= 1){
			header("location: ../index.html?falseuser=true");
		}
		else {
			while ($row = $result->fetch_assoc()) {
				$hashedpass = $row['paroli'];
				if(password_verify($mypassword, $hashedpass)){
					$_SESSION['login_user'] = $myusername;
					header("location: ../loggedusr/index.php");
				}
				else{
					session_destroy();
					header("location: ../index.html?falseuser=true");
				}
				
		   }
		}
		  
		  $getusers->free_result();
		  $getusers ->close();
	  }
	   
	   $db->close();

   }
?>