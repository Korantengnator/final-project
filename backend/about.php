<?php

include("../classes/loading_classes.php");


//checking if a user is logged in

$login= new Login();
$user_data=$login -> check_login($_SESSION['userid']);





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="sidebar.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>About|My Study Guide</title>
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
                    About &nbsp &nbsp<input type="text" id="searchbox" name="find" placeholder="search for questions...">
                    
                
                    
                    <img src="<?php echo $corner_image ?>"  style="width: 50px; height:50px; float: right;border-radius:50%;">
                    
                    <div style="font-size:18px;float:right; margin:10px; color:black;"> <?php echo $user_data['fname'] . " " . $user_data['lname']?></div> 
                </form>
            </div>       
        </div>
        <img src="../images/mountain.jpg" alt="sorry" style="width:100%; height: 300px;">
        <!-- cover area -->
        <div id="content" style="width: 800px; margin: auto; min-height: 400px;  "  >
            <div style="margin-top:70px;font-family:tahoma;text-align:justify;margin-left:200px; ">
      
            <p >
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp My Study Guide is an online learning platform that provides students with easy access to a wide range of textbooks and solution to questions provided on a number of school related subjects. The company was founded by Nana Yaw Koranteng.  My Study Guide provides digital, textbook solutions, online tutoring, and other student services such as essay reviews. The company’s target market is students that are in the university. My Study  Guide provides students with a vast library of digital textbooks which they can rent and use for their >personal  studies. The company also provides its students the opportunity to talk to seek clarification if they fail to  understand a concept.
            </p>
            <br>
            <p>
          
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp When students register, they can post a question on any subject area and have it answered within a few hours. When the answer to the question is posted the student can rate the answer as well as ask for further explanations if they are still confused. Students are also given access to textbooks written by one of the company’s authors or an outside author which they can rent. Students are also given the opportunity to have their papers reviewed so as to receive helpful feedback.

            </p>
                
  
            </div>
                    

            
        </div>
    
    </div>
    
</body>
</html>