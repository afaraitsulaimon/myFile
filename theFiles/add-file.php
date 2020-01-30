<?php
   session_start();
  require_once("../config.php");
  require_once("../handler.php");
  require_once("process-login.php");
  require_once("process-add-file.php");
?>

<?php
   storeAdminNotLogin();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<title>MyFile Home</title>
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
                      <?php
                         $usersLoggedIn = storeAdminLogin();
                        

                         $usersDetailsLogIn = " SELECT * FROM store_admin WHERE storeAdmin_id = $usersLoggedIn";

                         $queryUsersDetailsLog = mysqli_query($connection,$usersDetailsLogIn);

                         if (!$queryUsersDetailsLog) {
                           
                           die('could not query QUERY USERS DETAILS LOG' .mysqli_error($connection));
                         }
                         
                         $rowsUsersDetailsLog = mysqli_num_rows($queryUsersDetailsLog);


                         while ($fetchUsersDetailsLog = mysqli_fetch_assoc($queryUsersDetailsLog)) {

                          $button= "<button><a class='nav-link' href='edit-profile.php?theProfileId=$fetchUsersDetailsLog[storeAdmin_id]'>EDIT PROFILE</a></button>" ;
                    

                         }
                         
                       
                       echo $button;



                      ?>

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

<!-- DISPLAYING SUCCESSFUL AND ERROR MESSAGE ADDING FILE START-->
        <?php
           if (isset($_GET['addFileStatus']) && $_GET['addFileStatus'] == 'success') {
             echo "<div class='alert alert-success'>File Successfuy Retrieve</div>";

           }elseif (isset($addFileErrMessage)) {

              echo "<div class='alert alert-danger mt-3'>$addFileErrMessage</div>";
           }
        ?>

 <!-- DISPLAYING SUCCESSFUL AND ERROR MESSAGE ADDING FILE ENDS-->
              <h1 class="text-center">ADD FILE</h1>
                 <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" name='filesToAdd'>
                    <div class="form-group">
                      <label>File No:</label>
                      <input type="text" name="fileNo" class="form-control" required>
                    </div>

                    <div id="errorFileNo" style="padding-left: 170px; color: red;"></div>

                    <div class="form-group">
                      <label>File Picker:</label>
                      <select name="filePicker" class="form-control">
                        <option value="noPicker">Select Picker</option>
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

                    <div id="errorPickerName" style="padding-left: 170px; color: red;"></div>



                    <div class="form-group">
                      <label>File User:</label>
                      <input type="text" name="fileUser" class="form-control" required>
                    </div>

                    <div id="errorFileUser" style="padding-left: 170px; color: red;"></div>


                    <div class="form-group">
                      <label>Department:</label>
                      <select class="form-control" name="departmentStore">
                        <option value="noDept">Select Department</option>

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

                    <div id="errorAddDept" style="padding-left: 170px; color: red;"></div>


                    <div class="form-group submitButton" align="center" >
                      <button type="submit" name="retrieveButton" class="btn-lg">Retrieve File</button>
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

     <script type="text/javascript" src="validate-forms.js"></script>
     
</body>
</html>

