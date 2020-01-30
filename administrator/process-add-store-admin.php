<?php
   if (isset($_POST['addButton'])) {
   	
   	  $addStoreAdminErr = array();

   	  $theStoreAdminName = sanitize($_POST['storeFullName']);
   	  $theStoreAdminUserName = sanitize($_POST['storeUserName']);
        $salt = "ipDaloveyBuohgGTZwzJbanDS8gtoninjaYj48CP";
   	  $theStoreAdminPass = crypt($_POST['storePassWord'], $salt);

        



        

   	  if (isset($_POST['storeDept']) && $_POST['storeDept'] == 'LC') {
   	  	
   	  	  $theStoreAdminDept = $_POST['storeDept'];
   	  }


   	  if (isset($_POST['storeDept']) && $_POST['storeDept'] == 'Bills') {
   	  	
   	  	  $theStoreAdminDept = $_POST['storeDept'];
   	  }


   	  if (isset($_POST['storeDept']) && $_POST['storeDept'] == 'Non-valid') {
   	  	
   	  	  $theStoreAdminDept = $_POST['storeDept'];
   	  }


   	  if (isset($_POST['storeDept']) && $_POST['storeDept'] == 'Invisible') {
   	  	
   	  	  $theStoreAdminDept = $_POST['storeDept'];
   	  }

   	  if (isset($_POST['storeDept']) && $_POST['storeDept'] == 'Export') {
   	  	
   	  	  $theStoreAdminDept = $_POST['storeDept'];
   	  }


//check for errors


   	  if (isset($_POST['storeDept']) && $_POST['storeDept'] == 'noDept') {
   	  	
   	  	  $addStoreAdminErr[] = "Select department";
   	  }


   	  if (empty($theStoreAdminName)) {
   	  	
   	  	$addStoreAdminErr[] = "Enter Fullname";

   	  }


   	  if (empty($theStoreAdminUserName)) {
   	  	
   	  	$addStoreAdminErr[] = "Enter Username";

   	  }

   	  if (empty($theStoreAdminPass)) {
   	  	
   	  	$addStoreAdminErr[] = "Enter Password";

   	  }


//if no error found
//send detais to database

   	  if (empty($addStoreAdminErr)) {
   	  	
   	  	  $addStoreAdminDet = "INSERT INTO store_admin (storeAdmin_name,storeAdmin_username,storeAdmin_code,storeAdmin_dept,registration_date) VALUES('$theStoreAdminName', '$theStoreAdminUserName', '$theStoreAdminPass', '".$_POST['storeDept']."', NOW())";

   	  	  $queryAddStoreAdminDet = mysqli_query($connection, $addStoreAdminDet);

   	  	  if (!$queryAddStoreAdminDet) {
   	  	  	
   	  	  	die("could not query QUERYADDSTOREADMINDET ".mysqli_error($connection));
   	  	  }

   	  	  header("Location:add-store-admin.php?addAdminStatus=success");
   	  	  exit();

   	  }else{

   	  	$addStoreAdminErrMessage = "<ul>";

   	  	foreach ($addStoreAdminErr as $addStoreAdminErrors) {

   	  		$addStoreAdminErrMessage .= "<li>$addStoreAdminErrors</li>";
   	  	}

   	  	$addStoreAdminErrMessage .= "</ul>";
   	  }


   }
?>