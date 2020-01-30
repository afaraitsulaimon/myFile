<?php
   session_start();
   require_once("../config.php");
   require_once("../handler.php");
   require_once("process-admin-login.php");

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="admin-style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<title>ADMIN LOGIN PAGE</title>
</head>
<body>

	
        <div class="container-fluid">
          <div class="row justify-content-around">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 adminLogInPage bg-secondary" >
              <!--DISPLAY ERROR RESULT FOR LOGIN START HERE -->
              <?php

                 if (isset($adminLogErrorMess)) {
                   
                   echo "<div class='alert alert-danger'>$adminLogErrorMess</div>";
                 }

              ?>

              <!-- DISPLAY ERROR RESULT ENDS HERE-->

              <h1 class="text-center pt-4">ADMINISTRATOR LOGIN</h1>
              
               <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>">

                 <div class="form-group">
                   <label>Username:</label>
                   <input type="text" name="admin-user" class="form-control">

                 </div>


                 <div class="form-group">
                   <label>Password:</label>
                   <input type="password" name="admin-pass" class="form-control">

                 </div>

                 <div class="form-group" align="center">
                   <button type="submit" name="loginAdmin">Login</button>

                 </div>
                 
               </form>
              
              
            </div>
          </div>
        </div>


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

     <script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
     <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>