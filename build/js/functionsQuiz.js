function showQuizes()
		{
			$.ajax
			({
				url : 'quizmaintenance.php',
				type : 'POST',
				async : false,
				data : 
				{	
					showQuiz : 1
				},
				success : function (result)
				{
					$("#cell-Quizes").html(result);
				}
			});
		}
function addQuestion()
					{
						if(document.getElementById("Question").value != "")
						{
							document.getElementById("addQuestionMulti").disabled = false;
						}	
						if(document.getElementById("Question").value == "")
						{
							document.getElementById("addQuestionMulti").disabled = true;
						}
					}
function showQuestions()
					{
						$.ajax
						({
							url : 'quizmaintenance.php',
							type : 'POST',
							async : false,
							data : 
							{	
								showQue : 1
							},
							success : function (results)
							{
								$("#que").html(results);
							}
						});
					}
function addQuizs()
		{
				$.ajax
				({
					url : 'quizmaintenance.php',
					type : 'POST',
					async : false,
					data : 
					{	
						addQuiz : 1
					},
					success : function (results)
					{
						viewQuestion();
						showQuestions();
						showQuizes();
					}
				});
		}
function addQuest()
		{
			var Answer;	
			var Question = $("#Question").val();
			var A = $("#AnswerA").val();
			var B = $("#AnswerB").val();
			var C = $("#AnswerC").val();
			var D = $("#AnswerD").val();
			if($('input[name=Answer]:checked').val()=="A")
			{
				Answer = $("#AnswerA").val();
			}
			if($('input[name=Answer]:checked').val()=="B")
			{
				Answer = $("#AnswerB").val();
			}
			if($('input[name=Answer]:checked').val()=="C")
			{
				Answer = $("#AnswerC").val();
			}
			if($('input[name=Answer]:checked').val()=="D")
			{
				Answer = $("#AnswerD").val();
			}
			$.ajax
			({
					url : 'quizmaintenance.php',
					type : 'POST',
					async : false,
					data : 
					{	
						Ans : Answer,
						Quest : Question,
						AA : A,
						AB : B,
						AC : C,
						AD : D,
						addQue : 1
					},
					success : function (results)
					{
						
						showQuestions();
						viewQuestion();
						document.getElementById("Question").value="";
						document.getElementById("AnswerA").value="";
						document.getElementById("AnswerB").value="";
						document.getElementById("AnswerC").value="";
						document.getElementById("AnswerD").value="";
						$("#Question").focus();
						addQuestion();
						$('input[name=Answer]').attr('checked',false);
					}
			});
		}	
function viewQuestion()
					{	
						$.ajax 
						({
								url : "viewQuestions.php",
								type : 'POST',
								async : false,
								data : 
								{	
									viewQuestion : 1,
								},
								success : function (resView)
								{
									$("#Questionskks").html(resView);
								}
						});
					}
function deleteQuestion()
	{	
		var questiond = $("#QuestID").val();
		$.ajax
			({
				url : 'quizmaintenance.php',
				type : 'POST',
				async : false,
				data : 
				{	
					questionsD : questiond,
					deleteQuest : 1
				},
				success : function (LessonsResult)
				{
					showQuestions();
					viewQuestion();
					hideMetroDialog("#dialogChapter");
	                $.Notify({
		                caption: 'Delete Chapter',
		                content: 'Delete Success' ,
		                icon: "<span class='mif-bin icon'></span>",
		                type: "alert"
	                });  
	                hideMetroDialog("#dialogDeleteConfirmationQuestion");
				}				
			});	
	}
function deleteQuiz2()
	{	
		var questiond = $("#QuizIDNumber").val();
		$.ajax
			({
				url : 'quizmaintenance.php',
				type : 'POST',
				async : false,
				data : 
				{	
					questionsD : questiond,
					deleteQuiz2 : 1
				},
				success : function (LessonsResult)
				{

	                hideMetroDialog("#dialogDeleteConfirmationQuiz");
					viewQuestion();
					Quiz();
					showQuizNumber();
	                $.Notify({
		                caption: 'Delete Quiz',
		                content: 'Delete Success' ,
		                icon: "<span class='mif-question icon'></span>",
		                type: "alert"
	                });  
				}				
			});	
	}
