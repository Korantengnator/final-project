<?php
session_start();
include("../classes/db_connection.php");
include("../classes/loginClass.php");


$email="";
$password="";

// cheching if user hits button
if($_SERVER['REQUEST_METHOD']=='POST')
{
    // checking for sign up errors
    $login= new Login();
    $result=$login -> evaluate($_POST);
    if ($result != "")
    {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
        echo "The following errors occured<br><br>";
        echo $result;
        echo "</div>";
    } 
    else {
        header("location: index.php");
        die;
    }
    // keep previously entered details
    $email=$_POST['email'];
    $password=$_POST['password'];
    
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>My Study Guide | Log in</title>
</head>

<body style="font-family: tahoma; background-color:rgb(255, 255, 255) ;">
    <div id="bar33" >
      <div style="font-size: 40px;"> My Study Guide</div>   
      <div onclick="goTo()" id="signup_button">Signup</div> 
    </div>
    <div id="login_bar">
        <form method="POST">
            login to My Study Guide <br><br>
            <input name="email" value= "<?php echo $email ?>" type="text"  id="text" placeholder="enter your Email"><br><br>
            <input name="password" value= "<?php echo $password ?>" type="password"  id="text" placeholder="enter your password"><br><br>
            <input type="submit"  id="button" value="Log in">
        </form>
    </div>

</body>
<script>
        function goTo()
        {
            window.open('signup.php');
        }
    </script>
</html>