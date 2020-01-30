<?php
     
     if (isset($_POST['fileDelBut'])) {
     	
     	$theFile_IdNumber = $_POST['files_Idnumber'];

     	$delThePickedIdFiles = "DELETE FROM file_details WHERE file_id = $theFile_IdNumber";

     	$queryDeletedFile = mysqli_query($connection,$delThePickedIdFiles);

     	if (!$queryDeletedFile) {
     		
     		die("could not query QUERY DELETED FILE " .mysqli_error($connection));
     	}

     	echo "<div class='alert alert-success'>File successfully deleted</div>";

     }

?>