<?php
//problems update
	require 'dbconfig.php';
	if(isset($_POST['chapter']))
		{
			?>
		<h1 class="text-light" style="font-weight:10px;">Chapter's Area</h1>
				<div class="row flex-self-stretch">

					<div class="cell size4 padding10" style="padding-top:0;padding-right:0;">
						<div class="cell auto-size padding10 bg-white" style="overflow:hidden;height:77.3vh;border:0.5px solid black;" >
								<label class="text-light">Chapter Name</label>
								<div class="input-control textarea full-size">
									<textarea id="ChapterName" onKeyUp="addChapt();" style="resize:none;overflow-y:scroll;"></textarea>
								</div>
								<div class="input-control select full-size">
									<select id="selectCategory">
										<option selected disabled>Select a Category</option>
										<option value="Console">C# Console Application</option>
										<option value="Windows">C# Windows Form Application</option>
										<option value="Web">C# Asp.Net</option>
									</select>
								</div>
								<button class="button" id="ChapterButton" onClick="addNewChapt();" disabled>Add new Chapter</button>
						</div>
				    </div>
					<div class="cell colspan8 padding10 bg-grey" style="padding-top:0;padding-right:0;">
						<div class="auto-size padding10 bg-white" style="overflow:hidden;height:77.3vh;border:0.5px solid black;" >
							<label class="text-light sub-header">Current Chapters</label>
							<div class="padding0" id="cell-Chapters">
							</div>
						</div>
					</div>
		    </div>

   		 <div  class="padding20 dialog no-margin bg-aqua" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="50%" id="dialogChapter"  data-height="70vh" data-close-button="true" style="left: 372.5px;">
                    <h3 class="text-light">Edit "<span id="chapterName"></span>"</h3>
         			<input type="hidden" id="ChapterID"/>
                                <label class="text-light">Chapter Title: </label><br/>
                                    <div class="input-control text full-size" data-role="input" >
                                        <input type="text" id="chapterEdit">
                                    </div>
                                    <button class="button text-shadow" onClick="updateChapter()">Update Chapter</button>
                                    <div id="EditLessons" style="height:65%;overflow-y:scroll;"></div>
                                
        </div>
		<div  class="padding20 dialog no-margin" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-close-button="true" data-width="55%" data-height="70vh" id="dialogViewLessons" style="left: 372.5px;">
                    <h3 class="text-light">Content of "<span id="chapterdName"></span>"</h3>
         			<input type="hidden" id="ChapterdID"/>
         			<div class="padding20" style="overflow-y:scroll;height:80%;">
         				<div  id="output"></div>
         			</div>
        </div>
   		 <div  class="padding20 dialog no-margin" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="65%" data-height="80%" id="dialogAddLesson" data-close-button="true" style="left: 372.5px;overflow-y:scroll;">
                    <h3 class="text-light">Add lesson to "<span id="chaptersName"></span>"</h3>
             <br/>
		      		<input type="hidden" id="ChaptersID" name="ChaptersID"/>
		      		<div class="size6 bg-white">
					<label class="text-light">Lesson Name</label>
						
						<div class="input-control text full-size">
							<input type="text" id="LessonName" name="LessonName" onKeyUp="addLesson();" />
						</div>
			 				<table>
			 					<tr>
			 						<td>is Having a Video</td>
			 					</tr>
			 					<tr>
			 						<td><label class="input-control radio small-check">
										    <input type="radio" name="ishavingavid" value="Yes" id="ishavingavidyes">
										    <span class="check"></span>
										    <span class="caption">Yes</span>
										</label>
										<label class="input-control radio small-check">
										    <input type="radio" name="ishavingavid" id="ishavingavidno" value="No" checked>
										    <span class="check"></span>
										    <span class="caption">No</span>
										</label></td>
			 					</tr>
								<tr style="display:none;" id="selector">
									<td><label class="text-light">Video Name</label></td>
									<td><div class="input-control select" id="selectionVideo">
										</div>
									</td>
								</tr>
			 					<tr>
			 						<td>is Having a PDF File?</td>
			 					</tr>
			 					<tr>
			 						<td><label class="input-control radio small-check">
										    <input type="radio" name="ishavingapdf" id="ishavingapdfyes" value="Yes">
										    <span class="check"></span>
										    <span class="caption">Yes</span>
										</label>
										<label class="input-control radio small-check">
										    <input type="radio" name="ishavingapdf" id="ishavingapdfno" value="No" checked >
										    <span class="check"></span>
										    <span class="caption">No</span>
										</label></td>
			 					</tr>
								<tr style="display:none;" id="displaypdf">
									<td><label class="text-light">PDF Name</label></td>
									<td>
										<div class="input-control select" id="selectionPDF">
										</div>
									</td>
								</tr>
								<tr>
							</table>
							<label class="text-light">Content</label>
								<br/>
									<div class="input-control textarea full-size" data-text-auto-resize="false" data-role="input">
										<textarea name="ContentArea" id="Contents"></textarea>
									</div>
									<br/>
							<button class="button" id ="addLesson" onClick="addNewLesson();" name="submit" >Add new lesson</button>

						</div>
				</tr>
        <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark"  id="dialogDeleteConfirmationChapter" data-close-button="false" >
            		   <h3>Are you sure you want to delete <br/> "<span id="ChapterTitles"></span>"?</h3>
	            <br/>
                       <input type="hidden" id="DelChID"/>
                       <button class="button full-size" id="Yes" onClick="DeleteChapter();">Yes</button>
                       <button class="button full-size" id="No" onClick="hideMetroDialog(dialogDeleteConfirmationChapter)">No</button>  
  			</div>
        <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark"  id="dialogDeleteConfirmationLisson" data-close-button="false">
            		   <h3>Are you sure you want to delete <br/> "<span id="LissonName"></span>"?</h3>
            <br/>
                       <input type="hidden" id="DelLis"/>
                       <button class="button full-size" id="Yes" onClick="DeleteLisson();">Yes</button>
                       <button class="button full-size" id="No" onClick="hideMetroDialog(dialogDeleteConfirmationLisson),hideMetroDialog(dialogChapter)">No</button>  
  		</div>
  		<div class="padding20" data-role="dialog" data-overlay="true" id="dialogEditLessons" data-close-button="false" data-overlay-click-close="false" data-width="65%" data-height="80%" style="overflow-y:scroll;">
					<input type="hidden" id="LessonszID" name="lessonIDs"/>
	      		<div class="size6 bg-white">
				<label class="text-light">Lesson Name</label>
					<div class="input-control text full-size">
						<input type="text" name="LessonName2" id="LessonNamex" onKeyUp="addLesson();" />
					</div>
		 				<table>
		 					<tr>
		 						<td>is Having a Video</td>
		 					</tr>
		 					<tr>
		 						<td><label class="input-control radio small-check">
									    <input type="radio" name="ishavingavid12e" id="ishavingavid12yes" value="Yes">
									    <span class="check"></span>
									    <span class="caption">Yes</span>
									</label>
									<label class="input-control radio small-check">
									    <input type="radio" name="ishavingavid12e" id="ishavingavid12no" value="No" checked>
									    <span class="check"></span>
									    <span class="caption">No</span>
									</label></td>
		 					</tr>
							<tr style="display:none;" id="selector1">
								<td><label class="text-light">Video Name</label></td>
								<td><div class="input-control select" id="selectionVideo1">
									</div>
								</td>
							</tr>
		 					<tr>
		 						<td>is Having a PDF File?</td>
		 					</tr>
		 					<tr>
		 						<td><label class="input-control radio small-check">
									    <input type="radio" name="ishavingapdf12e" id="ishavingapdf12yes" value="Yes">
									    <span class="check"></span>
									    <span class="caption">Yes</span>
									</label>
									<label class="input-control radio small-check">
									    <input type="radio" name="ishavingapdf12e" id="ishavingapdf12no" value="No" checked >
									    <span class="check"></span>
									    <span class="caption">No</span>
									</label></td>
		 					</tr>
							<tr style="display:none;" id="displaypdf1">
								<td><label class="text-light">PDF Name</label></td>
								<td>
									<div class="input-control select" id="selectionPDF1">
									</div>
								</td>
							</tr>
							
						</table>
						<label class="text-light">Content</label>
							<br/>
								<div class="input-control textarea full-size" data-text-auto-resize="false" data-role="input">
									<textarea  id="Contents1" name="NewTAVal"></textarea>
								</div>
								<br/>
						<button class="button" onClick="UpdateLesson();">Update this lesson</button>
						<button class="button" onClick="hideMetroDialog(dialogEditLessons),hideMetroDialog(dialogChapter)">Cancel Updation</button>
					</div>
						
  		</div>
			<script type="text/javascript">
				showChapters();	
				SelectChapter();
				SelectQuiz();
				SelectPDF();
				SelectScreenShot();
				SelectVideos();
				// SelectPDF1();
				// SelectVideos1();
				$('body').delegate('.DelChapt','click',function()
					{
						var DelChapt = $(this).attr("idDelChapt");
						$.ajax 
						({
								url : "chaptermaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									deleteChapter1 : 1,
									DelCh : DelChapt
								},
								success : function (delChaptRes)
								{
									document.getElementById("ChapterTitles").innerHTML = delChaptRes.chapterTitle;
									$("#DelChID").val(delChaptRes.chapterID);
								}
						});
					});
				$('body').delegate('.EditLessons','click',function()
					{
						var LessonxId = $(this).attr("idEditLesson");
						$.ajax 
						({
								url : "lessonmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									editLesx : 1,
									LessIDz : LessonxId
								},
								success : function (editL)
								{
									$("#LessonNamex").val(editL.LessonTitle);
									$("#LessonszID").val(editL.lessonID);
									if(editL.ishavingaPDF=="Yes")
									{
										document.getElementById("ishavingapdf12yes").checked="true";
										switchVar4();
									}
									else if(editL.ishavingaPDF=="No")
									{
										document.getElementById("ishavingapdf12no").checked="true";
										switchVar4();

									}
									if(editL.ishavingaVideo=="Yes")
									{
										document.getElementById("ishavingavid12yes").checked="true";
										switchVar3();
									}
									else if(editL.ishavingaPDF=="No")
									{
										document.getElementById("ishavingavid12no").checked="true";
										switchVar4();

									}
								}
						});
						$.ajax 
						({
								url : "lessonmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									editLesx1 : 1,
									LessIDz : LessonxId
								},
								success : function (editL1)
								{
									$("#Contents1").val(editL1.contents);
								}
						});
						$.ajax 
						({
								url : "selectPDF1.php",
								type : 'POST',
								async : false,
								data : 
								{	
									selectPDF1 : 1,
									LessIDz : LessonxId
								},
								success : function (selectPDF)
								{
									$("#selectionPDF1").html(selectPDF);
								}
						});
						$.ajax 
						({
								url : "selectVideo1.php",
								type : 'POST',
								async : false,
								data : 
								{	
									selectVideo1 : 1,
									LessIDz : LessonxId
								},
								success : function (selectVideo3)
								{
									$("#selectionVideo1").html(selectVideo3);
								}
						});
					});
				$('body').delegate('.DelLis','click',function()
					{
						var DelLess = $(this).attr("idDelLess");
						$.ajax 
						({
								url : "lessonmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									deleteLesson1 : 1,
									DelLesss : DelLess
								},
								success : function (delLessRes)
								{
									document.getElementById("LissonName").innerHTML = delLessRes.LessonTitle;
									$("#DelLis").val(delLessRes.lessonID);
								}
						});
					});
				$('body').delegate('.EditChapter','click',function()
					{
							var EditChapter = $(this).attr('idEditChapt');
							$.ajax
							({
									url : "chaptermaintenance.php",
									type : 'POST',
									async : false,
									data : 
									{	
										editChapter : 1,
										ideC : EditChapter
									},
									success : function (eC)
									{
										document.getElementById("chapterName").innerHTML = eC.chapterTitle;
										$("#chapterEdit").val(eC.chapterTitle);
										$("#ChapterID").val(eC.chapterID);			
									}
							});
							$.ajax
							({	
									url : "chaptermaintenance.php",
									type : 'POST',
									async : false,
									data : 
									{	
										withLessons : 1,
										ideCA : EditChapter
									},
									success : function (resultTa)
									{		
											$("#EditLessons").html(resultTa);
									}
							});
					});
				$('body').delegate('.AddNewLess','click',function()
					{
							var NewLess = $(this).attr('idNL');
							$.ajax
							({
									url : "lessonmaintenance.php",
									type : 'POST',
									async : false,
									data : 
									{	
										addNewLessons : 1,
										idNewL : NewLess
									},
									success : function (adDNewL)
									{
										document.getElementById("chaptersName").innerHTML = adDNewL.chapterTitle;
										$("#ChaptersID").val(adDNewL.chapterID);
									}
							});
					});
				$('body').delegate('.ViewLesst','click',function()
					{
							var ViewLessd = $(this).attr('idVL');
							$.ajax
							({
									url : "viewLessons.php",
									type : 'POST',
									async : false,
									data : 
									{	
										viewLessonsx : 1,
										ChaptID : ViewLessd
									},
									success : function (viewLess)
									{
										document.getElementById("chapterdName").innerHTML = viewLess.chapterTitle;
										$("#ChapterdID").val(viewLess.chapterID);
									},
							});
							$.ajax
							({
									url : "viewLessons.php",
									type : 'POST',
									async : false,
									data : 
									{	
										viewLessonx : 1,
										ChaptsID : ViewLessd
									},
									success : function (viewLesss)
									{
										$("#output").html(viewLesss);
										
									},
							});
					});
				$('body').delegate('.deleteLesson','click',function()
					{
						var delLess = $(this).attr("iddLes");
						$.ajax 
						({
								url : "lessonmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									deleteLessons : 1,
									DelLe : delLess
								},
								success : function (delChaptRes)
								{
									showChapters();	

								}
						});
					});
				function switchVar()
					 {
					    if($("#ishavingavidyes").prop("checked"))
					       	$("#selector").show();
					     else
					        $("#selector").hide();
						}
				function switchVar2()
					 {
					    if($("#ishavingapdfyes").prop("checked"))
					       	$("#displaypdf").show();

					     else
					        $("#displaypdf").hide();
						}
				function switchVar3()
					 {
					    if($("#ishavingavid12yes").prop("checked"))
					       	$("#selector1").show();
					     else
					        $("#selector1").hide();
						}
				function switchVar4()
					 {
					    if($("#ishavingapdf12yes").prop("checked"))
					       	$("#displaypdf1").show();

					     else
					        $("#displaypdf1").hide();
						}
				$(document).ready(function()
					{
						switchVar();
						switchVar2();
						switchVar3();
						$("input[name=ishavingavid]").change(switchVar);
						$("input[name=ishavingapdf]").change(switchVar2);
						$("input[name=ishavingavid12e]").change(switchVar3);
						$("input[name=ishavingapdf12e]").change(switchVar4);

					});
			</script>
			<?php
			exit();
		}
					
?>