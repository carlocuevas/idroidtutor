<?php

	require 'dbconfig.php';
	if(isset($_POST['viewLessonsx']))
		{
			$sql=mysqli_query($con,"SELECT * from tblchapter where chapterID = {$_POST['ChaptID']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			
		}
	if(isset($_POST['viewLessonx']))
		{
			$sql=mysqli_query($con,"SELECT * from showeditabledata where ChapterID = {$_POST['ChaptsID']}");
									while($row=mysqli_fetch_array($sql))
										{
											
											?>

											<h4 class="text-light sub-header small">Lesson "<?php echo $row['LessonTitle']?>"</h4>
											<?php
													?>
														<table class="table">
														<tr>
															<td>
																Content
															</td>
															<td><?php echo $row['contents']?></td>
														</tr>
														<tr>
															<td>Video Title</td>
															<td><?php echo $row['videoTitle'];?></td>
														</tr>
														<tr>
															<td>PDF Title</td>
															<td><?php echo $row['pdfTitle'];?></td>
														</tr>
														</table>
											<br/>
											<hr class="bg-black"/>
													<?php			
											
										}
						exit();
		}


?>