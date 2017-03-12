<?php
	
	require 'dbconfig.php';
	if(isset($_POST['addNewLessons']))
		{
			$sql=mysqli_query($con,"SELECT * from tblchapter where chapterID = {$_POST['idNewL']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['editChapter']))
		{
			$sql=mysqli_query($con,"SELECT * from tblchapter where chapterID = {$_POST['ideC']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['deleteLesson1']))
		{	
			$sql=mysqli_query($con,"SELECT * from tbllessons where lessonID = {$_POST['DelLesss']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['deleteLesson']))
		{
			$priorityid=$_POST['lessIDs'];
				$sql2=mysqli_query($con,"SELECT * from tbllessons where lessonID = {$priorityid} ");
				while($row=mysqli_fetch_array($sql2))
				{
					$sql3=mysqli_fetch_array($con,"DELETE from tblcontent where contentID={$row['contontID']}");
				}	
			mysqli_query($con,"DELETE from tbllessons where lessonID = {$_POST['lessIDs']}");
			exit();	
		}
	if(isset($_POST['editLesx']))
		{
			$sql=mysqli_query($con,"SELECT * from tbllessons where lessonID = {$_POST['LessIDz']}");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['editLesx1']))
		{
			$sql1=mysqli_query($con,"SELECT * from tblcontent where contentID = (SELECT contentID from tbllessons where lessonID = {$_POST['LessIDz']})");
			header("Content-type: text/x-json");
			$row=mysqli_fetch_object($sql1);
			echo json_encode($row);
			exit();
		}
	if(isset($_POST['addNewLesson']))
		{
				$sqlid=mysqli_query($con,"INSERT INTO tblcontent values(DEFAULT,'{$_POST['Contents']}')");
				$id=mysqli_insert_id($con);
				mysqli_query($con,"INSERT INTO tbllessons values(DEFAULT,{$_POST['Chapterd']},'{$_POST['LessonName']}',0,{$_POST['PDFFile']},{$_POST['Videos']},{$id},'{$_POST['isHavingP']}','{$_POST['isHavingV']}','No','No')");
				exit();
		}
	if(isset($_POST['ULess']))
		{
			mysqli_query($con,"UPDATE tbllessons set LessonTitle='{$_POST['LessonName1']}' , VideoID={$_POST['Videos1']} , pdfID={$_POST['PDFFile1']} , ishavingaPDF = '{$_POST['isHavingaP1']}' , ishavingaVideo = '{$_POST['isHavingaV1']}' where lessonID = {$_POST['lessonID1']}");
						exit();	
			$content=$_POST['Contents1'];
				if($content=="")
				{
					$content="No Content";
				}
				else
				{
					$content=$_POST['Contents1'];
				}
				$sql=mysqli_query($con,"SELECT * from tbllessons where lessonID={$_POST['lessonID1']}");
				while($row=mysqli_fetch_array($sql))
				{
					mysqli_query($con,"UPDATE tblcontent set contents ='{$content}' where contentID={$row['contentID']}");
				}

		}

?>