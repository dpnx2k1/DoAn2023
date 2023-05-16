<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/34e972a4c1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style_F2.css">
    <title>DPN Store</title>
   <!--Start of Fchat.vn--><script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=645fb5d756498366700fac38" async="async"></script><!--End of Fchat.vn-->
</head>
<?php 
    if (session_id()=='') {
       session_start();
    }
    include "./classF/index_class.php";
    $header= new index;
    $show_category= $header ->show_category_header();
    
?>
<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="image/2.png" alt=""></a>
        </div>
        <div class="menu">
                   <?php 
                        if ($show_category) {
                            while ($result= $show_category->fetch_assoc()) {  
                                $category_id= $result['category_id']; 
                                $show_brand = $header->show_brand($category_id);
                                // if ($show_brand) {
                                //     $resultB=$show_brand->fetch_assoc();                                 
                        ?>
                    <li><a href="category.php"><?php echo $result['category_name']?></a>
                    <ul class="sub-menu">
                <?php  if ($show_brand) {
                            while ($resultB=$show_brand->fetch_assoc()) {                       
                 ?>  
                        <li><a href=<?php echo'category.php?brand_id='.$resultB['brand_id'].'&item_per_page=8&page=1'; ?>><?php echo $resultB['brand_name']?></a></li>      
                <?php }} ?>
                    </ul>
                    </li>
               <?php 
               }}  
               ?>
        </div> 
        
        <!-- <div class="orthe"> -->
            <!-- <li><a class="fa fa-paw"></a></li> -->

            <!-- <li>
                <a href="login.php" class="fa fa-user"></a>
            </li> -->
         <div class="menu2">
            <li><a href="login.php" class="fa fa-user"> </a>
            <?php if(!empty($_SESSION['current_user'])){
                 $currentUser = $_SESSION['current_user'];
                ?>
                <ul class="sub-menu2">
                    <li><a href=""><p style="color: #CC66FF;"> Xin chào <?= $currentUser['fullname']?> !</p></a></li>
                    <li><a style="color: #FF66CC;" href="./user_infor.php">Thông Tin tài Khoản</a></li>
                    <li><a style="color: #66FF00;" href="order_list_user.php">Danh sách đơn hàng</a></li>
                    <li><a style="color: #FF3300;" href="./logout.php">Đăng xuất</a></li>     
                </ul>
            </li>
       
        <?php } ?> 
            <li><a class="fa fa-shopping-bag" href="cart.php"></a></li>
        </div>
    <!-- </div> -->
        
    </header>