<?php
	require 'dbconfig.php';
	if(isset($_POST['SelectPDFs']))
		{
			$sql=mysqli_query($con,"SELECT * from tblpdf where pdfID > 0");
			?>
    		<select id="selectedPDF" name="PDFSelection">
            <option disabled selected value="0">Select PDF</option>
    		<?php
    		while($row=mysqli_fetch_array($sql))
    		{
    		?>
        		<option  value="<?php echo $row['pdfID']?>" ><?php echo $row['pdfTitle']?></option>
        	<?php
        	}
    		?>
    		</select>
			<?php
			exit();
		}
    
?>