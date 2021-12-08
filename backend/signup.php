<?php
include("../classes/db_connection.php");
include("../classes/signupClass.php");

$fname="";
$lname="";
$email="";
$course="";
$schoolName="";
$telno="";
$gender="";

if($_SERVER['REQUEST_METHOD']=='POST')
{
    // checking for sign up errors
    $signup= new Signup();
    $result=$signup -> evaluate($_POST);
    
        if ($result != "" )
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "The following errors occured<br><br>";
            echo $result;
            echo "</div>";
        } 
        else {
            header("location: login.php");
            die;
        }
    
    // keep previously entered details
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $course=$_POST['course'];
    $schoolName=$_POST['schoolName'];
    $telno=$_POST['telno'];
    $gender=$_POST['gender'];
    
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <title>My Study Guide | Sign Up</title>
</head>

<body style="font-family: tahoma; background-color:rgba(255, 255, 255, 0.13) ;">
    <div id="bar33" >
      <div style="font-size: 40px;"> My Study Guide</div>   
      <div onclick="goTo1()" id="signup_button">Log in</div> 
    </div>
    <div id="login_bar">
        Sign Up to My Study Guide <br><br>
        <form method="POST" action="signup.php">
            <input value="<?php echo $fname ?>" name="fname" type="text"  id="text" placeholder="enter your first name"><br><br>
            <input value="<?php echo $lname ?>" name="lname" type="text"  id="text" placeholder="enter your last name"><br><br>
            <input value="<?php echo $email ?>" name="email" type="text"  id="text" placeholder="enter your Email"><br><br>
            <input value="<?php echo $course?>" name="course" type="text"  id="text" placeholder="enter your Course"><br><br>
            <input value="<?php echo $schoolName ?>" name="schoolName" type="text"  id="text" placeholder="enter your School Name"><br><br>
            <input value="<?php echo $telno ?>" name="telno" type="text"  id="text" placeholder="enter your telephone number"><br><br>
            <span style="font-weight: normal;" >Gender:</span>  <br>
            <select  id="text" name="gender">
                <option <?php echo $gender ?>></option>
                <option >Male</option>
                <option >Female</option>
            </select>
            <br><br>
            <input name="password" type="password"  id="psw1" placeholder="enter your password" pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" onkeyup="return validate()">
            <br><br>
            <input name="password2" type="password"  id="psw2" placeholder="re-enter your password" pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" ><br><br>
            <input  type="submit"  id="button" value="Sign Up"><br><br><br>
            <div id ="errors"  >
                <h3>Password must contain the following:</h3>
                <p id="lower" >A <b>lowercase</b> letter</p>
                <p id="upper" >A <b>capital (uppercase)</b> letter</p>
                <p id="number" >A <b>number</b></p>
                <p id="length" >Minimum <b>8 characters</b></p>
                <p id="char" >a special <b>character</b></p>
            </div>
        </form>
        
    </div>
    

</body>
    <script>
        function goTo1()
        {
            window.open('login.php');
        }
    </script>

    <script>
        
           
       
        function validate()
        {
            var pass= document.getElementById("psw1");
            var lower = document.getElementById("lower");
            var upper = document.getElementById("upper");
            var num = document.getElementById("number");
            var len = document.getElementById("length");
            var char = document.getElementById("char");

           // When the user clicks on the password field, show the message box
            pass.onfocus = function()
            {
               document.getElementById("errors").style.display = "block";
            }

            // When the user clicks outside of the password field, hide the message box
            pass.onblur = function()
            {
               document.getElementById("errors").style.display = "none";
            }

            //checking for a number
            if(pass.value.match(/[0-9]/))
            {
                num.style.color='green';
            }
            else
            {
                num.style.color='red';
            }
            //checking for uppercase
            if(pass.value.match(/[A-Z]/))
            {
                upper.style.color='green';
            }
            else
            {
                upper.style.color='red';
            }
            //checking for a lowercase letters
            if(pass.value.match(/[a-z]/))
            {
                lower.style.color='green';
            }
            else
            {
                lower.style.color='red';
            }
            //checking for length
            if(pass.value.length >=8)
            {
                len.style.color='green';
            }
            else
            {
                len.style.color='red';
            }
           //checking for a special character
           if(pass.value.match(/[!@#$%^&*]/))
            {
                char.style.color='green';
            }
            else
            {
                char.style.color='red';
            }
        }
          
        

         
    </script>
</html>