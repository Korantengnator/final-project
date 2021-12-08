 
<div id="post" style="width:750px;">
                        
    <?php
        //for updating the profile image in the post
        $image="../images/profile.png";
        if (file_exists($user_row['profile_image']))
        {
            $image= $user_row['profile_image'];  
        }
    ?>
                        
    <img src="<?php echo $image ?>" style="width: 50px; margin-right: 10px;height: 50px; border-radius:50%; margin-top:-5px; ">
                        
    <div style="width:100%;">
                        
        <div style="font-weight: bold; color: rgb(233, 80, 80);width:100%;  ">
            <!-- using html escaping for security purposes  -->
            <?php echo htmlspecialchars($user_row['fname']) . " " . htmlspecialchars($user_row['lname']);?>

            <span style="color: black; ">
                <?php echo "<br>$Row[timeAsked]<hr style='margin-top: 5px'> "?>
            </span> 
        </div>
       
        <?php 
        
            echo htmlspecialchars($Row['question_details']) ;
                                
            if (file_exists($Row['image']))
            {
            echo "<br><img src='$Row[image]' style='width: 500px;;;height: 500px;;margin-left: 90px;' >";
            }                       
        ?>
       
       
        
    </div>
</div>