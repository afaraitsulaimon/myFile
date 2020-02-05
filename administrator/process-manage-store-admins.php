<?php
   if (isset($_POST['man_storeAdminSearchFBut']) || isset($_GET['paginated'])) {
   	    
   	    $errManageAdmin = array();

   	    if (isset($_POST['man_storeAdminDept']) && $_POST['man_storeAdminDept'] == 'allAdmins'  || isset($_GET['paginated'])) {
   	    	
   	    	$allTheAdmins = "SELECT * FROM store_admin";

   	    	$queryAllTheAdmins = mysqli_query($connection,$allTheAdmins);

   	    	if (!$queryAllTheAdmins) {
   	    		
   	    		die("could not query QUERY ALL THE ADMINS" .mysqli_error($connection));
   	    	}


   	    	$rowsOfAllAdmins = mysqli_num_rows($queryAllTheAdmins);

          //define how many per page

          $itemPerPages = 10;

           $numbers_of_pages = ceil($rowsOfAllAdmins/$itemPerPages);

            //the current page the user is on
           // the page in this $_GET['page'] is from
            // the for loop below
            //in displaying the links to the pages
            //which is the ?pages = '.$pages.'
            //the below says
            //if the page is not set, it still be on page 1
            //but if set which is the else
            // then the page should load the page requested

            if (isset($_GET['page']) && !empty($_GET['page'])) {
              $page = $_GET['page'];
            }else{
              
              $page = 1;


            }

            //determine the starting limit number to display

            $page_first_result = ($page-1) * $itemPerPages;

            $allOfTheStoreAdmin = "SELECT * FROM store_admin LIMIT " . $page_first_result . ',' . $itemPerPages ;

            $queryAllOfTheStoreAdmin = mysqli_query($connection,$allOfTheStoreAdmin);


          $nosOfAllTheStoreAdmin = mysqli_num_rows($queryAllOfTheStoreAdmin);

   	    	$table = "<table class='table-striped table-bordered' align='center'>";
   	    	$table .= "<tr>";
   	    	$table .= "<th>S/N</th>";
   	    	$table .= "<th>Name</th>";
   	    	$table .= "<th>Username</th>";
   	    	$table .= "<th>Password</th>";
   	    	$table .= "<th>Department</th>";
   	    	$table .= "<th>Registered Date</th>";
   	    	$table .= "</tr>";
          
         $i = $itemPerPages - 1;   // this gives us 9

         // the 1 ,is where we want our serial number to start from

          // Getting serial Number 
          // use the number of items per pages which is 10
          // then get the number of each page
          // deduct it from 9
          //why we had to deduct it from 9 , is to make sure the serial number start from 1
          //but if we change the 9(which is the $i) to $itemPerPages
          //the serial number starts from 0
          //so if your $per_pages is 5,
          // that means in that aspect, the 9 has to change to 4 which we did calculation for using 
         //$i = $itemPerPages - 1;

          // then echo the result and then increment it

          $serialNumbers = ($itemPerPages * $page) - $i;

   	    	while ($fetchAllAdmins = mysqli_fetch_assoc($queryAllOfTheStoreAdmin)) {

   	    		$table .= "<tr>";
   	    		$table .= "<td>{$serialNumbers}</td>";
            $serialNumbers++;
   	    		$table .= "<td>{$fetchAllAdmins['storeAdmin_name']}</td>";
   	    		$table .= "<td>{$fetchAllAdmins['storeAdmin_username']}</td>";
   	    		$table .= "<td>{$fetchAllAdmins['storeAdmin_code']}</td>";
   	    		$table .= "<td>{$fetchAllAdmins['storeAdmin_dept']}</td>";
   	    		$table .= "<td>{$fetchAllAdmins['registration_date']}</td>";
   	    		$table .= "</tr>";


   	    	}

   	    	$table .= "</table>";

   	    	echo $table;

          //displaying the links to the pages
          
          for ($page = 1; $page <= $numbers_of_pages ; $page++) { 

               echo '<button><a href="manage-store-admins.php?page='. $page . '&paginated">'. $page .'</a></button>';
              }    


   	    }elseif($_POST['man_storeAdminDept'] == 'LC') {
   	    	

   	    	$lcAdmins = "SELECT * FROM store_admin WHERE storeAdmin_dept = 'LC' ";

   	    	$queryLcAdmins = mysqli_query($connection,$lcAdmins);

   	    	if (!$queryLcAdmins) {
   	    		
   	    		die("could not query QUERY LC ADMINS" .mysqli_error($connection));
   	    	}


   	    	$rowsOfLcAdmins = mysqli_num_rows($queryLcAdmins);

   	    	$table = "<table class='table-striped table-bordered' align='center'>";
   	    	$table .= "<tr>";
   	    	$table .= "<th>S/N</th>";
   	    	$table .= "<th>Name</th>";
   	    	$table .= "<th>Username</th>";
   	    	$table .= "<th>Password</th>";
   	    	$table .= "<th>Department</th>";
   	    	$table .= "<th>Registered Date</th>";
          $table .= "<th>Edit</th>";
          $table .= "<th>Delete</th>";
   	    	$table .= "</tr>";

        
         $sLc = 1;

   	    	while ($fetchLcAdmins = mysqli_fetch_assoc($queryLcAdmins)) {
   	    		
   	    		$table .= "<tr>";
   	    		$table .= "<td>{$sLc}</td>";
            $sLc++;
   	    		$table .= "<td>{$fetchLcAdmins['storeAdmin_name']}</td>";
   	    		$table .= "<td>{$fetchLcAdmins['storeAdmin_username']}</td>";
   	    		$table .= "<td>{$fetchLcAdmins['storeAdmin_code']}</td>";
   	    		$table .= "<td>{$fetchLcAdmins['storeAdmin_dept']}</td>";
   	    		$table .= "<td>{$fetchLcAdmins['registration_date']}</td>";
            $table .= "<td><button><a href='edit-users.php?theUsersId=$fetchLcAdmins[storeAdmin_id]'>Edit</a></button></td>";
                $table .= "<form method='POST'>";
            $table .= "<td><button type='submit' name='userDelBut' onclick ='return delUser()'>Delete</button></td>";
            $table .= "<input type='hidden' name='storeAdmin_Idnumber' value='$fetchLcAdmins[storeAdmin_id]'>";
            $table .= "</form>";
   	    		$table .= "</tr>";


   	    	}

   	    	$table .= "</table>";
   	    	echo $table;

   	    }elseif($_POST['man_storeAdminDept'] == 'Bills') {
   	    	

   	    	$billsAdmins = "SELECT * FROM store_admin WHERE storeAdmin_dept = 'Bills' ";


   	    	$queryBillsAdmins = mysqli_query($connection,$billsAdmins);

   	    	if (!$queryBillsAdmins) {
   	    		
   	    		die("could not query QUERY BILLS ADMINS" .mysqli_error($connection));
   	    	}


   	    	$rowsOfBillsAdmins = mysqli_num_rows($queryBillsAdmins);

   	    	$table_bills = "<table class='table-striped table-bordered' align='center'>";
   	    	$table_bills  .= "<tr>";
   	    	$table_bills  .= "<th>S/N</th>";
   	    	$table_bills  .= "<th>Name</th>";
   	    	$table_bills  .= "<th>Username</th>";
   	    	$table_bills  .= "<th>Password</th>";
   	    	$table_bills  .= "<th>Department</th>";
   	    	$table_bills  .= "<th>Registered Date</th>";
          $table_bills .= "<th>Edit</th>";
          $table_bills .= "<th>Delete</th>";
   	    	$table_bills  .= "</tr>";

          $sBills = 1;
   	    	while ($fetchBillsAdmins = mysqli_fetch_assoc($queryBillsAdmins)) {
   	    		
   	    		$table_bills  .= "<tr>";
   	    		$table_bills  .= "<td>{$sBills}</td>";
            $sBills++;
   	    		$table_bills  .= "<td>{$fetchBillsAdmins['storeAdmin_name']}</td>";
   	    		$table_bills  .= "<td>{$fetchBillsAdmins['storeAdmin_username']}</td>";
   	    		$table_bills  .= "<td>{$fetchBillsAdmins['storeAdmin_code']}</td>";
   	    		$table_bills  .= "<td>{$fetchBillsAdmins['storeAdmin_dept']}</td>";
   	    		$table_bills  .= "<td>{$fetchBillsAdmins['registration_date']}</td>";
            $table_bills .= "<td><button><a href='edit-users.php?theUsersId=$fetchBillsAdmins[storeAdmin_id]'>Edit</a></button></td>";
                 $table_bills .= "<form method='POST'>";
            $table_bills .= "<td><button type='submit' name='userDelBut' onclick ='return delUser()'>Delete</button></td>";
            $table_bills .= "<input type='hidden' name='storeAdmin_Idnumber' value='$fetchBillsAdmins[storeAdmin_id]'>";
            $table_bills .= "</form>";
   	    		$table_bills  .= "</tr>";


   	    	}

   	    	$table_bills  .= "</table>";
   	    	echo $table_bills;

   	    }elseif($_POST['man_storeAdminDept'] == 'Non-valid') {
            

            $nonValidAdmins = "SELECT * FROM store_admin WHERE storeAdmin_dept = 'Non-valid' ";


            $queryNonValidAdmins = mysqli_query($connection,$nonValidAdmins);

            if (!$queryNonValidAdmins) {
               
               die("could not query QUERY NON VALID ADMINS" .mysqli_error($connection));
            }


            $rowsOfNonValidAdmins = mysqli_num_rows($queryNonValidAdmins);

            $table_nonValid = "<table class='table-striped table-bordered' align='center'>";
            $table_nonValid  .= "<tr>";
            $table_nonValid  .= "<th>S/N</th>";
            $table_nonValid  .= "<th>Name</th>";
            $table_nonValid  .= "<th>Username</th>";
            $table_nonValid  .= "<th>Password</th>";
            $table_nonValid  .= "<th>Department</th>";
            $table_nonValid  .= "<th>Registered Date</th>";
            $table_nonValid  .= "<th>Edit</th>";
            $table_nonValid  .= "<th>Delete</th>";
            $table_nonValid  .= "</tr>";

            $sNon = 1;


            while ($fetchNonValidAdmins = mysqli_fetch_assoc($queryNonValidAdmins)) {
               
               $table_nonValid  .= "<tr>";
               $table_nonValid  .= "<td>{$sNon}</td>";
               $sNon++;
               $table_nonValid  .= "<td>{$fetchNonValidAdmins['storeAdmin_name']}</td>";
               $table_nonValid  .= "<td>{$fetchNonValidAdmins['storeAdmin_username']}</td>";
               $table_nonValid  .= "<td>{$fetchNonValidAdmins['storeAdmin_code']}</td>";
               $table_nonValid  .= "<td>{$fetchNonValidAdmins['storeAdmin_dept']}</td>";
               $table_nonValid  .= "<td>{$fetchNonValidAdmins['registration_date']}</td>";
               $table_nonValid .= "<td><button><a href='edit-users.php?theUsersId=$fetchNonValidAdmins[storeAdmin_id]'>Edit</a></button></td>";
                $table_nonValid .= "<form method='POST'>";
               $table_nonValid .= "<td><button type='submit' name='userDelBut' onclick ='return delUser()'>Delete</button></td>";
               $table_nonValid .= "<input type='hidden' name='storeAdmin_Idnumber' value='$fetchNonValidAdmins[storeAdmin_id]'>";
               $table_nonValid .= "</form>";
               $table_nonValid  .= "</tr>";


            }

            $table_nonValid  .= "</table>";
            echo $table_nonValid;

          }elseif($_POST['man_storeAdminDept'] == 'Export') {
            

            $exportAdmins = "SELECT * FROM store_admin WHERE storeAdmin_dept = 'Export' ";


            $queryExportAdmins = mysqli_query($connection,$exportAdmins);

            if (!$queryExportAdmins) {
               
               die("could not query QUERY EXPORT ADMINS" .mysqli_error($connection));
            }


            $rowsOfExportAdmins = mysqli_num_rows($queryExportAdmins);

            $table_Export = "<table class='table-striped table-bordered' align='center'>";
            $table_Export  .= "<tr>";
            $table_Export  .= "<th>S/N</th>";
            $table_Export  .= "<th>Name</th>";
            $table_Export  .= "<th>Username</th>";
            $table_Export  .= "<th>Password</th>";
            $table_Export  .= "<th>Department</th>";
            $table_Export  .= "<th>Registered Date</th>";
            $table_Export  .= "<th>Edit</th>";
            $table_Export  .= "<th>Delete</th>";
            $table_Export  .= "</tr>";

            $sExp = 1;
            while ($fetchExportAdmins = mysqli_fetch_assoc($queryExportAdmins)) {
               
               $table_Export  .= "<tr>";
               $table_Export  .= "<td>{$sExp}</td>";
               $sExp++;
               $table_Export  .= "<td>{$fetchExportAdmins['storeAdmin_name']}</td>";
               $table_Export  .= "<td>{$fetchExportAdmins['storeAdmin_username']}</td>";
               $table_Export  .= "<td>{$fetchExportAdmins['storeAdmin_code']}</td>";
               $table_Export  .= "<td>{$fetchExportAdmins['storeAdmin_dept']}</td>";
               $table_Export  .= "<td>{$fetchExportAdmins['registration_date']}</td>";
               $table_Export .= "<td><button><a href='edit-users.php?theUsersId=$fetchExportAdmins[storeAdmin_id]'>Edit</a></button></td>";
                    $table_Export .= "<form method='POST'>";
               $table_Export .= "<td><button type='submit' name='userDelBut' onclick ='return delUser()'>Delete</button></td>";
               $table_Export .= "<input type='hidden' name='storeAdmin_Idnumber' value='$fetchExportAdmins[storeAdmin_id]'>";
               $table_Export .= "</form>";
               $table_Export  .= "</tr>";


            }

            $table_Export  .= "</table>";
            echo $table_Export;

          }elseif($_POST['man_storeAdminDept'] == 'Invisible') {
            

            $invisibleAdmins = "SELECT * FROM store_admin WHERE storeAdmin_dept = 'Invisible' ";


            $queryInvisibleAdmins = mysqli_query($connection,$invisibleAdmins);

            if (!$queryInvisibleAdmins) {
               
               die("could not query QUERY INVISIBLE ADMINS" .mysqli_error($connection));
            }


            $rowsOfInvisibleAdmins = mysqli_num_rows($queryInvisibleAdmins);

            $table_Invisible = "<table class='table-striped table-bordered' align='center'>";
            $table_Invisible  .= "<tr>";
            $table_Invisible  .= "<th>S/N</th>";
            $table_Invisible  .= "<th>Name</th>";
            $table_Invisible  .= "<th>Username</th>";
            $table_Invisible  .= "<th>Password</th>";
            $table_Invisible  .= "<th>Department</th>";
            $table_Invisible .= "<th>Registered Date</th>";
            $table_Invisible  .= "<th>Edit</th>";
            $table_Invisible  .= "<th>Delete</th>";
            $table_Invisible  .= "</tr>";

            $sInv = 1;
            while ($fetchInvisibleAdmins = mysqli_fetch_assoc($queryInvisibleAdmins)) {
               
               $table_Invisible  .= "<tr>";
               $table_Invisible  .= "<td>{$sInv}</td>";
               $sInv++;
               $table_Invisible  .= "<td>{$fetchInvisibleAdmins['storeAdmin_name']}</td>";
               $table_Invisible  .= "<td>{$fetchInvisibleAdmins['storeAdmin_username']}</td>";
               $table_Invisible  .= "<td>{$fetchInvisibleAdmins['storeAdmin_code']}</td>";
               $table_Invisible  .= "<td>{$fetchInvisibleAdmins['storeAdmin_dept']}</td>";
               $table_Invisible  .= "<td>{$fetchInvisibleAdmins['registration_date']}</td>";
               $table_Invisible .= "<td><button><a href='edit-users.php?theUsersId=$fetchInvisibleAdmins[storeAdmin_id]'>Edit</a></button></td>";
                    $table_Invisible .= "<form method='POST'>";
               $table_Invisible .= "<td><button type='submit' name='userDelBut' onclick ='return delUser()'>Delete</button></td>";
               $table_Invisible .= "<input type='hidden' name='storeAdmin_Idnumber' value='$fetchInvisibleAdmins[storeAdmin_id]'>";
               $table_Invisible .= "</form>";
               $table_Invisible  .= "</tr>";


            }

            $table_Invisible  .= "</table>";
            echo $table_Invisible;


          }elseif (sanitize($_POST['man_storeAdminName'])) {

            $searchName = mysqli_real_escape_string($connection,$_POST['man_storeAdminName']);
             
             $searchByName = "SELECT * FROM store_admin WHERE storeAdmin_name LIKE '%$searchName%' ";

             $querySearchByName = mysqli_query($connection,$searchByName);

             if (!$querySearchByName) {
                
                die("could not query QUERY SEARCH BY NAME" .mysqli_error($connection));
             }


             $rowSeachByName = mysqli_num_rows($querySearchByName);

             $table_searchByName= "<table class='table-striped table-bordered' align='center'>";
             $table_searchByName  .= "<tr>";
             $table_searchByName  .= "<th>S/N</th>";
             $table_searchByName  .= "<th>Name</th>";
             $table_searchByName  .= "<th>Username</th>";
             $table_searchByName  .= "<th>Password</th>";
             $table_searchByName  .= "<th>Department</th>";
             $table_searchByName  .= "<th>Registered Date</th>";
             $table_searchByName   .= "<th>Edit</th>";
             $table_searchByName   .= "<th>Delete</th>";
             $table_searchByName  .= "</tr>";

             $sName = 1;


             while ($fetchSearchByName = mysqli_fetch_assoc($querySearchByName)) {
                

                $table_searchByName  .= "<tr>";
                $table_searchByName  .= "<td>{$sName}</td>";
                $sName++;
                $table_searchByName .= "<td>{$fetchSearchByName['storeAdmin_name']}</td>";
                $table_searchByName  .= "<td>{$fetchSearchByName['storeAdmin_username']}</td>";
                $table_searchByName  .= "<td>{$fetchSearchByName['storeAdmin_code']}</td>";
                $table_searchByName  .= "<td>{$fetchSearchByName['storeAdmin_dept']}</td>";
                $table_searchByName  .= "<td>{$fetchSearchByName['registration_date']}</td>";
                $table_searchByName  .= "<td><button><a href='edit-users.php?theUsersId=$fetchSearchByName[storeAdmin_id]'>Edit</a></button></td>";
                $table_searchByName .= "<form method='POST'>";
           $table_searchByName .= "<td><button type='submit' name='userDelBut' onclick ='return delUser()'>Delete</button></td>";
           $table_searchByName .= "<input type='hidden' name='storeAdmin_Idnumber' value='$fetchSearchByName[storeAdmin_id]'>";
           $table_searchByName .= "</form>";
                $table_searchByName  .= "</tr>";


             }

             $table_searchByName .= "</table>";
             echo $table_searchByName;


          }


   }
?>

<script type="text/javascript">
  function delUser() {
    var confirmDel = confirm("Are you sure you want to delete");

    if (confirmDel == true) {

      alert("File Record Deleted");
    }else{

      alert("File not Deleted");
    }

    return confirmDel;
  }
</script>