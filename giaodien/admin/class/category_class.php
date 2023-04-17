<?php

include "database.php";

class category{
    private $db;
    public function __construct()
    {
        $this -> db= new Database();
    }
    public function insert_category($category_name){
        $query = "INSERT INTO tbl_category(category_name) VALUES('$category_name')";
        $result = $this ->db->insert($query);
        header("location: category_list.php");
        return $result;
    }
    public function show_category(){
        $query ="SELECT category_id,category_name FROM tbl_category ORDER BY category_id DESC";
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
