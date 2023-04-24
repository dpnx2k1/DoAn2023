<?php

include_once "./config/database.php";

class categoryF{
    private $db;
    public function __construct()
    {
        $this -> db= new Database();
    }
    
    public function show_category(){
        $query ="SELECT category_id,category_name FROM tbl_category";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_brand_c($brand_id){
        $query="SELECT * FROM tbl_brand WHERE brand_id=$brand_id";
        $result = $this ->db->select($query);
        return $result;
    }
    
    public function show_product_by_brandid($brand_id){
        $query ="SELECT * FROM tbl_product WHERE brand_id=$brand_id";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_category_by_id($id){
        $query ="SELECT category_id,category_name FROM tbl_category WHERE category_id='$id'";
        $result = $this ->db->select($query);
        return $result;
    }
    
}
?>