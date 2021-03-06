<?php
session_start();
    require_once("../config.php");
    require_once("../handler.php");
    require_once("process-admin-login.php");
    require_once("process-add-store-admin.php");
    require_once("process-edit-users.php");
?>

<?php
   administratorNotLogin();
?>


<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="admin-style.css">
	

	<title>Edit Store Admin</title>
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
				<a href="logout.php" style="float: right; padding: 20px; font-size: 1.5em; text-decoration: none;">Sign-out</a>
			</div>
		</div>
	</div>



	<!-- ADD STORE ADMIN FORM START FROM HERE  -->

		<div class="container">
			<div class="row d-flex justify-content-around">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 addStoreAdmins bg-primary mt-4">
    <?php

      if (isset($_GET['userEditStatus']) && $_GET['userEditStatus'] == 'done') {
      	
      	echo "<div class='alert alert-success'>Successfully Edited</div>";

      }elseif (isset($editUserErrMessage)) {
      	
      	echo "<div class='alert alert-danger'>$editUserErrMessage</div>";

      }


    ?>
		

					<h1 class="text-center">Edit Store Admin</h1>
					<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>">


						<div class="form-group">
							<label>Fullname:</label>
							<input type="text" name="editStoreFullName" class="form-control" value="<?php if(isset($_GET['theUsersId'])){
                   
                   $idUserToEdit = $_GET['theUsersId'];

                   $theDetOfId = "SELECT * FROM store_admin WHERE storeAdmin_id = $idUserToEdit";

                   $queryTheDetOfId = mysqli_query($connection,$theDetOfId);


                   if(!$queryTheDetOfId){

                    die("could not queryTheDetOfId" .mysqli_error($connection));
                   }

                   $fetchTheDetOfId = mysqli_fetch_assoc($queryTheDetOfId);

                   echo $fetchTheDetOfId['storeAdmin_name'];


                      }?>">
						</div>

						<div class="form-group">
							<label>Username:</label>
							<input type="text" name="editStoreUserName" class="form-control" value="<?php if(isset($_GET['theUsersId'])){
                   
                   $idUserToEdit = $_GET['theUsersId'];

                   $theDetOfId = "SELECT * FROM store_admin WHERE storeAdmin_id = $idUserToEdit";

                   $queryTheDetOfId = mysqli_query($connection,$theDetOfId);


                   if(!$queryTheDetOfId){

                    die("could not queryTheDetOfId" .mysqli_error($connection));
                   }

                   $fetchTheDetOfId = mysqli_fetch_assoc($queryTheDetOfId);

                   echo $fetchTheDetOfId['storeAdmin_username'];


                      }?>">
						</div>


						

						<div class="form-group">
							<label>Department:</label>
							<select class="form-control" name="editStoreDept">
							<option value="editNoDept">Select Department</option>
							<option value="LC">LC</option>
							<option value="Bills">Bills</option>
							<option value="Non-valid">Non-Valid</option>
							<option value="Invisible">Invisible</option>
							<option value="Export">Export</option>
							</select>
						</div>
                        
                        <div class="form-group">
                        	<input type="text" name="idOfUser" value="<?php if(isset($_GET['theUsersId'])){
                   
                   $idUserToEdit = $_GET['theUsersId'];

                   $theDetOfId = "SELECT * FROM store_admin WHERE storeAdmin_id = $idUserToEdit";

                   $queryTheDetOfId = mysqli_query($connection,$theDetOfId);


                   if(!$queryTheDetOfId){

                    die("could not queryTheDetOfId" .mysqli_error($connection));
                   }

                   $fetchTheDetOfId = mysqli_fetch_assoc($queryTheDetOfId);

                   echo $fetchTheDetOfId['storeAdmin_id'];


                      }?>">
                        </div>


						<div class="form-group" align="center">
							
							<button type="submit" name="editUserButton">Edit User</button>
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