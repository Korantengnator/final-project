<?php

include("../classes/loading_classes.php");


//checking if a user is logged in

$login= new Login();
$user_data=$login -> check_login($_SESSION['userid']);

if (isset($_POST['fname']))
{
    $settings_class=new Settings();
    $settings_class-> save_settings($_POST,$_SESSION['userid']);
    header("location: index.php");
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
    <title>Settings|My Study Guide</title>
</head>

<body style="font-family: tahoma; background-color:#f7f2f2;">
    <div style="width:100%;">
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
        <div id="bar" >
        <a href="logout.php">
                <div style="font-size:13px;float:right; color:white; margin: 10px; ">Logout</div>
            </a>
            <div style="margin: auto; width: 800px; font-size: 30px;">
                <form action="search.php" method="get">
                    Settings &nbsp &nbsp<input type="text" id="searchbox" name="find" placeholder="search for questions...">
                    
                
                    
                    <img src="<?php echo $corner_image ?>"  style="width: 50px; height:50px; float: right;border-radius:50%;">
                    
                    <div style="font-size:18px;float:right; margin:10px; color:black;"> <?php echo $user_data['fname'] . " " . $user_data['lname']?></div> 
                </form>
            </div>       
        </div>
        
        <div  style="width: 100%; min-height: 400px;  text-align:center;  "  >
            <div style="padding:20px;max-width:450px;display: inline-block;">
                <h3>Change your details</h3>
                <form method="POST" enctype="multipart/form-data">
                            
                
                    <?php
                    $settings_class= new Settings();
                    $settings=$settings_class->get_settings($_SESSION['userid']);
                    if (is_array($settings))
                    {
                        echo "<input type='text 'id='textbox' name='fname' value='$settings[fname]' placeholder='Enter you first name'>";
                        echo "<input type='text' id='textbox' name='lname' value='$settings[lname]' placeholder='Enter you last name'>";
                        echo "<select id='textbox' name='gender' style='height:30px;'>
                        <option>$settings[gender]</option>
                        <option>Male</option>
                        <option>Female</option>
                        </select>";
                        echo "<input type='text' id='textbox' name='email' value='$settings[email]' placeholder='Enter you email '>";
                        echo "<input type='password' id='textbox' value='$settings[password]' name='password' placeholder='Enter you password '>";
                        echo "<input type='password' id='textbox' value='$settings[password]' name='password2' placeholder='Enter you password '><br>";
                        echo "<input id='post_button' type='submit' value='save'>";  
                    }
                    ?>
                </form>
            </div>
                    

            
        </div>
    
    </div>
    
</body>
</html>