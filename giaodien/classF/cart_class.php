<?php

include_once "./config/database.php";

class cartF {
    private $db;
    public function __construct()
    {
        $this -> db= new Database();
    }

    public function get_product_id(){
        $product_name=$_POST['product_name'];
        $product_size=$_POST['product_size'];
        $product_color_name=$_POST['product_color_name'];
        $query ="SELECT product_id FROM tbl_product WHERE product_size ='.$product_size.' AND  product_color_name= '.$product_color_name.' AND product_name ='.$product_name.'";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_product_list($str){
        $query ="SELECT * FROM tbl_product WHERE product_id IN (".$str.")";
        $result = $this ->db->select($query);
        return $result;
        }
    public function get_sale($product_sale_id){
            $query ="SELECT  * FROM product_sale WHERE product_sale_id='$product_sale_id'";
             $result = $this ->db->select($query);
             return $result;
         }
    public function get_point($user_id){
            $query ="SELECT  * FROM user WHERE user_id='$user_id'";
             $result = $this ->db->select($query);
             return $result;
         }
}
?>
