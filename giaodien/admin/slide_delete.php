<?php 

    if (isset($_GET['slide_id'])&& $_GET['slide_id']!= NULL) {
        $con=mysqli_connect("localhost","root","123456789","db_doan"); 
        $result = mysqli_query($con, "DELETE FROM `tbl_slide` WHERE `slide_id` = " . $_GET['slide_id']); 
        header('location:slide_list.php');
    }
?>