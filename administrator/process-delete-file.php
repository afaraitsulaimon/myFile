<?php

   if (isset($_POST['fileDelBut'])) {
   	
   	    //once the delete button is clicked
   	    // get the id u want to delete
   	   // then delete

   	  $idToDelete = sanitize($_POST['file_Idnumber']);

   	  $delTheFile = "DELETE FROM file_details WHERE file_id = $idToDelete";


   	  $queryDelTheFile = mysqli_query($connection,$delTheFile);

   	  if (!$queryDelTheFile) {
   	  	
   	  	  die("could not query QUERY DEL THE FILE" .mysqli_error($connection));
   	  }

   	  echo "<div class='alert alert-success mt-4'>File Successfully Deleted</div>";


   }
    

?>