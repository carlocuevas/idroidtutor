<?php

require 'dbconfig.php';
if(isset($_POST['selectPDF1']))
        {
            $sql1=mysqli_query($con,"SELECT * from tbllessons where lessonID = {$_POST['LessIDz']}");
            $row1=mysqli_fetch_array($sql1);
            ?>
            <select id="selectedPDF1s" name="PDFOption1">
            <?php
                $rowID=$row1['pdfID'];
                $sql2=mysqli_query($con,"SELECT * from tblpdf where pdfID = {$rowID}");
                while($row3=mysqli_fetch_array($sql2))
                {
                ?>
                    <option disabled selected value="<?php echo $row3["pdfID"]?>" ><?php echo $row3["pdfTitle"]?></option>

                <?php
                $sql=mysqli_query($con,"SELECT * from tblpdf where pdfID != {$row3['pdfID']}");
                    while($row=mysqli_fetch_array($sql))
                    {
                    ?>
                        <option value="<?php echo $row['pdfID']?>" ><?php echo $row['pdfTitle']?></option>
                    

                    <?php
                    }
                }
            ?>
            </select>
            <?php
            exit();
        }
?>