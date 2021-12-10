<?php
    include("../classes/loading_classes.php");


    //checking if a user is logged in
    $login= new Login();
    $user_data=$login -> check_login($_SESSION['userid']);

    // retrieving question id
    $error= "";
    $QUESTION= new Questions();
    if (isset($_GET['id']))
    {
        $Row=$QUESTION-> get_one_question($_GET['id']);
        if(!$Row)
        {
            $error = "Question not found";
        }
        else
        {
            // to prevent users from deleting the questions of other users
            if ($Row['userid']!=$_SESSION['userid'])
            {
                $error= "You don't have access to delete this question!!!";
            }
        }
    }
    else
    {
        $error = "Question not found";
    }
    if (isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'],"edit.php"))
    {
        $_SESSION['return_to']= $_SERVER['HTTP_REFERER'];
    }
    
    //if a question was asked
    if ($_SERVER['REQUEST_METHOD']=="POST")
    {
        $QUESTION->edit_question($_POST,$_FILES);
        
        header("location: ".$_SESSION['return_to']);
        die;
    }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Edit|My Study Guide</title>
</head>

<body style="font-family: tahoma; background-color:#f7f2f2;">
    <!-- side bar -->
    <div class="sidebar">
        <h2>My Study Guide</h2>
        <ul>
        <li><a style="text-decoration: none;" href="index.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a style="text-decoration: none;" href="profile.php"><i class="fas fa-user"></i>Profile</a></li>
            <li><a style="text-decoration: none;" href="about.php"><i class="fas fa-address-card"></i>About us</a></li>
            <li><a style="text-decoration: none;" href="settings.php"><i class="fas fa-cog "></i>Settings</a></li>
            <li><a style="text-decoration: none;" href="Mybooks.php"><i class="fas fa-book"></i>My books</a></li>
            <li><a style="text-decoration: none;" href="../chatbot/mainbot.php"><i class="fas fa-robot"></i>Chat bot</a></li>
        </ul> 
    </div>
    <?php
            //for updating the profile image in the header
            $corner_image = "../images/profile.png";
            if (isset($user_data))
            {
              $corner_image= $user_data['profile_image'];  
            }
            ?>
        </div>
        <!-- top bar -->
        <div id="bar" style="width:100%" >
        <a href="logout.php">
            <div style="font-size:13px;float:right; color:white; margin: 10px;  ">Logout</div>
        </a>
            <div style="margin: auto; width: 800px; font-size: 30px;">
                <form action="search.php" method="get">
                    Edit &nbsp &nbsp<input type="text" id="searchbox" name="find" placeholder="search for questions...">
                    
                
                    
                    <img src="<?php echo $corner_image ?>"  style="width: 50px; height:50px; float: right;border-radius:50%;">
                    
                    <div style="font-size:18px;float:right; margin:10px; color:black;"> <?php echo $user_data['fname'] . " " . $user_data['lname']?></div> 
                </form>
            </div>       
        </div>
    
   
    <!-- cover area -->
    <div id="content" style="width: 1000px; margin: auto; min-height: 400px;  "  >
       
             <div style=" min-height: 400px; margin-left:100px; " >
                <div style="border: solid thin;  color:  #aaa; padding: 10px;  margin-top: 90px; border: none; background-color: white;box-shadow: 5px 10px 8px #888888;" >
                    <form method="POST" enctype="multipart/form-data" >     
                    
                    
                    <?php 
                    if ($error != "")
                    {
                        return $error;
                    }
                    else
                    {
                        
                        echo "Edit Post<br><br>";
                        echo '<textarea name="question_details" placeholder="Ask a question..."  id="questions" ">'.$Row['question_details'].'</textarea>';
                        
                        
                              
                       
                        echo "<input name='questionid' type='hidden' value='$Row[questionid]'>";
                        if (file_exists($Row['image']))
                              {
                                  echo "<br><img src='$Row[image]' style='width: 500px;;;height: 500px;;margin-left: 200px;' >";
                              }        
                              echo"<br><br>";
                              echo   '<label for="file-input">
                              <img src="https://icons.iconarchive.com/icons/dtafalonso/android-lollipop/128/Downloads-icon.png"  style="width:35px;height:35px;margin-left:50px;transform: rotate(180deg);">
                              </label>
                              <span style="display:none;">
                              <input id="file-input"  type="file" name="file">
                              </span>';
                        echo "<input id='edit_btn' type='submit' value='Edit'>";  
                        

                        
                    }
                    
                    
                    
                    ?>
                    
                    </form>
                    <br>
                </div> 
            </div>
    </div>
    
</body>
</html>