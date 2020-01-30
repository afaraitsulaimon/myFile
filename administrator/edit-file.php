<?php
session_start();
    require_once("../config.php");
    require_once("../handler.php");
    require_once("process-admin-login.php");
    require_once("process-add-store-admin.php");
    require_once("process-edit-file.php");
?>

<?php
   administratorNotLogin();
?>


<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="admin-style.css">
	

	<title>Edit File</title>

	<style type="text/css">
		button{

			border:2px solid black;
			font-weight: bold;
		}

		button:hover{

			background-color: red;
			color: white;
			border:2px solid white;
		}
	</style>

	
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-primary" style="padding: 20px;font-size: 1.5em">
				<a href='administrator-dashboard.php' style="text-decoration: none; color: black;"> <?php

				$adminId = administratorLogin();


				$adminDet = "SELECT * FROM administrators WHERE administrator_id = $adminId";

			

				$queryAdminDet = mysqli_query($connection, $adminDet);

				if (!$queryAdminDet) {
					
					die("could not query QUERY ADMIN DET ".mysqli_error($connection));
				}

				$fetchAdminDet = mysqli_fetch_assoc($queryAdminDet);

				echo "Welcome ".$fetchAdminDet['administrator_username'];
				?></a>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 bg-secondary">
				<a href="sign-out.php" style="float: right; padding: 20px; font-size: 1.5em; text-decoration: none;">Sign-out</a>
			</div>
		</div>
	</div>



	
		



	 <div class="container-fluid">
           <div class="row d-flex justify-content-around">
             <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 bg-primary" style="margin-top: 100px;">
<!-- DISPLAY FILE EDIT ERROR AND SUCCESSFUL MESSAGE START-->
<?php
   if (isset($_GET['fileEditStatus']) && $_GET['fileEditStatus'] == 'success') {
   	  echo "<div class='alert alert-success mt-4'>SUCCESSFULLY EDITED</div>";

   }elseif (isset($errEditFileMessage)) {
   	
   	  echo "<div class='alert alert-danger mt-4'>$errEditFileMessage</div>";

   }
?>
<!-- DISPLAY FILE EDIT ERROR AND SUCCESSFUL MESSAGE END-->

              <h1 class="text-center">EDIT FILE</h1>
                 <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>">
                    <div class="form-group">
                      <label>File No:</label>
                      <input type="text" name="fileNoToEdit"  class="form-control" value="<?php if(isset($_GET['theFilesId'])){
                   
                   $idOftheFiles = $_GET['theFilesId'];

                   $fileDet = "SELECT * FROM file_details WHERE file_id = $idOftheFiles";

                   $queryFileDet = mysqli_query($connection,$fileDet);


                   if(!$queryFileDet){

                    die("could not QUERY fileDet" .mysqli_error($connection));
                   }

                   $fetchFileDet = mysqli_fetch_assoc($queryFileDet);

                   echo $fetchFileDet['file_no'];


                      }?>" >
                    </div>

                    <div class="form-group">
                      <label>File Picker:</label>
                      <select name="filePickerToEdit" class="form-control">
                        <option value="noPickerToEdit">Select Picker</option>
                        
                      <?php

                        if(isset($_GET['theFilesId'])){
                        	$fileDet = "SELECT * FROM file_details WHERE file_id = $idOftheFiles";

                      

                        	$queryFileDet = mysqli_query($connection,$fileDet);

                        	if(!$queryFileDet){

                        	 die("could not QUERY fileDet" .mysqli_error($connection));
                        	}

                        	$fetchFileDet = mysqli_fetch_assoc($queryFileDet);

                        	$fileDept = $fetchFileDet['department'];

                        	
                        	$filePicker = "SELECT * FROM file_details WHERE department = '$fileDept' ";

                        	$queryFilePicker = mysqli_query($connection, $filePicker);

                        	if (!$queryFilePicker) {            die("could not query QUERY FILE PICKER " .mysqli_error($connection));
                        	     }

                        	$numOfFilePicker = mysqli_num_rows($queryFilePicker);
                        	
                        	while ($fetchFilePicker = mysqli_fetch_assoc($queryFilePicker)) {

					        echo "<option value = '". $fetchFilePicker['file_picker'] ."'>". $fetchFilePicker['file_picker'] ."</option>";             
                        					 } 


                        }

                        ?>
                        
                      </select>
                    </div>

                    <div class="form-group">
                      <label>File User:</label>
                      <input type="text" name="fileUserToEdit" class="form-control" value="<?php if(isset($_GET['theFilesId'])){
                   
                   $idOftheFiles = $_GET['theFilesId'];

                   $fileDet = "SELECT * FROM file_details WHERE file_id = $idOftheFiles";

                   $queryFileDet = mysqli_query($connection,$fileDet);


                   if(!$queryFileDet){

                    die("could not QUERY fileDet" .mysqli_error($connection));
                   }

                   $fetchFileDet = mysqli_fetch_assoc($queryFileDet);

                   echo $fetchFileDet['file_user'];


                      }?>">
                    </div>

                    <div class="form-group">
                      <label>Department:</label>
                      <select class="form-control" name="departmentToEdit">
                        <option value="noDeptToEdit">Select Department</option>

                        
                        <?php

                            if(isset($_GET['theFilesId'])){

                            	$idOftheFiles = $_GET['theFilesId'];

                            	$pickerDet = "SELECT * FROM file_details WHERE file_id = $idOftheFiles";

                          

                            	$queryPickerDet = mysqli_query($connection,$pickerDet);

                            	

                         if (!$queryPickerDet) {
                                                     
                          die("could not query QUERY PICKER DET ".mysqli_error($connection));
                          }

                          $fetchPickerDet = mysqli_fetch_assoc($queryPickerDet);



                          echo "<option value = '". $fetchPickerDet['department'] ."'>". $fetchPickerDet['department'] ."</option>";
 
           
                            }

                            ?>
                       
                       
                        
                      </select>
                    </div>

                    <div class="form-group">
                      <input type="hidden" name="idToEdit" value="<?php if(isset($_GET['theFilesId'])){
                   
                   $idOftheFiles = $_GET['theFilesId'];

                   $fileDet = "SELECT * FROM file_details WHERE file_id = $idOftheFiles";

                   $queryFileDet = mysqli_query($connection,$fileDet);


                   if(!$queryFileDet){

                    die("could not QUERY fileDet" .mysqli_error($connection));
                   }

                   $fetchFileDet = mysqli_fetch_assoc($queryFileDet);

                   echo $fetchFileDet['file_id'];


                      }?>">
                    </div>

                    <div class="form-group submitButton" align="center" >
                      <button type="submit" name="editFileBut" class="btn-lg">Edit File</button>
                    </div>

                 </form>
             </div>
           </div>
         </div>



	<script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>