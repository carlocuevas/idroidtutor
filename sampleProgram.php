<?php

require 'dbconfig.php';
if(isset($_POST['sampleProg']))
	{
		?>
		<h1 class="text-light" style="font-weight:10px;">Sample Program</h1>
		<div class="row cell-auto-size">
				<div class="cell full-size padding10 bg-grey " style="padding:bottom:0;padding-top:0;">
						<div class="padding10 bg-white" id="imageAlbumParse"  style="height:77.3vh;border:0.5px solid black;overflow:hidden;">
                   
					</div>
			     </div>	
			     <div class="cell full-size padding0 bg-grey">
						<div class="bg-grey">
								<div class="padding10 bg-white" style="height:77.3vh;border:0.5px solid black;padding-top:0;overflow-y:scroll;" id="reset">		
									<form action="sampleProgramUploader.php" id="addNewSampleProgram" method="post" enctype="multipart/form-data">
										<h3 class="text-light">Program Title</h3>
										<div class="input-control text full-size" data-role="input">
											<input type="text" name="ProgramTitle"/>
										</div>
										<div class="input-control file full-size" id="thisBox1" data-role="input" >
										    <input type="file"  id="file1" onchange="blankFiles();"   name="filesp_array[]" placeholder="Place File Here!">
										    <button class="button"><span class="mif-folder"></span></button>

										</div>
										<button class="button text-shadow" onClick="edit(diaglogSampleProgramUpload)" id="addingProgram" disabled>Add Program </button>
									</form>			
												
								</div>
				 		</div>
							<div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-width="50%" id="diaglogSampleProgramUpload" style="border:0.5px solid black;">
									<div class="cell auto-size paddin0 bg-grey" style="padding-left:0; padding-right:0;padding-top:0;">
												<div class="cell-colspan8 padding10 bg-white" style="height:1%;overflow:hidden;" >
													<h3 class="text-light"> <span id="sct-4">0%</span> Uploading Progress  ...</h3>
													<div class="progress small" data-role="progress" data-color="bg-violet" id="pb4"></div>		
													<button class="button success text-shadow" id="CancelsUpload">Cancel Upload</button>								
												</div>
											</div>
						        </div>

					</div>
			</div>
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="50%" id="dialogEditSampleProgram" data-close-button="true">
            		   <h3 class="text-light">Edit Title of this Program "<span id="progTi"></span>"</h3>
                       <?php require 'formvalidatorProgram.php';?>
            </div>		
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="50%" id="dialogDeleteConfirmationProgram" data-close-button="true">
            		   <h4>Are you sure you want to delete <br/>"<span id="programTitle"></span>"?</h4>
                <br/>
                       <input type="hidden" id="programID" value=""/>
                       <button class="button full-size" id="Yes" onClick="DeletePrograms()">Yes</button>
                       <button class="button full-size" id="No" onClick="hideMetroDialog('#dialogDeleteConfirmationProgram')">No</button>
            
            </div>	
			<div  class="padding20 dialog no-margin" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-close-button="true" data-width="55%" data-height="80vh" id="dialogViewPrograms" style="left: 372.5px;">
	                    <h3 class="text-light">Sample Program of "<span id="programName"></span>"</h3>
	         			<input type="hidden" id="programID" value=""/>
	         			<div class="padding20" style="overflow-y:scroll;height:80%;">
	         				<div  id="outputProgram"></div>
	         			</div>
	        </div>         	
			<script>
				var interval2;
				showSamplePrograms();
				blankFiles();
				function showSamplePrograms()
					{
						$.ajax
						({
								url : 'sampleProgramMaintenance.php',
								type : 'POST',
                                async : false,
								data : 
								{	
									showPrograms : 1
								},
								success : function (ze)
								{
									$("#imageAlbumParse").html(ze);
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
                function DeletePrograms()
					{
						var idDelPrograms = $("#programID").val();
						$.ajax
						({
								url : 'sampleProgramMaintenance.php',
								type : 'POST',
								async : false,
								data : 
								{	
									deleteProgram : 1,
									idDelProgram : idDelPrograms
								},
								success : function (updatedVid)
								{
									showSamplePrograms();
							        $.Notify({
							            caption: 'Delete',
							            content: 'Sample Program has been Deleted',
							            icon: "<span class='mif-bin icon'></span>",
							            type: "alert"
							        });
									hideMetroDialog("#dialogDeleteConfirmationProgram");
								}
						});
					}	
            	$('body').delegate('.EditProg','click',function()
					{
						var idProgEdit = $(this).attr('sampleProgramID');
						$.ajax
						({
								url : "sampleProgramMaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									editProg : 1,
									idPD : idPDF
								},
								success : function (elProg)
								{
									document.getElementById("progTi").innerHTML = elProg.programTitle;
									$("#ProgramTitles").val(elProg.programTitle);
									$("#progID").val(elProg.sampleProgramID);
									
								}
						});
					});
		//Check
				$('body').delegate('.DelProg','click',function()
					{
						var DelProg = $(this).attr("idDelProg");
						$.ajax 
						({
								url : "sampleProgramMaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									delProg : 1,
									iDelProg : DelProg
								},
								success : function (delProg)
								{
									document.getElementById("programTitle").innerHTML = delProg.programTitle;
									$("#programID").val(delProg.sampleProgramID);
								}
						});
					});             
		//Check
				$('body').delegate('.ViewPrograms','click',function()
					{
						var VPID=$(this).attr("idVP");
						$.ajax
							({
									url : "sampleProgramMaintenance.php",
									type : 'POST',
									async : false,
									data : 
									{	
										viewPrograms : 1,
										idSP : VPID
									},
									success : function (eP)
									{
										document.getElementById("programName").innerHTML = eP.programTitle;
										$("#programID").val(eP.sampleProgramID);			
									}
							});
						$.ajax
						({
									url : "sampleProgramMaintenance.php",
									type : 'POST',
									async : false,
									data : 
									{	
										withProgram : 1,
										idProg : VPID
									},
									success : function (programRe)
									{		
											$("#outputProgram").html(programRe);
									}
						});

					});

				var addProgram = function()
					{
						
						$("#addNewSampleProgram").on("submit", function(pdfs)
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
							        var pb1 = $("#pb4").data('progress');
							            pb1.set(percentComplete);
									$("#sct-4").html(percentComplete+'%');
								},
								success:function(data)
								{
									$("#sct-2").html("0"+'%');
									hideMetroDialog("#diaglogSampleProgramUpload");
									var pb = $("#pb4").data('progress');
    								    pb.set(0);
							        $.Notify({
							            caption: 'Inserted',
							            content: 'Sample Program has Been Inserted',
							            icon: "<span class='mif-versions icon'></span>",
							            type: "info"
							        });
							        SampleProgram();
							        showSamplePrograms();
								}

							});

						});
					};
			$(document).ready(addProgram);
            $(document).on('click', '#CancelsUpload', function(e){    
            	var XHR= new XMLHttpRequest();   
			    window.stop();
			    XHR.abort();
			    $("#sct-4").html("0"+'%');
			    var pb=$('#pb4').data('progress');
			    	pb.set(0);
			});
			function blankFiles()
				{
					var id_value1 = document.getElementById('file1').value;	
					
					
					
					
					if(document.getElementById("file1").value != "")
					{
						var valid_extensions1 = /(.png)$/i;
						if(valid_extensions1.test(id_value1))
					 	{ 
					  		$("#thisBox1").addClass("success");
					  		document.getElementById("addingProgram").disabled = false;
						}
					 	else
						{
					   		$("#thisBox1").addClass('error');
					   		document.getElementById("addingProgram").disabled = true;
					 	}
					}
					
					
				
					
				}
			function blankFiles2()
				{
					var id_value2 = document.getElementById('file2').value;	
					if(document.getElementById("file2").value != "")
					{
						var valid_extensions2 = /(.png)$/i;
						if(valid_extensions2.test(id_value2))
					 	{ 
					  		$("#thisBox2").addClass("success");
					  		document.getElementById("addingProgram").disabled = false;
						}
					 	else
						{
					   		$("#thisBox2").addClass('error');
					   		document.getElementById("addingProgram").disabled = true;
					 	}
					}
				}
			function blankFiles3()
				{
					var id_value3 = document.getElementById('file3').value;	
					if(document.getElementById("file3").value != "")
					{
						var valid_extensions3 = /(.png)$/i;
						if(valid_extensions3.test(id_value3))
					 	{ 
					  		$("#thisBox3").addClass("success");
					  		document.getElementById("addingProgram").disabled = false;
						}
					 	else
						{
					   		$("#thisBox3").addClass('error');
					   		document.getElementById("addingProgram").disabled = true;
					 	}
					}
				}
			function blankFiles4()
				{
					var id_value4 = document.getElementById('file4').value;	
					if(document.getElementById("file4").value != "")
					{
						var valid_extensions4 = /(.png)$/i;
						if(valid_extensions4.test(id_value4))
					 	{ 
					  		$("#thisBox4").addClass("success");
					  		document.getElementById("addingProgram").disabled = false;
						}
					 	else
						{
					   		$("#thisBox4").addClass('error');
					   		document.getElementById("addingProgram").disabled = true;
					 	}
					}
				}
			
					 
			
			</script>
		<?php
		exit();
	}
?>