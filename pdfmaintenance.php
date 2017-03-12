<?php


	require 'dbconfig.php';
	if(isset($_POST['showFiles']))
		{
			?>
			<table class="table"  id="DataTabs2">
			                     <thead>
			                      			  <tr>
			                      			 	 
												  <th>PDF Title</th>
												  <th>Maintenance</th>


			                     		   </tr>
			                     	     </thead>
			                        <tbody >
			                        	<?php
			                        	$sql=mysqli_query($con,"SELECT * From tblpdf where pdfID !=0 order by pdfID desc");
			                        	while($row=mysqli_fetch_array($sql))
			                        	{
			                        		
			                        	?>
			                        	<tr>
			                    		  <td><?php echo $row['pdfTitle'];?></td>
									      <td><div class="toolbar">
											        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white DelPDF" onclick="edit(dialogDeleteConfirmationPDF)" idDelP= '<?php echo $row['pdfID'];?>'><span class="mif-bin icon" ></span></button>
											        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white EditPDF" onClick="edit(dialogEditPDFtitle)" idEditP='<?php echo $row['pdfID'];?> '><span class="mif-pencil icon" ></span></button>
											         <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white "><a href="<?php echo $row['pdfFile']?>" download="<?php echo $row['pdfTitle']?>"><span class="mif-file-download icon" ></span></a></button>
											     </div>
										  </td>
			                        	</tr>
			                        	<?php
			                        	}

			                        	?>
			     			</tbody>
				</table>

			<script>

					$("#DataTabs2").dataTable({
					    scrollY:"53vh",
					    pagingType: 'full',
					   	responsive : true
					    
					});

			</script>

			<?php
			exit(); 
		}
	if(isset($_POST['deletePDF']))
		 { 
			if($sql = mysqli_query($con, "SELECT * from tblpdf where  pdfID = {$_POST['idDelPDFd']}"))
			{
				$sql1= mysqli_query($con, "SELECT * from tblpdf where pdfID = {$_POST['idDelPDFd']}");
				$row=mysqli_fetch_array($sql1);
				unlink($row['pdfFile']);
				mysqli_query($con,"DELETE from tblpdf where pdfID = {$_POST['idDelPDFd']}");
			}
			exit();	
		 }
	if(isset($_POST['deletePDF1']))
		 {
			$sql=mysqli_query($con, "SELECT * from tblpdf where pdfID = {$_POST['idDelPDFF']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();		
		 }
	if(isset($_POST{'editPDF'}))
		{
			$sql=mysqli_query($con, "SELECT * from tblpdf where pdfID = {$_POST['idPD']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();			
		}
	if(isset($_POST['updatePDF']))
		{
			if(mysqli_query($con,"UPDATE tblpdf set pdfTitle = '{$_POST['PDFTitleNew']}' where pdfID = {$_POST['pdI']}; ")

			)
			{
				echo 1;
			}
			else
			echo 0;

			exit();
		}
?>