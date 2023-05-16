<?php

$con=mysqli_connect("localhost","root","123456789","db_doan");   
if(!empty($_GET['id'])){
    $query="DELETE FROM `orders` WHERE (`order_id` = '".$_GET['id']."')";
    $update_status=mysqli_query($con,$query);
    header("Location:order_list.php");
}
?>