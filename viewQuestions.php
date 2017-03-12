<?php

	require 'dbconfig.php';
	$counter = mysqli_query($con,"SELECT MAX(quizID) as quizID from tblquiz");
	$counterrow = mysqli_fetch_array($counter);
	if(isset($_POST['viewQuestion']))
		{

			$sql=mysqli_query($con,"SELECT * from ctrquestion where quizID = {$counterrow['quizID']} ");
			while($row=mysqli_fetch_array($sql))
				{
					?>
						<h4 class="text-light sub-header small"><?php echo $row['questionID'].")   ".$row['question']?></h4>
					<?php
					$sql2=mysqli_query($con,"SELECT * from tblchoices where QuestionID = {$row['questionID']} and QuizID = {$counterrow['quizID']} ");
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
					$sql3=mysqli_query($con,"SELECT * from tblanswer where answerID = {$row['answerID']} ");	
					while($row3=mysqli_fetch_array($sql3))
					{
						?>
						<h5 class="text-light sub-alt-header">The Answer Is <?php echo $row3['answer'];?>.</h5>
						<?php
					}
				}
			exit();
		}

?>