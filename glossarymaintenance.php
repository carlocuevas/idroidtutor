<?php

require 'dbconfig.php';
if(isset($_POST['showLet']))
	{
	?>
			<table class="table"  id="DataTabs11">
			                     <thead>
		                      			  <tr> 
												  <th>Program Title</th>
												  <th>Maintenance</th>


			                     		   </tr>
			                     	     </thead>
			                        <tbody >
			                        	<?php
			                        	$sql=mysqli_query($con,"SELECT * From tblglossary");
			                        	while($row=mysqli_fetch_array($sql))
			                        	{
			                        		
			                        	?>
			                        	<tr>
			                    		  <td><?php echo $row['letterStarts'];?></td>
									      <td><div class="toolbar">
													<button class="toolbar-button bg-darkBlue bg-active-blue fg-white ViewPrograms" onClick="edit('#dialogViewMeanings')" idVM="<?php echo $row['glossaryID']; ?>"><span class="mif-eye icon" ></span></button>								      
											        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white deleLet" onclick="edit(diaglogDeleteLetter)" idDelLet= "<?php echo $row['glossaryID'];?>"><span class="mif-bin icon" ></span></button>
											     </div>
										  </td>
			                        	</tr>
			                        	<?php
			                        	}

			                        	?>
			     			</tbody>
				</table>

			<script>

					$("#DataTabs11").dataTable({
					    scrollY:"53vh",
					    pagingType: 'full',
					   	responsive : true
					    
					});

			</script>
	<?php
	exit();
	}
if(isset($_POST['deleteLetter']))
	{
		$sql=mysqli_query($con, "SELECT * from tblglossary where glossaryID = {$_POST['idDelete']}");
		$row=mysqli_fetch_object($sql);
		header("Content-type: text/x-json");
		echo json_encode($row);
		exit();		
	}
if(isset($_POST['deleteLetter1']))
	{
		mysqli_query($con,"DELETE from tblmeaning where glosaryID = {$_POST['idLett']}");
		exit();	
	}
if(isset($_POST['showMeanings']))
	{	
		?>
		<table class="table">
				<thead>
					<tr>
						<th>Word</th>
						<th>Meaning</th>
					</tr>
				</thead>
		<?php
				$id=$_POST['idPD'];
				$sql=mysqli_query($con,"SELECT * from tblmeaning where glosaryID = {$id}");
				while($row=mysqli_fetch_array($sql))
				{
					?>
						<tr>
							<td>
								<?php echo $row['word']?>
							</td>
							<td>
								<?php echo $row['meaning']?>
							</td>
						</tr>
					<?php
				}
		?>
			</table>
		<?php	
		
		exit();
	}
if(isset($_POST['adder']))
{
	$id=$_POST['Letter'];
	mysqli_query($con,"INSERT INTO tblmeaning values(DEFAULT,{$id},'{$_POST['word']}','{$_POST['Meaning']}')");
	exit();
}
?>