<?php
	require 'dbconfig.php';
	if(isset($_POST['editChapter']))
		{
			$sql=mysqli_query($con,"SELECT * from tblchapter where chapterID = {$_POST['ideC']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['deleteChapter']))
		{

			mysqli_query($con,"DELETE from tblchapter where chapterID = {$_POST['chapterDel']}");
			
			
			$sql=mysqli_query($con,"SELECT * from tbllessons where ChapterID={$_POST['chapterDel']}");
			
			while($row=mysqli_fetch_array($sql))
			{
				mysqli_query($con,"DELETE from tblcontent where contentID = {$row['contentID']}");
				$sql2=mysqli_query($con,"SELECT * from tblcontentImage where contentImageID=$row{['contentID']}");
				while($row2=mysqli_fetch_array($sql2))
				{
					unlink($row2['ImageContentURL']);
					
				}
				mysqli_query($con,"DELETE from tblcontentImage where contetImage={$row['contentID']}");
				

			}		
			mysqli_query($con,"DELETE from tbllessons where ChapterID = {$_POST['chapterDel']}");	
			
			

			exit();	
		}
	if(isset($_POST['deleteChapter1']))
		{
			$sql=mysqli_query($con,"SELECT * from tblchapter where chapterID = {$_POST['DelCh']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['showChapter']))
		{
			?>
			<table class="hovered border dataTable"  id="DataTabs7" data-auto-width="true">
			                     <thead>
			                      			  <tr>
			                      			 	  <th>Chapter's Name</th>
			                      			 	  <th>Counted Lessons</th>
			                      			 	  <th>Chapter's Category</th>
			                      			 	  <th>Maintenance</th>

			                     		   </tr>
			                     	     </thead>
			                        <tbody >
			                        	<?php
			                        	$sql=mysqli_query($con,"SELECT * from tblchapter order by moduleTitle ASC");
			                        	while($row=mysqli_fetch_array($sql))
			                        	{
			                        		$sqlcount=mysqli_query($con,"SELECT count(*) as Counteds from tbllessons where ChapterID={$row['chapterID']} ");
			                        		$rowcount=mysqli_fetch_array($sqlcount);
			                        	?>
			                        	<tr>
			                        	  <td><?php echo $row['chapterTitle']?></td>
			                        	  <td><?php echo $rowcount['Counteds']?></td>
			                        	  <td><?php echo $row['moduleTitle']?></td>
									      <td>
									      			<div class="toolbar">
													 <button class="toolbar-button bg-darkBlue bg-active-blue fg-white ViewLesst" onClick="edit('#dialogViewLessons')" idVL="<?php echo $row['chapterID']; ?>"><span class="mif-eye icon" ></span></button>
											        <button class="toolbar-button bg-darkBlue bg-active-blue fg-white DelChapt" onClick="edit('#dialogDeleteConfirmationChapter');" idDelChapt="<?php echo $row['chapterID']; ?>"><span class="mif-bin icon" ></span></button>
											        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white EditChapter" onClick="edit('#dialogChapter')" idEditChapt="<?php echo $row['chapterID']; ?>"><span class="mif-pencil icon" ></span></button>
											         <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white AddNewLess" onClick="edit('#dialogAddLesson')" idNL="<?php echo $row['chapterID']; ?>"><span class="mif-plus icon" ></span></button>

											         </div>

										  </td>
			                        	</tr>
			                        	<?php
			                        	}

			                        	?>
			     			</tbody>
				</table>

			<script>

					$("#DataTabs7").dataTable({
						"order" : [[3,"asc"]],
					    "scrollCollapse": true,
					    'scrollY':"50vh",
					    'pagingType': 'full'
					    
					});

			</script>

			<?php
			exit(); 
		}
	if(isset($_POST['addNewChapters']))
		{
				mysqli_query($con,"INSERT INTO tblchapter values(DEFAULT,'{$_POST['ChapterName']}','{$_POST['Category']}')");

			exit();
		}
	if(isset($_POST['updateChapter']))
		{
			mysqli_query($con,"UPDATE tblchapter set chapterTitle = '{$_POST['ChapTitle']}' where chapterID = {$_POST['pkey']}");
	 		exit();	
		}
	if(isset($_POST['withLessons']))
		{
			?>
			<table class="table">
						<tbody>
			<?php	
			$sql=mysqli_query($con,"SELECT * from tbllessons where ChapterID={$_POST['ideCA']}");
			while($row=mysqli_fetch_array($sql))
			{
			?>

							<tr>
							<td><?php echo $row['LessonTitle'];?></td>
							<td>
				      			<div class="toolbar">
							        <button class="toolbar-button bg-darkBlue bg-active-blue fg-white DelLis" onClick="edit('#dialogDeleteConfirmationLisson');" idDelLess="<?php echo $row['lessonID']; ?>"><span class="mif-bin icon" ></span></button>
							         <button class="toolbar-button bg-darkBlue bg-active-blue fg-white EditLessons" onClick="edit('#dialogEditLessons')" idEditLesson="<?php echo $row['lessonID']; ?>"><span class="mif-pencil icon" ></span></button>
						         </div>
							</td>
							</tr>
			<?php
			}
			?>
						</tbody>
					</table>
			<?php	
		exit();
		}

?>