<?php

	require 'dbconfig.php';
	if(isset($_POST['PDFfiles']))
	{
		?>
			<h1 class="text-light" style="font-weight:10px;">PDF's Area</h1>
 			<div class="row cell-auto-size">
				<div class="cell full-size padding10 bg-grey " style="padding:bottom:0;padding-top:0;">
						<div class="padding10 bg-white" id="PdfParse"  style="height:77.3vh;border:0.5px solid black;overflow:hidden;">
                   
					</div>
			     </div>	
			     <div class="cell full-size padding0 bg-grey">
						<div class="bg-grey">
								<div class="padding10 bg-white" style="border:0.5px solid black;padding-top:0;" id="reset" >		
									<form action="pdfUpload.php" id="addFile" method="post" enctype="multipart/form-data">
										<h3 class="text-light">Upload Files Here</h3>
										<div class="input-control file full-size" id="thisBox1" data-role="input" >
										    <input type="file"  id="file1" onchange="blankFiles();"   name="filep_array[]" placeholder="Place File Here!">
										    <button class="button"><span class="mif-folder"></span></button>

										</div>
										<div class="input-control file full-size" id="thisBox3" data-role="input" >
										    <input type="file"  onchange="blankFiles();" id="file3"   name="filep_array[]" placeholder="Place File Here!">
										    <button class="button"><span class="mif-folder"></span></button>
										</div>
										<button class="button text-shadow" id="uploadbutton" disabled>Upload File(s) </button>
									</form>			
												
								</div>
				 		</div>
						<div class="cell size6 padding10 bg-grey" style="padding-left:0;padding-right:0;">
								<div class="cell size6 padding10 bg-white" style="border:0.5px solid black;padding-top:0;" >				
									<h3 class="text-light">Uploading Progress <span id="sct-2">0%</span></h3>
									<br/>
									<div class="progress small" data-role="progress" data-color="bg-violet" id="pb2"></div>	<br/>
									<button class="button text-shadow" id="CancelsUpload">Cancel Upload</button>	
								</div>
				 		</div>

					</div>
			</div>
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="50%" id="dialogEditPDFtitle" data-close-button="true">
            		   <h3 class="text-light">Edit Title of this File "<span id="pdfTi"></span>"</h2>
                       <input type="hidden" id="pdfID" value=""/>
                       <label class="text-light">File Title</label>
                       <div class="input-control text full-size">
                       		<input type="text" id="pdfT"/>
                       </div>
                       <button class="button full-size" id="pdfUpdater" onClick="updatePDFS();">Update Title of PDF Files</button>
            </div>		
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="50%" id="dialogDeleteConfirmationPDF" data-close-button="true">
            		   <h4>Are you sure you want to delete <br/>"<span id="pdfTitl"></span>"?</h4>
                <br/>
                       <input type="hidden" id="pdfIDs" value=""/>
                       <button class="button full-size" id="Yes" onClick="DeletePDFS()">Yes</button>
                       <button class="button full-size" id="No" onClick="hideMetroDialog('#dialogDeleteConfirmationPDF')">No</button>
            
            </div>		
			<script>
				var interval2;
				showFiles();
				blankFiles();
				function showFiles()
					{
						$.ajax
						({
								url : 'pdfmaintenance.php',
								type : 'POST',
                                    async : false,
								data : 
								{	
									showFiles : 1
								},
								success : function (z)
								{
									$("#PdfParse").html(z);
								}
						});
					}
                function Loaders(id)
                        {
                                var dialog = $(id).data('dialog');
                                dialog.open();
                        }
                function updatePDFS()
					{
						var pdIDS = $("#pdfIDs").val();
						var pdfTitleUpdate = $("#pdfT").val();
						$.ajax
						({
								url : 'pdfmaintenance.php',
								type : 'POST',
								async : false,
								data : 
								{	
									pdI : pdIDS,
									PDFTitleNew : pdfTitleUpdate,
									updatePDF : 1
								},
								success : function (updatePDFx)
								{
									showFiles();
							        $.Notify({
							            caption: 'Success',
							            content: 'Updation Complete',
							            icon: "<span class='mif-file-pdf icon'></span>",
							            type: "success"
							        });							
						        	hideMetroDialog("#dialogEditPDFtitle");
								}
						});
					}
                function DeletePDFS()
					{
						var idDelPDFe = $("#pdfIDs").val();
						$.ajax
						({
								url : 'pdfmaintenance.php',
								type : 'POST',
								async : false,
								data : 
								{	
									deletePDF : 1,
									idDelPDFd : idDelPDFe
								},
								success : function (updatedVid)
								{
									showFiles();
							        $.Notify({
							            caption: 'Delete',
							            content: 'Record has been Deleted',
							            icon: "<span class='mif-bin icon'></span>",
							            type: "alert"
							        });
									hideMetroDialog("#dialogDeleteConfirmationPDF");
								}
						});
					}	
            	$('body').delegate('.EditPDF','click',function()
					{
						var idPDF = $(this).attr('idEditP');
						$.ajax
						({
								url : "pdfmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									editPDF : 1,
									idPD : idPDF
								},
								success : function (elPDF)
								{
									document.getElementById("pdfTi").innerHTML = elPDF.pdfTitle;
									$("#pdfT").val(elPDF.pdfTitle);
									$("#pdfIDs").val(elPDF.pdfID);
									
								}
						});
					});
				$('body').delegate('.DelPDF','click',function()
					{
						var DelPDFF = $(this).attr("idDelP");
						$.ajax 
						({
								url : "pdfmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									deletePDF1 : 1,
									idDelPDFF : DelPDFF
								},
								success : function (delPDF)
								{
									document.getElementById("pdfTitl").innerHTML = delPDF.pdfTitle;
									$("#pdfIDs").val(delPDF.pdfID);
								}
						});
					});             
				var addFiles = function()
					{
						
						$("#addFile").on("submit", function(pdfs)
						{
							pdfs.preventDefault();
							$(this).ajaxSubmit(
							{
								beforeSend:function()
								{
									$("#prog1").attr("value","0");
								},
								uploadProgress:function(event,position,total,percentComplete)
								{
							        clearInterval(interval2);
							        var pb1 = $("#pb2").data('progress');
							            pb1.set(percentComplete);
									$("#sct-2").html(percentComplete+'%');
								},
								success:function(data)
								{
									$("#sct-2").html("0"+'%');
									var pb = $("#pb2").data('progress');
    								    pb.set(0);
							        $.Notify({
							            caption: 'Inserted',
							            content: 'PDF File(s) has Been Uploaded',
							            icon: "<span class='mif-pdf-file icon'></span>",
							            type: "info"
							        });
							        PDF();
								}

							});

						});
					};
			$(document).ready(addFiles);
            $(document).on('click', '#CancelsUpload', function(e){    
            	var XHR= new XMLHttpRequest();   
			    window.stop();
			    XHR.abort();
			    $("#sct-2").html("0"+'%');
			    var pb=$('#pb2').data('progress');
			    	pb.set(0);
			});
			function blankFiles()
				{
					var id_value1 = document.getElementById('file1').value;	
					var id_value3 = document.getElementById('file3').value;	
					if(document.getElementById("file1").value != "")
					{
						var valid_extensions1 = /(.pdf)$/i;
						if(valid_extensions1.test(id_value1))
					 	{ 
					  		$("#thisBox1").addClass("success");
					  		document.getElementById("uploadbutton").disabled = false;
						}
					 	else
						{
					   		$("#thisBox1").addClass('error');
					   		document.getElementById("uploadbutton").disabled = true;
					 	}
					}
					if(document.getElementById("file3").value != "")
					{
						var valid_extensions3 = /(.pdf)$/i;
						if(valid_extensions3.test(id_value3))
					 	{ 
					  		$("#thisBox3").addClass("success");
					  		document.getElementById("uploadbutton").disabled = false;
						}
					 	else
						{
					   		$("#thisBox3").addClass('error');
					   		document.getElementById("uploadbutton").disabled = true;
					 	}
					}
				}
					 
			
			</script>
		<?php
		exit();
	}
?>