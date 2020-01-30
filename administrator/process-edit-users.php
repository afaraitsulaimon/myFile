<?php

   if (isset($_POST['editUserButton'])) {
   	    
   	    $editUserErr = array();

    $theFullNameToEdit = sanitize($_POST['editStoreFullName']);

    $theUsernameToEdit = sanitize($_POST['editStoreUserName']);

    $theUsersId = sanitize($_POST['idOfUser']);

    if (isset($_POST['editStoreDept']) && $_POST['editStoreDept'] == 'LC') {
    	
    	$theUsersDepts = $_POST['editStoreDept'];
    }

    if (isset($_POST['editStoreDept']) && $_POST['editStoreDept'] == 'Bills') {
    	
    	$theUsersDepts = $_POST['editStoreDept'];
    }

    if (isset($_POST['editStoreDept']) && $_POST['editStoreDept'] == 'Non-valid') {
    	
    	$theUsersDepts = $_POST['editStoreDept'];
    }


    if (isset($_POST['editStoreDept']) && $_POST['editStoreDept'] == 'Invisible') {
    	
    	$theUsersDepts = $_POST['editStoreDept'];
    }


    if (isset($_POST['editStoreDept']) && $_POST['editStoreDept'] == 'Export') {
    	
    	$theUsersDepts = $_POST['editStoreDept'];
    }


    //check for  error

    if (empty($theFullNameToEdit)) {
    	
    	$editUserErr[] = "Enter a Full name";
    }

    if (empty($theUsernameToEdit)) {
    	
    	$editUserErr[] = "Enter a Username";
    }

    if (isset($_POST['editStoreDept']) && $_POST['editStoreDept'] == 'editNoDept') {
    	
    	$editUserErr[] = "Select a department";
    }


// when no error found
// then update database

if (empty($editUserErr)) {
    	
    	$updateUserDet = "UPDATE store_admin SET storeAdmin_name	= '$theFullNameToEdit', storeAdmin_username	= '$theUsernameToEdit' , storeAdmin_dept = '".$_POST['editStoreDept']."', registration_date	= NOW() WHERE storeAdmin_id =  $theUsersId";

    	$queryUpdateUserDet = mysqli_query($connection, $updateUserDet);

    	if (!$queryUpdateUserDet) {
    		
    		die("could not query QUERYUPDATEUSERDET" .mysqli_error($connection));
    	}

    	header("Location:edit-users.php?userEditStatus=done");
    	exit();
    }else{

    	$editUserErrMessage = "<ul>";

    	foreach ($editUserErr as $editUserErrors) {
    		
    		$editUserErrMessage .= "<li>$editUserErrors</li>";

    	}

    	$editUserErrMessage .= "</ul>";
    }    



   }
?>