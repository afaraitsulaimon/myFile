<?php
    define('DBSERVER', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBNAME', 'myfile');


//CONNECT TO THE SERVER USING THE SERVER,USER AND THE PASSWORD

    $connection = mysqli_connect(DBSERVER,DBUSER,DBPASS);

    if (!$connection) {
    	
    	die("could not connect to server" .mysqli_error($connection));
    }

   //CONNECT THE DATABASE

    $database_conn = mysqli_select_db($connection, DBNAME);

    if (!$database_conn) {
    	
    	die("could not connect to database" .mysqli_error($connection));
    }
?>