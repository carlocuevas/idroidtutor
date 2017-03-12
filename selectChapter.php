<?php

	require 'dbconfig.php';
	if(isset($_POST['selectChapter']))
		{
			$sql=mysqli_query($con,"SELECT * from tblchapter");
			?>
    		<select id="selectedChapter">
            <option Disabled selected>Select Insertion</option>
    		<?php
    		while($row=mysqli_fetch_array($sql))
    		{
    		?>
        		<option value="<?php echo $row['chapterID']?>" id="<?php echo $row['chapterID']?>" ><?php echo $row['chapterTitle']?></option>
        	<?php
        	}
    		?>
    		</select>
			<?php
			exit();
		}


?>