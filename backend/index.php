<?php
include("../classes/loading_classes.php");


//checking if a user is logged in

$login= new Login();
$user_data=$login -> check_login($_SESSION['userid']);

// for posting
if ($_SERVER['REQUEST_METHOD']=="POST")
{
    $question_details= new Questions();
    $userid= $_SESSION['userid'];
    $result= $question_details-> ask_question($userid,$_POST, $_FILES);
    if($result=="")
    {
         header("location: index.php");
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





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <title>Index|My Study Guide</title>
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
                    Home &nbsp &nbsp<input type="text" id="searchbox" name="find" placeholder="search for questions...">
                    
                
                    
                    <img src="<?php echo $corner_image ?>"  style="width: 50px; height:50px; float: right;border-radius:50%;">
                    
                    <div style="font-size:18px;float:right; margin:10px; color:black;"> <?php echo $user_data['fname'] . " " . $user_data['lname']?></div> 
                </form>
            </div>         
        </div>
    
   
    <!-- cover area -->
    <div id="content" style="width: 1000px; margin: auto; min-height: 400px;  "  >
        <div style="display: flex; ">
            <!-- old post area area -->
             <div style=" min-height: 400px; flex: 3.5; padding: 20px;" >
                <div id="postbar" style="margin-left: 50px;  box-shadow: 5px 10px 8px #888888;">
                    <?php
                    $DB= new  Database();
                    $sql= "select * from questions where parent=0  order by id desc ";
                    
                    // $post=$DB-> readpost($sql);
                    
                     
                    //   if (isset($post) && $post)
                    //       {
                    //           foreach($post as  $Row)
                    //           {
                                
                    //               //getting user name
                    //               $user= new User();
                    //               $user_row = $user-> get_user($Row['userid']);
                    //               include('makingPost.php');
                    //           }
                    //       }
                      $new= mysqli_query($conn,$sql);
                      $resultcheck= mysqli_num_rows($new);
                      if ($resultcheck>0) {
                        
                    
                      while ($Row = mysqli_fetch_assoc($new)) {
                          $user= new User();
                          $user_row = $user-> get_user($Row['userid']);
                          include('makingPost.php'); 
                    
                        
                     }
                    }
                   
                   

                    ?>
                    

                </div>
               
                
            </div>
             <!-- questions area-->
             <div style=" min-height: 400px; flex: 1; " >
                
                <div style="border: solid thin;  color:  #aaa; padding: 10px;  margin-top: 90px; border: none; background-color: black;box-shadow: 5px 10px 8px #888888;" >
                    <form method="POST" enctype="multipart/form-data">
                            <label for="questions" style="font-family: tahoma;margin-left:90px;">Questions Area</label>
                            <textarea name="question_details" placeholder="Ask a question..."  id="questions" cols="30" rows="10" style="width:300px;color:black;"></textarea>
                            
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
            
            </div>
        </div>  

        
    </div>
    
</body>
</html>