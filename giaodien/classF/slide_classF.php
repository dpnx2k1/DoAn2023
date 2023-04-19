<?php

include "./config/database.php";

class slideF{
    private $db;
    public function __construct()
    {
        $this -> db= new Database();
    }

    public function show_slideF(){
        $query ="SELECT slide_img FROM tbl_slide";
        $result = $this ->db->select($query);
        return $result;
    }


    public function get_category($category_id){
        $query="SELECT category_id,category_name FROM tbl_category WHERE category_id=$category_id";
        $result = $this ->db->select($query);
        return $result;
    }
    public function update_category($category_id,$category_name){
        $query="UPDATE tbl_category SET category_name = '$category_name' WHERE category_id='$category_id'";
        $result = $this ->db->update($query); 
        header("location: category_list.php");
        return $result;    
    }
    public function delete_category($category_id){
        $query="DELETE FROM tbl_category WHERE category_id='$category_id' ";
        $result = $this ->db->delete($query); 
        header("location: category_list.php");
        return $result; 
    }
}
?>
