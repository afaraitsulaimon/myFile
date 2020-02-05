<?php
    if (isset($_POST['findFileBut']) || isset($_GET['paginate'])){


      
      if ((isset($_POST['searchFiles']) && $_POST['searchFiles'] == 'allFiles')
      || isset($_GET['paginate']))  {
        
        $pickerId = storeAdminLogin();

        $pickerDet = "SELECT * FROM store_admin WHERE storeAdmin_id = $pickerId";

        $queryPickerDet = mysqli_query($connection,$pickerDet);

        if (!$queryPickerDet) {
                                    
         die("could not query QUERY PICKER DET ".mysqli_error($connection));
         }

         $fetchPickerDet = mysqli_fetch_assoc($queryPickerDet);

         $pickerDept = $fetchPickerDet['storeAdmin_dept'];

         $theAllFiles = "SELECT * FROM file_details WHERE department = '$pickerDept' ";

         $queryTheAllFiles = mysqli_query($connection, $theAllFiles);

         if (!$queryTheAllFiles) {
          
          die("could not query QUERY THE ALL FILES" .mysqli_error($connection));
         }


         $numOfAllFiles = mysqli_num_rows($queryTheAllFiles);
         
         //define how many per page

         $per_pages = 10;

         //numbers of total pages available

           $numbers_of_pages = ceil($numOfAllFiles/$per_pages);
         
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

           $allTheFiles = "SELECT * FROM file_details WHERE department = '$pickerDept' LIMIT " . $page_first_result . ',' . $per_pages ;



           $queryAllTheFiles = mysqli_query($connection, $allTheFiles);


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


             $i = $per_pages - 1;

             $serialNumber = ($per_pages * $page) - $i;

              while ($fetchAllTheFiles = mysqli_fetch_assoc($queryAllTheFiles)) {
                  
                $table .= "<tr>";
                $table .= "<td>{$serialNumber}</td>";
                $serialNumber++;
                $table .= "<td>{$fetchAllTheFiles['file_no']}</td>";
                $table .= "<td>{$fetchAllTheFiles['file_picker']}</td>";
                $table .= "<td>{$fetchAllTheFiles['file_user']}</td>";
                $table .= "<td>{$fetchAllTheFiles['department']}</td>";
                $table .= "<td>{$fetchAllTheFiles['picked_date']}</td>";
                $table .= "<td><a href='edit-file.php?theEditFileId=$fetchAllTheFiles[file_id]'><button>Edit</button></a></td>";
                 $table .= "<form method='POST'>";
                 $table .= "<td><button type='submit' name='fileDelBut' onclick ='return delFiles()'>Delete</button></td>";
                 $table .= "<input type='hidden' name='files_Idnumber' value='$fetchAllTheFiles[file_id]'>";
                 $table .= "</form>";
                $table .= "</tr>";


                   }
                    
                   $table .= "</table>";

                   echo $table;

            //displaying the links to the pages
            
            for ($page = 1; $page <= $numbers_of_pages ; $page++) { 

                 echo '<button><a href="search-file.php?page='. $page . '&paginate">'. $page .'</a></button>';
                }       


      }elseif (isset($_POST['searchFiles']) == '$fetchNameOfPicker[storeAdmin_name]') {
        
         $pickerId = storeAdminLogin();

        $pickerDet = "SELECT * FROM store_admin WHERE storeAdmin_id = $pickerId";


        $queryPickerDet = mysqli_query($connection,$pickerDet);

        if (!$queryPickerDet) {
                                    
         die("could not query QUERY PICKER DET ".mysqli_error($connection));
         }

         $fetchPickerDet = mysqli_fetch_assoc($queryPickerDet);


         $pickerDept = $fetchPickerDet['storeAdmin_dept'];

         $eachPickerFile = "SELECT * FROM file_details WHERE department = '$pickerDept' AND file_picker = '". $_POST['searchFiles'] ."' ";
         
         
         $queryEachPickerFile = mysqli_query($connection,$eachPickerFile);

         if (!$queryEachPickerFile) {
           
           die("could not die QUERY EACH PICKER FILE ".mysqli_error($connection));
         }


         $numOfEachPickerFile = mysqli_num_rows($queryEachPickerFile);


         $table = "<table class='table table-striped table-bordered mt-4'>";
         $table .= "<tr>";
         $table .= "<th>S/N</th>";
         $table .= "<th>File Number</th>";
         $table .= "<th>File Picker</th>";
         $table .= "<th>File User</th>";
         $table .= "<th>Department</th>";
         $table .= "<th>Picked Date</th>";
         $table .= "<th>Edit</th>";
         $table .= "<th>Delete</th>";
         $table .= "</tr>";

         $serialNumPicker = 1;

         while ($fetchEachFileOfPicker = mysqli_fetch_assoc($queryEachPickerFile)) {
           
           $table .= "<tr>";
           $table .= "<td>{$serialNumPicker}</td>";
           $serialNumPicker++;
           $table .= "<td>{$fetchEachFileOfPicker['file_no']}</td>";
           $table .= "<td>{$fetchEachFileOfPicker['file_picker']}</td>";
           $table .= "<td>{$fetchEachFileOfPicker['file_user']}</td>";
           $table .= "<td>{$fetchEachFileOfPicker['department']}</td>";
           $table .= "<td>{$fetchEachFileOfPicker['picked_date']}</td>";
           $table .= "<td><a href='edit-file.php?theEditFileId=$fetchEachFileOfPicker[file_id]'><button>Edit</button></a></td>";
           $table .= "<form method='POST'>";
           $table .= "<td><button type='submit' name='fileDelBut' onclick ='return delFiles()'>Delete</button></td>";
           $table .= "<input type='hidden' name='files_Idnumber' value='$fetchEachFileOfPicker[file_id]'>";
           $table .= "</form>";
           $table .= "</tr>";
         }

         $table .= "</table>";
         echo $table;
         





      }




    }
?>

<script type="text/javascript">
  function delFiles() {
    var delConfirmation = confirm("Are you sure you want to delete");

    if (delConfirmation == true) {

      alert("File Record Deleted");
    }else{

      alert("File not Deleted");
    }

    return delConfirmation;
  }
</script>