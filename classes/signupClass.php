<?php

class Signup
{
    private $error = "";
    public function evaluate($data)
    {
        
        //checking if the form if empty
        foreach ($data as $key => $value) 
        {
            if (empty($value)) 
            {
                $this->error = $this->error. $key ." is empty!<br>";
            }
            

            if ($key == "email") 
            {
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value)) 
                {
                    $this->error = $this->error. " invalid email !<br>";
                }
            }
            if ($key == "fname") 
            {
                if (is_numeric($value)) 
                {
                    $this->error = $this->error. " name can't be a number !<br>";
                }
                if (strstr($value, " ")) 
                {
                    $this->error = $this->error. " name can't have spaces !<br>";
                }
            }if ($key == "lname") 
            {
                if (is_numeric($value)) 
                {
                    $this->error = $this->error. " name can't be a number !<br>";
                }
                if (strstr($value, " ")) 
                {
                    $this->error = $this->error. " name can't have spaces !<br>";
                }
            }
        }
        if($this->error=="")
        {
            //no error
            $this-> create_user($data);

        }else 
        {
            return $this->error;
        }
        

    }
    public function create_user($data)
    {
        $fname= ucfirst($data['fname']);
        $lname= ucfirst($data['lname']);
        $telno= $data['telno'];
        $email= $data['email'];
        $gender= $data['gender'];
        $course= $data['course'];
        $password= hash("sha1",$data['password']);
        $schoolName= $data['schoolName'];
        //creating userid
        $userid = $this->create_userid();
        
        $query= "INSERT INTO users (userid,fname,lname,telno,email,gender,course,password,schoolName)
         values('$userid','$fname','$lname','$telno','$email','$gender','$course','$password','$schoolName')";
        //echo $query;
        $DB= new Database();
        $DB-> save($query);

    }
    private function create_userid()
    {
        //generating a random userid
        $length= rand(5,10);
        $num= ""; 
        for ($i=0; $i <$length; $i++) 
        { 
            $new_rand= rand(0,9);
            $num = $num .$new_rand;
            
            
        }
        return $num;
        

    }
    
}
?>