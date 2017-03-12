<?php
	
	require 'dbconfig.php';
	if(isset($_POST['showVid']))
		{
			?>
			<table class="hovered dataTable"  id="DataTabs1" data-auto-width="true">
			                     <thead>
			                      			  <tr>
			                      			 	 
												  <th>Video</th>
												  <th>Video Title</th>
												  <th>Maintenance</th>


			                     		   </tr>
			                     	     </thead>
			                        <tbody >
			                        	<?php
			                        	$sql=mysqli_query($con,"SELECT * From tblvideos where VideoID > 0 order by VideoID desc");
			                        	while($row=mysqli_fetch_array($sql))
			                        	{
			                        		
			                        	?>
			                        	<tr>
			                    		  <td>
			                    		  	<div data-role="video">
			                    		  		<video  width="150px" height="150px">
				  			                  		  <source type="video/mp4" src="<?php echo $row['videoUrl'];?>" />
				  			                  		 
				  			                  	</video>
			                    		  	</div>
			                    		  </td>
			                    		  <td><?php echo $row['videoTitle'];?></td>
									      <td><div class="toolbar">
											        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white DelV" onClick="edit(dialogDeleteConfirmationVideo)" idDelV= '<?php echo $row['VideoID']; ?>'><span class="mif-bin icon" ></span></button>
											        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white EditVid" onClick="edit(dialogEditVid)" idEditV= '<?php echo $row['VideoID']; ?>'><span class="mif-pencil icon" ></span></button></div>
										  </td>
			                        	</tr>
			                        	<?php
			                        	}

			                        	?>
			     			</tbody>
				</table>

			<script>

					$("#DataTabs1").dataTable({

					    "scrollCollapse": true,
					    'scrollY':"49.5vh",
					    'pagingType': 'full'
					    
					});

			</script>

			<?php
			exit();  
		}
	if(isset($_POST['deleteV']))
		{
			$sql=mysqli_query($con, "SELECT * from tblvideos where VideoID = {$_POST['ideL']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();	

		}
	if(isset($_POST['deleteV1']))
		{
			if($sql = mysqli_query($con, "SELECT * from tblvideos where VideoID = {$_POST['VideoID']}"))
			{
				$sql1= mysqli_query($con, "SELECT * from tblvideos where VideoID = {$_POST['VideoID']}");
				$row=mysqli_fetch_array($sql1);
				unlink($row['videoUrl']);
				mysqli_query($con,"DELETE from tblvideos where VideoID = {$_POST['VideoID']}");
			}
			exit();	
		}
	if(isset($_POST{'editVid'}))
		{
			$sql=mysqli_query($con, "SELECT * from tblvideos where VideoID = {$_POST['ideL']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();			
		}
	if(isset($_POST['updateVideo']))
		{
			mysqli_query($con,"UPDATE tblvideos set videoTitle = '{$_POST['VideoTitleNew']}' where VideoID = {$_POST['VidsID']}; ");
			exit();
		}
?>