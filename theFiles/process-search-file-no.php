<?php
   if (isset($_POST['findFileBut'])) {
   	   
   	   $searchUsingFileNoErr = array();

   	   $theSearchUsingFileNo = sanitize($_POST['searchUsingFileNo']);



   	   if (!empty($searchUsingFileNo) && $searchUsingFileNo <= 5) {
   	   	$searchUsingFileNoErr[] = "Enter correct file number";
   	   }



   	   $pickerId = storeAdminLogin();

   	   $pickerDet = "SELECT * FROM store_admin WHERE storeAdmin_id = $pickerId";

   	   $queryPickerDet = mysqli_query($connection,$pickerDet);

   	   if (!$queryPickerDet) {
   	                               
   	    die("could not query QUERY PICKER DET ".mysqli_error($connection));
   	    }

   	    $fetchPickerDet = mysqli_fetch_assoc($queryPickerDet);


   	    $pickerDept = $fetchPickerDet['storeAdmin_dept'];


   	   $allTheFiles = "SELECT * FROM file_details WHERE department = '$pickerDept' AND file_no  = '$theSearchUsingFileNo' ";

   	   $queryAllTheFiles = mysqli_query($connection,$allTheFiles);

   	   if (!$queryAllTheFiles) {
   	   	
   	   	  die("could not query QUERY ALL THE FILES ".mysqli_error($connection));
   	   }

       $numAllTheFiles = mysqli_num_rows($queryAllTheFiles);

       

   	   $fetchAllTheFiles = mysqli_fetch_assoc($queryAllTheFiles);


   	   $fileNoInSearch = $fetchAllTheFiles['file_no'];

   	   if ($theSearchUsingFileNo !== $fileNoInSearch) {
   	   	
   	   	  $searchUsingFileNoErr[] = "File Number does not exist";
   	   }elseif (empty($searchUsingFileNoErr) && $theSearchUsingFileNo == $fileNoInSearch) {


   	   	$pickTheSearch = "SELECT * FROM file_details WHERE department = '$pickerDept' AND file_no  = '$theSearchUsingFileNo' ";

       $queryPickTheSearch =mysqli_query($connection,$pickTheSearch);

       if (!$queryPickTheSearch) {
       	
       	die("could not query QUERY PICK THE SEARCH " .mysqli_error($connection));
       }


       $numberOfFoundFile = mysqli_num_rows($queryPickTheSearch);

       $table = "<table class='table table-striped table-bordered mt-4'>";
       $table .= "<tr>";
       $table .= "<th>S/N</th>";
       $table .= "<th>File Number</th>";
       $table .= "<th>File Picker</th>";
       $table .= "<th>File User</th>";
       $table .= "<th>Department</th>";
       $table .= "<th>Date Picked</th>";
       $table .= "<th>Edit</th>";
       $table .= "<th>Delete</th>";
       $table .= "</tr>";

       $sNums = 1;

       while ($fetchFoundFile = mysqli_fetch_assoc($queryPickTheSearch)) {

       	$table .= "<tr>";
       	$table .= "<td>{$sNums}</td>";
        $sNums++;
        
       	$table .= "<td>{$fetchFoundFile['file_no']}</td>";
       	$table .= "<td>{$fetchFoundFile['file_picker']}</td>";
       	$table .= "<td>{$fetchFoundFile['file_user']}</td>";
       	$table .= "<td>{$fetchFoundFile['department']}</td>";
       	$table .= "<td>{$fetchFoundFile['picked_date']}</td>";
       	$table .= "<td><a href='edit-file.php?theEditFileId=$fetchFoundFile[file_id]'><button>Edit</button></a></td>";
       	$table .= "<form method='POST'>";
           $table .= "<td><button type='submit' name='fileDelBut' onclick ='return delFiles()'>Delete</button></td>";
           $table .= "<input type='hidden' name='files_Idnumber' value='$fetchFoundFile[file_id]'>";
           $table .= "</form>";
       	$table .= "</tr>";
       	
       }

                  $table .= "</table>";

         	         echo $table;

   	   }

   	   
   }
?>