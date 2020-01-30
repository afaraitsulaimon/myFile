<?php
session_start();
    require_once("../config.php");
    require_once("../handler.php");
    require_once("process-edit-profile.php");

?>

<?php
   storeAdminNotLogin();
?>
<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="../style.css">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	

	<title>Edit Profile</title>
</head>
<body>
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



	<!-- ADD STORE ADMIN FORM START FROM HERE  -->

		<div class="container">
			<div class="row d-flex justify-content-around">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 addStoreAdmins bg-primary mt-4">

		<?php
          if (isset($_GET['editStatus']) && $_GET['editStatus'] == 'successful') {
          	
          	echo "<div class='alert alert-success mt-4'>Successfully Edited</div>";

          }elseif (isset($profileEditErrMessage)) {
          	
          	echo "<div class='alert alert-danger mt-4'>$profileEditErrMessage</div>";

          }

		?>

			
					<h1 class="text-center">Edit Profile</h1>
					<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" name='editProfileForm'>


						<div class="form-group">
							<label>Fullname:</label>
							<input type="text" name="editStoreFullName" class="form-control" value="<?php if(isset($_GET['theProfileId'])){
                   
                   $idOfProfile = $_GET['theProfileId'];

                   $pickProfileDet = "SELECT * FROM store_admin WHERE storeAdmin_id = $idOfProfile";

                   $queryPickProfileDet = mysqli_query($connection,$pickProfileDet);


                   if(!$queryPickProfileDet){

                    die("could not QUERY QUERY PICK PROFILE DET" .mysqli_error($connection));
                   }

                   $fetchPickProfileDet = mysqli_fetch_assoc($queryPickProfileDet);

                   echo $fetchPickProfileDet['storeAdmin_name'];


                      }?>" required>


						</div>

            <div id="errorProfileFullName" style="padding-left: 170px; color: red;"></div>



						<div class="form-group">
							<label>Username:</label>
							<input type="text" name="editStoreUserName" class="form-control" value="<?php if(isset($_GET['theProfileId'])){
                   
                   $idOfProfile = $_GET['theProfileId'];

                   $pickProfileDet = "SELECT * FROM store_admin WHERE storeAdmin_id = $idOfProfile";

                   $queryPickProfileDet = mysqli_query($connection,$pickProfileDet);


                   if(!$queryPickProfileDet){

                    die("could not QUERY QUERY PICK PROFILE DET" .mysqli_error($connection));
                   }

                   $fetchPickProfileDet = mysqli_fetch_assoc($queryPickProfileDet);

                   echo $fetchPickProfileDet['storeAdmin_username'];


                      }?>" required>
						</div>

            <div id="errorProfileUserName" style="padding-left: 170px; color: red;"></div>


						<div class="form-group">
							<label>Department:</label>
							<select class="form-control" name="editStoreDept">
							<option value="noEditDept">Select Department</option>
							<option value="LC">LC</option>
							<option value="Bills">Bills</option>
							<option value="Non-valid">Non-Valid</option>
							<option value="Invisible">Invisible</option>
							<option value="Export">Export</option>
							</select>
						</div>

            <div id="errorProfileDept" style="padding-left: 170px; color: red;"></div>


						<div class="form-group">
							<input type="hidden" name="editingId" value="<?php if(isset($_GET['theProfileId'])){
                   
                   $idOfProfile = $_GET['theProfileId'];

                   $pickProfileDet = "SELECT * FROM store_admin WHERE storeAdmin_id = $idOfProfile";

                   $queryPickProfileDet = mysqli_query($connection,$pickProfileDet);


                   if(!$queryPickProfileDet){

                    die("could not QUERY QUERY PICK PROFILE DET" .mysqli_error($connection));
                   }

                   $fetchPickProfileDet = mysqli_fetch_assoc($queryPickProfileDet);

                   echo $fetchPickProfileDet['storeAdmin_id'];


                      }?>">
						</div>



						<div class="form-group" align="center">
							
							<button type="submit" name="editProfile">Edit Profile</button>
						</div>


						
					</form>
				</div>
			</div>
		</div>

		
	<!-- ADD STORE ADMIN FORM ENDS HERE  -->

	<script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>


<script type="text/javascript">
  var theEditProfileForm = document.forms.editProfileForm;

  var theErrorProfileFullName = document.getElementById('errorProfileFullName');

  var theErrorProfileUserName = document.getElementById('errorProfileUserName');

  var theErrorProfileDept = document.getElementById('errorProfileDept');

  // check the name for the profile  
  //if it is empty

  function checkProfileFullName(){

    if (theEditProfileForm.editStoreFullName.value === "" || theEditProfileForm.editStoreFullName.value === null) {

      theEditProfileForm.editStoreFullName.style.borderColor = "red";



       theErrorProfileFullName.innerHTML = "Enter a Full name";


    }else{

 theEditProfileForm.editStoreFullName.style.border = "3px solid green";

  theErrorProfileFullName.innerHTML = "";

    }
  }

  theEditProfileForm.editStoreFullName.addEventListener("blur", checkProfileFullName, false);



//check the user name

function checkProfileUserName(){

  if (theEditProfileForm.editStoreUserName.value === "" ||  theEditProfileForm.editStoreUserName.value === null) {

   theEditProfileForm.editStoreUserName.style.borderColor = "red";

   theErrorProfileUserName.innerHTML = "Enter a username";

  }else{

  theEditProfileForm.editStoreUserName.style.border = "3px solid green";

  theErrorProfileUserName.innerHTML = "";

  }
}

theEditProfileForm.editStoreUserName.addEventListener("blur", checkProfileUserName, false);

//check for department

function checkProfileDept(){

   if (theEditProfileForm.editStoreDept.value == 'noEditDept') {

    theEditProfileForm.editStoreDept.style.borderColor = 'red';

    theErrorProfileDept.innerHTML = "Select a Department";
   }else{

    theEditProfileForm.editStoreDept.style.border = '3px solid green';

    theErrorProfileDept.innerHTML = "";

   }
}

theEditProfileForm.editStoreDept.addEventListener("blur",checkProfileDept, false );

</script>