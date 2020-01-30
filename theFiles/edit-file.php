<?php
   session_start();
  require_once("../config.php");
  require_once("../handler.php");
  require_once("process-login.php");
  require_once("process-edit-file.php");
?>

<?php
   storeAdminNotLogin();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<title>Edit File</title>
</head>
<body >

	
		<header>

  <!-- HEADER STARTED FROM HERE -->
     <div class="container-fluid">
      <div class="row">
        <div class="col bg bg-primary">
            <nav class="navbar navbar-expand-lg ">
              <a class="navbar-brand" href="search-file.php" ><?php 
                 $userLogon = storeAdminLogin();

                 $userLogonDet = "SELECT * FROM store_admin WHERE storeAdmin_id = $userLogon";

                 $queryUserLogonDet = mysqli_query($connection, $userLogonDet);

                 if (!$queryUserLogonDet) {
                   
                   die("could not query QUERY USER LOGON DET ".mysqli_error($connection));
                 }

                 $fetchUserLogonDet = mysqli_fetch_assoc($queryUserLogonDet);

                 echo $fetchUserLogonDet['storeAdmin_name'];

              ?></a>
              <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                   <button> <a class="nav-link" href="#">ADD FILE <span class="sr-only">(current)</span></a></button>
                  </li>
                  <li class="nav-item">
                   <button> <a class="nav-link" href="search-file.php">SEARCH FOR FILE</a></button>
                  </li>

                  <li class="nav-item">
                   <button> <a class="nav-link" href="password-reset.php">RESET PASSWORD</a></button>
                  </li>

                    <li class="nav-item">
                   <button> <a class="nav-link" href="edit-profile.php">EDIT PROFILE</a></button>
                  </li>

                  <li class="nav-item">
                    <button><a class="nav-link" href="logout.php">LOGOUT</a></button>
                  </li>

                 

                </ul>
               
              </div>
            </nav>
        </div>
      </div>
     </div>
     <!-- HEADER ENDS HERE -->




    <!-- FORM FOR ADD FILE STARTED FROM HERE -->
         <div class="container-fluid">
           <div class="row d-flex justify-content-around">
             <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 bg-primary" style="margin-top: 100px;">
<!-- DISPLAY FILE EDIT ERROR AND SUCCESSFUL MESSAGE START-->
<?php
    if (isset($_GET['fileEditStatus']) && $_GET['fileEditStatus'] == 'correct') {
         echo "<div class='alert alert-success mt-4'>Successfully Edited</div>";
    }elseif (isset($editFileErrMessage)) {
      
      echo "<div class='alert alert-danger mt-4'>$editFileErrMessage</div>";
    }
