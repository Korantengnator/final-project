 
<div id="post" style="width:750px; background-color:#eee;">
                        
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

            <span style="color: #aaa; ">
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
       
        <br><br><br>
        <?php
        $likes="";
        $likes= ($Row['likes']>0) ? "(" .$Row['likes']. ")" : "" ;

        $reports="";
        $reports= ($Row['reports']>0) ? "(" .$Row['reports']. ")" : "" ;
        ?>
        <a href="like.php?type=question_details&id=<?php echo $Row['questionid']?>" style="text-decoration:none; color:black;">
        <img src="../images/like.png"  style="width:25px;height:25px;">
        <?php echo $likes ?>|
        </a>
        <a href="reports.php?type=question_details&id=<?php echo $Row['questionid']?>" style="text-decoration:none; color:black;">
        <img src="../images/report1.png"  style="width:25px;height:20px;">
        <?php echo $reports ?></a>
           
        <span style="color: #999;float:right;">
            <?php
            $QUESTION= new Questions();
            if ($QUESTION->I_asked_question($Row['questionid'],$_SESSION['userid']))
            {
                echo "
                <a href='edit.php?id=$Row[questionid]' style='text-decoration:none; color:black;'>
                <img src='../images/edit.png'  style='width:25px;height:25px;'> 
                </a>| 
                <a href='delete.php?id=$Row[questionid]' style='text-decoration:none; color:black;'>
                <img src='../images/delete.png'  style='width:25px;height:25px;'>  
                </a>";
            }
            
             
            ?>
            
        </span> 
        <?php
        // displaying who liked the question
        $i_reported= false;
        if (isset($_SESSION['userid']))
        {
           
            $DB= new Database();
            
            $sql= "SELECT reports FROM reports WHERE  type='question_details'&& contentid='$Row[questionid]' LIMIT 1";
            $result=$DB-> read($sql);
            if(is_array($result))
            {
                $reports= json_decode($result[0]['reports'],true);
                $user_ids= array_column($reports, "userid");

                if (in_array($_SESSION['userid'],$user_ids))
                {
                    $i_reported= true;

                }
            }  
        }  
        if($Row['reports']>0)
        {
            echo "<br>";
            if($Row['reports']==1)
            {
                if ($i_reported)
                {
                    echo "<span style='float:left; 
                    color:#ccc;'> You reported this question</span>";
                }
                else
                {
                    echo "<span style='float:left;color:#ccc;'>1 person reported this question</span>";

                }
     
            }
            else
            {
                if ($i_reported)
                {
                    $text= "people";
                    if ($Row['reports']-1 == 1)
                    {
                        $text= "person";
                    }
                    echo "<span style='float:left;
                    color:#ccc;'>You and".($Row['reports']-1). " $text reported this question</span>";
                }
                else
                {
                    echo "<span style='float:left;color:#ccc;'>".$Row['reports']." people reported this question</span>";
                }
                
            }
            


            
        }

        ?>
    </div>
</div>