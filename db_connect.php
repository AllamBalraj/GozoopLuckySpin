<?php
	
	include_once 'db_config.php';

	// Connecting to mysql database
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE)
         		or die(mysql_error());
?>