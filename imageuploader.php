<?php
require 'dbconfig.php';
				session_start();
				//File Properties
				$content=$_POST['ContentArea'];
				$sqlid=mysqli_query($con,"INSERT INTO tblcontent values(DEFAULT,'$content')");
				$id=mysqli_insert_id($con);
				$chapterID=$_POST['ChaptersID'];
				$LessonName=$_POST['LessonName'];
				$SelectorPDF=$_POST['ishavingapdf'];
				$SelectorVid=$_POST['ishavingavid'];
				$SelectorImg=$_POST['ishavingimage'];
				if($SelectorPDF == "No")
				{
					$PDF=0;
				}
				else
				{
					$PDF=$_POST['PDFSelection'];
				}
				if($SelectorVid == "No")
				{
					$Video=0;
				}
				else
				{
					$Video=$_POST['videoOption'];
				}
					if(!empty($_FILES['ImageFile']['name'][0]))
						{
							$files = $_FILES['ImageFile'];
							$uploaded = array();
							$failed = array();

							$allowed = array('png','jpeg','jpg');
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
											$file_destination = 'contentImage/' . $file_name_new;
											if(move_uploaded_file($file_tmp, $file_destination))
											{
												$uploaded[$position] = $file_destination;
												mysqli_query($con,"INSERT INTO tblcontentImage values(DEFAULT , {$id} , '$file_destination')");
											}
										}
									}
								}
							}	
						}
					else
					{
						
						$file_destination="No Image";

						mysqli_query($con,"INSERT INTO tblcontentImage values(DEFAULT , 0 , '$file_destination')");
					}

	if(!empty($_FILES['ImageFile']['name'][0]))
	{
	mysqli_query($con,"INSERT INTO tbllessons values(DEFAULT,$chapterID,'$LessonName', {$id} ,$PDF,$Video,{$id},'$SelectorPDF','$SelectorVid','No','$SelectorImg')");
	}
	else{
		mysqli_query($con,"INSERT INTO tbllessons values(DEFAULT,$chapterID,'$LessonName', 0 ,$PDF,$Video,{$id},'$SelectorPDF','$SelectorVid','No','$SelectorImg')");
	
	}
?>