function deleteQuiz()
	{
		$.ajax
			({
				url : 'quizmaintenance.php',
				type : 'POST',
				async : false,
				data : 
				{	
					deleteQuiz : 1
				},
				success : function (result)
				{
					
				}
			});
	}
function deleteQuestionManual()
	{
		var questionID = $("#QuestIDManual").val();
		var quizID = $("#QuizIDManual").val();
		$.ajax
			({
				url : 'quizmaintenance.php',
				type : 'POST',
				async : false,
				data : 
				{	
					questionID : questionID,
					deleteQuestionManual1 : 1,
					quizID : quizID
				},
				success : function (LessonsResult)
				{

	                hideMetroDialog("#dialogDeleteConfirmationQuestionManual");
	                hideMetroDialog("#ViewQuestions");
	                viewQuestion();
	                $.Notify({
		                caption: 'Delete Question',
		                content: 'Delete Success' ,
		                icon: "<span class='mif-question icon'></span>",
		                type: "alert"
	                });  
				}				
			});	
	}
function UpdateQuest()
	{
		var questionID = $("#QuizNumbersEditID").val();
		var quizID = $("#QuizIDEdit").val();
		var choicesA = $("#AnswerA1").val();
		var choicesB = $("#AnswerB1").val();
		var choicesC = $("#AnswerC1").val();
		var choicesD = $("#AnswerD1").val();		
		var Question = $("#Question2").val();
		var Answer;
		if(document.getElementById("choiceA").checked="true")
		{
			Answer = $("#AnswerA1").val();
		}
		else if(document.getElementById("choiceB").checked="true")
		{
			Answer = $("#AnswerB1").val();
		}
		else if(document.getElementById("choiceC").checked="true")
		{
			Answer = $("#AnswerC1").val();
		}
		else if(document.getElementById("choiceD").checked="true")
		{
			Answer = $("#AnswerD1").val();
		}

		$.ajax
			({
				url : 'quizmaintenance.php',
				type : 'POST',
				async : false,
				data : 
				{	
					UpdateQuestion : 1,
					questionID : questionID,
					quizID : quizID,
					choicesA : choicesA,
					choicesB : choicesB,
					choicesC : choicesC,
					choicesD : choicesD,
					Question : Question,
					Answer : Answer
				},
				success : function (LessonsResult)
				{

	                hideMetroDialog("#UpdateQuestions");
	                hideMetroDialog("#ViewQuestions");
	             	viewQuestion();
	             	Quiz();
	                $.Notify({
		                caption: 'Update Question',
		                content: 'Update Success' ,
		                icon: "<span class='mif-question icon'></span>",
		                type: "success"
	                });

				}				
			});	
	}
function addNewQ()
	{
		showQuizNumber();
		addQuizs();
		$("#wizard").wizard('next');
	}
function CancelQ()
	{
        $.Notify({
        caption: 'Cancelled',
        content: 'Quiz Insertion is Cancelled' ,
        icon: "<span class='mif-eye icon'></span>",
        type: "info"
        }); 
        deleteQuiz();
        Quiz();
	}
function finishQ()
	{
	    $.Notify({
	        caption: 'Inserted',
	        content: 'Quiz has been Inserted' ,
	        icon: "<span class='mif-eye icon'></span>",
	        type: "info"
	    });  
	    addQuizs();
	  	Quiz();		
	}
function showQuizNumber()
	{
		$.ajax
		({
				url : 'quizmaintenance.php',
				type : 'POST',
				async : false,
				data : 
				{	
					showQuizNumber : 1
				},
				success : function (resultNumber)
				{
						document.getElementById("quizNumber").innerHTML = "Quiz Number "+ resultNumber.QuizID;
				}
		});
	}

	//viewing of questions nalang