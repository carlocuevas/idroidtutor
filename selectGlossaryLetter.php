<?php
	require 'dbconfig.php';
	if(isset($_POST['selector']))
		{
			$sql=mysqli_query($con,"SELECT * from tblglossary");
			?>
    		<select id="selectLetter">
            <option disabled selected value="0">Select Letter</option>
    		<?php
    		while($row=mysqli_fetch_array($sql))
    		{
    		?>
        		<option  value="<?php echo $row['glossaryID']?>" ><?php echo $row['letterStarts']?></option>
        	<?php
        	}
    		?>
    		</select>
			<?php
			exit();
		}
    
?>