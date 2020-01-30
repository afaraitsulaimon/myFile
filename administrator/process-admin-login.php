<?php

   if (isset($_POST['loginAdmin'])) {
   	
   	   $adminLogErr = array();

   	   $theUserAdmin = sanitize($_POST['admin-user']);

   	   $theUserPass = sanitize($_POST['admin-pass']);


   	   //check for error

   	   if (empty($theUserAdmin)) {
   	   	
   	   	$adminLogErr[] = "Enter Username";
   	   }


   	   if (empty($theUserPass)) {
   	   	
   	   	$adminLogErr[] = "Enter Password";
   	   }

      
      //check if the password and username entered
   	   //is not the same as the one in the database

   	   $adminDetails = "SELECT * FROM administrators";

   	   

   	   $queryAdmin = mysqli_query($connection, $adminDetails);

   	   

   	   if (!$queryAdmin) {
   	   	
   	   	die("could not query QUERYADMIN" .mysqli_error($connection));
   	   }


   	   $fetchAdmin = mysqli_fetch_assoc($queryAdmin);



   	   $fetchAdminUser = $fetchAdmin['administrator_username'];
   	   $fetchAdminPass = $fetchAdmin['administrator_password'];

   	   

   	   if ($fetchAdminUser !== $theUserAdmin && $fetchAdminUser !== $theUserPass) {
   	   	

   	   	$adminLogErr[] = "Incorrect Username or Password";

   	   }


   	   if (empty($adminLogErr)) {
   	   	
   	   	   $loginAdminDet = "SELECT * FROM administrators WHERE administrator_username = '$theUserAdmin' AND administrator_password = '$theUserPass' ";


   	   	   $queryLoginAdminDet = mysqli_query($connection, $loginAdminDet);





   	   	   if (!$queryLoginAdminDet) {
   	   	   	   die("could not query QUERYLOGINADMINDET" .mysqli_error($connection));
   	   	   }


          $rows = mysqli_num_rows($queryLoginAdminDet);




          if ($rows = 1) {
          	
          	$fetchLoginAdminDet = mysqli_fetch_assoc($queryLoginAdminDet);

          	$_SESSION['adminId'] = $fetchLoginAdminDet['administrator_id'];

            

          	header("Location:administrator-dashboard.php");
          	exit();
          }

   	   }else{

          $adminLogErrorMess = "<ul>";

          foreach ($adminLogErr as $adminLogErrors) {
          	
          	$adminLogErrorMess .= "<li>$adminLogErrors</li>";
          }

          $adminLogErrorMess .= "<ul>";

   	   }



   }
?>