function addChapt()
	{
		if(document.getElementById("ChapterName").value != "")
		{
			document.getElementById("ChapterButton").disabled =false;
		}
		if(document.getElementById("ChapterName").value == "")
		{
			document.getElementById("ChapterButton").disabled =true;
		}
			
	}
function addLesson()
	{
		// if(document.getElementById("LessonName").value != "")
		// {
		// 	document.getElementById("addLesson").disabled =false;
		// }
		// if(document.getElementById("LessonName").value == "")
		// {
		// 	document.getElementById("addLesson").disabled =true;
		// }
			
	}				
function showLessons()
	{
		$.ajax
		({
			url : 'lessonmaintenance.php',
			type : 'POST',
			async : false,
			data : 
			{	
				showLesson : 1
			},
			success : function (resultLesson)
			{
				$("#cell-Lesson").html(resultLesson);
			}
		});
	}
function showChapters()
	{
		$.ajax
		({
			url : 'chaptermaintenance.php',
			type : 'POST',
			async : false,
			data : 
			{	
				showChapter : 1
			},
			success : function (resultChapter)
			{
				$("#cell-Chapters").html(resultChapter);
			}
		});
	}
function addNewChapt()
	{
		var chaptName = $("#ChapterName").val();
		var Module = $("#selectCategory").val();
		$.ajax
		({
			url : 'chaptermaintenance.php',
			type : 'POST',
			async : false,
			data : 
			{	
				ChapterName : chaptName,
				Category : Module,
				addNewChapters : 1
			},
			success : function (result)
			{
		        $.Notify({
		            caption: 'Inserted',
		            content: 'New Chapter has been added',
		            icon: "<span class='mif-file-text icon'></span>",
		            type: "info"
		        });
				$("#ChapterName").val("");
				addChapt();
				SelectChapter();
				showChapters();
			}							
		});
	}
function addNewLesson()
	{
		var Lname = $("#LessonName").val();
		var Vids;
		var PDF;
		var SS = $("#Contents").val();
		var Chap = $("#ChaptersID").val();
		var ChapName = $("#chaptersName").text();
		var isHavingVideo;
		var result= $('input[name="ishavingapdf"]:checked').val();
		var result1= $('input[name="ishavingavid"]:checked').val();
		if(result != "Yes")
		{
			PDF = 0;
		}
		else
		{
			PDF= $("#selectedPDF").val();
		}
		if(result1 != "Yes")
		{
			Vids = 0;
		}
		else
		{
			Vids= $("#selectedVideo").val();
		}

		$.ajax
		({
			url : 'lessonmaintenance.php',
			type : 'POST',
			async : false,
			data : 
			{	
				LessonName : Lname,
				Videos : Vids,
				PDFFile : PDF,
				Contents : SS,
				Chapterd : Chap,
				isHavingP : result,
				isHavingV : result1,
				addNewLesson : 1
			},
			success : function (LessonResult)
			{
		        $.Notify({
		            caption: 'Inserted',
		            content: 'Lesson has Been added in '+ ChapName ,
		            icon: "<span class='mif-file-text icon'></span>",
		            type: "info"
		        });
				$("#LessonName").val("");
				$("#Contents").val("");
				document.getElementById("ishavingavidno").checked=true;
				document.getElementById("ishavingapdfno").checked=true;
				document.getElementById("selectedVideo").text="No Video";
				document.getElementById("selectedPDF").text="No PDF";
				switchVar();
				switchVar2();
				SelectChapter();
				SelectQuiz();
				SelectPDF();
				addLesson();
				SelectVideos();
				showChapters();
				hideMetroDialog('#dialogAddLesson');
			}							
		});
	}	
