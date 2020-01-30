<?php

 
     if (isset($_POST['editFileBut'])) {
     	
     	$editFileErr = array();
     	$theidToEdit = sanitize($_POST['idToEdit']);

     	$theFileNoToEdit = sanitize($_POST['fileNoToEdit']);

      if (isset($_POST['filePickerToEdit']) && $_POST['filePickerToEdit'] == '$fetchPickersName[storeAdmin_name]') {
      	
      	$theFilePickerToEdit = $_POST['filePickerToEdit'];
      }


        $theFileUserToEdit = sanitize($_POST['fileUserToEdit']);


        if (isset($_POST['departmentToEdit']) && $_POST['departmentToEdit'] == '$fetchPickerDet[storeAdmin_dept]') {
        	
        	$theDepartmentToEdit = $_POST['departmentToEdit'];
        }

        //check for errors


        if (empty($theFileNoToEdit)){

        	$editFileErr[] = "Enter a File number";
        }

         
         if (isset($_POST['filePickerToEdit']) && $_POST['filePickerToEdit'] == 'noPickerToEdit') {
         	
         	$editFileErr[] = "Select a picker name";
         }


         if (empty($theFileUserToEdit)) {
         	
         	$editFileErr[] = "Enter file user name";

         }


        if (isset($_POST['departmentToEdit']) && $_POST['departmentToEdit'] == 'noDeptToEdit') {
        	
        	$editFileErr[] = "Select Department";

        }

        if (empty($editFileErr)) {
        	
        	$updateDetEdited = "UPDATE file_details SET file_no = '$theFileNoToEdit' , file_picker = '". $_POST['filePickerToEdit'] ."' , file_user = '$theFileUserToEdit' , department = '". $_POST['departmentToEdit'] ."' , picked_date = NOW() WHERE file_id = $theidToEdit "; 


        	$queryUpdateDetEdited = mysqli_query($connection,$updateDetEdited);

        	if (!$queryUpdateDetEdited) {
        		die("could not query QUERYUPDATEDETEDITED" .mysqli_error($connection));
        	}


        	header("Location:edit-file.php?fileEditStatus=correct");
        	exit();
        }else{
        	$editFileErrMessage = "<ul>";

        	foreach ($editFileErr as $editFileErrors) {
        		
        		$editFileErrMessage .= "<li>$editFileErrors</li>";
        	}

        	$editFileErrMessage .= "</ul>";

        }



     }
?>