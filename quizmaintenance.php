<?php
	//Extra Query
	require 'dbconfig.php';
	$sqlQuery = mysqli_query($con,"SELECT MAX(quizID) as quizID from tblquiz");
	$rowQuery = mysqli_fetch_array($sqlQuery);
	$maxID = $rowQuery["quizID"];
	$sqlQuery2=mysqli_query($con,"SELECT MAX(questionID) as questionID from ctrquestion where quizID = {$maxID}");
	$rowQuery2=mysqli_fetch_array($sqlQuery2);
	$increment=$rowQuery2['questionID']+1;
	if(isset($_POST['showQuiz']))
		{
			?>
			<table class="hovered border dataTable"  id="DataTabs3" data-auto-width="true">
			                     <thead>
			                      			  <tr>
			                      			 	  <th>Quiz Number</th>
			                      			 	  <th>Maintenance</th>
			                     		   </tr>
			                     	     </thead>
			                        <tbody >
			                        	<?php
			                        	$sql=mysqli_query($con,"SELECT * From tblquiz order by quizID desc");
			                        	while($row2=mysqli_fetch_array($sql))
			                        	{
			                        		
			                        	?>
			                        	<tr>
			                        	  <td><?php echo $row2['quizID']?></td>
									      <td><div class="toolbar">
											        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white DelQuiz"
											        	onclick="edit(dialogDeleteConfirmationQuiz)" idDelQ= '<?php echo $row2['quizID']; ?>' ><span class="mif-bin icon" ></span></button>
											        <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white ViewQ" onClick="edit(ViewQuestions);"  idView= '<?php echo $row2['quizID']; ?>'><span class="mif-eye icon" ></span></button>
											  </div>
										  </td>
			                        	</tr>
			                        	<?php
			                        	}

			                        	?>
			     			</tbody>
				</table>

			<script>

					$("#DataTabs3").dataTable({

					    "scrollCollapse": true,
					    'scrollY':"35.5vh",
					    'pagingType': 'full'
					    
					});

			</script>

			<?php
			exit(); 
		}
	if(isset($_POST['showQue']))
		{
			?>
			<table class="hovered border dataTable"  id="DataTabs4" >
			                     <thead>
			                      			  <tr>
			                      			 	  <th>Quiz Number</th>
			                      			 	  <th>Question Number</th>
			                      			 	  <th>Question</th>
			                      			 	  <th>Maintenance</th>

			                     		   </tr>
			                     	     </thead>
			                        <tbody >
			                        	<?php
			                        	$sql=mysqli_query($con,"SELECT * From ctrquestion where quizID = (SELECT MAX(quizID) from tblquiz)");
			                        	while($row=mysqli_fetch_array($sql))
			                        	{
			                        		
			                        	?>
			                        	<tr>
			                        	  <td><?php echo $row['quizID']?></td>
			                        	  <td><?php echo $row['questionID']?></td>
			                        	  <td><?php echo $row['question']?></td>
									      <td><div class="toolbar">
											        <button class="toolbar-button bg-darkViolet bg-active-violet fg-white DelQuest" onClick="edit(dialogDeleteConfirmationQuestion)" idDelQuest="<?php echo $row['questionID']?>"><span class="mif-bin icon" ></span></button>
											      <!--  <button class="toolbar-button bg-darkViolet bg-active-violet fg-white EditQuest" onClick="edit('#dialogQuestion')" idEditQuestion=><span class="mif-pencil icon" ></span></button>
											      --></div>
										  </td>
			                        	</tr>
			                        	<?php
			                        	}

			                        	?>
			     			</tbody>
				</table>

			<script>

					$("#DataTabs4").dataTable({

					    "scrollCollapse": true,
					    "scrollY":"30vh",
					    'pagingType': 'full'
					    
					});
					function edit(id)
					{
					        var dialog = $(id).data('dialog');
					        dialog.open();

					}
			</script>
			<?php
			exit(); 
		}
	if(isset($_POST['addQuiz']))
	 	{
	 		$sql=mysqli_query($con,"INSERT INTO tblquiz values(DEFAULT)");
	 		if(mysqli_affected_rows($sql) !=0)
	 		{
	 			echo 0;
	 		}
	 		exit();
	 	}
	if(isset($_POST['addQue']))
		{
			$query = mysqli_query($con,"INSERT INTO tblanswer values(DEFAULT,'{$_POST['Ans']}')");
			$id=mysqli_insert_id($con);
			mysqli_query($con,"INSERT INTO tblchoices values(DEFAULT,".$maxID.",".$increment.",'{$_POST['AA']}','{$_POST['AB']}','{$_POST['AC']}','{$_POST['AD']}');");
			mysqli_query($con,"INSERT INTO ctrquestion values(DEFAULT,".$maxID.",".$increment.",'{$_POST['Quest']}','".$id."');");
			echo 0;
			exit();
		}
	if(isset($_POST['deleteQuiz']))
		 {
		 	mysqli_query($con,"DELETE FROM tblquiz where quizID = {$rowQuery['quizID']}");
		 	$sql2=mysqli_query($con,"SELECT * from ctrquestion where quizID={$rowQuery['quizID']}");
		 	while($row2=mysqli_fetch_array($sql2))
		 	{
		 		mysqli_query($con,"DELETE from tblanswer where AnswerID = {$row2['answerID']}");
		 	}
		 	mysqli_query($con,"DELETE from tblchoices where quizID={$rowQuery['quizID']}");
		 	mysqli_query($con,"DELETE FROM ctrquestion where quizID = {$rowQuery['quizID']}");
		 	exit();	
		 }
	if(isset($_POST['deleteQuiz2']))
		 {
		 	mysqli_query($con,"DELETE FROM tblquiz where quizID = {$_POST['questionsD']}");

		 	$sql=mysqli_query($con,"SELECT * from ctrquestion where quizID={$_POST['questionsD']}");
		 	while($row2=mysqli_fetch_array($sql))
		 	{
		 		mysqli_query($con,"DELETE from tblanswer where AnswerID = {$row2['answerID']}");
	 			mysqli_query($con,"DELETE from tblchoices where quizID={$row2['quizID']}");
		 		mysqli_query($con,"DELETE FROM ctrquestion where quizID = {$row2['quizID']}");
		 	}
		 
		 	exit();	
		 }
	if(isset($_POST['deleteQuest']))
		 {
		 	if(mysqli_query($con,"DELETE FROM ctrquestion where questionID = {$_POST['questionsD']} and quizID = {$rowQuery['quizID']}"))
		 	{
		 		mysqli_query($con,"UPDATE ctrquestion set questionID = (questionID-1) where questionID > {$_POST['questionsD']} and quizID = {$rowQuery['quizID']} ");
		 		mysqli_query($con,"DELETE FROM tblchoices where QuestionID = {$_POST['questionsD']} and QuizID = {$rowQuery['quizID']}");
		 	}
		 	exit();	

		 }
	if(isset($_POST['deleteQuest1']))
		{
			$sql=mysqli_query($con,"SELECT * from ctrquestion where questionID = {$_POST['idDelQuest']} and quizID = {$rowQuery['quizID']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['deleteQuestionManual']))
		{
			$sql=mysqli_query($con,"SELECT * from ctrquestion where questionID = {$_POST['idDelQuest']} and quizID = {$_POST['quizID']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['viewQuizManual']))
		{
			$sql=mysqli_query($con,"SELECT * from showeditablequestions where questionID = {$_POST['idla']} and quizID = {$_POST['quizID']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['UpdateQuestion']))
		{
			mysqli_query($con,"UPDATE ctrquestion set question ='{$_POST['Question']}' where quizID ={$_POST['quizID']} and questionID = {$_POST['questionID']}");
			mysqli_query($con,"UPDATE tblchoices set choiceA = '{$_POST['choicesA']}',choiceB = '{$_POST['choicesB']}',choiceC = '{$_POST['choicesC']}',choiceD = '{$_POST['choicesD']}' where QuestionID={$_POST['questionID']} AND QuizID ={$_POST['quizID']}");
			$sql=mysqli_query($con,"SELECT * from ctrquestion where quizID={$_POST['quizID']} AND questionID = {$_POST['questionID']}");
			while($row=mysqli_fetch_array($sql))
			{
				mysqli_query($con,"UPDATE tblanswer set answer = '{$_POST['Answer']}' where AnswerID = {$row['answerID']}");
			}
			exit();	
		}
	if(isset($_POST['deleteQuestionManual1']))
		 {
		 	if(mysqli_query($con,"DELETE FROM ctrquestion where questionID = {$_POST['questionID']} and quizID = {$_POST['quizID']}"))
		 	{
		 		mysqli_query($con,"UPDATE ctrquestion set questionID = (questionID-1) where questionID > {$_POST['questionID']} and quizID = {$_POST['quizID']} ");
		 		if(mysqli_query($con,"DELETE FROM tblchoices where QuestionID = {$_POST['questionID']} and QuizID = {$_POST['quizID']}"))
		 		{
		 			mysqli_query($con,"UPDATE tblchoices set questionID = (questionID-1) where questionID > {$_POST['questionID']} and quizID = {$_POST['quizID']}");
		 		}
		 	}
		 	exit();	

		 }
	if(isset($_POST['deleteQuiz1']))
		{
			$sql=mysqli_query($con,"SELECT * from tblquiz where quizID = {$_POST['idDelQuest']}");
			$row2=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row2);
			exit();
		}
	if(isset($_POST['showQuizNumber']))
		{
			$sql=mysqli_query($con,"SELECT max(quizid) as QuizID from tblquiz");
			$row=mysqli_fetch_object($sql);
			header("Content-type:text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['viewQuiz']))
		{

			$sql=mysqli_query($con,"SELECT * from ctrquestion where quizID = {$_POST['idla']} ");
			while($row5=mysqli_fetch_array($sql))
				{
					?>
					<hr class="bg-black"/><br/>
				 <div class="toolbar">
					 <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white editManual" onClick="edit(UpdateQuestions);"  idEditManual= '<?php echo $row5['questionID']; ?>'><span class="mif-pencil icon" ></span></button>
	 				 <button class="toolbar-button bg-darkBlue bg-active-lightBlue fg-white delManual" onClick="edit(dialogDeleteConfirmationQuestionManual);"  idDeleteManual= '<?php echo $row5['questionID']; ?>'><span class="mif-bin icon" ></span></button>
 				 </div>
				<h4 class="text-light sub-header small"><?php echo $row5['questionID'].")   ".$row5['question']?></h4>
					<?php
				$sql2=mysqli_query($con,"SELECT * from tblchoices where QuestionID = {$row5['questionID']} and QuizID = {$_POST['idla']} ");
					while($row2=mysqli_fetch_array($sql2)) 
						{
							?>
								<table>
								<tr>
									<td>A )</td>
									<td><?php echo $row2['choiceA'];?></td>
								</tr>
								<tr>
									<td>B )</td>
									<td><?php echo $row2['choiceB'];?></td>
								</tr>
								<tr>
									<td>C )</td>
									<td><?php echo $row2['choiceC'];?></td>
								</tr>
								<tr>
									<td>D )</td>
									<td><?php echo $row2['choiceD'];?></td>
								</tr>
								</table>
							<?php			
						}
					$sql3=mysqli_query($con,"SELECT * from tblanswer where answerID = {$row5['answerID']} ");	
					while($row3=mysqli_fetch_array($sql3))
					{
						?>
						<h5 class="text-light sub-alt-header">The Answer Is <?php echo $row3['answer'];?>.</h5>
						<?php
					}
					?>

					<?php
				}
			exit();
		}
?>