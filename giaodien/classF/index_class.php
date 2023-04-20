<?php

include_once "./config/database.php";

class index{
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
    public function show_category_header(){
        $query ="SELECT * FROM tbl_category ORDER BY category_id DESC";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_brand($category_id){
        $query="SELECT * FROM tbl_brand WHERE category_id=$category_id";
        $result = $this ->db->select($query);
        return $result;
    }
}
?>