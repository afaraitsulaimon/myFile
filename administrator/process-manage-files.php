<?php
   if (isset($_POST['manFileSearchBut']) || isset($_GET['paginate'])) {
   	    
   	    $errManageFiles = array();

   	    if (isset($_POST['man_FileDept']) && $_POST['man_FileDept'] == 'allFiles' || isset($_GET['paginate'])) {
   	    


   	    	$allTheFiles = "SELECT * FROM file_details";



   	    	$queryAllTheFiles = mysqli_query($connection,$allTheFiles);

   	    	if (!$queryAllTheFiles) {
   	    		
   	    		die("could not query QUERY ALL THE FILES" .mysqli_error($connection));
   	    	}


   	    	$rowsOfAllFiles = mysqli_num_rows($queryAllTheFiles);

          //define how many per page

          $per_pages = 5;

           $numbers_of_pages = ceil($rowsOfAllFiles/$per_pages);
          
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

           $page_first_result = ($page-1) * $per_pages;

           $allOfTheFiles = "SELECT * FROM file_details LIMIT " . $page_first_result . ',' . $per_pages ;

     

           $queryOfAllTheFiles = mysqli_query($connection, $allOfTheFiles);

           $nosOfAllTheFiles = mysqli_num_rows($queryOfAllTheFiles);

           




   	    	$table = "<table class='table-striped table-bordered' align='center'>";
   	    	$table .= "<tr>";
   	    	$table .= "<th>S/N</th>";
   	    	$table .= "<th>File Number</th>";
   	    	$table .= "<th>Picker Name</th>";
   	    	$table .= "<th>File User</th>";
   	    	$table .= "<th>Department</th>";
   	    	$table .= "<th>Date</th>";
   	    	$table .= "</tr>";



        $i =1;

   	    	while ($fetchAllFiles = mysqli_fetch_assoc($queryOfAllTheFiles)) {

             

   	    		$table .= "<tr>";
            $table .=  "<td>{$i}</td>"; 
              $i++;
   	    		$table .= "<td>{$fetchAllFiles['file_no']}</td>";
   	    		$table .= "<td>{$fetchAllFiles['file_picker']}</td>";
   	    		$table .= "<td>{$fetchAllFiles['file_user']}</td>";
   	    		$table .= "<td>{$fetchAllFiles['department']}</td>";
   	    		$table .= "<td>{$fetchAllFiles['picked_date']}</td>";
           
   	    		$table .= "</tr>";

           


   	    	}

   	    	$table .= "</table>";

   	    	echo $table;


          //displaying the links to the pages
          
          for ($page = 1; $page <= $numbers_of_pages ; $page++) { 

               echo '<button><a href="manage-files.php?page='. $page . '&paginate">'. $page .'</a></button>';
              }       



   	    }elseif($_POST['man_FileDept'] == 'LC') {
   	    	


   	    	$lcFiles = "SELECT * FROM file_details WHERE department = 'LC' ";

   	    	$queryLcFiles = mysqli_query($connection,$lcFiles);

   	    	if (!$queryLcFiles) {
   	    		
   	    		die("could not query QUERY LC FILES" .mysqli_error($connection));
   	    	}

         

   	    	$rowsOfLcFiles = mysqli_num_rows($queryLcFiles);

   	    	$table = "<table class='table-striped table-bordered' align='center'>";
   	    	$table .= "<tr>";
   	    	$table .= "<th>S/N</th>";
   	    	$table .= "<th>File Number</th>";
          $table .= "<th>Picker Name</th>";
          $table .= "<th>File User</th>";
          $table .= "<th>Department</th>";
          $table .= "<th>Date</th>";
          $table .= "<th>Edit</th>";
          $table .= "<th>Delete</th>";
   	    	$table .= "</tr>";

          $a =1;

   	    	while ($fetchLcFiles = mysqli_fetch_assoc($queryLcFiles)) {
   	    		
   	    		$table .= "<tr>";
   	    		$table .= "<td>{$a}</td>";
            $a++;
   	    		$table .= "<td>{$fetchLcFiles['file_no']}</td>";
   	    		$table .= "<td>{$fetchLcFiles['file_picker']}</td>";
   	    		$table .= "<td>{$fetchLcFiles['file_user']}</td>";
   	    		$table .= "<td>{$fetchLcFiles['department']}</td>";
   	    		$table .= "<td>{$fetchLcFiles['picked_date']}</td>";
            $table .= "<td><button><a href='edit-file.php?theFilesId=$fetchLcFiles[file_id]'>Edit</a></button></td>";


                $table .= "<form method='POST'>";
            $table .= "<td><button type='submit' name='fileDelBut' onclick ='return delFile()'>Delete</button></td>";
            $table .= "<input type='hidden' name='file_Idnumber' value='$fetchLcFiles[file_id]'>";
            $table .= "</form>";
   	    		$table .= "</tr>";


   	    	}

   	    	$table .= "</table>";
   	    	echo $table;

   	    }elseif($_POST['man_FileDept'] == 'Bills') {
   	    	

   	    	$billsFiles = "SELECT * FROM file_details WHERE department = 'Bills' ";


   	    	$queryBillsFiles = mysqli_query($connection,$billsFiles);

   	    	if (!$queryBillsFiles) {
   	    		
   	    		die("could not query QUERY BILLS FILES" .mysqli_error($connection));
   	    	}


   	    	$rowsOfBillsFiles = mysqli_num_rows($queryBillsFiles);

   	    	$table_bills = "<table class='table-striped table-bordered' align='center'>";
   	    	$table_bills  .= "<tr>";
   	    	$table_bills  .= "<th>S/N</th>";
   	    	$table_bills .= "<th>File Number</th>";
          $table_bills .= "<th>Picker Name</th>";
          $table_bills .= "<th>File User</th>";
          $table_bills .= "<th>Department</th>";
          $table_bills .= "<th>Date</th>";
          $table_bills .= "<th>Edit</th>";
          $table_bills .= "<th>Delete</th>";
   	    	$table_bills  .= "</tr>";

        $b =1;
   	    	while ($fetchBillsFiles = mysqli_fetch_assoc($queryBillsFiles)) {
   	    		
   	    		  $table_bills .= "<tr>";
            $table_bills .= "<td>{$b}</td>";

            $b++;
            $table_bills .= "<td>{$fetchBillsFiles['file_no']}</td>";
            $table_bills .= "<td>{$fetchBillsFiles['file_picker']}</td>";
            $table_bills .= "<td>{$fetchBillsFiles['file_user']}</td>";
            $table_bills .= "<td>{$fetchBillsFiles['department']}</td>";
            $table_bills .= "<td>{$fetchBillsFiles['picked_date']}</td>";
            $table_bills .= "<td><button><a href='edit-file.php?theFilesId=$fetchBillsFiles[file_id]'>Edit</a></button></td>";
              $table_bills .= "<form method='POST'>";
            $table_bills .= "<td><button type='submit' name='fileDelBut' onclick ='return delFile()'>Delete</button></td>";
            $table_bills .= "<input type='hidden' name='file_Idnumber' value='$fetchBillsFiles[file_id]'>";
            $table_bills .= "</form>";
            $table_bills .= "</tr>";


   	    	}

   	    	$table_bills  .= "</table>";
   	    	echo $table_bills;

   	    }elseif($_POST['man_FileDept'] == 'Non-valid') {
            

            $nonValidFiles = "SELECT * FROM file_details WHERE department = 'Non-valid' ";


            $queryNonValidFiles = mysqli_query($connection,$nonValidFiles);

            if (!$queryNonValidFiles) {
               
               die("could not query QUERY NON VALID FILES" .mysqli_error($connection));
            }


            $rowsOfNonValidFiles = mysqli_num_rows($queryNonValidFiles);

            $table_nonValid = "<table class='table-striped table-bordered' align='center'>";
            $table_nonValid  .= "<tr>";
            $table_nonValid  .= "<th>S/N</th>";
            $table_nonValid .= "<th>File Number</th>";
            $table_nonValid .= "<th>Picker Name</th>";
            $table_nonValid .= "<th>File User</th>";
            $table_nonValid .= "<th>Department</th>";
            $table_nonValid .= "<th>Date</th>";
            $table_nonValid  .= "<th>Edit</th>";
            $table_nonValid  .= "<th>Delete</th>";
            $table_nonValid  .= "</tr>";
     $n = 1;


            while ($fetchNonValidFiles = mysqli_fetch_assoc($queryNonValidFiles)) {
               
              $table_nonValid .= "<tr>";
            $table_nonValid .= "<td>{$n}</td>";
            $n++;
            $table_nonValid .= "<td>{$fetchNonValidFiles['file_no']}</td>";
            $table_nonValid .= "<td>{$fetchNonValidFiles['file_picker']}</td>";
            $table_nonValid .= "<td>{$fetchNonValidFiles['file_user']}</td>";
            $table_nonValid .= "<td>{$fetchNonValidFiles['department']}</td>";
            $table_nonValid .= "<td>{$fetchNonValidFiles['picked_date']}</td>";
            $table_nonValid .= "<td><button><a href='edit-file.php?theFilesId=$fetchNonValidFiles[file_id]'>Edit</a></button></td>";
              $table_nonValid .= "<form method='POST'>";
            $table_nonValid .= "<td><button type='submit' name='fileDelBut' onclick ='return delFile()'>Delete</button></td>";
            $table_nonValid .= "<input type='hidden' name='file_Idnumber' value='$fetchNonValidFiles[file_id]'>";
            $table_nonValid .= "</form>";
            $table_nonValid .= "</tr>";



            }

            $table_nonValid  .= "</table>";
            echo $table_nonValid;

          }elseif($_POST['man_FileDept'] == 'Export') {
            

            $exportFiles = "SELECT * FROM file_details WHERE department = 'Export' ";


            $queryExportFiles = mysqli_query($connection,$exportFiles);

            if (!$queryExportFiles) {
               
               die("could not query QUERY EXPORT FILES" .mysqli_error($connection));
            }


            $rowsOfExportFiles = mysqli_num_rows($queryExportFiles);

            $table_Export = "<table class='table-striped table-bordered' align='center'>";
            $table_Export  .= "<tr>";
            $table_Export  .= "<th>S/N</th>";
            $table_Export  .= "<th>File Number</th>";
            $table_Export  .= "<th>Picker Name</th>";
            $table_Export  .= "<th>File User</th>";
            $table_Export  .= "<th>Department</th>";
            $table_Export  .= "<th>Date</th>";
            $table_Export  .= "<th>Edit</th>";
            $table_Export  .= "<th>Delete</th>";
            $table_Export  .= "</tr>";

           $e =1;
            while ($fetchExportFiles = mysqli_fetch_assoc($queryExportFiles)) {
               
                 $table_Export .= "<tr>";
               $table_Export .= "<td>{$e}</td>";
               $e++;
               $table_Export .= "<td>{$fetchExportFiles['file_no']}</td>";
               $table_Export .= "<td>{$fetchExportFiles['file_picker']}</td>";
               $table_Export .= "<td>{$fetchExportFiles['file_user']}</td>";
               $table_Export .= "<td>{$fetchExportFiles['department']}</td>";
               $table_Export .= "<td>{$fetchExportFiles['picked_date']}</td>";
               $table_Export .= "<td><button><a href='edit-file.php?theFilesId=$fetchExportFiles[file_id]'>Edit</a></button></td>";
                 $table_Export .= "<form method='POST'>";
               $table_Export .= "<td><button type='submit' name='fileDelBut' onclick ='return delFile()'>Delete</button></td>";
               $table_Export .= "<input type='hidden' name='file_Idnumber' value='$fetchExportFiles[file_id]'>";
               $table_Export .= "</form>";
               $table_Export .= "</tr>";


            }

            $table_Export  .= "</table>";
            echo $table_Export;

          }elseif($_POST['man_FileDept'] == 'Invisible') {
            

            $invisibleFiles = "SELECT * FROM file_details WHERE department = 'Invisible' ";


            $queryInvisibleFiles = mysqli_query($connection,$invisibleFiles);

            if (!$queryInvisibleFiles) {
               
               die("could not query QUERY INVISIBLE FILES" .mysqli_error($connection));
            }


            $rowsOfInvisibleFiles = mysqli_num_rows($queryInvisibleFiles);

            $table_Invisible = "<table class='table-striped table-bordered' align='center'>";
            $table_Invisible  .= "<tr>";
            $table_Invisible  .= "<th>S/N</th>";
            $table_Invisible .= "<th>File Number</th>";
            $table_Invisible .= "<th>Picker Name</th>";
            $table_Invisible .= "<th>File User</th>";
            $table_Invisible .= "<th>Department</th>";
            $table_Invisible .= "<th>Date</th>";
            $table_Invisible  .= "<th>Edit</th>";
            $table_Invisible  .= "<th>Delete</th>";
            $table_Invisible  .= "</tr>";

            $inv = 1;

            while ($fetchInvisibleFiles = mysqli_fetch_assoc($queryInvisibleFiles)) {
               
                 $table_Invisible .= "<tr>";
               $table_Invisible .= "<td>{$inv}</td>";
               $inv++;

               $table_Invisible .= "<td>{$fetchInvisibleFiles['file_no']}</td>";
               $table_Invisible .= "<td>{$fetchInvisibleFiles['file_picker']}</td>";
               $table_Invisible .= "<td>{$fetchInvisibleFiles['file_user']}</td>";
               $table_Invisible .= "<td>{$fetchInvisibleFiles['department']}</td>";
               $table_Invisible .= "<td>{$fetchInvisibleFiles['picked_date']}</td>";
               $table_Invisible .= "<td><button><a href='edit-file.php?theFilesId=$fetchInvisibleFiles[file_id]'>Edit</a></button></td>";
                 $table_Invisible .= "<form method='POST'>";
               $table_Invisible .= "<td><button type='submit' name='fileDelBut' onclick ='return delFile()'>Delete</button></td>";
               $table_Invisible .= "<input type='hidden' name='file_Idnumber' value='$fetchInvisibleFiles[file_id]'>";
               $table_Invisible .= "</form>";
               $table_Invisible .= "</tr>";


            }

            $table_Invisible  .= "</table>";
            echo $table_Invisible;


          }elseif (sanitize($_POST['man_fileNo'])) {

            $searchFileNo = mysqli_real_escape_string($connection,$_POST['man_fileNo']);
             
             $searchByFileNo = "SELECT * FROM file_details WHERE file_no LIKE '%$searchFileNo%' ";

             $querySearchByFileNo = mysqli_query($connection,$searchByFileNo);

             if (!$querySearchByFileNo) {
                
                die("could not query QUERY SEARCH BY FILE NUMBER" .mysqli_error($connection));
             }


             $rowSeachByFileNo = mysqli_num_rows($querySearchByFileNo);

             $table_searchByFileNo= "<table class='table-striped table-bordered' align='center'>";
             $table_searchByFileNo  .= "<tr>";
             $table_searchByFileNo  .= "<th>S/N</th>";
             $table_searchByFileNo .= "<th>File Number</th>";
             $table_searchByFileNo .= "<th>Picker Name</th>";
             $table_searchByFileNo .= "<th>File User</th>";
             $table_searchByFileNo .= "<th>Department</th>";
             $table_searchByFileNo .= "<th>Date</th>";
             $table_searchByFileNo   .= "<th>Edit</th>";
             $table_searchByFileNo   .= "<th>Delete</th>";
             $table_searchByFileNo  .= "</tr>";

             $sNo = 1;

             while ($fetchSearchByFileNo = mysqli_fetch_assoc($querySearchByFileNo)) {
                

                 $table_searchByFileNo .= "<tr>";
               $table_searchByFileNo .= "<td>{$sNo}</td>";
               $sNo++;
               $table_searchByFileNo .= "<td>{$fetchSearchByFileNo['file_no']}</td>";
               $table_searchByFileNo .= "<td>{$fetchSearchByFileNo['file_picker']}</td>";
               $table_searchByFileNo .= "<td>{$fetchSearchByFileNo['file_user']}</td>";
               $table_searchByFileNo .= "<td>{$fetchSearchByFileNo['department']}</td>";
               $table_searchByFileNo .= "<td>{$fetchSearchByFileNo['picked_date']}</td>";
               $table_searchByFileNo .= "<td><button><a href='edit-file.php?theFilesId=$fetchSearchByFileNo[file_id]'>Edit</a></button></td>";
                 $table_searchByFileNo .= "<form method='POST'>";
               $table_searchByFileNo .= "<td><button type='submit' name='fileDelBut' onclick ='return delFile()'>Delete</button></td>";
               $table_searchByFileNo .= "<input type='hidden' name='file_Idnumber' value='$fetchSearchByFileNo[file_id]'>";
               $table_searchByFileNo .= "</form>";
               $table_searchByFileNo .= "</tr>";


             }

             $table_searchByFileNo .= "</table>";
             echo $table_searchByFileNo;


          }


   }
?>

<script type="text/javascript">
  function delFile() {
    var confirmDel = confirm("Are you sure you want to delete");

    if (confirmDel == true) {

      alert("File Record Deleted");
    }else{

      alert("File not Deleted");
    }

    return confirmDel;
  }
</script>