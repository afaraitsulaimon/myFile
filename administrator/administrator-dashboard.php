<?php
    session_start();
    require_once("../config.php");
    require_once("../handler.php");
    require_once("process-admin-login.php");
?>

<?php
   administratorNotLogin();
?>
<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="admin-style.css">
	

	<title>Administrator  Dashboard</title>
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



	<div class="container-fluid" style="margin-top: 150px;">
		<div class="row d-flex justify-content-around adminDashBoardContent1">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 bg-primary pt-4 pb-4 text-center">
				<a href="add-store-admin.php">ADD STORE ADMIN</a>
			</div>

			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 bg-secondary pt-4 pb-4 text-center">
				<a href="manage-store-admins.php">MANAGE STORE ADMIN</a>
			</div>

			<div class="col-lg-3 col-md-3 col-sm-12 col-xs- 12 bg-primary pt-4 pb-4 text-center">
				<a href="manage-files.php">MANAGE FILES</a>
			</div>

			
		</div>
	</div>


	<div class="container-fluid mt-4 adminDashBoardContent2">
		<div class="row d-flex justify-content-around">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bg-primary pt-4 pb-4 text-center">
				<?php
               $countAll = "SELECT storeAdmin_id FROM store_admin";

               $queryCountAll = mysqli_query($connection, $countAll);

               if (!$queryCountAll) {
               	   die("could not query QUERY COUNT ALL" .mysqli_error($connection));
               }

               $numOfStoreAdmin = mysqli_num_rows($queryCountAll);

               echo $numOfStoreAdmin . ' Users';
				?>
			</div>

			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bg-primary pt-4 pb-4 text-center">
			<?php
           $countAllFiles = "SELECT file_id FROM file_details";

           $queryCountAllFiles = mysqli_query($connection, $countAllFiles);

           if (!$queryCountAllFiles) {
           	   die("could not query QUERY COUNT ALL FILES" .mysqli_error($connection));
           }

           $numOfFiles = mysqli_num_rows($queryCountAllFiles);

           echo $numOfFiles . ' Files';
			?>
			</div>

			
		</div>
	</div>

	<script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>