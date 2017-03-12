<?php

	require 'dbconfig.php';
	if(isset($_POST['selectQuiz']))
		{
			$sql=mysqli_query($con,"SELECT * from tblquiz");
			?>
    		<select id="selectedQuiz">
            <option disabled selected>Select Quiz</option>
    		<?php
    		while($row=mysqli_fetch_array($sql))
    		{
    		?>
        		<option value="<?php echo $row['quizID']?>" ><?php echo $row['quizID']?></option>
        	<?php
        	}
    		?>
    		</select>
			<?php
			exit();
		}
    if(isset($_POST['selectQuiz1']))
        {
            $sql=mysqli_query($con,"SELECT * from tblquiz");
            ?>
            <select id="selectedQuiz">
            <option disabled selected>Select Quiz</option>
            <?php
            while($row=mysqli_fetch_array($sql))
            {
            ?>
                <option value="<?php echo $row['quizID']?>" ><?php echo $row['quizID']?></option>
            <?php
            }
            ?>
            </select>
            <?php
            exit();
        }


?>