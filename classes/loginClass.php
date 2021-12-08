<?php

class Login
{
    private $error ="";

    public function evaluate($data)
    {
       // calling data and security
        $email= addslashes($data['email']);
        $password= addslashes($data['password']);

       //checking if user exists
        $query= "SELECT * FROM users WHERE email='$email' limit 1";
        //echo $query;
        $DB= new Database();
        $result=$DB-> read($query);

        if ($result)
        {
            $row=$result[0];

            if ($this->hashing($password) ==$row['password']) {
                // creating session
                $_SESSION['userid']= $row['userid'];
            }
            else
            {
                $this->error .="Incorrect  password <br>";
            }
                return $this->error;
        } 
        else
        {
            $this->error .="Incorrect email <br>";
        }
            return $this->error;
        

    }
    //for password hashing
    private function hashing($text)
    {
        $text= hash("sha1",$text);
        return $text;
    }
    public function check_login($userid)
    {
        if ( is_numeric($userid))
        {
            $query= "SELECT * FROM users WHERE userid= '$userid' limit 1";
            
            $DB= new Database();
            $result=$DB-> read($query);

            if ($result)
            {
                $user_data= $result[0];
                return $user_data;
            }
            else
            {
                header("location:login.php");
                die;
            }
            
        }
        else
        {
            header("location:login.php");
            die;
        }

        

    }
}
?>