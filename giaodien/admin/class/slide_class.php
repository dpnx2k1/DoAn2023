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
    public function update_slide(){
        $slide_id=$_GET['slide_id'];
        $slide_img =$_FILES['slide_img']['name'];
        $filetmp =$_FILES['slide_img']['tmp_name'];
        foreach($slide_img as $key => $value) {
            move_uploaded_file($filetmp[$key],"Upload/".$value);      
        } 
        $query="UPDATE tbl_slide
            SET `slide_img` = '$slide_img[0]'
            WHERE `slide_id`= $slide_id";
            $result = $this ->db->update($query);
            header('location:slide_list.php');
        }
    }

?>
