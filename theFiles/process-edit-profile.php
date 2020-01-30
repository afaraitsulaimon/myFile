<?php
    if (isset($_POST['editProfile'])) {
    	
    	$editProfile_error = array();


    
        
        $theEditFullname = sanitize($_POST['editStoreFullName']);

        $theEditUsername = sanitize($_POST['editStoreUserName']);
        
        $theEditingId = sanitize($_POST['editingId']);

        if (isset($_POST['editStoreDept']) 	&& $_POST['editStoreDept'] == 'LC') {
        	
        		$editDept = $_POST['editStoreDept'];

        }

        if (isset($_POST['editStoreDept']) 	&& $_POST['editStoreDept'] == 'Bills') {
        	
        		$editDept = $_POST['editStoreDept'];

        }

        if (isset($_POST['editStoreDept']) 	&& $_POST['editStoreDept'] == 'Non-valid') {
        	
        		$editDept = $_POST['editStoreDept'];

        }

        if (isset($_POST['editStoreDept']) 	&& $_POST['editStoreDept'] == 'Invisible') {
        	
        		$editDept = $_POST['editStoreDept'];

        }


        if (isset($_POST['editStoreDept']) 	&& $_POST['editStoreDept'] == 'Export') {
        	
        		$editDept = $_POST['editStoreDept'];

        }


        	//check if it empty and department not selected

        if (empty($theEditFullname)) {
        	
        	$editProfile_error[] = "Enter Full name";
        }

        if (empty($theEditUsername)) {
        	
        	$editProfile_error[] = "Enter Username";
        }


        if (isset($_POST['editStoreDept']) 	&& $_POST['editStoreDept'] == 'noEditDept') {
        	
        		$editProfile_error[] = "Select your Department";

        }


// if no errors
//insert the edited details to the database
        if (empty($editProfile_error)) {
        	
        $editedProfile = "UPDATE store_admin SET storeAdmin_name = '$theEditFullname' , storeAdmin_username = '$theEditUsername' , storeAdmin_dept = '".$_POST['editStoreDept']."' , registration_date = NOW() WHERE storeAdmin_id = $theEditingId ";

        $queryEditedProfile = mysqli_query($connection, $editedProfile);

        if (!$queryEditedProfile) {
        	
        	die("could not query QUERY EDITED PROFILE" .mysqli_error($connection));
        }

        header("Location:edit-profile.php?editStatus=successful");
        exit();

        }else{

        	$profileEditErrMessage = "<ul>";

        	foreach ($editProfile_error as $editProfile_errors) {

        		$profileEditErrMessage .= "<li>$editProfile_errors</li>";
        	}

        	$profileEditErrMessage .= "</ul>";
        }




    }

?>