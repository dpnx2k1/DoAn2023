<?php

include "../config/database.php";
class product{
    private $db;
    public function __construct()
    {
        $this -> db= new Database();
    }
    public function show_category(){
        $query ="SELECT category_id,category_name FROM tbl_category ORDER BY category_id DESC";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_brand(){
        // $query ="SELECT * FROM tbl_brand ORDER BY brand_id DESC";
        $query="SELECT tbl_brand.*,tbl_category.category_name FROM tbl_brand INNER JOIN tbl_category ON
        tbl_brand.category_id=tbl_category.category_id ORDER BY tbl_brand.brand_id DESC ";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_product(){
        $query ="SELECT * FROM tbl_product ORDER BY product_id DESC";
        $result = $this ->db->select($query);
        return $result;
    }
    public function insert_product(){
        $product_name=$_POST['product_name'];
        $category_id=$_POST['category_id'];
        $brand_id=$_POST['brand_id'];
        $product_color_name=$_POST['product_color_name'];
        $product_size=$_POST['product_size'];
        $product_total=$_POST['product_total'];
        $product_price= $_POST['product_price'];
        $product_price_pro=$_POST['product_price_pro'];
        $product_description=$_POST['product_description'];
        $product_pre=$_POST['product_pre'];
        $product_img=$_FILES['product_img']['name'];
        move_uploaded_file($_FILES['product_img']['tmp_name'],"Upload/".$_FILES['product_img']['name']);
        $query = "INSERT INTO tbl_product(
                                        product_name,
                                        category_id,
                                        brand_id,
                                        product_color_name,
                                        product_size,
                                        product_price,
                                        product_total,
                                        product_price_pro,
                                        product_description,
                                        product_pre,
                                        product_img
        ) VALUES('$product_name','$category_id','$brand_id','$product_color_name','$product_size','$product_total','$product_price','$product_price_pro','$product_description','$product_pre','$product_img')";
        $result = $this ->db->insert($query);
        if ($result) {
            $query="SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1";
            $result = $this ->db->select($query)-> fetch_assoc();
            $product_id = $result['product_id']; 
            $filename=$_FILES['product_img_desciption']['name'];
            $filetmp=$_FILES['product_img_desciption']['tmp_name'];
        
            foreach($filename as $key => $value) {
                move_uploaded_file($filetmp[$key],"Upload/".$value);
                $query="INSERT INTO tbl_product_img_desciption(product_id,product_img_desciption) VALUES('$product_id','$value')";
                $result = $this ->db->insert($query);
            }
        }
         header("location: product_add.php");
        return $result;
    }

    public function show_brand_ajax($category_id){
        $query="SELECT * FROM tbl_brand WHERE category_id=$category_id";
        $result = $this ->db->select($query);
        return $result;
    }


    public function get_brand($brand_id){
        $query="SELECT * FROM tbl_brand WHERE brand_id=$brand_id";
        $result = $this ->db->select($query);
        return $result;
    }






    public function update_brand($brand_id,$brand_name,$category_id){
        $query="UPDATE tbl_brand SET brand_name ='$brand_name',category_id = '$category_id' WHERE brand_id='$brand_id'";
        $result = $this ->db->update($query); 
        header("location: brand_list.php");
        return $result;    
    }


    public function delete_brand($brand_id){
        $query="DELETE FROM tbl_brand WHERE brand_id='$brand_id' ";
        $result = $this ->db->delete($query); 
        header("location: brand_list.php");
        return $result; 
    }
 
}
?>
