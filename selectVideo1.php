<?php

require 'dbconfig.php';
if(isset($_POST['selectVideo1']))
        {

            ?>
            <select id="selectedVideo1s" name="VideoOption1">
            <?php
                $sql1=mysqli_query($con,"SELECT * from tbllessons where lessonID = {$_POST['LessIDz']}");
                $row1=mysqli_fetch_array($sql1);
                $rowID=$row1['VideoID'];
                $sql2=mysqli_query($con,"SELECT * from tblvideos where VideoID = {$rowID}");
                while($row3=mysqli_fetch_array($sql2))
                {
                ?>
                    <option disabled selected  value="<?php echo $row3["VideoID"]?>" ><?php echo $row3["videoTitle"]?></option>

                <?php
                $sql=mysqli_query($con,"SELECT * from tblvideos where VideoID != {$row3['VideoID']}");
                    while($row=mysqli_fetch_array($sql))
                    {
                    ?>
                        <option value="<?php echo $row['VideoID']?>" ><?php echo $row['videoTitle']?></option>
                    <?php
                    }
                }
            ?>
            </select>
            <?php
            exit();
        }
?>