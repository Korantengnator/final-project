<?php

define("servername", "localhost");
define("username", "root");
define("dbname", "myStudyGuide");
define("password", "");

// create connection
$conn = mysqli_connect(servername, username, password, dbname);
// getting user message through ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

//checking user query to database query
$sql = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
$result = mysqli_query($conn, $sql) or die("Error");

// if user query matched to database query we'll show the reply otherwise it go to else statement
if(mysqli_num_rows($result) > 0){
    //fetching replay from the database according to the user query
    $fetch_data = mysqli_fetch_assoc($result);
    //storing replay to a varible which we'll send to ajax
    $reply = $fetch_data['replies'];
    echo $reply;
}else{
    echo "Sorry I didn't understand you!";
}


?>