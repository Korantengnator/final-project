<?php
// class to controll the posting of questions
class Questions
{
    private $error="";
    public function ask_question($userid,$data,$files)
    {
        if (!empty($data['question_details']) || !empty($files['file']['name']))
        {
            $q_image = "";
            $has_image=0;
            $likes=0;
            $answers=0;
            $reports=0;
            
            if (!empty($files['file']['name']))
            {
                //if everything is fine
               $folder= "../uploads/" . $userid."/";

               //creating folder
               if (!file_exists($folder))
               {
                   mkdir($folder,0777,true);// 0777 for security purposes
                   file_put_contents($folder . "index.php", "");//to prevent access to other file through the images
               }
                $image_class= new Image();
                $q_image= $folder .$image_class->generate_filename(10);
                move_uploaded_file($_FILES['file']['tmp_name'], $q_image);
                
                $has_image=1;
            }
            $question_details="";
            if (isset($data['question_details']))
            {
                $question_details=addslashes($data['question_details']);
            }
            $questionid= $this-> create_questionid();
            $parent=0;
            $DB = new Database();
            if (isset($data['parent']) && is_numeric($data['parent']))
            {
                $parent= $data['parent'];
                $sql= "update questions set answers=answers+1 where questionid= '$parent' limit 1";
                $DB-> save($sql);
            }
            
            //adding post to the data base
            $query= "INSERT INTO questions (questionid,userid,question_details,image,has_image,likes,answers,reports,parent) VALUES ('$questionid','$userid','$question_details','$q_image','$has_image','$likes','$answers','$reports','$parent')";
            //echo $query;
            
            $DB-> save($query);
        }
        else
        {
            $this->error.= "please add a question!!<br>";
        }
        return $this->error;
    }


    public function edit_question($data,$files)
    {
        if (!empty($data['question_details']) || !empty($files['file']['name']))
        {
            $q_image = "";
            $has_image=0;
            if (!empty($files['file']['name']))
            {
                //if everything is fine
               $folder= "../uploads/" . $userid."/";

               //creating folder
               if (!file_exists($folder))
               {
                   mkdir($folder,0777,true);// 0777 for security purposes
                   file_put_contents($folder . "index.php", "");//to prevent access to other file through the images
               }
                $image_class= new Image();
                $q_image= $folder .$image_class->generate_filename(10);
                move_uploaded_file($_FILES['file']['tmp_name'], $q_image);
                
                $has_image=1;
            }
            $question_details="";
            if (isset($data['question_details']))
            {
                $question_details=addslashes($data['question_details']);
            }
            
            $questionid= addslashes($data['questionid']);
            
            //adding post to the data base
            if ($has_image)
            {
                $query= "UPDATE questions SET question_details='$question_details', image='$q_image' WHERE questionid='$questionid' limit 1";
            }
            else {
                $query= "UPDATE questions SET question_details='$question_details' WHERE questionid='$questionid' limit 1";
            }
            
            $DB = new Database();
            $DB-> save($query);
        }
        else
        {
            $this->error.= "please add a question!!<br>";
        }
        return $this->error;
    }
    // public function get_question($userid)
    // {
    //     $query= "SELECT * from questions where parent=0 and userid='$userid' order by id desc limit 10";
        
        

    //     $DB = new Database();
    //     $result=$DB-> read($query);
        

    //     if ($result)
    //     {
    //         return $result;
    //     }
    //     else
    //     {
    //         return false;
    //     }
        
    // }
    // public function get_answers($userid)
    // {
    //     $query= "SELECT * from questions where parent='$userid' order by id asc limit 10";
        
        

    //     $DB = new Database();
    //     $result=$DB-> read($query);

    //     if ($result)
    //     {
    //         return $result;
    //     }
    //     else
    //     {
    //         return false;
    //     }
    // }
    public function get_one_question($questionid)
    {
        if (!is_numeric($questionid))
        {
            return false;
        }
        $query= "SELECT * from questions where questionid='$questionid' ";
        
        $DB = new Database();
        $result=$DB-> read($query);

        if ($result)
        {
            return $result[0];
        }
        else
        {
            return false;
        }
    }


    public function delete_question($questionid)
    {
        if (!is_numeric($questionid))
        {
            return false;
        }
        $DB = new Database();
        $sql= "select parent from questions where questionid='$questionid' limit 1";
        $result=$DB-> read($sql);
        if (is_array($result))
        {
            if ($result[0]['parent'] > 0 )
                {
                    $parent= $result[0]['parent'];
                    $sql= "update questions set answers=answers-1 where questionid= '$parent' limit 1";
                    $DB-> save($sql);
                }

            $query= "DELETE from questions where questionid='$questionid' limit 1";
            
            
            $DB-> save($query);
        }

    }

