<?php
  if (isset($_POST['editFileBut'])) {
  	
  	 $errEditFiles = array();

  	 $theIdToEdit = sanitize($_POST['idToEdit']);

  	 $theFileNoToEdit = sanitize($_POST['fileNoToEdit']);

  	 if (isset($_POST['filePickerToEdit']) && $_POST['filePickerToEdit'] == 'fetchFilePicker[file_picker]') {
  	 	
  	 	$theNewFilePicker = $_POST['filePickerToEdit'];
  	 }




  	 $theFileUser = sanitize($_POST['fileUserToEdit']);

  	 if (isset($_POST['departmentToEdit']) && $_POST['departmentToEdit'] == '$fetchPickerDet[department]') {
  	 	
  	 	$thePickersDept = $_POST['departmentToEdit'];
  	 }

  	 //check for errors

  	 if (empty($theFileNoToEdit)) {
  	 	
  	 	$errEditFiles[] = "Enter a file Number";
  	 }

  	 if (empty($theFileUser)) {
  	 	
  	 	$errEditFiles[] = "Enter the file user full name";
  	 }


  	 if (isset($_POST['filePickerToEdit']) && $_POST['filePickerToEdit'] == 'noPickerToEdit') {
  	 	
  	 	$errEditFiles[] = "Select a Picker";
  	 }

  	 if (isset($_POST['departmentToEdit']) && $_POST['departmentToEdit'] == 'noDeptToEdit') {
  	 	
  	 	$errEditFiles[] = "Select a Department";
  	 }



   if (empty($errEditFiles)) {
   	
   	   $updateFileEdited = "UPDATE file_details SET file_no = '$theFileNoToEdit', file_picker = '".$_POST['filePickerToEdit']."' , file_user = '$theFileUser', department = '".$_POST['departmentToEdit']."' , picked_date = NOW() WHERE file_id = $theIdToEdit";

   	   $queryUpdateFileEdited = mysqli_query($connection, $updateFileEdited);

   	   if (!$queryUpdateFileEdited) {
   	   	
   	   	    die("could not query QUERY UPDATE FILE EDITED" .mysqli_error($connection));
   	   }

   	   header("Location:edit-file.php?fileEditStatus=success");
   	   exit();
   }else{


   	$errEditFileMessage = "<ul>";

   	foreach ($errEditFiles as $errorEditFiles) {
   		
   		$errEditFileMessage .= "<li>$errorEditFiles</li>";
   	}

   	$errEditFileMessage .= "</ul>";
  	 
  }
   }

?>