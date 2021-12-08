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
    $result= $question_details-> ask_question($userid,$_POST);
    if($result=="")
    {
         header("location: profile.php");
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

// retrieving  questionid
     $question_details= new Questions();
     $userid= $_SESSION['userid'];
     //$questions= $question_details-> get_question($userid);


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
    <title>Profile|My Study Guide</title>
</head>

<body style="font-family: tahoma; background-color:#f7f2f2;">
    <div style="width:100%;">
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
                    My Profile &nbsp &nbsp<input type="text" id="searchbox" name="find" placeholder="search for questions...">
                    
                
                    
                    <img src="<?php echo $corner_image ?>"  style="width: 50px; height:50px; float: right;border-radius:50%;">
                    
                    <div style="font-size:18px;float:right; margin:10px; color:black;"> <?php echo $user_data['fname'] . " " . $user_data['lname']?></div> 
                </form>
            </div>       
        </div>
        
      
        <img src="../images/mountain.jpg" alt="sorry" style="width:100%; height: 300px;">
        <!-- cover area -->
        <div id="content" style="width: 1000px; margin: auto; min-height: 400px;  "  >
                            
        
                <!-- profile picture-->
                <div style=" text-align:center;"> 
                <?php
                $image= "../images/profile.png";
                if (file_exists($user_data['profile_image'])) {
                    $image= $user_data['profile_image'];
                }

                ?>
                <img id="profile_pic"src="<?php echo $image ?>"  alt="sorry">
                <span style="margin-left: -160px;margin-top:-100px;">
                   <a style="text-decoration:none;color:#f0f" href="changeProfile.php"> change picture</a>
                </span>
         
                </div>
                <div style="display: flex;">
                    <!-- old post area area -->
                    <div style=" min-height: 400px; flex: 3.5; padding: 20px;" >
                        <div id="postbar" style="margin-left: 100px;box-shadow: 5px 10px 8px #888888;">
                            <?php
                            
                            // if ($questions)
                            // {
                            //     foreach($questions as  $Row)
                            //     {
                            //         //getting user name
                            //         $user= new User();
                            //         $user_row = $user-> get_user($Row['userid']);
                            //         include('makingPost.php');
                            //     }
                            // }
                            $sql= "SELECT * from questions where parent=0 and userid='$userid' order by id desc limit 10";
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
                    
                </div>  

            
        </div>
    
    </div>
    
</body>
</html>