<?php


//define how many per pages

$per_pages = 10;

//find out the number of result stored in database

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

$numbers_of_result = mysqli_num_rows($queryTheAllFiles);


?>