<?php
include("../classes/loading_classes.php");


//checking if a user is logged in

$login= new Login();
$user_data=$login -> check_login($_SESSION['userid']);

//to return user to previous page
if (isset($_SERVER['HTTP_REFERER']))
{
    $return_to= $_SERVER['HTTP_REFERER'];
}
else
{
    $return_to= "profile.php";
}

if (isset($_GET['type']) && isset($_GET['id']))
{
    if(is_numeric($_GET['id']))
    {
        $allowed[]= 'question_details';
        $allowed[]= 'answer';

        if(in_array($_GET['type'],$allowed))
        {
            $question= new Questions();
            $question-> like_question($_GET['id'],$_GET['type'],$_SESSION['userid']);

        }

    }
}


header("location: ". $return_to);
die;


?>