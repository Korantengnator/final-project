<?php
include("../classes/loading_classes.php");

//checking if a user is logged in
$login= new Login();
$user_data=$login -> check_login($_SESSION['userid']);

// for posting
if ($_SERVER['REQUEST_METHOD']=="POST")
{
    $QUESTION= new Questions();
    $userid= $_SESSION['userid'];
    $result= $QUESTION-> ask_question($userid,$_POST,$_FILES);
    if($result=="")
    {
         header("location: single_post.php?id=$_GET[id]");
        die;
    }
    else
    {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "The following errors occured<br><br>";
        echo $result;
        echo "</div>";
    }
    
}
// retrieving questions

$error= "";
$QUESTION= new Questions();
if (isset($_GET['id']))
{
    $Row=$QUESTION-> get_one_question($_GET['id']);
  
}
else
{
    $error = "Question not found";
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
    <title>Answer|My Study Guide</title>
</head>

<body style="font-family: tahoma; background-color:#f7f2f2;">
    <div style="width:100%;">
    <div class="sidebar">
            <h2>My Study Guide</h2>
            <ul>
            <li><a style="text-decoration: none;" href="index.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a style="text-decoration: none;" href="profile.php"><i class="fas fa-user"></i>Profile</a></li>
            <li><a style="text-decoration: none;" href="about.php"><i class="fas fa-address-card"></i>About</a></li>
            <li><a style="text-decoration: none;" href="settings.php"><i class="fas fa-cog "></i>Settings</a></li>
            <li><a style="text-decoration: none;" href="Mybooks.php"><i class="fas fa-book"></i>My books</a></li>
            <li><a style="text-decoration: none;" href="../chatbot/mainbot.php"><i class="fas fa-robot"></i>Chat bot</a></li>
                
            </ul> 
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
        <div id="bar" >
        <a href="logout.php">
                <div style="font-size:13px;float:right; color:white; margin: 10px; ">Logout</div>
            </a>
            <div style="margin: auto; width: 800px; font-size: 30px;">
                <form action="search.php" method="get">
                    Answer &nbsp &nbsp<input type="text" id="searchbox" name="find" placeholder="search for questions...">
                    
                
                    
                    <img src="<?php echo $corner_image ?>"  style="width: 50px; height:50px; float: right;border-radius:50%;">
                    
                    <div style="font-size:18px;float:right; margin:10px; color:black;"> <?php echo $user_data['fname'] . " " . $user_data['lname']?></div> 
                </form>
            </div>       
        </div>
        
      
        
        <!-- cover area -->
        <div id="content" style="width: 1000px; margin: auto; min-height: 400px;  "  >
                <div style="display: flex;">
                    <!-- old post area area -->
                    <div style=" min-height: 400px; flex: 3.5; padding: 20px;" >
                        <div id="postbar" style="margin-left: 100px;box-shadow: 5px 10px 8px #888888;">
                            <?php
                            
                                if (is_array($Row))
                                {
                                    $user = new User();
                                    $user_row=$user->get_user($Row['userid']);
                                    include("foranswers.php");
                                }
                            
                            
                            ?>
                            <br style="clear:both;"> 
                            <div style="border: solid thin grey;  color:  #aaa; padding: 10px;  margin-top: 90px;width:750px;  " >
                                <form method="POST" enctype="multipart/form-data">
                                        
                                    <textarea name="question_details" placeholder="Answer the question..."  id="questions" cols="20" rows="3"></textarea>
                                    <input type="hidden" name="parent" value="<?Php echo $Row['questionid'] ?>">
                                    <label for="file-input">
                                    <img src="https://icons.iconarchive.com/icons/dtafalonso/android-lollipop/128/Downloads-icon.png"  style="width:35px;height:35px;margin-left:5px;">
                                    </label>
                                    <span style="display:none;">
                                    <input id="file-input"  type="file" name="file">
                                    </span>
                                    <input id="post_button" type="submit" value="post">
                                    <br><br>
                                </form>
                                
                                
                            </div> 
                            <br><br>
            
                            <?php
                            $user= new User();
                            $sql= "SELECT * from questions where parent='$Row[questionid]' order by id asc limit 10";
                             //$answers=$QUESTION->get_answers($Row['questionid']);
                            
                            
                            // if(is_array($answers))
                            // {
                            //     foreach ($answers as  $Row)
                            //     {
                            //         $user_row=$user->get_user($Row['userid']);
                            //         include("answers.php");
                            //     }
                            // }
                            $new= mysqli_query($conn,$sql);
                            $resultcheck= mysqli_num_rows($new);
                            if ($resultcheck>0)
                            {
                                while ($Row = mysqli_fetch_assoc($new))
                                {
                                    
                                    $user_row = $user-> get_user($Row['userid']);
                                    include("answers.php");
                                }
                            }


                            ?>

                        </div>
                        
                    </div>
                    
                </div>  

            
        </div>
    
    </div>
    
</body>
</html>