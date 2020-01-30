<?php

require_once('../administrator/process-add-store-admin.php');

if (isset($_POST['storeLogin'])) {
	

	$adminStoreLogInErr = array();

	$adminStoreUsername = sanitize($_POST['storeLogUsername']);

  $salt = "ipDaloveyBuohgGTZwzJbanDS8gtoninjaYj48CP";

	$adminStorePassCode = crypt($_POST['storeLogPass'], $salt);

 

 

	//check for errors

	if (empty($adminStoreUsername)) {
		
		$adminStoreLogInErr[] = "Enter your username";
	}


	if (empty($adminStorePassCode)) {
		
		$adminStoreLogInErr[] = "Enter your password";
	}


   $storeLogDet = "SELECT * FROM store_admin WHERE storeAdmin_username = '$adminStoreUsername' AND storeAdmin_code = '$adminStorePassCode' ";

   $queryStoreLogDet = mysqli_query($connection,$storeLogDet);

   if (!$queryStoreLogDet) {
   	
   	  die("could not query QUERYSTORELOGDET ".mysqli_query($connection));
   }

   $fetchStoreLogDet = mysqli_fetch_assoc($queryStoreLogDet);

   $fetchUsername = $fetchStoreLogDet['storeAdmin_username'];
   $fetchPassword = $fetchStoreLogDet['storeAdmin_code'];

   if ($fetchUsername !== $adminStoreUsername && $fetchPassword !== $adminStorePassCode) {
   	
   	   $adminStoreLogInErr[] = "Incorrect Username or Password";
   }



   if (empty($adminStoreLogInErr)) {
   	

   	   $theLogInDetails = "SELECT * FROM store_admin WHERE storeAdmin_username = '$adminStoreUsername' AND storeAdmin_code = '$adminStorePassCode' ";




   	   $queryTheLogInDetails = mysqli_query($connection, $theLogInDetails);


   	   if (!$queryTheLogInDetails) {
   	   	
   	   	   die("could not query QUERYTHELOGINDETAILS ".mysqli_error($connection));
   	   }


   	   //check the number of rows found

   	   $rowsLogin = mysqli_num_rows($queryTheLogInDetails);

   	   if ($rowsLogin = 1) {
   	   	
   	   	    $fetchTheLogInDetails = mysqli_fetch_assoc($queryTheLogInDetails);

   	   	    $_SESSION['storeAdId'] = $fetchTheLogInDetails['storeAdmin_id'];

   	   	    header("Location:search-file.php");
   	   	    exit();
   	   }
   }else{

      $adminStoreLogInErrMess = "<ul>";

      foreach ($adminStoreLogInErr as $adminStoreLogInErrors) {
         
         $adminStoreLogInErrMess .= "<li>$adminStoreLogInErrors</li>";
      }

      $adminStoreLogInErrMess .= "</ul>";

   }

}


?>