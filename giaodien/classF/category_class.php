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
    
    public function show_product_by_brandid($brand_id,$item_per_page,$offset){
        $query ="SELECT * FROM tbl_product WHERE brand_id=$brand_id  ORDER BY product_id ASC LIMIT $item_per_page OFFSET $offset ";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_product_total($brand_id){
        $query ="SELECT * FROM tbl_product WHERE brand_id=$brand_id";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_product_by_brandid2($search,$brand_id,$item_per_page,$offset){
        $query ="SELECT * FROM tbl_product WHERE brand_id=$brand_id AND  `product_name` LIKE '%" . $search . "%'  ORDER BY product_id ASC LIMIT $item_per_page OFFSET $offset ";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_product_by_brandid3($search,$brand_id){
        $query ="SELECT * FROM tbl_product WHERE brand_id=$brand_id AND  `product_name` LIKE '%" . $search . "%'  ORDER BY product_id ASC";
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