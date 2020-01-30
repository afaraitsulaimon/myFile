<?php
   session_start();
  require_once("../config.php");
  require_once("../handler.php");
  require_once("process-login.php");
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
                   <button> <a class="nav-link" href="add-file.php">ADD FILE <span class="sr-only">(current)</span></a></button>
                  </li>
                  <li class="nav-item">
                   <button> <a class="nav-link" href="#">SEARCH FOR FILE</a></button>
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

         </header>
  
        <!-- SEARCH BAR START FROM HERE-->
        <div class="container-fluid">
          <div class="row d-flex justify-content-around">
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
              <h1 class="text-center pt-4 pb-4">File Search by Department</h1>
              <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>">
                 <div class="form-group">

                     <select class="form-control" name="searchFiles">
                        <option>Search By Store Admin</option>
                       <option value="allFiles">ALL</option>
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

                            $queryNameOfPicker = mysqli_query($connection, $pickersName);

                            if (!$queryNameOfPicker) {
                                                       
                            die("could not query QUERY NAME OF PICKER".mysqli_error($connection));
                                         }

                             $numOfPicker = mysqli_num_rows($queryNameOfPicker);

                         while ($fetchNameOfPicker = mysqli_fetch_assoc($queryNameOfPicker)) {
                                                 
             echo "<option value= '". $fetchNameOfPicker['storeAdmin_name'] ."'> ". $fetchNameOfPicker['storeAdmin_name'] ." </option>";   
                                               }

                          ?>
                     </select>
                 </div>

                 <h1 class="text-center">OR</h1>

                 <div class="form-group">
                   <input type="text" name="searchUsingFileNo" placeholder="Find File Using File No" class="form-control">
                 </div>

                 <div class="form-group">
                   <button type="submit" name="findFileBut">Find</button>
                 </div>
              </form>
            </div>
          </div>
        </div>
        <!-- SEARCH BAR ENDS HERE-->



        <!-- RESULT OF SEARCH START FROM HERE-->


        

        <div class="container">
          <div class="row d-flex justify-content-around">
            <div class="col bg bg-primary">

              

              <?php
             require_once("process-search-file.php");
             require_once("process-search-file-no.php");
             require_once("process-delete-file.php");
              ?>
            </div>
          </div>
        </div>
        
   <!-- RESULT OF SEARCH ENDS HERE-->





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