function DeleteChapter()
	{
		var chapterIDss = $("#DelChID").val();
		var chapterName = $("#ChapterTitles").text();
		$.ajax
			({
				url : 'chaptermaintenance.php',
				type : 'POST',
				async : false,
				data : 
				{	
					chapterDel : chapterIDss,
					deleteChapter : 1
				},
				success : function (ChapterResult)
				{
					SelectChapter();
					showChapters();
					hideMetroDialog("#dialogChapter");
	                $.Notify({
		                caption: 'Delete Chapter',
		                content: 'Chapter ' + chapterName +' is Deleted',
		                icon: "<span class='mif-bin icon'></span>" ,
		                type: "alert"
	                });  
	                hideMetroDialog("#dialogDeleteConfirmationChapter");
				}				
			});	
	}
function DeleteChapter()
	{
		var chapterIDss = $("#DelChID").val();
		var chapterName = $("#ChapterTitles").text();
		$.ajax
			({
				url : 'chaptermaintenance.php',
				type : 'POST',
				async : false,
				data : 
				{	
					chapterDel : chapterIDss,
					deleteChapter : 1
				},
				success : function (ChapterResult)
				{
					SelectChapter();
					showChapters();
					hideMetroDialog("#dialogChapter");
	                $.Notify({
		                caption: 'Delete Chapter',
		                content: 'Chapter ' + chapterName +' is Deleted',
		                icon: "<span class='mif-bin icon'></span>" ,
		                type: "alert"
	                });  
	                hideMetroDialog("#dialogDeleteConfirmationChapter");
				}				
			});	
	}
function DeleteLisson()
	{
		var lessonIDs = $("#DelLis").val();
		$.ajax
			({
				url : 'lessonmaintenance.php',
				type : 'POST',
				async : false,
				data : 
				{	
					lessIDs : lessonIDs,
					deleteLesson : 1
				},
				success : function (LessonsResult)
				{
					showChapters();
					hideMetroDialog("#dialogChapter");
	                $.Notify({
		                caption: 'Delete Chapter',
		                content: 'Delete Success' ,
		                icon: "<span class='mif-bin icon'></span>",
		                type: "alert"
	                });  
	                hideMetroDialog("#dialogDeleteConfirmationLisson");
				}				
			});	
	}
function updateChapter()
	{
		var chapterIDs = $("#ChapterID").val();
		var ChapterT = $("#chapterEdit").val();
		$.ajax
		({
			url : 'chaptermaintenance.php',
			type : 'POST',
			async : false,
			data : 
			{	
				pkey : chapterIDs,
				ChapTitle : ChapterT,
				updateChapter : 1
			},
			success : function (LessonResult)
			{
				SelectChapter();
				showChapters();
				hideMetroDialog("#dialogChapter");
                $.Notify({
	                caption: 'Update Chapter',
	                content: 'Update Success' ,
	                icon: "<span class='mif-pencil icon'></span>",
	                type: "success"
                });  
			}				
		});	
	}
function UpdateLesson()
	{
		var results= $('input[name="ishavingapdf12e"]:checked').val();
		var results1= $('input[name="ishavingavid12e"]:checked').val();
		var ChapName = $("#ChapterName").val();
		var lessonID1= $("#LessonszID").val();
		var Lname1 = $("#LessonNamex").val();
		var Vids1 ;
		var PDF1 ;
		var SS1 = $("#Contents1").val();
		// if(results == "No")
		// {
		// 	PDF1 = 0;
		// }
		// else
		// {
		// 	PDF1= $("#selectPDF1s").val();
		// }
		// if(results1 == "No")
		// {
		// 	Vids1 = 0;
		// }
		// else
		// {
		// 	Vids1= $("#selectVideo1s").val();
		// }

		$.ajax
		({
			url : 'lessonmaintenance.php',
			type : "POST",
			async : false,
			data : 
			{	
				lessonID1 : lessonID1,
				LessonName1 : Lname1,
				isHavingP1 : results,
				isHavingV1 : results1,
				Videos1 : Vids1,
				PDFFile1 : PDF1,
				Contents1 : SS1,
				
				ULess : 1
			},
			success : function (LessonResult)
			{
				alert(results);
				alert(results1);
		        $.Notify({
		            caption: 'Inserted',
		            content: 'Lesson has Been Updated in ',
		            icon: "<span class='mif-file-text icon'></span>",
		            type: "info"
		        });
				showChapters();
				hideMetroDialog('#dialogEditLessons');
				hideMetroDialog('#dialogChapter');
			}							
		});
	}	
