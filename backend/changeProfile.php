<?php
include("../classes/loading_classes.php");

//checking if a user is logged in

$login= new Login();
$user_data=$login -> check_login($_SESSION['userid']);

// for posting
if ($_SERVER['REQUEST_METHOD']=="POST")
{
   

   if (isset($_FILES['file']['name']) && $_FILES['file']['name']!="")
   {
       //restricting file type
       if ($_FILES['file']['type']=="image/jpeg")
       {
           $allowed_size= (1024*1024) * 3;
           //restricting image size
           if ($_FILES['file']['size']<$allowed_size)
           {
               //if everything is fine
               $folder= "../uploads/" . $user_data['userid']."/";

               //creating folder
               if (!file_exists($folder))
               {
                   mkdir($folder,0777,true);// 0777 for security purposes
               }
                $image= new Image();
                $filename= $folder .$image->generate_filename(10);
                move_uploaded_file($_FILES['file']['tmp_name'], $filename);
                if (file_exists($filename))
                {
                    $userid= $user_data['userid'];
                    $query = "UPDATE users SET profile_image = '$filename' WHERE userid= $userid limit 1";
                    $DB = new Database();
                    $DB -> save($query);

                    header("location:profile.php");
                    die;
                }
            }
           else
           {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "The following errors occured<br><br>";
            echo "Image size must be less than 3mb";
            echo "</div>";
           }
       }
       else
       {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "The following errors occured<br><br>";
        echo "Only jpeg is allowed";
        echo "</div>";
       }
        
    }
   else
   {
    echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
    echo "The following errors occured<br><br>";
    echo "Please add an image";
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
    
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title> Change pic|My Study Guide</title>
</head>

<body style="font-family: tahoma; background-color:#f7f2f2;">
    <div style="width:100%;">
        <!-- side bar -->
        <div class="sidebar">
            <h2>My Study Guide</h2>
            <ul>
            <li><a style="text-decoration: none;" href="index.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a style="text-decoration: none;" href="profile.php"><i class="fas fa-user"></i>Profile</a></li>
            <li><a style="text-decoration: none;" href="about.php"><i class="fas fa-address-card"></i>About Uss</a></li>
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
        <div id="bar" >
        <a href="logout.php">
                <div style="font-size:13px;float:right; color:white; margin: 10px; ">Logout</div>
            </a>
            <div style="margin: auto; width: 800px; font-size: 30px;">
                <form action="search.php" method="get">
                    Change pic &nbsp &nbsp<input type="text" id="searchbox" name="find" placeholder="search for questions...">
                    
                
                    
                    <img src="<?php echo $corner_image ?>"  style="width: 50px; height:50px; float: right;border-radius:50%;">
                    
                    <div style="font-size:18px;float:right; margin:10px; color:black;"> <?php echo $user_data['fname'] . " " . $user_data['lname']?></div> 
                </form>
            </div>       
        </div>
        
      

        <!-- cover area -->
        <div id="content" style="width: 800px; margin: auto; min-height: 400px;  "  >
            <div style="display: flex;">
                <!-- old post area area -->
                <div style=" min-height: 400px; flex: 2.5; padding: 20px;" >
                        <form method="POST" enctype="multipart/form-data">
                            <h3 style="margin-left: 390px; " >Upload new picture</h3>
                            <div style=" color:  #aaa; padding: 10px;  margin-top: 50px; border: none;margin-left: 250px; background-color:black;" >
                                    <label for="file-input">
                                    <img src="https://icons.iconarchive.com/icons/dtafalonso/android-lollipop/128/Downloads-icon.png"  style="width:35px;height:35px;margin-left:5px;">
                                    </label>
                                    <span style="display:none;">
                                    <input id="file-input"  type="file" name="file">
                                    </span>
                                    <input id="button1" type="submit" value="change" >
                                    <br><br>
                                    <!-- previewing the profile picture before changing it -->
                                    <div style="text-align:center;">
                                        <img src="<?php echo $user_data['profile_image']?>" style="max-width:500px" alt="">
                                    </div>
                            </div> 
                        </form>
                </div>
  
            </div>
                    

            
        </div>
    
    </div>
    
</body>
</html>