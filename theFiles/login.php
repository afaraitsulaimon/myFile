<?php
   session_start();

  require_once("../config.php");
  require_once("../handler.php");
  require_once("process-login.php");
  require_once("process-password-reset.php");


?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<title>MyFile Home</title>
</head>
<body>

	

	<!-- HEADER STARTED FROM HERE -->
     <div class="container-fluid">
     	<div class="row">
     		<div class="col bg-primary">
     		   	<nav class="navbar navbar-expand-lg ">
     		   	  <a class="navbar-brand" href="../index.php" >myFile</a>
     		   	  <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
     		   	    <span class="navbar-toggler-icon"></span>
     		   	  </button>
     		   	  <div class="collapse navbar-collapse" id="navbarText">
     		   	    <ul class="navbar-nav ml-auto">
     		   	      <li class="nav-item active">
     		   	       <button> <a class="nav-link" href="#">LOGIN ADMINISTRATOR <span class="sr-only">(current)</span></a></button>
     		   	      </li>
  
     		   	      <li class="nav-item">
     		   	        <button><a class="nav-link" href="#">ABOUT US</a></button>
     		   	      </li>

     		   	     

     		   	    </ul>
     		   	   
     		   	  </div>
     		   	</nav>
     		</div>
     	</div>
     </div>
     <!-- HEADER ENDS HERE -->

          


     <!--   STORE ADMIN LOGIN FORM START FROM HERE-->
          	
          	
          		<div class="container-fluid">
          			<div class="row justify-content-around">
          				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 logInStore bg-secondary" >

                    <?php
                    if (isset($adminStoreLogInErrMess)) {
                      
                         echo "<div class='alert alert-danger'>$adminStoreLogInErrMess</div>";


                    }elseif (isset($_GET['pwResetStatus']) && $_GET['pwResetStatus'] == 'success') {
                       
                       echo "<div class='alert alert-success'>Password Succesfully Change</div>";
                     }

                    ?>


          					<h1 class="text-center">LOGIN STORE ADMIN</h1>
          					
                    <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>">

                      <div class="form-group">
                        <label>Username:</label>
                        <input type="text" name="storeLogUsername" class="form-control">

                      </div>


                      <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="storeLogPass" class="form-control">

                      </div>

                      <div class="form-group" align="center">
                        <button type="submit" name='storeLogin'>Login</button>

                      </div>
                      
                    </form>
          					
          					
          				</div>
          			</div>
          		</div>
          

     <!--   STORE ADMIN LOGIN FORM ENDS HERE-->

         <!-- FOOTER START FROM HERE-->
        <footer>
       	 <div class="container-fluid">
       	 	 <div class="row justify-content-around">
       	 	 	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center text-light">
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