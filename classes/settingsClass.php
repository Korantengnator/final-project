<?php
class Settings 
{
   public function get_settings($userid)
   {
       $DB= new Database();
       $sql= "select * from users where userid='$userid' limit 1";
       $row= $DB-> read($sql);
       if (is_array($row))
       {
           return $row[0];
       }
   } 
   public function save_settings($data,$userid)
   {
       $DB= new Database();
       $password= $data['password'];
       if (strlen($password < 30))
       {
           if ($data['password']==$data['password2'])
           {
            $data['password']= hash("sha1",$password);
           }
           else
           {
              unset($data['password']);
           }
       }
       unset($data['password2']);
       $sql= "update users set ";
        foreach ($data as $key => $value) {
            $sql.= $key . "='" . $value. "',";
        }
        $sql= trim($sql,",");
        $sql.= " where userid='$userid' limit 1";
        //echo $sql;die;
        $DB-> save($sql);


    }
}

?>