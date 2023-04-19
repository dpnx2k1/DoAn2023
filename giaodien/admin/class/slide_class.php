<?php

include "../config/database.php";

class slide{
    private $db;
    public function __construct()
    {
        $this -> db= new Database();
    }

    public function insert_slide(){
        
        $slide_img =$_FILES['slide_img']['name'];
        $filetmp =$_FILES['slide_img']['tmp_name'];
        foreach($slide_img as $key => $value) {
            move_uploaded_file($filetmp[$key],"Upload/".$value);
            $query="INSERT INTO tbl_slide(slide_img) VALUES('$value')";
            $result = $this ->db->insert($query);
        }
    }
    public function show_slide(){
        $query ="SELECT slide_id,slide_img FROM tbl_slide ORDER BY slide_id DESC";
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
