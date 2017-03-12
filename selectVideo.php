<?php

    require 'dbconfig.php';
    if(isset($_POST['selectVideo']))
        {
            $sql=mysqli_query($con,"SELECT * from tblvideos where VideoID > 0");
            ?>
            <select id="selectedVideo" name="videoOption">
            <option disabled selected  value="0">Select Video</option>
            <?php
            while($row=mysqli_fetch_array($sql))
            {
            ?>
                <option  value="<?php echo $row['VideoID']?>" ><?php echo $row['videoTitle']?></option>
            <?php
            }
            ?>
            </select>
            <?php
            exit();
        }
        

    

?>