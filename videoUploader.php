<?php
require 'dbconfig.php';

				//File Properties
				$file=$_FILES['file'];
				$file_name = $file['name'];
				$file_tmp = $file['tmp_name'];
				$file_size = $file['size'];
				$file_error = $file['error'];

				//Work out the file Extension
				$file_ext = explode('.',$file_name);
				$file_ext = strtolower(end($file_ext));
				$allowed = array('mp4','avi','wmv');
				if(in_array($file_ext, $allowed))
				{
					if($file_error === 0)
					{
						if($file_size <= 2097152001)
						{
							$file_name_new = uniqid('',true) . '.' . $file_ext;
							$file_destination = 'videos/' . $file_name_new;
							if(move_uploaded_file($file_tmp, $file_destination))
							{
								$file_namd=$_POST['vidTitle'];
								mysqli_query($con, "INSERT INTO tblvideos values(DEFAULT ,'$file_destination', '$file_namd')");
							}

						}
					}
				}


?>