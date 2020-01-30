<?php

    if (isset($_POST['retrieveButton'])) {
    	
    	$addFileErr = array();

    	$theFileNo = sanitize($_POST['fileNo']);

    	if (isset($_POST['filePicker']) && $_POST['filePicker'] == '$fetchPickersName[storeAdmin_name]') {
    	
    	  $thePicker = $_POST['filePicker'];
    	}



    	$theFileUser = sanitize($_POST['fileUser']);


	  if (isset($_POST['departmentStore']) && $_POST['departmentStore'] == '$fetchPickerDet[storeAdmin_dept]') {
	  
	    $thePickerDept = $_POST['departmentStore'];
	  }


	  //check for error

	  if (empty($theFileNo)) {
	  	
	  	$addFileErr[] = "Enter file number";
	  }

	  if (empty($theFileUser)) {
	  	
	  	$addFileErr[] = "Enter name of file user";
	  }

	  if (isset($_POST['filePicker']) && $_POST['filePicker'] == 'noPicker') {
	  
	    $addFileErr[] = "Select name of picker";
	  }

	  if (isset($_POST['departmentStore']) && $_POST['departmentStore'] == 'noDept') {
	  
	    $addFileErr[] = "Select picker department";
	  }


     if (empty($addFileErr)) {
     	
     	 $addFileDetails = "INSERT INTO file_details (file_no,file_picker,file_user,department,picked_date) VALUES('$theFileNo', '". $_POST['filePicker'] ."', '$theFileUser', '". $_POST['departmentStore'] ."', NOW())";

     	 $queryAddFileDetails = mysqli_query($connection, $addFileDetails);

     	 if (!$queryAddFileDetails) {
     	 	
     	 	die("could not query QUERY ADD FILE DETAILS ".mysqli_error($connection));
     	 }

     	 header("Location:add-file.php?addFileStatus=success");
     	 exit();
     }else{

        $addFileErrMessage = "<ul>";

        foreach ($addFileErr as $addFileErrors) {
        	
        	$addFileErrMessage .= "<li>$addFileErrors</li>";
        }

        $addFileErrMessage .= "</ul>";


     }
    }

?>