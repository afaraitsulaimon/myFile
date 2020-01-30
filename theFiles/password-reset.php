<?php
   session_start();
  require_once("../config.php");
  require_once("../handler.php");
  require_once("process-password-reset.php");
?>


<?php
   storeAdminNotLogin();
?>


<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../style.css">
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

         </header>
  
       <!-- PASSWORD RESET START FROM HERE -->

       <div class="container">
         <div class="row d-flex justify-content-around">
           <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 bg bg-primary resetPassWord">


            <?php
               if (isset($resetPwErrMessage)) {
                 
                   echo "<div class='alert alert-danger'>$resetPwErrMessage</div>";
               }

            ?>

                <h1 class="text-center">RESET PASSWORD</h1>
            <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" name='passReset'>


              <div class="form-group">
                <label>Current Password:</label>
                <input type="password" name="currentPassCode" class="form-control"  required>
              </div>

              <div id="errorCurrentPw" style="padding-left: 170px; color: red;"></div>

              <div class="form-group">
                <label>New Password:</label>
                <input type="password" name="newPassCode" class="form-control" required>
              </div>

              <div id="errorNewPw" style="padding-left: 170px; color: red;"></div>


              <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="confirmNewPassCode" class="form-control" required>
              </div>

              <div id="errorConfirmNewPw" style="padding-left: 170px; color: red;"></div>

              <div class="form-group" align="center">
                
                <button type="submit" name="resetPwButton"> Reset Password</button>
              </div>




              
            </form>
             
           </div>
         </div>
       </div>


       <!-- PASSWORD RESET ENDS HERE -->



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
  
  var thePassReset = document.forms.passReset;


  //variable for the errors of password reset start here 

var theErrorCurrentPw = document.getElementById('errorCurrentPw');
var theErrorNewPw = document.getElementById('errorNewPw');
var theErrorConfirmNewPw = document.getElementById('errorConfirmNewPw');

//variable for the errors of password reset ends here 

  //check if current password entered

  function checkCurrentPw() {
    if (thePassReset.currentPassCode.value === "" || thePassReset.currentPassCode.value === null) {

      thePassReset.currentPassCode.style.borderColor = "red";
      theErrorCurrentPw.innerHTML = "Enter your current password";

    }else {

     thePassReset.currentPassCode.style.borderColor = "green";
     theErrorCurrentPw.innerHTML = "";

    }
  }

  thePassReset.currentPassCode.addEventListener("blur", checkCurrentPw, false);


  function checkNewPw(){

    if (thePassReset.newPassCode.value === "" || thePassReset.newPassCode.value === null) {

      thePassReset.newPassCode.style.borderColor = "red";
      theErrorNewPw.innerHTML = "Enter new Password";

    }else if (thePassReset.newPassCode.value !== "" && thePassReset.newPassCode.value !== null && thePassReset.newPassCode.value.length <= 6) {

     thePassReset.newPassCode.style.borderColor = "red";
     theErrorNewPw.innerHTML = "New Password must be longer than 6";


    }else{

      thePassReset.newPassCode.style.borderColor = "green";
      theErrorNewPw.innerHTML = "";

    }
  }

  thePassReset.newPassCode.addEventListener("blur", checkNewPw, false);



   function checkConfirmPw(){

    if (thePassReset.confirmNewPassCode.value === "" || thePassReset.confirmNewPassCode.value === null) {

    thePassReset.confirmNewPassCode.style.borderColor = "red";
    theErrorConfirmNewPw.innerHTML = "Confirm your new password";

    }else if ( thePassReset.confirmNewPassCode.value !== thePassReset.newPassCode.value) {


      thePassReset.confirmNewPassCode.style.borderColor = "red";
      theErrorConfirmNewPw.innerHTML = "Passwrod does match";

    }else{

      thePassReset.confirmNewPassCode.style.borderColor = "green";
      theErrorConfirmNewPw.innerHTML = "";

    }
   }

   thePassReset.confirmNewPassCode.addEventListener('blur', checkConfirmPw, false);

</script>