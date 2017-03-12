<?php


	require 'dbconfig.php';
if(isset($_POST['showExercise']))
	{
		?>
		<table class="table"  id="DataTabs20">
				                     <thead>
			                      			  <tr> 
													  <th>Exercise Title</th>
													  <th>Maintenance</th>


				                     		   </tr>
				                     	     </thead>
				                        <tbody >
				                        	<?php
				                        	$sql=mysqli_query($con,"SELECT * From tblexercises");
				                        	while($row=mysqli_fetch_array($sql))
				                        	{
				                        		
				                        	?>
				                        	<tr>
				                    		  <td><?php echo $row['exerciseTitle'];?></td>
										      <td><div class="toolbar">
														<button class="toolbar-button bg-darkBlue bg-active-blue fg-white ViewExercises" onClick="edit('#dialogViewExercises')" idVEx="<?php echo $row['exerciseID']; ?>"><span class="mif-eye icon" ></span></button>	      
												        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white DeleteExercise" onclick="edit(dialogDeleteConfirmationExercise)" idDelEX= "<?php echo $row['exerciseID'];?>"><span class="mif-bin icon" ></span></button>
												        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white EditExercise" onClick="edit(dialogEditSampleExercise)" idEditEx='<?php echo $row['exerciseID'];?> '><span class="mif-pencil icon" ></span></button>
												     </div>
											  </td>
				                        	</tr>
				                        	<?php
				                        	}

				                        	?>
				     			</tbody>
					</table>

				<script>

						$("#DataTabs20").dataTable({
						    scrollY:"53vh",
						    pagingType: 'full',
						   	responsive : true
						    
						});

				</script>
		<?php
		exit();
	}
	if(isset($_POST['viewExercise']))
		{
			$sql=mysqli_query($con,"SELECT * from tblexercises where exerciseID={$_POST['exercise']}");
			while($row=mysqli_fetch_array($sql))
			{
			?>
				<h3 class="text-light header">Exercise Title : <?php echo $row['exerciseTitle']?></h3>
				<table class="table">
					<tr><td>Exercise Content</td>
					<td><?php echo $row['exerciseContent']?></td>
					</tr>

				</table>
			<?php
			}
			exit();
		}
	if(isset($_POST['editExercise']))
		{
			$sql=mysqli_query($con,"SELECT * from tblexercises where exerciseID = {$_POST['exercise']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['deleteExercise']))
		{
			$sql=mysqli_query($con,"SELECT * from tblexercises where exerciseID = {$_POST['exercise']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['deleteExercise1']))
		{
			mysqli_query($con,"DELETE from tblexercises where exerciseID={$_POST['exercise']}");
			exit();			
		}
	if(isset($_POST['updateExe']))
		{
			mysqli_query($con,"UPDATE tblexercises set exerciseTitle = '{$_POST['exerciseT']}',exerciseContent='{$_POST['exercisesContent']}' where exerciseID={$_POST['exerciseid']}");
			exit();			
		}
?>