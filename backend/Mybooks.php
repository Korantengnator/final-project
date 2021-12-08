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
   
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>My books|My Study Guide</title>
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
                    Books &nbsp &nbsp<input type="text" id="searchbox" name="find" placeholder="search for questions...">
                    
                
                    
                    <img src="<?php echo $corner_image ?>"  style="width: 50px; height:50px; float: right;border-radius:50%;">
                    
                    <div style="font-size:18px;float:right; margin:10px; color:black;"> <?php echo $user_data['fname'] . " " . $user_data['lname']?></div> 
                </form>
            </div>       
        </div>
        <img src="../images/mountain.jpg" alt="sorry" style="width:100%; height: 300px;">
        <!-- cover area -->
        <div id="content" style="width: 1000px; margin: auto; min-height: 400px;margin-right: 100px; "  >
        
            <div class="row row-cols-1 row-cols-md-2 g-4" style="margin-top: 40px;">
                <div class="col">
                    <div class="card" style="box-shadow: 5px 10px 8px #888888;">
                    <img src="../images/seed1.jpg" class="card-img-top" style="width:100%; height:400px">
                    <div class="card-body">
                        <h5 class="card-title">Adaptive Alcohol Stove</h5>
                        <a href="https://seed.ashesi.edu.gh/uploads/Adaptive_Alcohol_Stove_2.pdf" id="download" class="btn btn-primary">Download</a>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="box-shadow: 5px 10px 8px #888888;">
                    <img src="../images/book1.png" class="card-img-top" style="width:100%; height:400px">
                    <div class="card-body">
                        <h5 class="card-title">Intro to Science</h5>
                        <a href="https://www.pobschools.org/cms/lib/NY01001456/Centricity/Domain/517/scientific_method_powerpointVA17ppt.pdf" id="download" class="btn btn-primary">Download</a>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="box-shadow: 5px 10px 8px #888888;">
                    <img src="../images/book2.png" class="card-img-top" style="width:100%; height:400px">
                    <div class="card-body">
                        <h5 class="card-title">Intro to Computing</h5>
                        <a href="https://computingbook.org/FullText.pdf" id="download" class="btn btn-primary">Download</a>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="box-shadow: 5px 10px 8px #888888;">
                    <img src="../images/book3.png" class="card-img-top" style="width:100%; height:400px">
                    <div class="card-body">
                        <h5 class="card-title">Intro to Acounting</h5>
                        <a href="https://www.ddegjust.ac.in/studymaterial/bba/bba-104.pdf" id="download" class="btn btn-primary">Download</a>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="box-shadow: 5px 10px 8px #888888;">
                    <img src="../images/book4.png" class="card-img-top" style="width:100%; height:400px"alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Into to Academic writing</h5>
                        <a href="https://edisciplinas.usp.br/pluginfile.php/3928474/mod_resource/content/1/Introduction%20to%20Academic%20Writing.pdf" id="download" class="btn btn-primary">Download</a>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="box-shadow: 5px 10px 8px #888888;">
                    <img src="../images/seed2.jpg" class="card-img-top" style="width:100%; height:400px">
                    <div class="card-body">
                        <h5 class="card-title">Reducing Pollution</h5>
                        <a href="https://seed.ashesi.edu.gh/uploads/Article_Reducing_Coconut_Husk_Pollution_Using_Cellulose_Degrading2.pdf" id="download" class="btn btn-primary">Download</a>
                    </div>
                    </div>
                </div>
                
            </div>
        </div>
    
    </div>
    
</body>
</html>