<?php
require 'dbconfig.php';
// echo '<pre>' , print_r($_FILES) , '</pre>';
	$ProgramT=$_POST['ProgramTitle'];
	$sql=mysqli_query($con,"INSERT INTO tblsampleprogram values(DEFAULT,'$ProgramT','No Content')");
	$sql2=mysqli_query($con,"SELECT MAX(sampleProgramID) as sampleProgramID from tblsampleprogram");
	$row=mysqli_fetch_array($sql2);
	$id=$row['sampleProgramID'];
	if(!empty($_FILES['filesp_array']['name'][0]))
	{
		$files = $_FILES['filesp_array'];
		$uploaded = array();
		$failed = array();

		$allowed = array('jpeg','jpg','png');
		foreach ($files['name'] as $position => $file_name) 
		{
			$file_tmp=$files['tmp_name'][$position];
			$file_size=$files['size'][$position];
			$file_error=$files['error'][$position];
			$file_namd = $files['name'][$position];
			$file_ext = explode('.' , $file_name);
			$file_ext = strtolower(end($file_ext));
			if(in_array($file_ext,$allowed))
			{
				if($file_error === 0)
				{
					if($file_size <= 2097152001)
					{
						$file_name_new = uniqid('', true) . '.' . $file_ext;
						$file_destination = 'samplePrograms/' . $file_name_new;
						if(move_uploaded_file($file_tmp, $file_destination))
						{
							$uploaded[$position] = $file_destination;
							mysqli_query($con,"INSERT INTO tblprogramimages values(DEFAULT,$id,'$file_destination')");
							
						}
					}
				}
			}
		}	
	}
?>