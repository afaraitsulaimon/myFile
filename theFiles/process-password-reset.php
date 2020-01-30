<?php
     if (isset($_POST['resetPwButton'])) {
     	
     	$resetPwErr = array();
     $salt = "ipDaloveyBuohgGTZwzJbanDS8gtoninjaYj48CP";
      
     	$thePresentPw = crypt($_POST['currentPassCode'], $salt);

     	$theNewPw = crypt($_POST['newPassCode'], $salt);

     	$confirmTheNewPw = crypt($_POST['confirmNewPassCode'], $salt);


     	//check for errors

     	if (empty($thePresentPw)) {
     		
     		$resetPwErr[]  = "Enter current password";
     	}

       if (empty($theNewPw)) {
       	   
       	   $resetPwErr[] = "Enter your new password";
       }
       
       

       if (empty($confirmTheNewPw)) {
       	
       	  $resetPwErr[] = "Confirm your new password";
       }


       if ($theNewPw !== $confirmTheNewPw) {
       	   $resetPwErr[] = "New Password does not match";
       }


       if (empty($resetPwErr) && strlen($theNewPw) <= 6) {
        
        $resetPwErr[] = "Password too short";
       }


       //check if the current password matches
       //with the one in the database

       $IdOfLoginUser = storeAdminLogin();

       $usersDetails = "SELECT * FROM store_admin WHERE storeAdmin_id = $IdOfLoginUser";

       $queryUsersDetails = mysqli_query($connection, $usersDetails);

       if (!$queryUsersDetails) {
       	
       	    die("could not query QUERY USERS DETAILS ".mysqli_error($connection));
       }


       $fetchUsersDetails = mysqli_fetch_assoc($queryUsersDetails);


       $passOfLoginUser = $fetchUsersDetails['storeAdmin_code'];


       if ($thePresentPw !== $passOfLoginUser) {
       	
       	$resetPwErr[] = "Incorrect Current Password";

       }

       


      if (empty($resetPwErr)) {

      	$updateUserPw = "UPDATE store_admin SET storeAdmin_code = '$theNewPw' WHERE storeAdmin_id = $IdOfLoginUser";

      	$queryUpdateUserPw = mysqli_query($connection, $updateUserPw);

      	if (!$queryUpdateUserPw) {
      		
      		die("coud not query QUERY UPDATE USER PW" .mysqli_error($connection));
      	}


      	header("Location:login.php?pwResetStatus=success");
      	exit();
      	
      }else{

      	$resetPwErrMessage = "<ul>";

      	foreach ($resetPwErr as $resetPwErrors) {
      		
      		$resetPwErrMessage .= "<li>$resetPwErrors</li>";
      	}

      	$resetPwErrMessage .= "</ul>";

      }


     }

?>