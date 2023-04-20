<?php

include_once "./config/database.php";

class product{
    private $db;
    public function __construct()
    {
        $this -> db= new Database();
    }
    
    public function show_product(){
        $query ="SELECT category_id,category_name FROM tbl_category";
        $result = $this ->db->select($query);
        return $result;
    }
    // public function show_brand_c($brand_id){
    //     $query="SELECT brand_name FROM tbl_brand WHERE brand_id=$brand_id";
    //     $result = $this ->db->select($query);
    //     return $result;
    // }
}
?>