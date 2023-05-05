<?php 
     session_start();
     unset($_SESSION['product_filter']);
     header("location:product_list.php");
?>