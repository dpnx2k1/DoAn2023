<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/34e972a4c1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stlye.css">
    <title>Danh muc san pham</title>
</head>
<body>
<?php
        session_start();
        // include '../connect_db.php';
        include '../function.php';
        if (!empty($_SESSION['current_user'])) { //Kiểm tra xem đã đăng nhập chưa?
            ?>
            <div id="admin-heading-panel">
                <div class="container">
                    <div class="left-panel">
                      <p> Xin chào <span>Admin !</span></p> 
                    </div>
                    <div class="center_panel">
                        ADMIN
                    </div>
                    <div class="right-panel">
                        <img height="24" src="../image/home.png" />
                        <a href="../index.php">Trang chủ</a>
                        <img height="24" src="../image/logout.png" />
                        <a href="../logout.php">Đăng xuất</a>
                    </div>
                </div>
            </div>
            <!-- <div id="content-wrapper">
                <div class="container">
                    <div class="left-menu">
                        <div class="menu-heading">Admin Menu</div>
                        <div class="menu-items">
                            <ul>
                                <li><a href="#">Cấu hình</a></li>
                                <li><a href="#">Tin tức</a></li>
                                <li><a href="product_listing.php">Sản phẩm</a></li>
                                <li><a href="#">Đơn hàng</a></li>
                            </ul>
                        </div> -->
                    </div>
                    
                <?php 
                include "slider.php";
                    } ?>