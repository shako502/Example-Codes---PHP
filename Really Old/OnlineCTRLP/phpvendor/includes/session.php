<?php
   include('connection.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select saxeli from usrs where saxeli = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['saxeli'];
	
	$role_select = mysqli_query($db, "select * from usrs where saxeli = '$user_check' ");
	$role_select_row = mysqli_fetch_array($role_select, MYSQL_ASSOC);

	$role = $role_select_row['role'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:../index.html?redirected=true");
   }
?>