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
    public function get_name_p(){
            $p=$_POST['provinces'];
            $query ="SELECT * FROM provinces WHERE code_p=$p";
            $result = $this ->db->select($query)-> fetch_assoc();
            $name= $result['name_p'];
            return $name;
        }
    
    public function get_name_d(){
            $d=$_POST['districts'];
            $query ="SELECT * FROM districts WHERE code_d=$d";
            $result = $this ->db->select($query)-> fetch_assoc();
            $name= $result['name_d'];
            return $name;
        }
    public function get_name_w(){
            $w=$_POST['wards'];
            $query ="SELECT * FROM wards WHERE code_w=$w";
            $result = $this ->db->select($query)-> fetch_assoc();
            $name= $result['name_w'];
            return $name;
        }


    public function get_product($id){
        $query ="SELECT * FROM tbl_product WHERE product_id=$id";
        $result = $this ->db->select($query);
        return $result;
        }
    // public function insert_order($addr_){
    //     $user_name =$_POST['hoten'];
    //     $sdt=$_POST['sdt'];
    //     $address_detail=$_POST['diachi'];
        
    //     $note=$_POST['note'];
    //     $total=$_SESSION['tong'];
    //     $query = "INSERT INTO `orders`(
    //         `order_id`,
    //         `user_name`,
    //         `sdt`,
    //         `address_`,
    //        `address_detail`,
    //         `note`,
    //         `total`,
    //         `created_time`,
    //         `last_updated`
    // ) VALUES(null,'$user_name','$sdt','$addr_','$address_detail','$note','$total','".time()."','".time()."')";
    // $result = $this ->db->insert($query);
    // }

    // public function get_id_order(){
    //     $query="SELECT * FROM `orders` ORDER BY `order_id` DESC LIMIT 1";
    //     $result = $this ->db->select($query)-> fetch_assoc();
    //     $product_id = $result['order_id'];
    //     return $product_id;
    // }

   
    public function  insert_order_detail($str){
     $query="INSERT INTO `order_detail` (`id`,`order_id`, `product_id`, `quantity`, `price`, `created_time`, `last_updated`) VALUES " . $str . ";";
    $result = $this ->db->insert($query);
    }
}
?>
