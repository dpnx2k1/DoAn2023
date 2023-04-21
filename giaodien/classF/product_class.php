<?php

include_once "./config/database.php";

class product{
    private $db;
    public function __construct()
    {
        $this -> db= new Database();
    }
    
    public function show_product_byid($product_id){
       $query ="SELECT * FROM tbl_product WHERE product_id='$product_id'";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_category_in_product($category_id){
        $query="SELECT category_name FROM tbl_category WHERE category_id=$category_id";
        $result = $this ->db->select($query);
        return $result;
    }
    public function  show_brand_in_product($brand_id){
        $query="SELECT brand_name FROM tbl_brand WHERE brand_id=$brand_id";
        $result = $this ->db->select($query);
        return $result;
    }
    public function get_product_img_small($product_id){
        $query ="SELECT * FROM tbl_product_img_desciption WHERE product_id='$product_id' ";
         $result = $this ->db->select($query);
         return $result;
     }
     
     public function get_color_id_by_product_id($product_color_name){
        $query ="SELECT  * FROM product_color WHERE product_color_name='$product_color_name' ";
         $result = $this ->db->select($query);
         return $result;
     }
}
?>