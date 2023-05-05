<?php

include_once "./config/database.php";

class delivery {
    private $db;
    public function __construct()
    {
        $this -> db= new Database();
    }
    public function show_provinces(){
        $query ="SELECT * FROM provinces";
        $result = $this ->db->select($query);
        return $result;
        }
     public function show_districts_ajax($code){
            $query ="SELECT * FROM districts WHERE province_code=$code";
            $result = $this ->db->select($query);
            return $result;
            }
    
    public function show_wards_ajax($code){
        $query ="SELECT * FROM wards WHERE district_code=$code";
        $result = $this ->db->select($query);
        return $result;
        }
    public function get_product($id){
        $query ="SELECT * FROM tbl_product WHERE product_id=$id";
        $result = $this ->db->select($query);
        return $result;
        }
    public function insert_order(){
        $user_name =$_POST['hoten'];
        $sdt=$_POST['sdt'];
        $address=$_POST['diachi'];
        $note=$_POST['note'];
        $total=$_SESSION['tong'];
        $query = "INSERT INTO `order`(
            `order_id`,
            `user_name`,
            `sdt`,
           `addresss`,
            `note`,
            `total`,
            `created_time`,
            `last_updated`
    ) VALUES(null,'$user_name','$sdt','$address','$note','$total','".time()."','".time()."')";
    $result = $this ->db->insert($query);
    }

    public function get_id_order(){
        $query="SELECT * FROM `order` ORDER BY `order_id` DESC LIMIT 1";
        $result = $this ->db->select($query)-> fetch_assoc();
        $product_id = $result['order_id'];
        return $product_id;
    }

   
    public function  insert_order_detail($str){
     $query="INSERT INTO `order_detail` (`id`,`order_id`, `product_id`, `quantity`, `price`, `created_time`, `last_updated`) VALUES " . $str . ";";
    $result = $this ->db->insert($query);
    }
}
?>