?>
<!-- DISPLAY FILE EDIT ERROR AND SUCCESSFUL MESSAGE END-->

              <h1 class="text-center">EDIT FILE</h1>
                 <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" name='editFileForm'>
                    <div class="form-group">
                      <label>File No:</label>
                      <input type="text" name="fileNoToEdit" class="form-control" value="<?php if(isset($_GET['theEditFileId'])){
                   
                   $idOfFileToEdit = $_GET['theEditFileId'];

                   $pickDetToEdit = "SELECT * FROM file_details WHERE file_id = $idOfFileToEdit";

                   $queryPickDetToEdit = mysqli_query($connection,$pickDetToEdit);


                   if(!$queryPickDetToEdit){

                    die("could not QUERY QUERYPICKDETTOEDIT" .mysqli_error($connection));
                   }

                   $fetchDetToEdit = mysqli_fetch_assoc($queryPickDetToEdit);

                   echo $fetchDetToEdit['file_no'];


                      }?>" required>
                    </div>

                    <div id="errorFileNo" style="padding-left: 170px; color: red;"></div>

                    <div class="form-group">
                      <label>File Picker:</label>
                      <select name="filePickerToEdit" class="form-control">
                        <option value="noPickerToEdit">Select Picker</option>
                        <?php
                         $pickerId = storeAdminLogin();

                         $pickerDet = "SELECT * FROM store_admin WHERE storeAdmin_id = $pickerId";

                         $queryPickerDet = mysqli_query($connection,$pickerDet);

                         if (!$queryPickerDet) {
                                                     
                          die("could not query QUERY PICKER DET ".mysqli_error($connection));
                          }

                          $fetchPickerDet = mysqli_fetch_assoc($queryPickerDet);


                          $pickerDept = $fetchPickerDet['storeAdmin_dept'];

                          $pickersName = "SELECT * FROM store_admin WHERE storeAdmin_dept = '$pickerDept' ";

                          $queryPickersName = mysqli_query($connection, $pickersName);

                          if (!$queryPickersName) {
                                                     
                          die("could not query QUERY PCIKERS NAME ".mysqli_error($connection));
                                       }

                           $numOfPicker = mysqli_num_rows($queryPickersName);

                       while ($fetchPickersName = mysqli_fetch_assoc($queryPickersName)) {
                                               
                     echo "<option value = '". $fetchPickersName['storeAdmin_name'] ."'>". $fetchPickersName['storeAdmin_name'] ."</option>";             

                                             }

                        ?>
                      </select>
                    </div>

                    <div id="errorFilePicker" style="padding-left: 170px; color: red;"></div>

                    <div class="form-group">
                      <label>File User:</label>
                      <input type="text" name="fileUserToEdit" class="form-control" value="<?php if(isset($_GET['theEditFileId'])){
                   
                   $idOfFileToEdit = $_GET['theEditFileId'];

                   $pickDetToEdit = "SELECT * FROM file_details WHERE file_id = $idOfFileToEdit";

                   $queryPickDetToEdit = mysqli_query($connection,$pickDetToEdit);


                   if(!$queryPickDetToEdit){

                    die("could not QUERY QUERYPICKDETTOEDIT" .mysqli_error($connection));
                   }

                   $fetchDetToEdit = mysqli_fetch_assoc($queryPickDetToEdit);

                   echo $fetchDetToEdit['file_user'];


                      }?>" required>
                    </div>

                    <div id="errorFileUser" style="padding-left: 170px; color: red;"></div>


                    <div class="form-group">
                      <label>Department:</label>
                      <select class="form-control" name="departmentToEdit">
                        <option value="noDeptToEdit">Select Department</option>

                        <?php
                         $pickerId = storeAdminLogin();

                         $pickerDet = "SELECT * FROM store_admin WHERE storeAdmin_id = $pickerId";

                         $queryPickerDet = mysqli_query($connection,$pickerDet);

                         if (!$queryPickerDet) {
                                                     
                          die("could not query QUERY PICKER DET ".mysqli_error($connection));
                          }

                          $fetchPickerDet = mysqli_fetch_assoc($queryPickerDet);


                          echo "<option value = '". $fetchPickerDet['storeAdmin_dept'] ."'>". $fetchPickerDet['storeAdmin_dept'] ."</option>";

                          ?>
                        
                      </select>
                    </div>

                    <div id="errorFileDept" style="padding-left: 170px; color: red;"></div>

                    <div class="form-group">
                      <input type="hidden" name="idToEdit" value="<?php if(isset($_GET['theEditFileId'])){
                   
                   $idOfFileToEdit = $_GET['theEditFileId'];
                   echo $idOfFileToEdit;

                 } ?>">
                    </div>

                    <div class="form-group submitButton" align="center" >
                      <button type="submit" name="editFileBut" class="btn-lg">Edit File</button>
                    </div>

                 </form>
             </div>
           </div>
         </div>

    <!-- FORM FOR ADD FILE END HERE -->







         <!-- FOOTER START FROM HERE-->
        <footer>
       	 <div class="container-fluid">
       	 	 <div class="row justify-content-around">
       	 	 	<div class="col text-center text-dark" style="margin-top: -80px;">
       	 	 		  &copy myFile <?php echo date("Y"); ?>
                       
       	 	  	 </div>
       	 	 </div>
       	 	
       	 </div>
       </footer>
          <!-- FOOTER ENDS HERE-->

          </div>
          	
            
          <!--TRANSPARENT BACKGROUND COLOR ENDS HERE -->

     <script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
     <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<script type="text/javascript">
  var theEditFileForm = document.forms.editFileForm;

  var theErrorFileNo = document.getElementById('errorFileNo');
  var theErrorFilePicker = document.getElementById('errorFilePicker');

  var theErrorFileUser = document.getElementById('errorFileUser');

   var theErrorFileDept = document.getElementById('errorFileDept');

   //check for file no

   function checkFileNumber(){

    if (theEditFileForm.fileNoToEdit.value === "" || theEditFileForm.fileNoToEdit.value === null) {

      theEditFileForm.fileNoToEdit.style.borderColor = "red";
      theErrorFileNo.innerHTML = "Enter a File Number";
    }else{

      theEditFileForm.fileNoToEdit.style.border = "3px solid green";
      theErrorFileNo.innerHTML = "";
    }
   }

   theEditFileForm.fileNoToEdit.addEventListener("blur",checkFileNumber, false);

   //check forfile picker

   function checkFilePicker(){

     if (theEditFileForm.filePickerToEdit.value == 'noPickerToEdit') {

        theEditFileForm.filePickerToEdit.style.borderColor = "red";

          theErrorFilePicker.innerHTML = "Select Picker";
     }else{

      theEditFileForm.filePickerToEdit.style.border = "3px solid green";

        theErrorFilePicker.innerHTML = "";
     }

   }

   theEditFileForm.filePickerToEdit.addEventListener("blur", checkFilePicker, false);

   //check for file user

   function checkFileUser(){

      if (theEditFileForm.fileUserToEdit.value === "" || theEditFileForm.fileUserToEdit.value === null) {

        theEditFileForm.fileUserToEdit.style.borderColor = "red";
        theErrorFileUser.innerHTML = "Enter File User name";

      }else{

        theEditFileForm.fileUserToEdit.style.border = "3px solid green";
        theErrorFileUser.innerHTML = "";
      }
   }

   theEditFileForm.fileUserToEdit.addEventListener("blur", checkFileUser, false);

   //check for department

   function checkFileEditDept(){

       if (theEditFileForm.departmentToEdit.value == 'noDeptToEdit') {

        theEditFileForm.departmentToEdit.style.borderColor = "red";
        theErrorFileDept.innerHTML = "Select Department";

       }else{

   theEditFileForm.departmentToEdit.style.border = "3px solid green";
   theErrorFileDept.innerHTML = "";

       }
   }

   theEditFileForm.departmentToEdit.addEventListener("blur",checkFileEditDept, false );



</script>