function SelectChapter()
	{
		$.ajax
		({
			url : 'selectChapter.php',
			type : 'POST',
			async : false,
			data : 
			{
				selectChapter : 1
			},
			success : function (selChapt)
			{
				$("#thisBoxx").html(selChapt);
			}							
		});		
	}
function SelectQuiz()
	{
		$.ajax
		({
			url : 'selectQuiz.php',
			type : 'POST',
			async : false,
			data : 
			{
				selectQuiz : 1
			},
			success : function (selQuiz)
			{
				$("#selectionQuiz").html(selQuiz);
				$("#selectEditQuiz").html(selQuiz);
			}							
		});		
	}
function SelectPDF()
	{
		$.ajax
		({
			url : 'selectPDF.php',
			type : 'POST',
			async : false,
			data : 
			{
				SelectPDFs : 1
			},
			success : function (selPDF)
			{
				$("#selectionPDF").html(selPDF);
				$("#selectEditPDF").html(selPDF);
			}							
		});		
	}
function SelectScreenShot()
	{
		$.ajax
		({
			url : 'selectScreenShot.php',
			type : 'POST',
			async : false,
			data : 
			{
				SelectScreenShots : 1
			},
			success : function (selScreenShot)
			{
				$("#selectionScreenShot").html(selScreenShot);
				$("#selectEditSShot").html(selScreenShot);
			}							
		});		
	}
function SelectVideos()
	{
		$.ajax
		({
			url : 'selectVideo.php',
			type : 'POST',
			async : false,
			data : 
			{
				selectVideo : 1
			},
			success : function (selVideo)
			{
				$("#selectionVideo").html(selVideo);
				$("#selectEditVideo").html(selVideo);
			}							
		});		
	}
// function SelectQuiz1()
// 	{
// 		$.ajax
// 		({
// 			url : 'selectQuiz.php',
// 			type : 'POST',
// 			async : false,
// 			data : 
// 			{
// 				selectQuiz1 : 1
// 			},
// 			success : function (selQuiz1)
// 			{
// 				$("#selectionQuiz1").html(selQuiz1);
// 				$("#selectEditQuiz1").html(selQuiz1);
// 			}							
// 		});		
// 	}
// function SelectPDF1()
// 	{
// 		$.ajax
// 		({
// 			url : 'selectPDF1.php',
// 			type : 'POST',
// 			async : false,
// 			data : 
// 			{
// 				SelectPDFs1 : 1
// 			},
// 			success : function (selPDF1)
// 			{
// 				$("#selectionPDF1").html(selPDF1);
// 				$("#selectEditPDF1").html(selPDF1);
// 			}							
// 		});		
// 	}
// function SelectScreenShot1()
// 	{
// 		$.ajax
// 		({
// 			url : 'selectScreenShot.php',
// 			type : 'POST',
// 			async : false,
// 			data : 
// 			{
// 				SelectScreenShots1 : 1
// 			},
// 			success : function (selScreenShot1)
// 			{
// 				$("#selectionScreenShot1").html(selScreenShot1);
// 				$("#selectEditSShot1").html(selScreenShot1);
// 			}							
// 		});		
// 	}
// function SelectVideos1()
// 	{
// 		$.ajax
// 		({
// 			url : 'selectVideo1.php',
// 			type : 'POST',
// 			async : false,
// 			data : 
// 			{
// 				selectVideo1 : 1
// 			},
// 			success : function (selVideo1)
// 			{
// 				$("#selectionVideo1").html(selVideo1);
// 				$("#selectEditVideo1").html(selVideo1);
// 			}							
// 		});		
// 	}
