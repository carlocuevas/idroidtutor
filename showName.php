<?php

	require 'dbconfig.php';
	if(isset($_POST['showsName']))
	{
			$sql=mysqli_query($con, "SELECT * from tbldean where DeanID = {$_POST['deanID']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();			
	}
	
?>