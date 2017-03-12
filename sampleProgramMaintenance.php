<?php

require 'dbconfig.php';
if(isset($_POST['showPrograms']))
	{
		?>
				<table class="table"  id="DataTabs10">
				                     <thead>
			                      			  <tr> 
													  <th>Program Title</th>
													  <th>Maintenance</th>


				                     		   </tr>
				                     	     </thead>
				                        <tbody >
				                        	<?php
				                        	$sql=mysqli_query($con,"SELECT * From tblsampleprogram");
				                        	while($row=mysqli_fetch_array($sql))
				                        	{
				                        		
				                        	?>
				                        	<tr>
				                    		  <td><?php echo $row['programTitle'];?></td>
										      <td><div class="toolbar">
														<button class="toolbar-button bg-darkBlue bg-active-blue fg-white ViewPrograms" onClick="edit('#dialogViewPrograms')" idVP="<?php echo $row['sampleProgramID']; ?>"><span class="mif-eye icon" ></span></button>								      
												        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white DelProg" onclick="edit(dialogDeleteConfirmationProgram)" idDelProg= "<?php echo $row['sampleProgramID'];?>"><span class="mif-bin icon" ></span></button>
												        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white EditProg" onClick="edit(dialogEditSampleProgram)" idEditP='<?php echo $row['sampleProgramID'];?> '><span class="mif-pencil icon" ></span></button>
												     </div>
											  </td>
				                        	</tr>
				                        	<?php
				                        	}

				                        	?>
				     			</tbody>
					</table>

				<script>

						$("#DataTabs10").dataTable({
						    scrollY:"53vh",
						    pagingType: 'full',
						   	responsive : true
						    
						});

				</script>
		<?php
		exit();
	}
if(isset($_POST['delProg']))
	{
		$sql=mysqli_query($con, "SELECT * from tblsampleprogram where sampleProgramID = {$_POST['iDelProg']}");
		$row=mysqli_fetch_object($sql);
		header("Content-type: text/x-json");
		echo json_encode($row);
		exit();		
	}
if(isset($_POST['deleteProgram']))
	{
		if($sql = mysqli_query($con, "SELECT * from tblsampleprogram where  sampleProgramID = {$_POST['idDelProgram']}"))
		{
			$sql1= mysqli_query($con, "SELECT * from tblprogramimages where programID = {$_POST['idDelProgram']}");
			while($row=mysqli_fetch_array($sql1))
			{
				unlink($row['imageURL']); 
			}
			mysqli_query($con,"DELETE from tblprogramimages where programID = {$_POST['idDelProgram']}");
			mysqli_query($con,"DELETE from tblsampleprogram where sampleProgramID = {$_POST['idDelProgram']}");
		}
		exit();	
	}
if(isset($_POST['withProgram']))
	{	
		?>
		<table class="table">
		<?php
				$sql=mysqli_query($con,"SELECT * from tblsampleprogram where sampleProgramID = {$_POST['idProg']}");
				while($row=mysqli_fetch_array($sql))
				{
					?>
						<tr>
						<td><h4>Content</h4></td>
						<td><tr><td><?php echo trim($row['programContent'])?></td></tr></td>
						</tr>
					<?php
				}
				?>
					<tr>
						<td><h4>Images</h4></td>
					<?php
				$sql2=mysqli_query($con,"SELECT * from tblprogramimages where programID = {$_POST['idProg']}");
				while($row2=mysqli_fetch_array($sql2))
				{
				?>
						
							<td><tr><td><img src="<?php echo $row2['imageURL']?>"/></td></tr></td>
						
				<?php
				}
				?>		
					</tr>
			</table>
		<?php	
		
		exit();
	}
if(isset($_POST['viewPrograms']))
	{
		$sql=mysqli_query($con,"SELECT * from tblsampleprogram where sampleProgramID = {$_POST['idSP']}");
		$row=mysqli_fetch_object($sql);
		header("Content-type: text/x-json");
		echo json_encode($row);
		exit();
	}
if(isset($_POST['editProg']))
	{
		$sql=mysqli_query($con, "SELECT * from tblsampleprogram where sampleProgramID = {$_POST['idPD']}");
		$row=mysqli_fetch_object($sql);
		header("Content-type: text/x-json");
		echo json_encode($row);
		exit();		
	}
?>