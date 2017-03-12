<?php

	require 'dbconfig.php';
	if(isset($_POST['SelectScreenShots']))
		{
			$sql=mysqli_query($con,"SELECT * from tblchapter");
			?>
    		<select id="selectedScreenShot">
            <option disabled selected>Select Content</option>
    		<?php
    		while($row=mysqli_fetch_array($sql))
    		{
    		?>
        		<option name="ScreenShotOption" value="<?php echo $row['chapterID']?>" ><?php echo $row['chapterTitle']?></option>
        	<?php
        	}
    		?>
    		</select>
			<?php
			exit();
		}


?>