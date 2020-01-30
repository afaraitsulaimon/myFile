<?php
session_start();
    require_once("../config.php");
    require_once("../handler.php");
    require_once("process-admin-login.php");
    require_once("process-add-store-admin.php");
?>

<?php
   administratorNotLogin();
?>


<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="admin-style.css">
	

	<title>Manange File</title>

	<style type="text/css">
		select{
			height: 40px;
			border-radius: 5px;
			font-size: 1.5em;
			border: 2px solid ;
		}

		input[type='text']{

			height: 40px;
			border-radius: 5px;
			font-size: 1.2em;
			margin-left: 20px;
			border: 2px solid ;

		}

		button{
            width: 70px;
			height: 30px;
			border-radius: 5px;
			border: 2px solid blue;
			color: blue;
			margin-left: 10px;
			
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



	<!-- MANAGE STORE ADMIN START FROM HERE  -->

		<div class="container">
			<div class="row d-flex justify-content-around">
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mt-4">

		
				            <h1 class="text-center pt-4">MANAGE FILE</h1>

						
					
				</div>
			</div>
		</div>

		



	<!-- MANAGE STORE ADMIN DISPLAY TABLE START FROM HERE  -->

		<div class="container manage_storeAdmin">
			<div class="row d-flex justify-content-around">
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mt-4 ">

		
          <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" align='center'>

        
           	<select name="man_FileDept" class="col-lg-4 col-md-4 col-sm-12 col-xs">
           		<option value="noFileSearch">Search by Dept</option>
           		<option value="allFiles">ALL</option>
           		<option value="LC">LC</option>
           		<option value="Bills">Bills</option>
           		<option value="Non-valid">Non-Valid</option>
           		<option value="Export">Export</option>
           		<option value="Invisible">Invisible</option>
           	</select>
                        
				          	
				          	
				          	
          	<input type="text" name="man_fileNo" placeholder="Search By File No"class="col-lg-4 col-md-4 col-sm-12 col-xs">

          	

          	<button type="submit" name="manFileSearchBut">Search</button>
          </form>
						
					
				</div>
			</div>
		</div>

		
	<!-- MANAGE STORE ADMIN DISPLAY TABLE ENDS HERE  -->


	<!-- DISPLAY RESULT OF SEARCH STARTS FROM HERE-->
			<div class="container manage_storeAdmin">
				<div class="row d-flex justify-content-around">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4 bg-primary">

			
       <?php
          require_once('process-manage-files.php');
          require_once('process-delete-file.php');
       ?>
							
						
					</div>
				</div>
			</div>

	<!-- DISPLAY RESULT OF SEARCH ENDS HERE-->


	<script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>