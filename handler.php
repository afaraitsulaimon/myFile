<?php
   //TO REMOVE ALL THE UNWANTED TAGS FROM INPUTTING INTO OUR DATABASE
function sanitize($data){

	$data = trim($data);
	$data = strip_tags($data);
	return $data;
}


// TO CHECK IF THE  ADMINISTRATOR IS LOGGED IN
	function administratorLogin(){
		if(isset($_SESSION['adminId'])){
		  return $_SESSION['adminId']; 
		}else{
			return false;
		}
	}


	// TO CHECK IF THE ADMINISTRATOR IS NOT LOGGED IN
	//TO BE ABLE TO ACCESS THAT PAGE
	//THEN REDIRECT BACK TO LOGIN

		function administratorNotLogin(){
			if(administratorLogin() == false){

	       header("location:admin-login.php");
	       exit();
			}
		}


		// TO CHECK IF THE STORE ADMIN IS LOGGED IN
	function storeAdminLogin(){
		if(isset($_SESSION['storeAdId'])){
		  return $_SESSION['storeAdId']; 
		}else{
			return false;
		}
	}



		function storeAdminNotLogin(){
			if(storeAdminLogin() == false){

	       header("location:login.php");
	       exit();
			}
		}

		

?>



