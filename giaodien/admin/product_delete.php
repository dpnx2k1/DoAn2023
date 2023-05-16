<?php 

    if (isset($_GET['product_id'])&& $_GET['product_id']!= NULL) {
        $con=mysqli_connect("localhost","root","123456789","db_doan"); 
        $result = mysqli_query($con, "DELETE FROM `tbl_product` WHERE `product_id` = " . $_GET['product_id']); 
        header('location:product_list.php');
    }

?>