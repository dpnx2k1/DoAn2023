<?php

include_once "./config/database.php";

class user{
    private $db;
    public function __construct()
    {
        $this -> db= new Database();
    }
    
    public function show_user($userid){
       $query ="SELECT * FROM user WHERE user_id='$userid'";
        $result = $this ->db->select($query);
        return $result;
    }
   
    public function update_point_zero($id){
        $query="UPDATE user SET `point` ='0' Where user_id=$id";
        $result = $this ->db->update($query); 
        
        return $result;    
    }
}
?>