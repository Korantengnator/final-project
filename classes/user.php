<?php
class   User
{
    public function get_data($userid)
    {
        $query= " select * from users where userid=$userid ";
        $DB= new Database();
        $result= $DB-> read($query);
        if ($result)
        {
            $row=$result[0];
            return $row;
        }
        else
        {
            return false;
        }
    }

    public function get_user($userid)
    {
        // getting user name from user id
        $query= "Select * from users where userid= '$userid' ";
        $DB= new Database();
        $result= $DB -> read($query);

        if ($result)
        {
            return $result[0];
        }
        else
        {
            return false;
        }

    }

}
?>