// 제출하는 거는 아님. php, html 테스트용 넣어놓음!

<?php

	// collect login variable values
	include 'conf.php';  

	// attempt to create a connection to db
	$conn = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

	// report whether failure or success
	if ($conn->connect_errno) {
	   echo("Connect failed: \n".$conn->connect_error);
	   exit();

	   // now $conn contains a connection to dbase we can use - we'll close it
	   // in another php script after we use it to execute some SQL statements
	}

?>
