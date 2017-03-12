<?php
		require 'dbconfig.php';
		session_start();

		if(isset($_POST['updatepas']))
			{
				$aa = mysqli_query($con,"SELECT * from tbldean");
				$row = mysqli_fetch_array($aa);
				$oldpass= "{$_POST['old']}";
				$newpass="{$_POST['newp']}";
				$conf="{$_POST['conf']}";
				if($oldpass != $row['password'] || $newpass != $conf)
				{
					echo 0;
				}
				elseif($oldpass = $row['password'] && $newpass = $conf)
				{
					mysqli_query($con,"UPDATE tbldean set password = '$newpass' where DeanID = {$_SESSION['deanID']}");				
					echo 1;
				}
				exit();
			}
		if(isset($_POST['updateAccount']))
			{
				mysqli_query($con,"UPDATE tbldean set firstname='{$_POST['f']}',middlename='{$_POST['s']}',lastname='{$_POST['t']}',username='{$_POST['un']}' where DeanID={$_POST['accountID']}")
				exit();
			}
		if(isset($_POST['editAcc1']))
			{
				$sql=mysqli_query($con, "SELECT * from tbldean where DeanID = {$_POST['accountID']}");
				$row=mysqli_fetch_object($sql);
				header("Content-type: text/x-json");
				echo json_encode($row);
				exit();		
			}


?>