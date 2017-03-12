<?php
	require 'dbconfig.php';
	if(isset($_POST['lesson']))
		{
			?>
				<h1 class="text-light" style="font-weight:10px;">Lesson Area</h1>
				<div class="row flex-align-stretch">
					<div class="cell size12  padding10 bg-grey" style="padding-right:0;padding-top:0;">
						<div class="cell auto-size   padding10 bg-white" style="height:77.3vh;border:0.5px solid black;overflow:hidden;">
							<label class="text-light">Current Lessons</label>
							<div class="auto-size " id="cell-Lesson">
							</div>
						</div>
					</div>
			 	</div>
   		 <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="dialogLesson">
                    <h4 class="text-light sub-header small">Edit Lesson "<span id="LessonTitle"></span>" </h4>
                    <input type="hidden" id="LessonID"/>
                            

                               <label class="text-light">Lesson Name: </label>
                               <br/>
                                    <td><div class="input-control text full-size" data-role="input" >
                                        <input type="text" id="lessonUpdate">
                                    </div>
 							<table>
							<tr>
								<td><label class="text-light">Video Name</label></td>
								<td><div class="input-control select" id="selectEditVideo">
									</div>
								</td>
							</tr>
							<tr>
								<td><label class="text-light">PDF Name</label></td>
								<td>
									<div class="input-control select" id="selectEditPDF">
									</div>
								</td>
							</tr>
							<tr>
								<td><label class="text-light">Content Title</label></td>
								<td>
									<div class="input-control select" id="selectEditSShot">
									</div>
								</td>
							</tr>
						</table>
                                <button class="button success text-shadow" onClick="updateLesson()">Update Lesson</button>                               
        </div>
        <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="dialogDeleteConfirmationLesson" data-close-button="true">
            		   <h3>Are you sure you want to delete <br/> "<span id="LessonsTitle"></span>"?</h3>
            <br/>
                       <input type="hidden" id="DelLIDs"/>
                       <button class="button full-size" id="Yes" onClick="DeleteLesson();">Yes</button>
                       <button class="button full-size" id="No" onClick="hideMetroDialog(dialogDeleteConfirmationLesson)">No</button>  
  		</div>

			<script type="text/javascript">
				showLessons();
				SelectQuiz();
				SelectPDF();
				SelectScreenShot();
				SelectVideos();
				$('body').delegate('.DelLesson','click',function()
					{
						var DelLess = $(this).attr("idDelLesson");
						$.ajax 
						({
								url : "lessonmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									deleteLesson1 : 1,
									idDelLessons : DelLess
								},
								success : function (delL)
								{
									document.getElementById("LessonsTitle").innerHTML = delL.LessonTitle;
									$("#DelLIDs").val(delL.lessonID);
								}
						});
					});
				$('body').delegate('.EditLesson','click',function()
					{
							var EditLesson = $(this).attr('idEditLesson');
							$.ajax
							({
									url : "lessonmaintenance.php",
									type : 'POST',
									async : false,
									data : 
									{	
										editLesson : 1,
										ideL : EditLesson
									},
									success : function (eL)
									{
										document.getElementById("LessonTitle").innerHTML = eL.LessonTitle;
										$("#lessonUpdate").val(eL.LessonTitle);
										$("#LessonID").val(eL.lessonID);
										$("#selectEditSShot").val(el.contentID);
										$("#selectEditVideo").val(el.VideoID);
										$("#selectEditPDF").val(el.pdfID);
										
									}
							});
					});
			</script>
			<?php
			exit();
		}
					
?>