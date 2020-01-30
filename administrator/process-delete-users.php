<?php
   if (isset($_POST['userDelBut'])) {
   	
   	  $idToDelete = $_POST['storeAdmin_Idnumber'];


   	  $detToDelete = "DELETE FROM store_admin WHERE storeAdmin_id = $idToDelete";

   	  $queryDetToDelete = mysqli_query($connection, $detToDelete);

   	  if (!$queryDetToDelete) {
   	  	
   	  	die("could not query QUERYDETTODELETE" .mysqli_error($connection));
   	  }

   	  echo "<div class='alert alert-success mt-4'>File successfully deleted</div>";
   }

?>