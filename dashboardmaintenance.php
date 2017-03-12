<?php

	require 'dbconfig.php';
	if(isset($_POST['chapter']))
		{
			$sql=mysqli_query($con,"SELECT Count(*) as chapterCount from tblchapter");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);

			exit();
		}
	if(isset($_POST['lesson']))
		{
			$sql=mysqli_query($con,"SELECT Count(*) as lessonCount from tbllessons");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);

			exit();
		}
	if(isset($_POST['pdf']))
		{
			$sql=mysqli_query($con,"SELECT Count(*) as pdfCount from tblpdf where pdfid > 0");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);

			exit();
		}
	if(isset($_POST['video']))
		{
			$sql=mysqli_query($con,"SELECT Count(*) as videoCount from tblvideos where VideoID > 0");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);

			exit();
		}
	if(isset($_POST['quiz']))
		{
			$sql=mysqli_query($con,"SELECT Count(*) as quizCount from tblquiz");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);

			exit();
		}
	if(isset($_POST['sampleProgCount']))
		{
			$sql=mysqli_query($con,"SELECT Count(*) as sampleProgCount from tblsampleprogram");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);

			exit();
		}
	if(isset($_POST['exercises']))
		{
			$sql=mysqli_query($con,"SELECT Count(*) as exerciseCount from tblexercises");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);

			exit();
		}
	if(isset($_POST['glosaryCount']))
		{
			$sql=mysqli_query($con,"SELECT Count(*) as glossaryCount from tblmeaning");
			$row=mysqli_fetch_object($sql);
			header("Content-type: text/x-json");
			echo json_encode($row);

			exit();
		}
?>