    public function I_asked_question($questionid,$userid)
    {
        if (!is_numeric($questionid))
        {
            return false;
        }
        $query= "SELECT * from questions where questionid='$questionid' limit 1";
        
        $DB = new Database();
        $result=$DB-> read($query);
        if (is_array($result))
        {
            if($result[0]['userid']== $userid)
            {
                return true;

            }
        }

    }

    public function like_question($id,$type,$userid)
    {
        
        if($type== "question_details")
        {
            

            $DB= new Database();
            

            //saves the like details
            $sql= "SELECT likes FROM likes WHERE  type='question_details'&& contentid='$id' LIMIT 1";
            $result=$DB-> read($sql);
            if(is_array($result))
            {
                $likes= json_decode($result[0]['likes'],true);
                $user_ids= array_column($likes, "userid");

                if (!in_array($userid,$user_ids))
                {
                    // if this is not the first like
                    $arr["userid"]= $userid;
                    $arr["date"]= date("Y-m-d H:i:s");
                    $likes[]=$arr;
                    $likes_string = json_encode($likes);
                    $sql= "UPDATE likes SET likes= '$likes_string' WHERE  type='question_details'&& contentid='$id' LIMIT 1";
                    $DB-> save($sql);

                    //increments the questions table
                    $sql= "UPDATE questions SET likes=likes+1 where questionid='$id' limit 1";
                    $DB-> save($sql);

                }
                else
                {
                    //for unliking
                    $key = array_search($userid,$user_ids);
                    unset($likes[$key]);
                    $likes_string = json_encode($likes);
                    $sql= "UPDATE likes SET likes= '$likes_string' WHERE  type='question_details'&& contentid='$id' LIMIT 1";
                    $DB-> save($sql);
                    //decrements the questions table
                    $sql= "UPDATE questions SET likes=likes-1 where questionid='$id' limit 1";
                    $DB-> save($sql);
                }

            }else
            {
                
                // if this is the first like
                $arr["userid"]= $userid;
                $arr["date"]= date("Y-m-d H:i:s");
                $arr2[]=$arr;
                $likes = json_encode($arr2);// turn array into string
                $sql= "INSERT INTO likes (type,contentid,likes) VALUES ('$type','$id','$likes')";
                $DB-> save($sql);

                //increments the questions table
                $sql= "UPDATE questions SET likes=likes+1 where questionid='$id' limit 1";
                $DB-> save($sql);
            }
        }
    }
    private function create_questionid()
    {
        //generating a random questionid
        $length= rand(5,10);
        $num= ""; 
        for ($i=0; $i <$length; $i++) 
        { 
            $new_rand= rand(0,9);
            $num = $num .$new_rand;
            
            
        }
        return $num;
        

    }

    public function report_question($id,$type,$userid)
    {
        
        if($type== "question_details")
        {
            

            $DB= new Database();
            

            //saves the like details
            $sql= "SELECT reports FROM reports WHERE  type='question_details'&& contentid='$id' LIMIT 1";
            $result=$DB-> read($sql);
            if(is_array($result))
            {
                $reports= json_decode($result[0]['reports'],true);
                $user_ids= array_column($reports, "userid");

                if (!in_array($userid,$user_ids))
                {
                    // if this is not the first like
                    $arr["userid"]= $userid;
                    $arr["date"]= date("Y-m-d H:i:s");
                    $reports[]=$arr;
                    $reports_string = json_encode($reports);
                    $sql= "UPDATE reports SET reports= '$reports_string' WHERE  type='question_details'&& contentid='$id' LIMIT 1";
                    $DB-> save($sql);

                    //increments the questions table
                    $sql= "UPDATE questions SET reports=reports+1 where questionid='$id' limit 1";
                    $DB-> save($sql);

                }
                else
                {
                    //for unliking
                    $key = array_search($userid,$user_ids);
                    unset($reports[$key]);
                    $reports_string = json_encode($reports);
                    $sql= "UPDATE reports SET reports= '$reports_string' WHERE  type='question_details'&& contentid='$id' LIMIT 1";
                    $DB-> save($sql);
                    //decrements the questions table
                    $sql= "UPDATE questions SET reports=reports-1 where questionid='$id' limit 1";
                    $DB-> save($sql);
                }

            }else
            {
                
                // if this is the first like
                $arr["userid"]= $userid;
                $arr["date"]= date("Y-m-d H:i:s");
                $arr2[]=$arr;
                $reports = json_encode($arr2);// turn array into string
                $sql= "INSERT INTO reports (type,contentid,reports) VALUES ('$type','$id','$reports')";
                $DB-> save($sql);

                //increments the questions table
                $sql= "UPDATE questions SET reports=reports+1 where questionid='$id' limit 1";
                $DB-> save($sql);
            }
        }
    }
    
}
?>

