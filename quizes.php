<?php
//unfinished design yet
	require 'dbconfig.php';
	if(isset($_POST['quiz']))
		{
			?>
				<h1 class="text-light" style="font-weight:10px;">Quiz Area</h1>
					<div class="wizard auto-size" id="wizard">
					    <div class="steps ">
					    	<!--Instructions-->
					        <div class="step">
					        	<div class="row flex-self-stretch">
					        		<div class="cell auto-size bg-white padding5" style="height:66vh; border:1px solid black;">
					        			<button class="button place-right" onClick='addNewQ();'>Add new Quiz</button>
					        			<h3 class="text-light header small">Current Quiz : <span id="quizNumber">No Quiz to be Shown</span></h3>
					        			<div class="cell auto-size padding10" id="cell-Quizes"></div>
					        		</div>
					        	</div>
					        </div>
					        <!--Add Questions-->
					        <div class="step">
					        	<div class="cell size6 padding10" style="padding:bottom:0;padding-top:0;">
								<div class="cell padding10 bg-white" style="border:0.5px solid black;overflow:hidden;">
								<div class="size6 bg-white">

								<h3 class="text-light header small">Add Question </h3>
								<div class="input-control textarea full-size">
									<textarea id="Question" onKeyUp="addQuestion();" style="resize:none;overflow-y:scroll;"></textarea>
								</div>				
								
								        	<table>
								        		<tr>
								        			<td><label>Answer A</label></td>
								        			<td><div class="input-control text full-size"><input type="text" id="AnswerA"/></div></td>
								        			<td><label class="input-control radio small-check">
														    <input type="radio" name="Answer" value="A">
														    <span class="check"></span>
														    <span class="caption">This is The Answer</span>
														</label></td>
								        		</tr>
								        		<tr>
								        			<td><label>Answer B</label></td>
								        			<td><div class="input-control text full-size"><input type="text" id="AnswerB"/></div></td>
								        			<td><label class="input-control radio small-check">
														    <input type="radio" name="Answer" value="B">
														    <span class="check"></span>
														    <span class="caption">This is The Answer</span>
														</label></td>
								        		</tr>
								        		<tr>
								        			<td><label>Answer C</label></td>
								        			<td><div class="input-control text full-size"><input type="text" id="AnswerC"/></div></td>
								        			<td><label class="input-control radio small-check">
														    <input type="radio" name="Answer" value="C">
														    <span class="check"></span>
														    <span class="caption">This is The Answer</span>
														</label></td>
								        		</tr>
								        		<tr>
								        			<td><label>Answer D</label></td>
								        			<td><div class="input-control text full-size"><input type="text" id="AnswerD"/></div></td>
								        			<td><label class="input-control radio small-check">
														    <input type="radio" name="Answer" value="D">
														    <span class="check"></span>
														    <span class="caption">This is The Answer</span>
														</label></td>
								        		</tr>

								        		
								        	</table>
								        	<br/>
								        	<button class="button  no-margin-right"  id="addQuestionMulti" onClick="addQuest();" disabled>Add Question</button>
								</div>
										</div>
									</div>
								</div>
					        </div>
					        <!--View and Edit Questions-->
					        <div class="step">	
										<div class="cell padding10 bg-grey" style="padding-top:0;padding-bottom:0">
												<div class="cell auto-size bg-white" style="height:56vh;border:0.5px solid black;overflow:hidden;"> 
															<div class="padding10" id="que">
															</div>
												</div>
										</div>
							</div>
							<!--Resibo at ending-->
					        <div class="step">
								<div class="cell auto-size padding10 bg-grey" style="padding-top:0;padding-bottom:0">
										<div class="cell size12 bg-white" style="height:56vh;border:0.5px solid black;overflow-y:scroll;"> 
												<div id="Questionskks" class="padding20" style="padding-top:0;"></div> 
										
										</div>
									<button class="button" onClick="CancelQ()">Cancel</button>
									<button class="button success place-right bg-darkBlue bg-active-lightBlue bg-hover-blue" onClick="finishQ()">Submit Quiz</button>
								</div>					        	
					        </div>
					    </div>
					</div>
	 <!--OK!-->				
        <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-width="50%" data-overlay-click-close="true" id="dialogDeleteConfirmationQuestion" data-close-button="true">
            		   <h3 class="text-light">Are you sure you want to delete <br/> "<span id="QuestionTitle"></span>"?</h3>
            <br/>
                       <input type="hidden" id="QuestID"/>
                       <button class="button full-size" id="Yes" onClick="deleteQuestion();">Yes</button>
                       <button class="button full-size" id="No" onClick="hideMetroDialog(dialogDeleteConfirmationQuestion)">No</button>  
  		</div>
    <!--OK!-->
        <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="dialogDeleteConfirmationQuiz" data-close-button="true">
            		   <h3>Are you sure you want to delete <br/>Quiz Number: <span id="QuizID"></span>?</h3>
            <br/>
                       <input type="hidden" id="QuizIDNumber"/>
                       <button class="button full-size" id="Yes" onClick="deleteQuiz2()">Yes</button>
                       <button class="button full-size" id="No" onClick="hideMetroDialog(dialogDeleteConfirmationQuiz)">No</button>  
  		</div>
  	<!--OK!-->
        <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark"  data-height="70%" data-overlay-click-close="true" id="ViewQuestions" data-close-button="true" data-width="50%">
            		   <h3 class="text-light">Questions that are in <br/>Quiz Number: <span id="QuizNumberID"></span></h3>
                       <input type="hidden" id="QuizNumbersID"/>
                       <div id="Questionsx" style="overflow-y:scroll; height:50vh;"></div>
  		</div>
  	 <!--OK!-->
        <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-width="50%" data-overlay-click-close="true" id="dialogDeleteConfirmationQuestionManual" data-close-button="true">
            		   <h3 class="text-light header">Are you sure you want to delete<br/> <span id="QuestionTitleManual" style="font-size:18px;"></span>?</h3>
            <br/>
                       <input type="hidden" id="QuestIDManual"/>
                       <input type="hidden" id="QuizIDManual"/>
                       <button class="button full-size" id="Yes" onClick="deleteQuestionManual();">Yes</button>
                       <button class="button full-size" id="No" onClick="hideMetroDialog(dialogDeleteConfirmationQuestionManual), hideMetroDialog(ViewQuestions)">No</button>  
  		</div>  		
        <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark"  data-height="80%"  id="UpdateQuestions" data-close-button="true" data-width="50%">
            		   <h3 class="text-light">Update Question Number <span id="QuestionNumberEdit"></span> that are in <br/>Quiz Number: <span id="QuizNumberEditID"></span></h3>
                       <input type="hidden" id="QuizNumbersEditID"/>
                       <input type="hidden" id="QuizIDEdit"/>
								<div class="input-control textarea full-size">
									<textarea id="Question2"  style="resize:none;overflow-y:scroll;"></textarea>
								</div>				
						        	<table>
						        		<tr>
						        			<td><label>Answer A</label></td>
						        			<td><div class="input-control text full-size"><input type="text" id="AnswerA1"/></div></td>
						        			<td><label class="input-control radio small-check">
												    <input type="radio" name="Answer1" id="choiceA" value="A">
												    <span class="check"></span>
												    <span class="caption">This is The Answer</span>
												</label></td>
						        		</tr>
						        		<tr>
						        			<td><label>Answer B</label></td>
						        			<td><div class="input-control text full-size"><input type="text" id="AnswerB1"/></div></td>
						        			<td><label class="input-control radio small-check">
												    <input type="radio" name="Answer1" id="choiceB" value="B">
												    <span class="check"></span>
												    <span class="caption">This is The Answer</span>
												</label></td>
						        		</tr>
						        		<tr>
						        			<td><label>Answer C</label></td>
						        			<td><div class="input-control text full-size"><input type="text" id="AnswerC1"/></div></td>
						        			<td><label class="input-control radio small-check">
												    <input type="radio" name="Answer1" id="choiceC" value="C">
												    <span class="check"></span>
												    <span class="caption">This is The Answer</span>
												</label></td>
						        		</tr>
						        		<tr>
						        			<td><label>Answer D</label></td>
						        			<td><div class="input-control text full-size"><input type="text" id="AnswerD1"/></div></td>
						        			<td><label class="input-control radio small-check">
												    <input type="radio" name="Answer1"  id="choiceD" value="D">
												    <span class="check"></span>
												    <span class="caption">This is The Answer</span>
												</label></td>
						        		</tr>

						        		
						        	</table>
						        	<br/>
						        	<button class="button  no-margin-right"  id="addQuestionMulti" onClick="UpdateQuest();">Update Question</button>
						        	<button class="button  no-margin-right" onClick="hideMetroDialog(ViewQuestions),hideMetroDialog(UpdateQuestions)">Cancel Edit</button>
						        	
								</div>
  		</div>
			<script type="text/javascript">
				$(function(){
				    $('#wizard').wizard({
				            stepper: true, 
				            stepperType: 'cycle', 
				            stepperClickable: false, // set to true if you can switch page over click on stepper
				            startPage: 1, // if this value ne 'default' wizard started from this page
				            locale: $.Metro.currentLocale, //'en', 'ua', 'ru', ... more languages defined in metro-locale.js
				            finishStep: 'default', // 'default' - last page or int - number of page
				            buttons: {
								cancel: false,
					            help: false,
					            prior: {
					                show: true,
					                title: "Previous page",
					                group: "left",
					                cls: "navy"
					            },
					            next: {
					                show: true,
					                title: "Next page",
					                group: "right",
					                cls: "navy"
					            },
					            finish:false,
				            },
				           	onPrior : function(page, wiz)
				           	{
				           		$("#wizard").wizard("prior");
								showQuizNumber();
				           	},
				           	onNext : function(page,wiz)
				           	{
				           		if(document.getElementById("quizNumber").value=="No Quiz to be Shown")
				           		{
				           			$("#wizard").button("next").disabled=true;
									showQuizNumber();
				           			addNewQ();
				           		}
				           		else
				           		{
				           			$("#wizard").wizard("next");
									showQuizNumber();
				           		}
				           	}
				            // Buttons click methods, page change events
	
				    	});
					});
				showQuizNumber();
				showQuizes();
				showQuestions();
				viewQuestion();
				$('body').delegate('.DelQuiz','click',function()
					{
						var DelQuiz = $(this).attr("idDelQ");
						$.ajax 
						({
								url : "quizmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									deleteQuiz1 : 1,
									idDelQuest : DelQuiz
								},
								success : function (delQ)
								{
									document.getElementById("QuizID").innerHTML = delQ.quizID;
									$("#QuizIDNumber").val(delQ.quizID);
								}
						});
					});
				$('body').delegate('.delManual','click',function()
					{
						var quizID = $("#QuizNumbersID").val();
						var delMan = $(this).attr("idDeleteManual");
						$.ajax 
						({
								url : "quizmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									deleteQuestionManual : 1,
									quizID:quizID,
									idDelQuest : delMan
								},
								success : function (delQM)
								{
									document.getElementById("QuestionTitleManual").innerHTML = "Question Number : "+delQM.questionID +") "+ delQM.question;
									$("#QuestIDManual").val(delQM.questionID);
									$("#QuizIDManual").val(delQM.quizID);
								}
						});
					});
				$('body').delegate('.DelQuest','click',function()
					{
						var DelQuest = $(this).attr("idDelQuest");
						$.ajax 
						({
								url : "quizmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									deleteQuest1 : 1,
									idDelQuest : DelQuest
								},
								success : function (delQ)
								{
									document.getElementById("QuestionTitle").innerHTML = delQ.question;
									$("#QuestID").val(delQ.questionID);
								}
						});
					});
				$('body').delegate('.ViewQ','click',function()
					{
						var viewQ = $(this).attr("idView");
						$.ajax 
						({
								url : "quizmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									viewQuiz : 1,
									idla : viewQ
								},
								success : function (resQuiz)
								{
									document.getElementById("QuizNumberID").innerHTML = viewQ;
									$("#QuizNumbersID").val(viewQ);
									$("#Questionsx").html(resQuiz);
								}
						});
					});
				$('body').delegate('.editManual','click',function()
					{
						var quizID = $("#QuizNumbersID").val();
						var viewQ = $(this).attr("idEditManual");
						$.ajax 
						({
								url : "quizmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									quizID : quizID,
									viewQuizManual : 1,
									idla : viewQ
								},
								success : function (upQues)
								{
									document.getElementById("QuestionNumberEdit").innerHTML= upQues.questionID;
									document.getElementById("QuizNumberEditID").innerHTML= upQues.quizID;
									$("#QuizNumbersEditID").val(upQues.questionID);
									$("#QuizIDEdit").val(upQues.quizID);
									$("#AnswerA1").val(upQues.choiceA);
									$("#AnswerB1").val(upQues.choiceB);
									$("#AnswerC1").val(upQues.choiceC);
									$("#AnswerD1").val(upQues.choiceD);
									$("#Question2").val(upQues.question);
									if(upQues.answer==upQues.choiceA)
									{
										document.getElementById("choiceA").checked="true";
									}
									else if(upQues.answer==upQues.choiceB)
									{
										document.getElementById("choiceB").checked="true";
									}
									else if(upQues.answer==upQues.choiceC)
									{
										document.getElementById("choiceC").checked="true";
									}
									else if(upQues.answer==upQues.choiceD)
									{
										document.getElementById("choiceD").checked="true";
									}

								}
						});
					});				
			</script>
			<?php
			exit();
		}
					
?>