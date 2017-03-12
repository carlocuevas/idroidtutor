<?php
	require 'dbconfig.php';
	if(isset($_POST['dashboard']))
		{
			?>
		<div  style="height:87vh;">
		<h1 class="text-light" style="font-weight:10px;">Dashboard</h1>

				<div class="row">
					<div class="cell size4 padding10">
							<div class="tile full-size" onclick="Chapter();">
							    <div class="tile-content slide-left-2 bg-dark">
							        <span class="tile-label fg-white">Chapters</span>
							        <span class="tile-badge fg-white bg-dark" id="ChapterCount">1</span>
						        <div class="slide">
						        </div>
							        <div class="slide-over bg-darkRed fg-white">
							        	<div class="padding10">
							        	<span class="text-light">In this module you can add and modify Chapters that can be seen in the App.</span>
							        	</div>
						       		 </div>
							    </div>

							</div>
					</div>	
					<div class="cell size4 padding10">
							<div class="tile full-size bg-dark"  onclick="Chapter();">
							    <div class="tile-content slide-down-2">
							        <span class="tile-label fg-white">Lessons</span>
							        <span class="tile-badge fg-white bg-dark" id="LessonCount">2</span>
	    					        <div class="slide">
							        </div>
							        <div class="slide-over bg-darkBlue fg-white">
							        	<div class="padding10">
							        	<span class="text-light">In this module can see the lesson and you can modify and add a new lesson</span>
							        	</div>
							        </div>
							    </div>
							</div>
					</div>
					<div class="cell size4 padding10">
							<div class="tile full-size bg-dark"  onclick="SamplExercises();">
							    <div class="tile-content slide-right-2">
							        <span class="tile-label fg-white">Exercises</span>
							        <span class="tile-badge fg-white bg-dark" id="ExercisesCount">2</span>
	    					        <div class="slide">
							        </div>
							        <div class="slide-over bg-darkIndigo fg-white">
							        	<div class="padding10">
							        	<span class="text-light">In this module can see the Program Exercises and its maintenance</span>
							        	</div>
							        </div>
							    </div>
							</div>
					</div>
				</div>
				<div class="row">
					<div class="cell size6 padding10">
						<div class="tile full-size">
						    <div class="tile-content slide-up-2 bg-dark"  onclick="videos();">
						        <span class="tile-label fg-white">Videos</span>
						        <span class="tile-badge fg-white bg-dark" id="VideoCount">3</span>
						        <div class="slide">
						        </div>
						        <div class="slide-over bg-darkTeal fg-white">
						        	<div class="padding10">
						        	<span class="text-light">In this module can upload Video that can be watched through the mobile devices</span>
						        	</div>
						        </div>
						    </div>
						</div>
					</div>
					<div class="cell size6 padding10">
						<div class="tile full-size">
						    <div class="tile-content slide-down-2 bg-dark"  onclick="PDF();">
						        <span class="tile-label fg-white">PDF's</span>
						        <span class="tile-badge fg-white bg-dark" id="PDFCount">3</span>
						        <div class="slide">
						        	
						        </div>
						        <div class="slide-over bg-darkEmerald fg-white">
						        	<div class="padding10">
						        		<span class="text-light">In this module can upload pdf Files that can be Downloaded in the Mobile Application</span>
						        	</div>
						        </div>
						    </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="cell size4 padding10" style="padding-top:0;padding-bottom:0;">
						<div class="tile full-size tile-wide">
						    <div class="tile-content slide-left-2 bg-dark"  onclick="Quiz();">
						        <span class="tile-label fg-white">Quizzes</span>
						        <span class="tile-badge fg-white bg-dark" id="QuizCount">5</span>
						        <div class="slide">
						        	
						        </div>
						        <div class="slide-over bg-darkCrimson fg-white">
						        	<div class="padding10">
						        		<span class="text-light">In this module you can add and modify Quizzes</span>
						        	</div>
						        </div>
						    </div>
						</div>
					</div>
					<div class="cell size4 padding10" style="padding-top:0;padding-bottom:0;">
						<div class="tile full-size tile-wide">
						    <div class="tile-content slide-up-2 bg-dark"  onclick="SampleProgram();">
						        <span class="tile-label fg-white">Sample Programs</span>
						        <span class="tile-badge fg-white bg-dark" id="SampleProgramCount">5</span>
						        <div class="slide">
						        	
						        </div>
						        <div class="slide-over bg-darkBrown fg-white">
						        	<div class="padding10">
						        		<span class="text-light">In this module you can add and modify Sample programs</span>
						        	</div>
						        </div>
						    </div>
						</div>
					</div>
					<div class="cell size4 padding10" style="padding-top:0;padding-bottom:0;">
						<div class="tile full-size tile-wide">
						    <div class="tile-content slide-right-2 bg-dark"  onclick="Glossary();">
						        <span class="tile-label fg-white">Glossary Meanings</span>
						        <span class="tile-badge fg-white bg-dark" id="GlossaryMeaningCount">5</span>
						        <div class="slide">
						        	
						        </div>
						        <div class="slide-over bg-darkMagenta fg-white">
						        	<div class="padding10">
						        		<span class="text-light">In this module you can add and modify glossary meanings<span>
						        	</div>
						        </div>
						    </div>
						</div>
					</div>
				</div>
		</div>
			<script type="text/javascript">
				getCounts();
				function getCounts()
				{
					$.ajax
					({
						url:"dashboardmaintenance.php",
						type:"POST",
						async:false,
						data:
						{
							chapter:1
						},
						success:function(chapterCount)
						{
							document.getElementById("ChapterCount").innerHTML=chapterCount.chapterCount;
						}
					});
					$.ajax
					({
						url:"dashboardmaintenance.php",
						type:"POST",
						async:false,
						data:
						{
							glosaryCount:1
						},
						success:function(glossaryCount)
						{
							document.getElementById("GlossaryMeaningCount").innerHTML=glossaryCount.glossaryCount;
						}
					});
					$.ajax
					({
						url:"dashboardmaintenance.php",
						type:"POST",
						async:false,
						data:
						{
							sampleProgCount:1
						},
						success:function(sampleProgCount)
						{
							document.getElementById("SampleProgramCount").innerHTML=sampleProgCount.sampleProgCount;
						}
					});
					$.ajax
					({
						url:"dashboardmaintenance.php",
						type:"POST",
						async:false,
						data:
						{
							lesson:1
						},
						success:function(lessonCount)
						{
							document.getElementById("LessonCount").innerHTML=lessonCount.lessonCount;
						}
					});
					$.ajax
					({
						url:"dashboardmaintenance.php",
						type:"POST",
						async:false,
						data:
						{
							pdf:1
						},
						success:function(pdfCount)
						{
							document.getElementById("PDFCount").innerHTML=pdfCount.pdfCount;
						}
					});
					$.ajax
					({
						url:"dashboardmaintenance.php",
						type:"POST",
						async:false,
						data:
						{
							video:1
						},
						success:function(videoCount)
						{
							document.getElementById("VideoCount").innerHTML=videoCount.videoCount;
						}
					});
					$.ajax
					({
						url:"dashboardmaintenance.php",
						type:"POST",
						async:false,
						data:
						{
							quiz:1
						},
						success:function(quizCount)
						{
							document.getElementById("QuizCount").innerHTML=quizCount.quizCount;
						}
					});
					$.ajax
					({
						url:"dashboardmaintenance.php",
						type:"POST",
						async:false,
						data:
						{
							exercises:1
						},
						success:function(exerciseCount)
						{
							document.getElementById("ExercisesCount").innerHTML=exerciseCount.exerciseCount;
						}
					});				
				}
			</script>
			<?php
			exit();
		}
					
?>