<?php
// logging ou the user
session_start();
if(isset($_SESSION['userid']))
{
    $_SESSION['userid']= NULL;
    unset($_SESSION['userid']);
}
header("location:login.php");
?>