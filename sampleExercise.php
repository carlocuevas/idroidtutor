<?php

require 'dbconfig.php';
if(isset($_POST['sampleEx']))
	{
		?>
		<h1 class="text-light" style="font-weight:10px;">Sample Exercises</h1>
		<div class="row cell-auto-size">
				<div class="cell full-size padding10 bg-grey " style="padding:bottom:0;padding-top:0;">
						<div class="padding10 bg-white" id="exercises"  style="height:77.3vh;border:0.5px solid black;overflow:hidden;">
                   
					</div>
			     </div>	
			     <div class="cell full-size padding0 bg-grey">
						<div class="bg-grey">
								<div class="padding10 bg-white" style="height:77.3vh;border:0.5px solid black;padding-top:0;overflow-y:scroll;" id="reset">	
										<h3 class="text-light">Exercise Title</h3>
										<div class="input-control text full-size" data-role="input">
											<input type="text" name="ProgramTitle"/>
										</div>
										<h3 class="text-light">Exercise Content</h3>
										<div class="input-control textarea full-size" data-role="input">
											<textarea name="programContent"></textarea>
										</div>
										<button class="button text-shadow" 
										onClick="addExercise();">Add Exercise </button>		
												
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
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="50%" id="dialogEditSampleExercise" data-close-button="true">
            		   <h3 class="text-light">Edit this Exercise "<span id="titulongehersisyo"></span>"</h2>
            		   <input type="hidden" id="exercisesD" value=""/>
            		   <label>Exercise Title</label>	
            		   <div class="input-control text full-size" data-role="input">
            		   		<input type="text" id="edittedExercise"/>
            		   </div>
            		   <label>Exercise Content</label>
            		   <div class="input-control textarea full-size" data-role="input">
            		   		<textarea id="exercisesarea"></textarea>
            		   </div>
            		   <button class="button" onClick="UpdateExercise()">Update Exercise</button>
                      
            </div>		
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="50%" id="dialogDeleteConfirmationExercise" data-close-button="true">
            		   <h4>Are you sure you want to delete <br/>"<span id="exerciseTitle"></span>"?</h4>
                <br/>
                       <input type="hidden" id="exeID" value=""/>
                       <button class="button full-size" id="Yes" onClick="DeleteExercise()">Yes</button>
                       <button class="button full-size" id="No" onClick="hideMetroDialog('#dialogDeleteConfirmationExercise')">No</button>
            </div>	
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="50%" id="dialogViewExercises" data-close-button="true">
            	<div id="ClickViewExercise"></div>
            </div>	
			<script>
			showExercises();
			function showExercises()
				{
					$.ajax
					({
						url : "sampleExerciseMaintenance.php",
						async : false,
						type : "POST",
						data : 
						{
							showExercise : 1
						},
						success : function(showedExercise)
						{
							$("#exercises").html(showedExercise);
						}

					});
				}
			$('body').delegate('.ViewExercises','click',function()
				{
					var IdExercise= $(this).attr('idVEx');
					$.ajax
					({
						url : "sampleExerciseMaintenance.php",
						type : "POST",
						async : false,
						data : 
						{	
								viewExercise : 1,
								exercise : IdExercise
						},
						success : function (viewExercises)
						{
							$("#ClickViewExercise").html(viewExercises);
						}
					});
				});
			$('body').delegate('.DeleteExercise','click',function()
				{
					var IdExercise= $(this).attr('idDelEX');
					$.ajax
					({
						url : "sampleExerciseMaintenance.php",
						type : "POST",
						async : false,
						data : 
						{	
								deleteExercise : 1,
								exercise : IdExercise
						},
						success : function (deleteExercises)
						{
							document.getElementById("exerciseTitle").innerHTML = deleteExercises.exerciseTitle;
							$("#exeID").val(deleteExercises.exerciseID);
						}
					});
				});
			$('body').delegate('.EditExercise','click',function()
				{
					var IdExercise= $(this).attr('idEditEx');
					$.ajax
					({
						url : "sampleExerciseMaintenance.php",
						type : "POST",
						async : false,
						data : 
						{	
								editExercise : 1,
								exercise : IdExercise
						},
						success : function (editExercises)
						{
							document.getElementById("titulongehersisyo").innerHTML=editExercises.exerciseTitle;
							$("#exercisesD").val(editExercises.exerciseID);
							$("#edittedExercise").val(editExercises.exerciseTitle);
							$("#exercisesarea").val(editExercises.exerciseContent);
							

						}
					});
				});
			function UpdateExercise()
				{
					var IdExercise= $("#exercisesD").val();
					var exerT=$("#edittedExercise").val();
					var exerC=$("#exercisesarea").val();
					$.ajax
					({
						url : "sampleExerciseMaintenance.php",
						type : "POST",
						async : false,
						data : 
						{
							updateExe:1,
							exerciseid:IdExercise,
							exerciseT:exerT,
							exercisesContent:exerC
						},
						success : function(updated)
						{
							showExercises();
			                $.Notify({
				                caption: 'Update Exercise',
				                content: 'Update Success' ,
				                icon: "<span class='mif-layers icon'></span>",
				                type: "success"
			                }); 
			                hideMetroDialog("#dialogEditSampleExercise");
						}
					});
				}
			function DeleteExercise()
				{
					var IdExercise= $("#exeID").val();
					$.ajax
					({
						url : "sampleExerciseMaintenance.php",
						type : "POST",
						async : false,
						data : 
						{	
								deleteExercise1 : 1,
								exercise : IdExercise
						},
						success : function (editExercises)
						{
							showExercises();
			                $.Notify({
				                caption: 'Delete Exercise',
				                content: 'Delete Success' ,
				                icon: "<span class='mif-layers icon'></span>",
				                type: "alert"
			                }); 
			                hideMetroDialog("#dialogDeleteConfirmationExercise");
						}
					});
				}
			</script>
		<?php
		exit();
	}
?>