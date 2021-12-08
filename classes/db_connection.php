<?php

// create connection class
class Database 
{
    private $servername= "localhost";
    private $username= "root";
    private $dbname= "myStudyGuide";
    private $password= "";
    // creating connection function
    function connect()
    {
        $connection = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        return $connection;
    }
    
    // creating reading function
    function read($query)
    {
        $conn= $this->connect();
        $result = mysqli_query($conn,$query);

        if(!$result)
        {
            return false;
        }
        else 
        {
            $data=false;
            while($row=mysqli_fetch_assoc($result))
            {
                $data[]=$row;
                return $data; 
            }
        }

    }
    // creating saving function
    function save($query)
    {
        $conn= $this->connect();
        $result = mysqli_query($conn,$query);

        if(!$result)
        {
            return false;
        }
        else 
        {
            return true;
        }
        
    }
    
}







?>