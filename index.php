<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<title>MyFile Home</title>
</head>
<body style="background-image: url(image/indexBackground.jpg); background-size: cover;">

	<div class="newGround">
		<!-- MENU , WHERE WE HAVE LOGO AND OTHER MENU STARTS FROM HERE -->
		<header>

	<!-- HEADER STARTED FROM HERE -->
     <div class="container-fluid">
     	<div class="row">
     		<div class="col">
     		   	<nav class="navbar navbar-expand-lg ">
     		   	  <a class="navbar-brand" href="index.php" >myFile</a>
     		   	  <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
     		   	    <span class="navbar-toggler-icon"></span>
     		   	  </button>
     		   	  <div class="collapse navbar-collapse" id="navbarText">
     		   	    <ul class="navbar-nav ml-auto">
     		   	      <li class="nav-item active">
     		   	       <button> <a class="nav-link" href="theFiles/login.php">LOGIN ADMINISTRATOR <span class="sr-only">(current)</span></a></button>
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

         </header>

     </div>    


     <!-- CONTENT DETAILS START FROM HERE-->
          	
          	<section>
          		<div class="container-fluid">
          			<div class="row justify-content-around">
          				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 theContent">
          					<h1 class="text-center">WELCOME TO</h1>
          					<p class="text-center">
          						myArchive
          					</p>
                           
                           <div align="center">
                           	  <button><a href="about-us.php">Learn More</a></button>
                           </div>
          					
          					
          				</div>
          			</div>
          		</div>
          	</section>

          	<!-- CONTENT DETAILS ENDS HERE-->

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

     <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
     <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>